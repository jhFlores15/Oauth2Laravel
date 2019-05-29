<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Http\Resources\Cliente as ClienteResource;
use Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
   
    public function index()
    {
        $clientes = ClienteResource::collection(Cliente::all());

         return datatables()
            ->resource($clientes)
            ->addColumn('btn','clientes.acciones')
            ->rawColumns(['btn'])
            ->toJson();    
    }
  
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|numeric|unique:clientes',
            'rut' => 'required|numeric|unique:clientes',
            'dv' => 'required',
            'razon_social' => 'required|string',
            'direccion'=>'required|max:255|string|unique:clientes',            
            'comuna_id' =>'exists:comunas,id',                       
            'user_id'=>'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $cliente = new Cliente();
        $cliente->codigo = $request->get('codigo');
        $cliente->rut = $request->get('rut');
        $cliente->dv = $request->get('dv');
        $cliente->razon_social = $request->get('razon_social');
        $cliente->direccion = $request->get('direccion');

        $comuna = \App\Comuna::findOrFail($request->get('comuna_id'));
        $cliente->comuna()->associate($comuna);

        $user = \App\User::findOrFail($request->get('user_id'));
        $cliente->user()->associate($user);

        $cliente->save();

        return response()->json('ok');

    }

    public function show($id)
    {
         $cliente = cliente::findOrFail($id);
         $cliente->comuna;
         $cliente->user;
         return response()->json($cliente);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|numeric|unique:clientes,codigo,'.$id,
            'rut' => 'required|numeric|unique:clientes,rut,'.$id,
            'dv' => 'required',
            'razon_social' => 'required|string',
            'direccion'=>'required|max:255|string|unique:clientes,direccion,'.$id,           
            'comuna_id' =>'exists:comunas,id',                       
            'user_id'=>'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $cliente = \App\Cliente::findOrFail($id);
        $cliente->codigo = $request->get('codigo');
        $cliente->rut = $request->get('rut');
        $cliente->dv = $request->get('dv');
        $cliente->razon_social = $request->get('razon_social');
        $cliente->direccion = $request->get('direccion');

        if($cliente->comuna_id !== $request->get('comuna_id')){
            $cliente->comuna()->dissociate();
            $comuna = \App\Comuna::findOrFail($request->get('comuna_id'));
            $cliente->comuna()->associate($comuna);
        }
        if($cliente->user_id !== $request->get('user_id')){
            $cliente->user()->dissociate();
            $user = \App\User::findOrFail($request->get('user_id'));
            $cliente->user()->associate($user);
        }
        
        $cliente->save();

        return response()->json('ok');
    }


    public function destroy($id)
    {
        $cliente = \App\Cliente::findOrFail($id);
        $cliente->delete();
        return 'ok';
    }

    public function file(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required|file'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        if($request->hasFile('file')){

            //   DB::beginTransaction();
             
            // try {

            $file = $request->file('file');
            $clientes = (new FastExcel)->import($file, function ($line) {
                if($line['codigo'] != ''){
                    $cliente = \App\Cliente::all()->where('codigo','=',trim($line['codigo']))->first();
                    if($cliente){ //actualizar
                        $vendedor = \App\User::all()->where('codigo','=',trim($line['cod_vendedor']))->first();
                        $cliente->user_id = $vendedor->id;
                        $cliente->save();
                    }
                    else{ 
                        $cliente = new \App\Cliente();
                        $cliente->codigo = trim($line['codigo']);
                        $cliente->rut = trim(\str_replace ( ".", "", $line['rut']));
                        $cliente->dv =trim($line['dv']);
                        $cliente->razon_social = $line['razon_social'];
                        $cliente->direccion = $line['direccion'];
                        if($line['comuna'] != ''){
                            $comuna = \App\Comuna::all()->where('nombre','=',trim($line['comuna']))->first();
                            $cliente->comuna_id = $comuna->id;
                        }  
                        else{
                            $comuna = \App\Comuna::all()->where('nombre','No Tiene')->first();
                            $cliente->comuna_id = $comuna->id;
                        }
                        $vendedor = \App\User::all()->where('codigo','=',trim($line['cod_vendedor']))->first();
                        $cliente->user_id = $vendedor->id;
                        $cliente->save();
                    } 
                }
                return ;
            });

            $clientes_eliminar = \App\Cliente::updatedd()->orderBy('codigo')->get();

            $arrays = ($clientes_eliminar->modelKeys());
             \App\Cliente::destroy($arrays);


            // DB::commit();
            // } catch (\Exception $e) {
            //     DB::rollback();
            //     throw $e;
            // }
            // catch (\Throwable $e) {
            //     DB::rollback();
            //     throw $e;
            // }
           
        }
        return response()->json('ok');
    }

}
