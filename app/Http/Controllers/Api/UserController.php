<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\User as UserResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
use Rap2hpoutre\FastExcel\FastExcel;

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


        if($request->hasFile('file')){
            $file = $request->file('file');
            $users = (new FastExcel)->import($file, function ($line) {
                $vendedor = \App\User::all()->where('codigo','=',$line['codigo'])->first();
                if($vendedor){ //actualizar
                    $vendedor->rut = $line['rut'];
                    $vendedor->dv = $line['dv'];
                    $vendedor->razon_social = $line['razon_social'];
                    $vendedor->email = $line['email'];
                    $vendedor->password_visible = $line['password'];
                    $vendedor->password = bcrypt($line['password']);
                    $vendedor->save();
                }
                else{ //crear

                        $vendedor = new \App\User();
                        $vendedor->codigo = $line['codigo'];
                        $vendedor->rut = $line['rut'];
                        $vendedor->dv = $line['dv'];
                        $vendedor->razon_social = $line['razon_social'];
                        $vendedor->email = $line['email'];
                        $vendedor->password_visible = $line['password'];
                        $vendedor->password = bcrypt($line['password']);
                        $vendedor->rol_id = 2;
                        $vendedor->save();
                } 
                return ;
            });
            //eliminar no actualizados
            $vendedores_eliminar = \App\User::role()->updated()->orderBy('codigo')->get();
            if($vendedores_eliminar){
                foreach ($vendedores_eliminar as $vendedor) {
                     $vendedor->delete();
                }
            }
        }
        return response()->json('ok');
        

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
