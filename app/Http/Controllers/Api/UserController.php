<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\User as UserResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
	///poner policy en cada una de las funciones verificando que sean administradores los que hacen las peticiones
     public function administradores(){
     	$administradores = UserResource::collection(User::all()->where('rol.nombre','==','Administrador'));  

        return datatables()
            ->resource($administradores)
            ->addColumn('btn','administradores.acciones')
            ->rawColumns(['btn'])
            ->toJson();
        // return response()->json($administradores); 
    }
    public function vendedores(){
        $vendedores = UserResource::collection(User::all()->where('rol.nombre','==','Vendedor'));       
         return datatables()
            ->resource($vendedores)
            ->addColumn('btn','vendedores.acciones')
            ->rawColumns(['btn'])
            ->toJson();
    }
    public function file(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required|file'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        // $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        // $file = $request->file('file');

        if($request->hasFile('file')){
            return response()->json('ok');
        }
        return response()->json('oknno');
        

    }
     public function user($id)
    {
        $user = \App\User::findOrFail($id);
        return response()->json($user); 
    } 
    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
        $user->delete();
        return 'ok';
    } 

}
