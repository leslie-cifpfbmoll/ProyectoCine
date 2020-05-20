<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Reservas;
use App\Carteleras;
use Illuminate\Http\Request;
class ReservasController extends Controller
{   

    public function index($id){
        $reserva = Carteleras::find($id);
        return view('admin.reservas.index')->with('reserva', $reserva);
    }


}
