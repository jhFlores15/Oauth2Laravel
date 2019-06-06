<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;

class Nota_Credito extends Model
{
    protected $table = 'notas_credito';
    public function user(){
    	return $this->belongsto('Encuestas_Carozzi\User');
    }
    public function autorizadores(){
    	return $this->belongsto('Encuestas_Carozzi\Autorizador');
    }
     public function getCreatedAtAttribute($value)
    {
         return Carbon::parse($value)->format('d-m-Y');
    }
}
