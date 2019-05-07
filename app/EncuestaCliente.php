<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EncuestaCliente extends Pivot
{
    public $incrementing = true;
    protected $table = 'encuesta_cliente';

    public function scopeEncuesta($query,$encuesta_id){

    	return $query->where('encuesta_id', '=', $encuesta_id);

    }
    public function scopeCliente($query,$cliente_id){

    	return $query->where('cliente_id', '=', $cliente_id);

    }
     public function scopeUser($query,$user_id){

    	return $query->where('user_id', '=', $user_id);

    }
}
