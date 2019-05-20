<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Http\Resources\Cliente as ClienteResource;
use Validator;
use Rap2hpoutre\FastExcel\FastExcel;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = ClienteResource::collection(Cliente::all());

         return datatables()
            ->resource($clientes)
            ->addColumn('btn','clientes.acciones')
            ->rawColumns(['btn'])
            ->toJson();    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $cliente = cliente::findOrFail($id);
         $cliente->comuna;
         $cliente->user;
         return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            $file = $request->file('file');
            $clientes = (new FastExcel)->import($file, function ($line) {
                $cliente = \App\Cliente::all()->where('codigo','=',$line['codigo'])->first();
                if($cliente){ //actualizar
                    $cliente->rut = $line['rut'];
                    $cliente->dv = $line['dv'];
                    $cliente->razon_social = $line['razon_social'];
                    $cliente->direccion = $line['direccion'];                    
                    $comuna = \App\Comuna::all()->where('nombre','=',$line['comuna'])->first();
                    $cliente->comuna_id = $comuna->id;
                    $vendedor = \App\User::all()->where('codigo','=',$line['cod_vendedor'])->first();
                    $cliente->user_id = $vendedor->id;
                    $cliente->save();
                }
                else{ //crear
                        $cliente = new \App\Cliente();
                        $cliente->codigo = $line['codigo'];
                        $cliente->rut = $line['rut'];
                        $cliente->dv = $line['dv'];
                        $cliente->razon_social = $line['razon_social'];
                        $cliente->direccion = $line['direccion'];
                        $comuna = \App\Comuna::all()->where('nombre','=',$line['comuna'])->first();
                        $cliente->comuna_id = $comuna->id;
                        $vendedor = \App\User::all()->where('codigo','=',$line['cod_vendedor'])->first();
                        $cliente->user_id = $vendedor->id;
                        $cliente->save();
                } 
                return ;
            });
            $clientes_eliminar = \App\Cliente::updatedd()->orderBy('codigo')->get();

            $arrays = ($clientes_eliminar->modelKeys());
             \App\Cliente::destroy($arrays);
        }
        return response()->json('ok');
        

    }
}
