<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salas extends Model
{
     protected $table = 'sala';
    protected $fillable = array('numFilas','numColumnas');
}
