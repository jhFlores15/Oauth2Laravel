<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Encuesta extends Model
{
    protected $table = 'encuestas';
    protected $fillable = ['descripcion','inicio','termino'];

    public function tipo_encuesta(){
    	return $this->belongsto('Encuestas_Carozzi\Tipo_Encuesta');
    }
    public function clientes (){
		return $this->belongsToMany('Encuestas_Carozzi\Cliente','encuesta_cliente','encuesta_id','cliente_id')->using('Encuestas_Carozzi\EncuestaCliente')->withTimestamps()->withPivot(['fecha_nacimiento','telefono','email']);
    }
    // public function marcas (){
    //     return $this->belongsToMany('Encuestas_Carozzi\Categoria','marcas','encuesta_id','categoria_id')->using('Encuestas_Carozzi\Marca')->withTimestamps()->withPivot(['nombre']);
    // }

    public function marca_cliente()
    {
        return $this->hasManyThrough('Encuestas_Carozzi\ClienteMarca', 'Encuestas_Carozzi\Marca','encuesta_id','marca_id','id','id');
    }
    //  public function categorias()
    // {
    //     return $this->hasOneThrough('Encuestas_Carozzi\Categoria', 'Encuestas_Carozzi\Marca','encuesta_id','marca_id','id','id');
    // }
     public function marcas(){
        return $this->hasMany('Encuestas_Carozzi\Marca');
    }
    public function scopeInicio($query){
    	return $query->whereDate('inicio', '<=', Carbon::today());
    }
    public function scopeTerminoo($query){
    	return $query->where('termino', '=', null);
    }
    public function scopeTermino($query){
    	return $query->where('termino', '>', Carbon::today());
    }

    public static function Editable_Eliminable($encuesta_id){
        $encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($encuesta_id);
        $marcas = $encuesta->marcas;
        foreach ($marcas as $marca) {
            if(count($marca->clientes) > 0){
                return false;
            }           
        }
        return true;
    }
    


}
