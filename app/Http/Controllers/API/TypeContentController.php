<?php

namespace App\Http\Controllers\API;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeContentController extends Controller
{
    //
    public function list(Request $request) {
        try {

            $types = Type::all();
            $typesReturn = [];


            return response()->json($types, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'label' => 'required'
        ]);
        try {
            $input = $request->all([
                'label', 'description'
            ]);


            $type = new Type($input);
            $type->save();

            return response()->json($type, 200);

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
                'label', 'description', 'id'
            ]);


            Type::where('id', '=', $input['id'])->update($input);
            $type = Type::find($input['id']);

            return response()->json($type, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request, $id) {
        try {

            $type = Type::destroy($id);

            return response()->json('Object Complete Deleted', 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail(Request $request, $id) {
        try {

            $type = Type::find($id);

            return response()->json($type, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}

