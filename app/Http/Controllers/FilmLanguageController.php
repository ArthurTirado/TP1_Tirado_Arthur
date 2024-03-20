<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Language;
use App\Http\Resources\FilmResource;
use Symfony\Component\HttpFoundation\Response;

class FilmLanguageController extends Controller
{
    public function show($id, $filmId)
    {
        try
        {
            $language = Language::findOrFail($id);
            return (new FilmResource($language->films[$filmId-1]))->response()->setStatusCode(200);
            
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
            $language = Language::findOrFail($id);
            return FilmResource::collection($language->films)->response()->setStatusCode(200);    
        }
        catch(Exception $ex)
        {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function destroy($id)
    {
        try{
            $film = Film::findOrFail($id);
            $film->delete();
            return response()->noContent();
        }
        catch(Exception $ex){
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
}
