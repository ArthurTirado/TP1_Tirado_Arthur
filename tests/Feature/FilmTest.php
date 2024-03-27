<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Film;
use Symfony\Component\HttpFoundation\Response;

class FilmTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseMigrations;
    public function testGetFilms()
    {
        $this->seed();
        $films = Film::all();
        
        $response = $this->get('/api/films');

        $response->assertJsonCount(FILMS_PAGINATION, "data");
        
        for($i = 0 ; $i < FILMS_PAGINATION; $i++)
        {
            $response->assertJsonFragment(['title' => $films[$i]->title, 
                                            'release_year' => $films[$i]->release_year,
                                            'length' => $films[$i]->length, 
                                            'description' => $films[$i]->description, 
                                            'rating' => $films[$i]->rating,
                                            'language_id' => $films[$i]->language_id,
                                            'special_features' => $films[$i]->special_features,
                                            'image' => $films[$i]->image
                                        ]);
        }       
        
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testGetFilmById()
    {
        $ID_TO_FIND = 1;
        
        $this->seed();

        $film = Film::find($ID_TO_FIND);
        
        $response = $this->get('/api/films/'.$ID_TO_FIND);        
        
                    $response->assertJsonFragment(['title' => $film->title, 
                                            'release_year' => $film->release_year,
                                            'length' => $film->length, 
                                            'description' => $film->description, 
                                            'rating' => $film->rating,
                                            'language_id' => $film->language_id,
                                            'special_features' => $film->special_features,
                                            'image' => $film->image
                                        ]);
        
        $response->assertStatus(Response::HTTP_OK);
    }

   public function testGetFilmByIdShouldReturn404WhenInvalidId()
    {
        $INVALID_ID = 10000;
        $this->seed();

        $response = $this->get('/api/films/'.$INVALID_ID);        
        
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testPostFilm()
    {   
        $this->seed();

        $json = ['title' => 'a movie', 
        'release_year' => 2001,
        'length' => 120, 
        'description' => 'cool movie', 
        'rating' => 'G',
        'language_id' => 1,
        'special_features' => 'Trailers',
        'image' => 'image.png'
        ];

        $response = $this->postJson('/api/films', $json);
                
        $response->assertJsonFragment($json);                                    

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('films', $json);
    }

    public function testPostFilmWithMinimalParameters()
    {   
        $this->seed();

        $json = ['title' => 'a minimal movie',         
        'language_id' => 1,   
        ];

        $response = $this->postJson('/api/films', $json);
                
        $response->assertJsonFragment($json);                                    

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('films', $json);
    }


    public function testPostFilmShouldReturn422WhenInvalidData()
    {   
        $this->seed();

        $json = [
        'release_year' => 2001,
        'length' => 120, 
        'description' => 'cool movie', 
        'rating' => 'G',
        'language_id' => 1,
        'special_features' => 'Trailers',
        'image' => 'image.png'
        ];

        $response = $this->postJson('/api/films', $json);                              

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);      
    }

    public function testDeleteFilm()
    {   
        $ID_TO_DELETE = 50;
        $this->seed();

        $response = $this->delete('/api/films/'.$ID_TO_DELETE);                          

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function testDeleteFilmShouldReturn404WhenInvalidId()
    {   
        $INVALID_ID = 5000;
        $this->seed();

        $response = $this->delete('/api/films/'.$INVALID_ID);                          

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
