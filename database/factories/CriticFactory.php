<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

use App\Models\Critic;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Critic>
 */
class CriticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $faker = Faker::create();
        return [
            'login'=> $faker->text(10),
            'password'=> $faker->text(10),
            'email'=> $faker->text(10),
            'last_name'=> $faker->text(10),
            'first_name'=> $faker->text(10),
        ];
    }
}
