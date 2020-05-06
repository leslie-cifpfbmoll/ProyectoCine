<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carteleras extends Model
{
   protected $table = 'cartelera';
    protected $fillable = array('idPelicula','idSala','horario','precio');

}
