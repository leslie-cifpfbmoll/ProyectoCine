<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    protected $table = 'horarios';
    protected $fillable = array('hora');
    public function carteleras(){
        return $this->belongsTo('\App\Carteleras');
    }
}
