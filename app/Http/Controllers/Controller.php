<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

define("FILMS_PAGINATION",10);
define("FILMS_SEARCH_PAGINATION",10);
/** * @OA\Info(title="Films API", version="0.1") */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
