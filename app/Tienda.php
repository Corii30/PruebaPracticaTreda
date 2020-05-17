<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $fillable = ['id', 'nombre', 'fecha_apertura'];    

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    public function productos(){

        return $this->hasMany('App\Producto');
    }
}
