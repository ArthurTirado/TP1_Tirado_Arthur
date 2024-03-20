<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

use App\Models\Film;
class FilmFactory extends Factory
{
    public function definition(): array
    {
        $faker = Faker::create();

        return [
            'title' => $faker->text(10),
            'release_year' => $faker->year,
            'length' => $faker->numberBetween(60, 240),
            'description' => $faker->text,
            'language_id' => $faker->numberBetween(1,3),
            'image' => $faker->text(10),
        ];
    }
}
