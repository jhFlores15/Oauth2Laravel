<?php

namespace Encuestas_Carozzi\Http\Controllers;

use Illuminate\Http\Request;

class NotaCreditoController extends Controller
{
     public function create()
    {
        return view('notas_credito.create');
    }
}
