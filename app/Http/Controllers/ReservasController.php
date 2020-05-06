<?php

namespace App\Http\Controllers;
use \App\Reservas;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function getAll(){
        $reservas =Reservas::all();
        return $reservas;
    }
    public function add(Request $request){
        $reserva = Reservas::create($request->all());
        return $reserva;
    }
    
    public function get($id){
        $reserva = Reservas::find($id);
        return $reserva;
    }
    
    public function edit($id, Request $request){
        $reservas = $this->get($id);
        $reserva->fill($request->all())->save();
        return $reserva; 
    }
    public function delete($id){
        $reservas = $this->get($id);
        $reserva->delete();
        return $reserva;
    }

}
