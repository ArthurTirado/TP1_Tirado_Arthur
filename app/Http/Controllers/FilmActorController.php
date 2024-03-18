<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\Film;
use App\Http\Resources\ActorResource;
class FilmActorController extends Controller
{
    public function show($id, $actorId)
    {
        try
        {
            $film = Film::findOrFail($id);
            return (new ActorResource($film->actors[$actorId-1]))->response()->setStatusCode(200);
            
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
            return ActorResource::collection($film->actors)->response()->setStatusCode(200);    
        }
        catch(Exception $ex)
        {
            abort(500, 'Server error');
        }
    }
}
