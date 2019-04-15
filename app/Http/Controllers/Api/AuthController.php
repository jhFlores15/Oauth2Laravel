<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'confirm_password' => 'required|same:password',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error'=>$validator->errors()], 422);
    //     }

    //     $input = $request->all();
    //     $input['password'] = bcrypt($request->get('password'));
    //     $user = User::create($input);
    //     $token =  $user->createToken('MyApp')->accessToken;

    //     return response()->json([
    //         'token' => $token,
    //         'user' => $user
    //     ], 200);
    // }

    // public function login(Request $request)
    // {
    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         $user = Auth::user();
    //         $token =  $user->createToken('MyApp')->accessToken;
    //         return response()->json([
    //             'token' => $token,
    //             'user' => $user
    //         ], 200);
    //     } else {
    //         return response()->json(['error' => 'Unauthorised'], 401);
    //     }
    // }
    // public function profile()
    // {
    //     $user = Auth::user();
    //     return response()->json(compact('user'), 200);
    // }



    public function signup(Request $request)
	{
    
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

	    $user = new User([
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

	    $user->save();
	    
	    return response()->json([
	       'user' => $user
	    ], 201);
	}

	public function login(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
		
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }

	    $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
        ]);
	}

	 public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 
            'Successfully logged out']);
    }
	
}
