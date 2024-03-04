<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Resources\LanguageResource;

class LanguageController extends Controller
{
    public function show($id)
    {
        try{
            return (new LanguageResource(Language::find($id)))->response()->setStatusCode(200);
        }
        catch(Exception $ex)
        {
            abort(500, 'Server error');
        }
    }
    public function index()
    {
        try{
            return LanguageResource::collection(Language::paginate(10))->response()->setStatusCode(200);
        }
        
        catch(Exception $ex)
        {
            abort(500, 'Server error');
        }
    }
}
