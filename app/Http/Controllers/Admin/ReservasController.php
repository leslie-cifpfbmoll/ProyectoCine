<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \App\Reservas;
use App\Carteleras;
use Illuminate\Http\Request;

class ReservasController extends Controller {

    public function index($id) {
        $cartelera = Carteleras::find($id);
        $sala_id = DB::select(DB::raw("SELECT salas_id FROM carteleras_salas where carteleras_id LIKE '$id'"));
        $numTotal = DB::select(DB::raw("SELECT sum(numFilas * numColumnas) as sitios FROM sala where id LIKE :sala_id"), array('sala_id' => $sala_id[0]->salas_id));
        $numReservado = DB::select(DB::raw("SELECT sum(r.cantidad) as sitios FROM reserva r, carteleras_reservas cr, carteleras_salas cs where cs.id='$id' AND r.id=cr.carteleras_id AND cr.carteleras_id=cs.id"));
        $sitio = DB::select(DB::raw("SELECT :numTotal - :numReservado as sitios FROM reserva"), array('numTotal' => $numTotal[0]->sitios, 'numReservado' => $numReservado[0]->sitios));

        return view('admin.reservas.index')->with('cartelera', $cartelera)->with('sitio', $sitio);
    }

    public function pagar(Request $request, $id) {
        $cartelera = Carteleras::find($id);
        $cantidad = $request->cantidad;
        $total = $cantidad * $cartelera->precio;
        return view('admin.reservas.pagar')->with('total', $total)->with('cartelera', $cartelera)->with('cantidad', $cantidad);
    }

    public function reservar($id, $cantidad) {
        $user = Auth::user();
        $user = $user->id;
        $cartelera = Cartelera::find($id);
        
        $director->nombre = $request->nombre;
        $director->apellido = $request->apellido;
        if ($director->save()) {
            $request->session()->flash('success', 'Director actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar el director.');
        }
        return redirect()->route('admin.directores.index');
    }

}
