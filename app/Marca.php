<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';
	public function categorias(){
    	return $this->belongsto('App\Categoria');
    }
    public function tipo_producto(){
    	return $this->belongsto('App\Tipo_Producto');
    }
    
}
