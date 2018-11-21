<?php

namespace App\Http\Controllers\API;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    //
    public function list(Request $request) {
        try {

            $clients = Client::all();
            $clientsReturn = [];


            return response()->json($clients, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'nom' => 'required',
            'tel' => 'required'
        ]);
        try {
            $input = $request->all([
                'nom', 'prenom', 'tel', 'email',
                'adresse', 'compte'
            ]);


            $client = new Client($input);
            $client->save();

            return response()->json($client, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required',
            'nom' => 'required',
            'tel' => 'required'
        ]);
        try {
            $input = $request->all([
                'nom', 'prenom', 'tel', 'email',
                'adresse', 'compte', 'id'
            ]);


            Client::where('id', '=', $input['id'])->update($input);
            $client = Client::find($input['id']);

            return response()->json($client, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request, $id) {
        try {

            $client = Client::destroy($id);

            return response()->json('Object Complete Deleted', 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail(Request $request, $id) {
        try {

            $client = Client::find($id);

            return response()->json($client, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
