<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

use App\Models\Language;

class LanguageFactory extends Factory
{
    public function definition(): array
    {
        $faker = Faker::create();

        return [
            'name' => $faker->word,
        ];
    }
}
