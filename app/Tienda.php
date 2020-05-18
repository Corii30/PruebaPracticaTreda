<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $table = 'tiendas';
    
    protected $fillable = ['id', 'nombre', 'fecha_apertura'];
    
    protected $casts = [
        'fecha_apertura' => 'datetime:d-m-Y',
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
    ];

    public function productos(){

        return $this->hasMany('App\Producto');
    }
}
