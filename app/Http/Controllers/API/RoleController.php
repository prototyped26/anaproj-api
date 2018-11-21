<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //
    public function list(Request $request) {
        try {

            $roles = Role::all();

            return response()->json($roles, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'label' => 'required',
        ]);
        try {
            $input = $request->all(['label', 'description']);


            $role = new Role($input);
            $role->save();

            return response()->json($role, 200);

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
            $input = $request->all(['label', 'id', 'description']);


            Role::where('id', '=', $input['id'])->update($input);
            $role = Role::find($input['id']);

            return response()->json($role, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request, $id) {
        try {

            $role = Role::destroy($id);

            return response()->json('Object Complete Deleted', 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail(Request $request, $id) {
        try {

            $role = Role::find($id);
            $role['anonymat'] = $role->anonymat;
            $role['matiere'] = $role->matiere;

            return response()->json($role, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
