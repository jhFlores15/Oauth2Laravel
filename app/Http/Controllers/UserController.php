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
	public function pepe(Request $request)
	{
		 return view('pepe');
		
	}
}
