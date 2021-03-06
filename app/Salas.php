<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salas extends Model {

    protected $table = 'sala';
    protected $fillable = array('numSala', 'aforo');

    public function carteleras() {
        return $this->belongsTo('\App\Carteleras');
    }

}
