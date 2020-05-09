<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Generos;
use App\Directores;
class Peliculas extends Model
{
    protected $table = 'peliculas';
    protected $fillable = array('nombre','idGenero','idDirector','estreno','duracion','sinopsis','imagen');
    
     public function generos(){
        return $this->belongsToMany(Generos::class);
     }
      public function directores(){
        return $this->belongsToMany(Directores::class);
    }
}
