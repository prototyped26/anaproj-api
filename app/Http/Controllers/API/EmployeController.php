<?php

namespace App\Http\Controllers\API;

use App\Models\Employe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeController extends Controller
{
    //
    public function list(Request $request) {
        try {

            $employes = Employe::all();
            $employesReturn = [];

            foreach ($employes as $employe) {
               $employe['profession'] = $employe->profession;
               $employesReturn[] = $employe;
            }

            return response()->json($employesReturn, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'nom' => 'required',
            'profession_id' => 'required'
        ]);
        try {
            $input = $request->all([
                'nom', 'prenom', 'date_naiss',
                'lieu_naiss', 'tel', 'email',
                'residence', 'photo',
                'profession_id'
            ]);


            $employe = new Employe($input);
            $employe->save();

            return response()->json($employe, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required',
            'nom' => 'required',
            'profession_id' => 'required'
        ]);
        try {
            $input = $request->all([
                'nom', 'prenom', 'date_naiss',
                'lieu_naiss', 'tel', 'email',
                'residence', 'photo',
                'profession_id', 'id'
            ]);


            Employe::where('id', '=', $input['id'])->update($input);
            $employe = Employe::find($input['id']);

            return response()->json($employe, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request, $id) {
        try {

            $employe = Employe::destroy($id);

            return response()->json('Object Complete Deleted', 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail(Request $request, $id) {
        try {

            $employe = Employe::find($id);
            $employe['profession'] = $employe->profession;

            return response()->json($employe, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
