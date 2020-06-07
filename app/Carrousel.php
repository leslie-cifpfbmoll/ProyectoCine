<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrousel extends Model {

    protected $table = 'carrousel';
    protected $fillable = array('mime', 'original_filename', 'filename');

    public function peliculas() {
        return $this->belongsToMany(Peliculas::class);
    }

}
