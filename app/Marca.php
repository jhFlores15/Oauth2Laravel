<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';
	public function categorias(){
    	return $this->belongsto('App\Categoria');
    }
    
}
