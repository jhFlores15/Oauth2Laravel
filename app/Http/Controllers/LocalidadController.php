<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalidadController extends Controller
{
     public function index()
    {
        return view('localidades.localidades');
    }
}
