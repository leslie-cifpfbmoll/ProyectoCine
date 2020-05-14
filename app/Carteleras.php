<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carteleras extends Model {

    protected $table = 'cartelera';
    protected $fillable = array( 'fecha', 'precio');

    public function peliculas() {
        return $this->belongsToMany(Peliculas::class);
    }

    public function salas() {
        return $this->belongsToMany(Salas::class);
    }

    public function horarios() {
        return $this->belongsToMany(Horarios::class);
    }

}
