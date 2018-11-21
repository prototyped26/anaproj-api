<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    //
    public function list(Request $request) {
        try {

            $events = Event::all();

            return response()->json($events, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        try {
            $input = $request->all([
                'title', 'place', 'color', 'color_secondary', 'start', 'end'
            ]);


            $event = new Event($input);
            $event->save();

            return response()->json($event, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        try {
            $input = $request->all([
                'title', 'place', 'color', 'color_secondary', 'start', 'end', 'id'
            ]);


            Event::where('id', '=', $input['id'])->update($input);
            $event = Event::find($input['id']);

            return response()->json($event, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request, $id) {
        try {

            $event = Event::destroy($id);

            return response()->json('Object Complete Deleted', 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function detail(Request $request, $id) {
        try {

            $event = Event::find($id);

            return response()->json($event, 200);

        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
