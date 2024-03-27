<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\Film;
use App\Http\Resources\ActorResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class FilmActorController extends Controller

{
    public function show($id, $actorId)
    {
        try
        {
            $film = Film::findOrFail($id);
            $actors = $film->actors;

            if (!isset($actors[$actorId - 1])) {
                throw new NotFoundHttpException("Actor not found for the given film.");
            }

            return (new ActorResource($actors[$actorId - 1]))->response()->setStatusCode(Response::HTTP_OK);
        }
        catch (NotFoundHttpException $ex) 
        {
            abort(Response::HTTP_NOT_FOUND);
        }
        catch(Exception $ex)
        {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
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
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
