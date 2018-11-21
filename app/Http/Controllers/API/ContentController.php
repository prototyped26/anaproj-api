<?php

namespace App\Http\Controllers\API;

use App\Models\Contenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    //
    public function list(Request $request) {
        try {

            $contenus = Contenu::whereRaw('1')->orderBy('id', 'desc')->get();
            $contenusReturn = [];
            foreach ($contenus as $contenu) {
                $contenu['type'] = $contenu->type;
                $contenusReturn[] = $contenu;
            }


            return response()->json($contenusReturn, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function listByType(Request $request, $type) {
        try {

            $contenus = Contenu::where('type_id', '=', $type)->where('active', '=', 1)->orderBy('id', 'desc')->get();
            $contenusReturn = [];
            foreach ($contenus as $contenu) {
                $contenu['type'] = $contenu->type;
                $contenusReturn[] = $contenu;
            }


            return response()->json($contenusReturn, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'titre' => 'required',
            'lien' => 'required',
            'titre_en' => 'required',
            'description' => 'required',
            'content' => 'required',
            'content_en' => 'required',
            'type_id' => 'required'
        ]);
        try {
            $input = $request->all([
                'titre', 'titre_en', 'lien', 'description', 'content','content_en', 'image', 'active', 'type_id'
            ]);


            $contenu = new Contenu($input);
            $contenu->save();

            return response()->json($contenu, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'titre' => 'required',
            'lien' => 'required',
            'titre_en' => 'required',
            'description' => 'required',
            'content' => 'required',
            'content_en' => 'required',
            'type_id' => 'required',
            'id' => 'required'
        ]);
        try {
            $input = $request->all([
                'id', 'titre', 'titre_en', 'lien', 'description', 'content','content_en', 'image', 'active', 'type_id'
            ]);


            Contenu::where('id', '=', $input['id'])->update($input);
            $contenu = Contenu::find($input['id']);
            $contenu['type'] = $contenu->type;

            return response()->json($contenu, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request, $id) {
        try {

            $contenu = Contenu::destroy($id);

            return response()->json('Object Complete Deleted', 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail(Request $request, $id) {
        try {

            $contenu = Contenu::find($id);
            $contenu['type'] = $contenu->type;

            return response()->json($contenu, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function contenuByLink(Request $request, $link) {
        try {

            $contenu = Contenu::where('lien', '=', $link)->get();
            if (sizeof($contenu) > 0) {
                $contenu = Contenu::find($contenu[0]->id);
                $contenu['type'] = $contenu->type;
            }


            return response()->json($contenu, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
