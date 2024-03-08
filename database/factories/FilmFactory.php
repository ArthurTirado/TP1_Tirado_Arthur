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
            'login' => $faker->text(10),
            'release_year' => $faker->year,
            'length' => $faker->numberBetween(60, 240),
            'description' => $faker->text,
            'rating' => $faker->randomFloat(1, 1, 10),
            'language_id' => Language::factory(),
            'special_features' => $faker->text,
            'image' => $faker->imageUrl(),
        ];
    }
}
