<?php

namespace Encuestas_Carozzi\Http\Controllers;

use Illuminate\Http\Request;

class ComunaController extends Controller
{
     public function index()
    {
        return view('comunas.comunas');
    }
}
