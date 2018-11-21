<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    public function list(Request $request) {
        try {

            $posts = Post::whereRaw('1')->orderBy('id', 'desc')->get();
            $postsReturn = [];

            foreach ($posts as $post) {
                $post['categorie'] = $post->categorie;
                $post['user'] = $post->user;
                $postsReturn[] = $post;
            }

            return response()->json($postsReturn, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'titre' => 'required',
            'message' => 'required',
            'user_id' => 'required',
            'categorie_id' => 'required'
        ]);
        try {
            $input = $request->all([
                'titre', 'message', 'user_id', 'categorie_id'
            ]);


            $post = new Post($input);
            $post->save();

            return response()->json($post, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'titre' => 'required',
            'message' => 'required',
            'user_id' => 'required',
            'categorie_id' => 'required',
            'id' => 'required',
        ]);
        try {
            $input = $request->all([
                'titre', 'message', 'user_id', 'categorie_id', 'id'
            ]);


            Post::where('id', '=', $input['id'])->update($input);
            $post = Post::find($input['id']);
            $post['categorie'] = $post->categorie;
            $post['user'] = $post->user;

            return response()->json($post, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request, $id) {
        try {

            $post = Post::destroy($id);

            return response()->json('Object Complete Deleted', 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail(Request $request, $id) {
        try {

            $post = Post::find($id);
            $post['categorie'] = $post->categorie;
            $post['user'] = $post->user;

            return response()->json($post, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
