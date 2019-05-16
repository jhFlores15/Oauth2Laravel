<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Encuesta extends Model
{
    protected $table = 'encuestas';
    protected $fillable = ['descripcion','inicio','termino'];

    public function tipo_encuesta(){
    	return $this->belongsto('App\Tipo_Encuesta');
    }
    public function clientes (){
		return $this->belongsToMany('App\Cliente','encuesta_cliente','encuesta_id','cliente_id')->using('App\EncuestaCliente')->withTimestamps()->withPivot(['fecha_nacimiento','telefono','email']);
    }
    // public function marcas (){
    //     return $this->belongsToMany('App\Categoria','marcas','encuesta_id','categoria_id')->using('App\Marca')->withTimestamps()->withPivot(['nombre']);
    // }

    public function marca_cliente()
    {
        return $this->hasManyThrough('App\ClienteMarca', 'App\Marca','encuesta_id','marca_id','id','id');
    }
    //  public function categorias()
    // {
    //     return $this->hasOneThrough('App\Categoria', 'App\Marca','encuesta_id','marca_id','id','id');
    // }
     public function marcas(){
        return $this->hasMany('App\Marca');
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
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $marcas = $encuesta->marcas;
        foreach ($marcas as $marca) {
            if(count($marca->clientes) > 0){
                return false;
            }           
        }
        return true;
    }
    


}
