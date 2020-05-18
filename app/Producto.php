<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';    

    protected $fillable = [
        'id', 'nombre', 'sku', 'descripcion', 'valor', 'imagen'
    ];  

    public function tienda(){

        return $this->belongsTo('App\Tienda');
    }
}
