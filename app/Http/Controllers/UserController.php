<?php

namespace Encuestas_Carozzi\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function vendedores(Request $request)
	{

		 return view('vendedores.vendedores');
		
	}
	public function administradores(Request $request)
	{
		return view('administradores.administradores');
		
	}
	public function welcome(){
		return view('home');
	}
}
