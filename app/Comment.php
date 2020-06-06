<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   public function pelicula(){
       return $this->belongsTo('App\Peliculas');
   }
    public function user(){
       return $this->belongsTo('App\User');
   }
}
