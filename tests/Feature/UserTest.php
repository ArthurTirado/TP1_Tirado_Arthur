<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseMigrations;
    
    public function testPostUser()
    {   
        $this->seed();

        $json = ['login' => 'user00', 
        'password' => 'pass123',
        'email' => 'a@a.com', 
        'first_name' => 'user', 
        'last_name' => 'name'
        ];

        $response = $this->postJson('/api/users', $json);
        unset($json['password']);
        $response->assertJsonFragment($json);                                    

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('users', $json);
    }



    public function testPostFilmShouldReturn422WhenInvalidData()
    {   
        $this->seed();

        $json = [
        'password' => 'pass123',
        'email' => 'a@a.com', 
        'first_name' => 'user', 
        'last_name' => 'name'
        ];

        $response = $this->postJson('/api/users', $json);                              

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);      
    }

    public function testUpdateUser()
    {
        $this->seed();
        
        $user = User::first();

        $newData = [
            'login' => 'new_login',
            'password' => 'pass123',
            'email' => 'new_email@example.com',
            'first_name' => 'New',
            'last_name' => 'Name'
        ];

        $response = $this->putJson('/api/users/' . $user->id, $newData);
        unset($newData['password']);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('users', $newData);
    }
    public function testUpdateInvalidUserShouldReturnNotFound()
    {
        $this->seed();
    
        $invalidId = 1000;
    
        $newData = [
            'login' => 'new_login',
            'password' => 'pass123',
            'email' => 'new_email@example.com',
            'first_name' => 'New',
            'last_name' => 'Name'
        ];
    
        $response = $this->putJson('/api/users/' . $invalidId, $newData);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
