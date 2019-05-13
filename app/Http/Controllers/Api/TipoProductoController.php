<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoProductoController extends Controller
{
     public function index()
    {
        $tipo_encuestas = \App\Tipo_Producto::all();
        return $tipo_encuestas;
    }
}
