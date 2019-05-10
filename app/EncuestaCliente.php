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
     public function scopeDate($query){

        return $query->whereColumn('created_at', '!=', 'updated_at');

    }
     public function scopeDateEq($query){

        return $query->whereColumn('created_at', 'updated_at');

    }
    public function scopeTelefono($query){
        return $query->whereNotNull('telefono'); 
    }
    public function scopeEmail($query){
        return $query->whereNotNull('email');
    }
    public function scopeFecha_nacimiento($query){
        return $query->whereNotNull('fecha_nacimiento');
    }
    public function scopeTelefonoN($query){
        return $query->whereNull('telefono'); 
    }
    public function scopeEmailN($query){
        return $query->whereNull('email');
    }
    public function scopeFecha_nacimientoN($query){
        return $query->whereNull('fecha_nacimiento');
    }
   
}
