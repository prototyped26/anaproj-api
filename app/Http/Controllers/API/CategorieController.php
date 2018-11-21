<?php

namespace App\Http\Controllers\API;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorieController extends Controller
{
    //
    public function list(Request $request) {
        try {

            $categories = Categorie::all();

            return response()->json($categories, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'label' => 'required',
            'couleur' => 'required'
        ]);
        try {
            $input = $request->all([
                'label', 'couleur'
            ]);


            $categorie = new Categorie($input);
            $categorie->save();

            return response()->json($categorie, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'label' => 'required',
            'couleur' => 'required',
            'id' => 'required',
        ]);
        try {
            $input = $request->all([
                'label', 'couleur', 'id'
            ]);


            Categorie::where('id', '=', $input['id'])->update($input);
            $categorie = Categorie::find($input['id']);

            return response()->json($categorie, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request, $id) {
        try {

            $categorie = Categorie::destroy($id);

            return response()->json('Object Complete Deleted', 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail(Request $request, $id) {
        try {

            $categorie = Categorie::find($id);

            return response()->json($categorie, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
