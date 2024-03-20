<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Critic;

class CriticController extends Controller
{
    public function destroy($id)
    {
        try{
            $critic = Critic::findOrFail($id);
            $critic->delete();
            return response()->noContent();
        }
        catch(Exception $ex){
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
}
