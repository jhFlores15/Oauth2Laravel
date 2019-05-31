<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;

class TipoProductoController extends Controller
{
     public function index()
    {
        $tipo_encuestas = \Encuestas_Carozzi\Tipo_Producto::all();
        return $tipo_encuestas;
    }
}
