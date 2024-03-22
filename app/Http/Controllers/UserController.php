<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Language;
use App\Models\Film;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest; 
use App\Http\Requests\UpdateUserRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function store(StoreUserRequest $request){
        try{
            $user = User::create($request->validated());
            return (new UserResource($user))->response()->setStatusCode(201);
        }
        catch(Exception $ex){
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(UpdateUserRequest $request, $id){
        try {
            $user = new UserResource(User::findOrFail($id));
            $user->update($request->validated());
            return (new UserResource($user))->response()->setStatusCode(200);
        } 
        catch (Exception $ex) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function favoriteLanguage($id)
    {
        try {
            $user = User::findOrFail($id);
    
            $films = $user->critics()->with('film')->get();

            $languageCounts = [];

            foreach ($films as $film) {
                $languageId = $film->film->language->id;
                if (!isset($languageCounts[$languageId])) {
                    $languageCounts[$languageId] = 0;
                }
                $languageCounts[$languageId]++;
    }

            arsort($languageCounts);

            if (empty($languageCounts)) {
                $favoriteLanguage = 'No reviews';
            } else {
                $favoriteLanguageId = array_key_first($languageCounts);

                $favoriteLanguage = Language::findOrFail($favoriteLanguageId)->name;
            }
            return response()->json(['favorite_language' => $favoriteLanguage])->setStatusCode(Response::HTTP_OK);
        }
        
        catch (Exception $ex) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
