<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Generos;
use App\Directores;

class Peliculas extends Model {

    protected $table = 'peliculas';
    protected $fillable = array('nombre', 'idGenero', 'idDirector', 'estreno', 'duracion','trailer', 'sinopsis', 'mime', 'priginal_filename', 'filename');

    public function getImageAttribute() {
        return $this->imagen;
    }

    public function generos() {
        return $this->belongsToMany(Generos::class);
    }

    public function directores() {
        return $this->belongsToMany(Directores::class);
    }

    public function carteleras() {
        return $this->belongsTo('\App\Carteleras');
    }
     public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function carrousel() {
        return $this->belongsTo('\App\Carrousel');
    }

}
