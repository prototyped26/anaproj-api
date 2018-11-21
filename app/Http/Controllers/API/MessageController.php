<?php

namespace App\Http\Controllers\API;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
        //
    public function list(Request $request) {
        try {

            $messages = Message::whereRaw('1')->orderBy('id', 'desc')->get();
            $messagesReturn = [];
            foreach ($messages as $message) {
                $message['user'] = $message->user;
                $messagesReturn[] = $message;
            }


            return response()->json($messagesReturn, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function listByUser(Request $request, $user) {
        try {

            $messages = Message::where('user_id', '=', $user)->orderBy('id', 'desc')->get();
            $messagesReturn = [];
            foreach ($messages as $message) {
                $message['user'] = $message->user;
                $messagesReturn[] = $message;
            }


            return response()->json($messagesReturn, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'label' => 'required',
            'user_id' => 'required'
        ]);
        try {
            $input = $request->all([
                'label', 'user_id'
            ]);


            $message = new Message($input);
            $message->save();
            $message = Message::find($message->id);
            $message['user'] = $message->user;

            return response()->json($message, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'label' => 'required',
            'user_id' => 'required',
            'id' => 'required'
        ]);
        try {
            $input = $request->all([
                'id', 'label', 'user_id'
            ]);


            Message::where('id', '=', $input['id'])->update($input);
            $message = Message::find($input['id']);
            $message['user'] = $message->user;

            return response()->json($message, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request, $id) {
        try {

            $message = Message::destroy($id);

            return response()->json('Object Complete Deleted', 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail(Request $request, $id) {
        try {

            $message = Message::find($id);
            $message['user'] = $message->user;

            return response()->json($message, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
