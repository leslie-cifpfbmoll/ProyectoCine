<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    protected $table = 'precios';
    protected $fillable = array('tipo', 'precio');

    public function carteleras() {
        return $this->belongsTo('\App\Carteleras');
    }
}
