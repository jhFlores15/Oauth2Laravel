<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\User as UserResource;
use Carbon\Carbon;

class UserController extends Controller
{
	///poner policy en cada una de las funciones verificando que sean administradores los que hacen las peticiones
     public function administradores(){

     	$administradores = UserResource::collection(User::all())->where('rol.nombre','==','Administrador');       
        return response()->json($administradores); 
    }
    public function vendedores(){
        $vendedores = UserResource::collection(User::all())->where('rol.nombre','!=','Administrador');       
        return response()->json($vendedores); 
    }

    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
        $user->delete();
        return 'ok';
    } 

}
