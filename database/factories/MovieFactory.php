<?php

namespace Database\Factories;

use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use PHPUnit\Event\Telemetry\Duration;
use Ramsey\Uuid\Type\Integer;
use Ramsey\Uuid\Type\Time;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'num_movie'=>fake()->uuid(),
            'name'=>fake()->sentence(3),
            'synopsis'=>fake()->text(50),
            'duration'=>fake()->time("h:i:s",20),
            'release'=>fake()->dateTime(),
        ];
    }
}
