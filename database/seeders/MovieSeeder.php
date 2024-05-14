<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directors = Director::all();
        $movies = Movie::factory(250)->sequence(fn($sequence)=>['num_director'=>$directors->random()])->create();
        foreach($movies as $movie){
            $numberOfActors = rand(1,25);
            $actors = Actor::inRandomOrder()->limit($numberOfActors)->get();
            $movie->actors()->attach($actors);
        }
    }
}
