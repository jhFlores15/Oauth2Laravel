<?php

namespace Encuestas_Carozzi\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //  public function postLogin(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email'       => 'required|string|email',
    //         'password'    => 'required|string',
    //     ]);


    //     if ($validator->fails()) {
    //         return response()->json(['error'=>$validator->errors()], 422);
    //     }
		
    //     $credentials = request(['email', 'password']);
    //     if (!Auth::attempt($credentials)) {
    //         return response()->json([
    //             'message' => 'Los Datos ingresados no son correctos'], 401);
    //     }
    //     return response()->json(auth()->user());
    // }

    // public function logOut()
    // {
    //     Auth::logout();
    //     return Redirect::to('home');
    // }

}
