<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $movies = Movie::all();
        $movies = $movies->map(function ($movie) {
            return [
                'name' => $movie->name,
                'duration' => $movie->duration,
                'synopsis' => $movie->synopsis,
                'release' => $movie->release,
                'num_movie' => $movie->num_movie,

            ];
        });
        return response()->json($movies, 200);   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $uuid = Uuid::uuid4();
        $movie = new Movie();
        $movie->name = $request->input('name');
        $movie->duration = $request->input('duration');
        $movie->synopsis = $request->input('synopsis');
        $movie->release = $request->input('release');
        $movie->num_movie = $uuid;
        $movie->num_director = $request->input('num_director');
        $movie->save();

        $actorsInMovie = $request->input('actorsInMovie')->toArray();

        foreach ($actorsInMovie as $actorInMovie) {
            $movie->actors()->attach($actorInMovie['num_actor']);
        }


        return response()->json($movie,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::where('num_movie', $id)->firstOrFail();
        $actors = $movie->actors;   
        $movie = [
            'name' => $movie->name,
            'duration' => $movie->duration,
           'synopsis' => $movie->synopsis,
           'release' => $movie->release,
           'num_movie'=>$movie->num_movie,
            'num_director' => $movie->num_director,
            'actors' => $actors,
        ];
        return response()->json($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->name = $request->input('name');
        $movie->duration = $request->input('duration');
        $movie->synopsis = $request->input('synopsis');
        $movie->release = $request->input('release');
        $movie->num_director = $request->input('num_director');
        $actorIds = $request->input('actors')->toArray();
        $movie->actors()->sync($actorIds);
        $movie->save();
    
        return response()->json($movie, 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return response()->json(null, 204);
    }
}
