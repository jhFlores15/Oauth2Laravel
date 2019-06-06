<?php

namespace Encuestas_Carozzi\Http\Controllers;

use Illuminate\Http\Request;

class AutorizadorController extends Controller
{
    public function index()
    {
        return view('autorizadores.index');
    }
}
