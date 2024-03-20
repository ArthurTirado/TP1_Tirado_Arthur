<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Resources\FilmResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreFilmRequest; 
use Symfony\Component\HttpFoundation\Response;
class FilmController extends Controller
{
    public function show($id)
    {
        try{
            return (new FilmResource(Film::findOrFail($id)))->response()->setStatusCode(200);
        }
    
        catch(Exception $ex)
        {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function index()
    {
        try{
            return FilmResource::collection(Film::paginate(10))->response()->setStatusCode(200);
        }
    
        catch(Exception $ex)
        {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function store(StoreFilmRequest $request){
        try{
            $film = Film::create($request->validated());
            return (new FilmResource($film))->response()->setStatusCode(201);
        }
        catch(Exception $ex){
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function averageRentalRate($language_id)
    {
        try {
            $avg = Film::where('language_id', $language_id)->avg('rental_rate');
            return response()->json(['average_rental_rate' => $avg])->setStatusCode(200);
        } 
        
        catch (Exception $ex) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
