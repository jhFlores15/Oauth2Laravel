<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';
	public function categoria(){
    	return $this->belongsto('App\Categoria');
    }
    public function tipo_producto(){
    	return $this->belongsto('App\Tipo_Producto');
    }
      public function clientes (){

		return $this->belongsToMany('App\Cliente','clientes_marcas','marca_id','cliente_id')->withTimestamps()->withPivot(['valor']);
    }
    
}
