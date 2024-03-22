<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#Route 1
Route::get('/films','App\Http\Controllers\FilmController@index');
Route::get('/films/{id}','App\Http\Controllers\FilmController@show');
#Route 2
Route::get('/films/{id}/actors','App\Http\Controllers\FilmActorController@index');
Route::get('/films/{id}/actors/{actorId}','App\Http\Controllers\FilmActorController@show');
#Route 3
Route::get('/films/{id}/critics','App\Http\Controllers\FilmCriticController@index');
Route::get('/films/{id}/critics/{criticId}','App\Http\Controllers\FilmCriticController@show');
#Route 4
Route::post('/users','App\Http\Controllers\UserController@store');
#Route 5
Route::put('/users/{id}','App\Http\Controllers\UserController@update');
#Route 6
Route::delete('/critics/{id}','App\Http\Controllers\CriticController@destroy');
#Route 7
Route::get('/films/{id}/score','App\Http\Controllers\FilmController@avgScore');
#Route 8
Route::get('/users/{id}/favoriteLanguage','App\Http\Controllers\UserController@favoriteLanguage');

Route::get('/languages','App\Http\Controllers\LanguageController@index');
Route::get('/languages/{id}','App\Http\Controllers\LanguageController@show');
Route::get('/languages/{id}/averageRentalRate','App\Http\Controllers\FilmController@averageRentalRate');
Route::get('/languages/{id}/films/','App\Http\Controllers\FilmLanguageController@index');
Route::get('/languages/{id}/films/{filmId}','App\Http\Controllers\FilmLanguageController@show');

Route::post('/films','App\Http\Controllers\FilmController@store');
Route::delete('/films/{id}','App\Http\Controllers\FilmLanguageController@destroy');