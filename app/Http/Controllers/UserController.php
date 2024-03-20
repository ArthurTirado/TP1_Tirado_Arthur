<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest; 

class UserController extends Controller
{
    public function store(StoreUserRequest $request){
        try{
            $user = User::create($request->validated());
            return (new UserResource($user))->response()->setStatusCode(201);
        }
        catch(Exception $ex){
            abort(500, 'Server error');
        }
    }
}
