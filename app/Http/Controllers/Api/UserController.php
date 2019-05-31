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
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	///poner policy en cada una de las funciones verificando que sean administradores los que hacen las peticiones
     public function administradores(){
     	$administradores = UserResource::collection(User::all()->where('rol.nombre','Administrador'));  

        return datatables()
            ->resource($administradores)
            ->addColumn('btn','administradores.acciones')
            ->rawColumns(['btn'])
            ->toJson();
        // return response()->json($administradores); 
    }
    public function vendedores(){
        $vendedores = UserResource::collection(User::all()->where('rol.nombre','Vendedor'));       
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
         DB::beginTransaction();             
            try {
                if($request->hasFile('file')){
                    $file = $request->file('file');
                    $i = 0;
                    $users = (new FastExcel)->import($file, function ($line) use ($i){
                        $vendedor = \App\User::all()->where('rol_id',2)->where('codigo',trim($line['codigo']))->first();
                        if($vendedor){ //actualizar
                            $vendedor->rut = trim(str_replace ( ".", "", $line['rut']));
                            $vendedor->dv = trim($line['dv']);
                            $vendedor->razon_social = $line['nombre'];
                            $vendedor->email = trim($line['email']);
                            $vendedor->password_visible = $line['password'];
                            $vendedor->password = bcrypt($line['password']);
                            $vendedor->save();
                        }
                        else{ //crear
                            if($line['codigo'] != ''){
                                $vendedor = new \App\User();
                                $vendedor->codigo = trim($line['codigo']);
                                $vendedor->rut = trim(str_replace ( ".", "", $line['rut']));
                                $vendedor->dv = trim($line['dv']);
                                $vendedor->razon_social = $line['nombre'];
                                $vendedor->email = trim($line['email']);
                                $vendedor->password_visible = trim($line['password']);
                                $vendedor->password = bcrypt(trim($line['password']));
                                $vendedor->rol_id = 2;
                                $vendedor->save();
                            }                               
                        } 
                        return ;
                    });
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
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
