<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoEncuestaController extends Controller
{
    public function index()
    {
        $tipo_encuestas = \App\Tipo_Encuesta::all();
        return $tipo_encuestas;
    }

}
