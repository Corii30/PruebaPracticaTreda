<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'id', 'nombre', 'sku', 'descripcion', 'valor', 'imagen'
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    public function tienda(){

        return $this->belongsTo('App\Tienda');
    }
}
