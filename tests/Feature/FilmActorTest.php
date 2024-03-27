<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Film;
use App\Models\Actor;
use Symfony\Component\HttpFoundation\Response;

class FilmActorTest extends TestCase
{
    use DatabaseMigrations;
    public function testGetActorsForFilm()
    {
        $this->seed();
        $film = Film::first();

        $actors = Actor::factory(5)->create();
        $film->actors()->attach($actors);

        $response = $this->get('/api/films/' . $film->id . '/actors');

        foreach ($actors as $actor) {
            $response->assertJsonFragment(['last_name' => $actor->last_name,
                                            'first_name' => $actor->first_name,
                                            'birthdate' => $actor->birthdate]);
        }

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testGetActorsForNonexistentFilm()
    {
        $invalidFilmId = 10000;
        $response = $this->get('/api/films/' . $invalidFilmId . '/actors');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testGetActorForFilm()
    {
        $this->seed();
        $film = Film::first();
        $actor =  $film->actors()->first();

        $response = $this->get('/api/films/' . $film->id . '/actors/' . $actor->id);

        $response->assertJsonFragment([
            'last_name' => $actor->last_name,
            'first_name' => $actor->first_name,
            'birthdate' => $actor->birthdate
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testGetActorForNonexistentFilm()
    {
        $invalidFilmId = 10000;
        $actorId = 1;
        $response = $this->get('/api/films/' . $invalidFilmId . '/actors/' . $actorId);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testGetNonexistentActorForFilm()
    {
        $this->seed();
        $film = Film::first();
        $invalidActorId = 10000;
        $response = $this->get('/api/films/' . $film->id . '/actors/' . $invalidActorId);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
