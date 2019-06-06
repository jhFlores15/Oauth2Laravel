<?php

namespace Encuestas_Carozzi\Http\Controllers;

use Illuminate\Http\Request;

class NotaCreditoController extends Controller
{
    public function create()
    {
        return view('notas_credito.vendedor.create');
    }
    public function edit($id)
    {
    	$nota = \Encuestas_Carozzi\Nota_Credito::findOrFail($id);
        return view('notas_credito.vendedor.edit', ['id' => $id ]);
    }
    public function indexVendedor()
    {
        return view('notas_credito.vendedor.index.index');
    }
    public function indexAdmin()
    {
    	return view('notas_credito.index');
    }
}
