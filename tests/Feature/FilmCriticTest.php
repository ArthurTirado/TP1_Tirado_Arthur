<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Film;
use App\Models\Critic;
use Symfony\Component\HttpFoundation\Response;

class FilmCriticTest extends TestCase
{
    use DatabaseMigrations;
    public function testGetFilmCriticsForFilm()
    {
        $this->seed();
        $film = Film::first();

        $critics = Critic::factory(5)->create(['film_id' => $film->id]);

        $response = $this->get('/api/films/' . $film->id . '/critics');

        foreach ($critics as $critic) {
            $response->assertJsonFragment([
                'user_id' => $critic->user_id,
                'film_id' => $critic->film_id,
                'comment' => $critic->comment,
            ]);
        }

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testGetFilmCriticsForNonexistentFilm()
    {
        $invalidFilmId = 10000;
        $response = $this->get('/api/films/' . $invalidFilmId . '/critics');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

   
}
