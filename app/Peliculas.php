<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peliculas extends Model
{
    protected $table = 'peliculas';
    protected $fillable = array('nombre','idGenero','idDirector','estreno','duracion','sinopsis','imagen');
}
