<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Movie;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directors = Director::all();
        $directors = $directors->map(function ($director) {
            return [
                'name' => $director->name,
                'num_director' => $director->num_director
            ];
        });
        return response()->json($directors,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $uuid = Uuid::uuid4();
        $director = new Director();
        $director->name = $request->name;
        $director->num_director = $uuid;
        $director->save();
        return response()->json($director,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $director = Director::where('num_director',$id)->firstOrFail();
        $filmsProductByDirector = Movie::where('num_director',$id)->get();
        $directorWithFilmsTheyProduced = [
            'name' => $director->name,
            'num_director' => $director->num_director,
            'films' => $filmsProductByDirector->map(function ($movie) {
                return [
                    'name'=>$movie->name,
                    'num_movie'=>$movie->num_movie
                ];
            }),
        ];
        return response()->json($directorWithFilmsTheyProduced,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $director = Director::where('num_director',$id)->firstOrFail();
        $director->name = $request->input('name');
        $director->save();
        return response()->json($director,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $director = Director::where('num_director',$id)->firstOrFail();
        $director->delete();
        return response()->json(null,204);
    }
}
