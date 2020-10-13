<?php

namespace App\Http\Controllers;

use App\Cases\Fast\Insert;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FastInsertController extends Controller
{
    public function insert(Request $request)
    {
        $insert = new Insert();
        $attendance = $insert->action($request->all());
        return new Response($attendance, Response::HTTP_CREATED);
    }
}
