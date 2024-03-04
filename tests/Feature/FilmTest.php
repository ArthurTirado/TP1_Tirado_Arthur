<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilmTest extends TestCase
{
    use DatabaseMigrations;

    public function test_Create_film()
    {
        $this->seed();

        $json = ["title" => "abdbsbs",
                "release_year"=> 1999,
                "language_id"=> 1];

        $response = $this->postJson('/api/films', $json);

        $response->assertJsonFragment($json);
        $response->assertStatus(201);
    }
    public function testPostShouldReturn422WhenMissingField()
    {
        $this->seed();

        $json = ['title'=>500, 'release_year'=>1];
        $response = $this->postJson('/api/songs', $json);
        
        $response->assertStatus(INVALID_DATA);
    }
}
