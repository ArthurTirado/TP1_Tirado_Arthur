<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Critic;
use App\Models\Film;
use App\Http\Resources\CriticResource;

class FilmCriticController extends Controller
{
    public function show($id, $criticId)
    {
        try
        {
            $film = Film::findOrFail($id);
            return (new CriticResource($film->critics[$criticId-1]))->response()->setStatusCode(200);
            
        }
        catch(Exception $ex)
        {
            abort(500, 'Server error');
        }
    }
    public function index($id)
    {
        try
        {
            $film = Film::findOrFail($id);
            return CriticResource::collection($film->critics)->response()->setStatusCode(200);    
        }
        catch(Exception $ex)
        {
            abort(500, 'Server error');
        }
    }
}
