<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';
	public function categoria(){
    	return $this->belongsto('Encuestas_Carozzi\Categoria');
    }
    public function tipo_producto(){
    	return $this->belongsto('Encuestas_Carozzi\Tipo_Producto');
    }
      public function clientes (){

		return $this->belongsToMany('Encuestas_Carozzi\Cliente','clientes_marcas','marca_id','cliente_id')->withTimestamps()->withPivot(['valor']);
    }
    
}
