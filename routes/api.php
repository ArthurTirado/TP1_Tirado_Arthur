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

Route::get('/films','App\Http\Controllers\FilmController@index');
Route::get('/films/{id}','App\Http\Controllers\FilmController@show');

Route::get('/languages','App\Http\Controllers\LanguageController@index');
Route::get('/languages/{id}','App\Http\Controllers\LanguageController@show');
Route::get('/languages/{id}/averageRentalRate','App\Http\Controllers\FilmController@averageRentalRate');
Route::get('/languages/{id}/films/','App\Http\Controllers\FilmLanguageController@index');
Route::get('/languages/{id}/films/{filmId}','App\Http\Controllers\FilmLanguageController@show');

Route::post('/films','App\Http\Controllers\FilmController@store');
Route::delete('/films/{id}','App\Http\Controllers\FilmLanguageController@destroy');