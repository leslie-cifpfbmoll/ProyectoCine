<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    protected $table = 'reserva';
    protected $fillable = array('idUsuario','idCartelera','cantidad');
}
