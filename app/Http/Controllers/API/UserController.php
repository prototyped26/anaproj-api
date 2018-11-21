<?php

namespace App\Http\Controllers\API;

use App\Mail\EmailReset;
use App\Models\UserPassword;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\EmailRest;
use Lcobucci\JWT\Parser;

class UserController extends Controller
{
    //
    public $publicSuccessStatus = 200;


    public function login(Request $request) {
        if( Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = Auth::user();
            $token= $user->createToken('TutsForWeb')->accessToken;

            return response()->json(['token' => $token], $this->publicSuccessStatus);
        } else {
            return response()->json(['error'=>'Erro de login et/ou mot de passe !'], 400);
        }
    }

    public function logout(Request $request) {
        try {
            $value = $request->bearerToken();
            $id = (new Parser())->parse($value)->getHeader('jti');
            //return response()->json($request->user()->tokens->find($id), 200);
            $token = $request->user()->tokens->find($id);
            $token->revoke();

            return response()->json(['message' => 'success'], 200);
        }catch (QueryException $e) {
            return response()->json(['' . $e->getMessage()], 400);
        }

    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'role_id' => 'required'
        ]);

        try{
            $input = $request->all(['name', 'email', 'password', 'role_id']);
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);

            return response()->json($user, 200);
        }catch (QueryException $e) {
            $messageError = '';
            if ($e->errorInfo['1'] == 1062) {
                $messageError = "User already exist please change informations and retry !";
            } else {
                $messageError = $e->getMessage();
            }


            return response()->json(['error'=> $messageError], 500);
        }

    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'role_id' => 'required'
        ]);
        try {
            $input = $request->all(['name', 'email', 'password', 'role_id', 'id']);
            $input['password'] = bcrypt($input['password']);

            User::where('id', '=', $input['id'])->update($input);
            $user = User::find($input['id']);

            return response()->json($user, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function update2(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required'
        ]);
        try {
            $input = $request->all(['name', 'email', 'img', 'role_id', 'id']);


            User::where('id', '=', $input['id'])->update($input);
            $user = User::find($input['id']);

            return response()->json($user, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function list(Request $request) {
        try {

            $users = User::all();
            $usersReturn = [];

            foreach ($users as $user) {
                $user['role'] = $user->role;
                $usersReturn[] = $user;
            }

            return response()->json($usersReturn, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail(Request $request, $id) {
        try {

            $user = User::find($id);
            $user['role'] = $user->role;

            return response()->json($user, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function register2(Request $request) {
        $request->validate([
            'password' => 'required',
            'c_password' => 'required|same:password',
            'token' => 'required'
        ]);

        $input = $request->all();
        $userPassword = UserPassword::where('token', '=',  $input['token'])->where('status', '=', 1)->get();
        if ( sizeof($userPassword) > 0) {
            $user = User::where('email', '=', $userPassword[0]->email)->get();

            $user = $user[0];
            $user->password = bcrypt($input['password']);
            $user->save();

            return response()->json(['success' => 'Password Reset'], 200);

        } else {
            return response()->json(['error'=> 'The entered email address is not available'], 400);
        }
        return response()->json(['error'=> 'An error has occurred'], 400);
    }

    public function resetPassword(Request $request) {
        $input = $request->all();

        $user = User::where('email', '=',  $input['email'])->get();

        if ( sizeof($user) > 0) {

            $resetPassword = new UserPassword();
            //return response()->json(['data'=>  $resetPassword], 300);
            $resetPassword->email = $user[0]->email;
            $resetPassword->token = Str::random(60);
            $resetPassword->life_cycle = 7200;
            $resetPassword->send_date = date("Y-m-d H:i:s");

            Mail::send(new EmailReset($user[0], $resetPassword->token));

            $resetPassword->save();

            return response()->json(['success' => 'If the email you specified exists in our system, we\'ve sent a password reset link to it.'], 200);

        } else {
            return response()->json(['error'=> 'The entered email address is not available'], 400);
        }

        return response()->json(['error'=> 'An error has occurred'], 400);
    }

    public function getTokenReset(Request $request) {
        $input = $request->all();

        $userPassword = UserPassword::where('token', '=',  $input['token'])->where('status', '=', 0)->get();
        if ( sizeof($userPassword) > 0) {
            $userPassword = $userPassword[0];
            $userPassword->status = 1;
            $userPassword->save();

            return response()->json(['success' => 'Insert your new password'], 200);

        } else {
            return response()->json(['error'=> 'The entered email address is not available'], 400);
        }

        return response()->json(['error'=> 'An error has occurred'], 400);
    }

    public function editInformations(Request $request) {
        $input = $request->all();

        try{
            $id= $input['id'];

            $user = new User();
            $user = $user->updateInformation($id, $input);

            return response()->json(['success'=> $user], 200);
        }catch (QueryException $e) {
            $messageError = '';

            return response()->json(['error'=> $e->getMessage()], 400);
        }

        return response()->json(['error'=> 'An error has occurred'], 400);
    }
    /**
     * @param $file
     * @return array|bool
     */
    public function uploadFile($file, $configPath)
    {
        if ($file != null) {
            if ($file->isValid()) {
                $chemin = config($configPath);
                $extension = $file->getClientOriginalExtension();
                $name = $file->getClientOriginalName();
                $taille = $file->getSize();
                do {
                    $nom = str_random(10) . '.' . $extension;
                } while (file_exists($chemin . '/' . $nom));
                if ($file->move($chemin, $nom)) {
                    $chemin = '/' . $chemin . '/' . $nom ;
                    return compact('chemin', 'extension', 'taille', 'name');
                }
            }
        }
        return false;
    }
}
