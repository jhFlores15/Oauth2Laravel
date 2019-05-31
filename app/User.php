<?php

namespace Encuestas_Carozzi;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'razon_social', 'email','rut','dv','codigo','rol_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //  public function getUpdatedAtAttribute($value)
    // {
    //      return Carbon::parse($value)->format('d-m-Y');
    // }

    public function rol(){
        return $this->belongsto('Encuestas_Carozzi\Rol');
    }

     public function clientes(){
        return $this->hasMany('Encuestas_Carozzi\Cliente');
    }

    public function scopeRole($query) // vendedor
    {
        return $query->where('rol_id', '=', 2);
    }

    public function scopeUpdated($query)
    {
        return $query->whereDate('updated_at', '!=', Carbon::today());
    }

}
