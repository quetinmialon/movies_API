<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actors = Actor::all();
        $actors = $actors->map(function ($actor) {
            return [
                'name' => $actor->name,
                'num_actors' => $actor->num_actor
            ];
        });
        return response()->json($actors,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $uuid = Uuid::uuid4();
        $actor = new Actor();
        $actor->name = $request->name;
        $actor->num_actor = $uuid;
        $actor->save();
        return response()->json($actor,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $actor = Actor::where('num_actor',$id)->firstOrFail();
        $filmsWhereActorIs = $actor->movies;

        $actorsWithThereFilm = [
            'name'=>$actor->name,
            'num_actors'=>$actor->num_actor,
            'films'=>$filmsWhereActorIs->map(function ($movie) {
                return [
                    'name'=>$movie->name,
                    'num_movie'=>$movie->num_movie
                ];
            })
        ];
        return response()->json($actorsWithThereFilm,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $actor = Actor::where('num_actor',$id)->firstOrFail();
        $actor->name = $request->input('name');
        $actor->save();
        return response()->json($actor,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $actor = Actor::where('num_actor',$id)->firstOrFail();
        $actor->delete();
        return response()->json(null,204);
    }
}
