<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
	{
		 return view('auth.login');
		 // dd(session()->get('accessToken'));
	}
	public function vendedores(Request $request)
	{
		 return view('usuarios.vendedores');
		
	}
	public function administradores(Request $request)
	{
		 return view('usuarios.administradores');
		
	}
}
