<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Http\Resources\Cliente as ClienteResource;
use Validator;

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
            'localidad_id' =>'exists:localidades,id',                       
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

        $localidad = \App\Localidad::findOrFail($request->get('localidad_id'));
        $cliente->localidad()->associate($localidad);

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
         $cliente->localidad;
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
            'localidad_id' =>'exists:localidades,id',                       
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


        if($cliente->localidad_id !== $request->get('localidad_id')){
            $cliente->localidad()->dissociate();
            $localidad = \App\Region::findOrFail($request->get('localidad_id'));
            $cliente->localidad()->associate($localidad);
        }
        if($cliente->user_id !== $request->get('user_id')){
            $cliente->user()->dissociate();
            $user = \App\Region::findOrFail($request->get('user_id'));
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
}
