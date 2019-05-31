<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Rol;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
   
    public function signup(Request $request) //solo administrador
	{
    
        $validator = Validator::make($request->all(), [
            'razon_social' => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required',
            'codigo' => 'numeric|unique:users',
            'rut' => 'required|numeric|unique:users',
            'dv' => 'required',
            'rol_id' =>'exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $user = new User();
        $user->razon_social = $request->get('razon_social');
        $user->email = $request->get('email');
        $user->password =bcrypt($request->get('password'));
        $user->password_visible = $request->get('password');
        $user->codigo = $request->get('codigo');
        $user->rut = $request->get('rut');
        $user->dv = $request->get('dv');
        ////////////////validar entrada rol, admin o vendedor///////////////////
        if($request->get('tipo_usuario') == 'Administrador'){
            $rol = \App\Rol::all()->where('nombre','==','Administrador')->first();

        }
        else{
            $rol = \App\Rol::all()->where('nombre','!=','Administrador')->first();
        }
        $user->rol()->associate($rol);
	    $user->save();
	    
	    return response()->json('ok');
	}

	public function login(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'email'       => 'required|string|email',
            'password'    => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
		
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Los Datos ingresados no son correctos'], 401);
        }

	    $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'rol_id' => $user->rol_id,
        ]);
	}

    public function update(Request $request, $id){ //solo administrador
        $validator = Validator::make($request->all(), [
            'razon_social' => 'required|max:255|string',
            'email'    => 'required|string|email|unique:users,email,'.$id,
            'password' => 'required',
            'codigo' => 'numeric|unique:users,codigo,'.$id,
            'rut' => 'required|numeric|unique:users,rut,'.$id,
            'dv' => 'required|numeric',
            'rol_id' =>'exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $user = \App\User::findOrFail($id);
        $user->razon_social = $request->get('razon_social');
        $user->email = $request->get('email');
        $user->password =bcrypt($request->get('password'));
        $user->password_visible = $request->get('password');        
        if($request->get('codigo')){
            $user->codigo = $request->get('codigo');
        }
        $user->rut = $request->get('rut');
        $user->dv = $request->get('dv');
        if($request->get('rol_id')){
            if($user->rol_id !== $request->get('rol_id')){
                $user->rol()->dissociate();
                $rol = \App\Rol::findOrFail($request->get('rol_id'));
                $user->rol()->associate($rol);
            }
        }
        $user->save();
        return response()->json('ok'); 
    }

	 public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 
            'Successfully logged out']);
    }
	
}
