<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Http\Resources\Encuesta as EncuestaResource;
use App\Encuesta;


class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encuestas = EncuestaResource::collection(Encuesta::all()); //Listado de encuestas Para el  Administrador

        return datatables()
            ->resource($encuestas)
            ->addColumn('btn','encuestas.acciones')
            ->rawColumns(['btn'])
            ->toJson();
    }

    public function index_admin($vendedor_id)
    {
        $encuestas = EncuestaResource::collection(Encuesta::all()); //Listado de encuestas Para el  VENDEDOR

        return datatables()
            ->resource($encuestas)
            ->addColumn('btn','encuestas.acciones')
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
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
