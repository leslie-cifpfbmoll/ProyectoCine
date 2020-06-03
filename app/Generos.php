<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generos extends Model
{
    protected $table = 'generos';
    protected $fillable = array('nombre');
    public function peliculas(){
        return $this->belongsTo('\App\Peliculas');
    }
    
    
}
