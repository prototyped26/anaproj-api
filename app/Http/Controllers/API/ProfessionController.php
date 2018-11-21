<?php

namespace App\Http\Controllers\API;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfessionController extends Controller
{
    //
    public function list(Request $request) {
        try {

            $professions = Profession::all();

            return response()->json($professions, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'label' => 'required',
        ]);
        try {
            $input = $request->all([
                'label', 'description', 'code',
            ]);


            $profession = new Profession($input);
            $profession->save();

            return response()->json($profession, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required',
            'label' => 'required',
        ]);
        try {
            $input = $request->all([
                'label', 'description', 'code', 'id'
            ]);


            Profession::where('id', '=', $input['id'])->update($input);
            $profession = Profession::find($input['id']);

            return response()->json($profession, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request, $id) {
        try {

            $profession = Profession::destroy($id);

            return response()->json('Object Complete Deleted', 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail(Request $request, $id) {
        try {

            $profession = Profession::find($id);

            return response()->json($profession, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
