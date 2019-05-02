<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    public function index()
    {
        return view('encuestas.index');
    }
     public function create()
    {
        return view('encuestas.create');
    }
     public function show()
    {
        return view('encuestas.index');
    }
}
