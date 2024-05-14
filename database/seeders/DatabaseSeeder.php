<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Movie;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DirectorSeeder;
use Database\Seeders\ActorSeeder;
use Database\Seeders\MovieSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call(
            [
                DirectorSeeder::class,
                ActorSeeder::class,
                MovieSeeder::class,
            ]
            );
    }
}
