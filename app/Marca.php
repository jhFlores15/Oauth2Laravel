<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
	public function categorias(){
    	return $this->belongsto('App\Categoria');
    }
    
}
