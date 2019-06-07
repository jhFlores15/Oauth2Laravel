<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Nota_Credito extends Model
{
    protected $table = 'notas_credito';
    protected $fillable = [
        'cliente_id', 'cliente_name','factura','descripcion','cantidad', 'detalle', 'monto',
    ];
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
