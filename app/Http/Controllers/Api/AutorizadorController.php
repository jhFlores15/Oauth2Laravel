<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;

class AutorizadorController extends Controller
{
    public function index(){
    	$autorizadores = \Encuestas_Carozzi\Autorizador::all();
    	return response()->json($autorizadores);
    }
}
