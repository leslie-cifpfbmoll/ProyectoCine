<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Carteleras;
use App\User;
class Reservas extends Model
{
    protected $table = 'reserva';
    protected $fillable = array('idUsuario','idCartelera','cantidad');
    
    
    public function usuarios() {
        return $this->belongsToMany(User::class);
    }
     public function carteleras() {
        return $this->belongsToMany(Carteleras::class);
    }
}
