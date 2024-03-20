<?php

namespace Database\Seeders;
use App\Models\Critic;
use App\Models\User;
use App\Models\Film;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FilmSeeder::class,
            LanguagesSeeder::class,
            ActorSeeder::class,
            FilmActorSeeder::class
        ]);
        User::factory(10)->has(Critic::factory(3))->create();
        Film::factory(10)->has(Critic::factory(3))->create();
    }
}
