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
            return FilmResource::collection(Film::paginate(FILMS_PAGINATION))->response()->setStatusCode(200);
        }
    
        catch(Exception $ex)
        {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function store(StoreFilmRequest $request){
        try{
            $film = Film::create($request->validated());
            return (new FilmResource($film))->response()->setStatusCode(Response::HTTP_CREATED);
        }
        catch(Exception $ex){
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function avgScore($id)
    {
        try {
            $film = Film::findOrFail($id);
            $avg = $film->critics()->avg('score');
            
            $formattedAvg = !is_null($avg) ? number_format($avg, 1) : 'None';
            
            return response()->json(['average_score' => $formattedAvg])->setStatusCode(Response::HTTP_OK);
        }
        
        catch (Exception $ex) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function filmSearch(Request $request)
    {
    try {
        $query = Film::query();

        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('title', 'like', "%$keyword%");
        }

        if ($request->has('rating')) {
            $rating = $request->input('rating');
            $query->where('rating', $rating);
        }

        if ($request->has('minLength')) {
            $minLength = $request->input('minLength');
            $query->where('length', '>=', $minLength);
        }

        if ($request->has('maxLength')) {
            $maxLength = $request->input('maxLength');
            $query->where('length', '<=', $maxLength);
        }
        $films = $query->paginate(FILMS_SEARCH_PAGINATION);
    return FilmResource::collection($films)->response()->setStatusCode(Response::HTTP_OK);
    } catch (Exception $ex) {
        abort(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

}
