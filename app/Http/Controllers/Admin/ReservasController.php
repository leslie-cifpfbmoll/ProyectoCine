<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \App\Reservas;
use App\Carteleras;
use App\Horarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasController extends Controller {

    public function index($id, $horario_id) {     
        $cartelera = Carteleras::find($id);
        $sala_id = DB::select(DB::raw("SELECT salas_id FROM carteleras_salas where carteleras_id LIKE '$id'"));
        $numTotal = DB::select(DB::raw("SELECT sum(numFilas * numColumnas) as sitios FROM sala where id LIKE :sala_id"), array('sala_id' => $sala_id[0]->salas_id));
        $numReservado = DB::select(DB::raw("SELECT sum(DISTINCT r.cantidad) as sitios FROM sala s, reserva r, horarios h, cartelera c, carteleras_salas cs, carteleras_reservas cr, horarios_reservas hr, carteleras_horarios ch WHERE s.id LIKE '$id' AND r.id=cr.reservas_id AND s.id=cs.salas_id AND h.id='$horario_id' AND ch.horarios_id= h.id AND cs.carteleras_id = c.id AND cr.carteleras_id = c.id"));
        if ($numReservado[0]->sitios !== null) {
            $sitio = DB::select(DB::raw("SELECT :numTotal - :numReservado as sitios FROM reserva"), array('numTotal' => $numTotal[0]->sitios, 'numReservado' => $numReservado[0]->sitios));
        } else {
            $sitio = $numTotal;
        }
        return view('admin.reservas.index')->with('cartelera', $cartelera)->with('sitio', $sitio);
    }

    public function pagar(Request $request, $id) {
        $cartelera = Carteleras::find($id);
        $horario = $request->horario;
        $cantidad = $request->cantidad;
        $total = $cantidad * $cartelera->precio;
        return view('admin.reservas.pagar')->with('total', $total)->with('cartelera', $cartelera)->with('cantidad', $cantidad)->with('horario', $horario);
    }

    public function reservar($id, $cantidad, $horario) {
        $user = Auth::user();
        $cartelera = Carteleras::find($id);
      
        $reserva = Reservas::create([
                    'cantidad' => $cantidad,
        ]);
        
        $reserva->usuarios()->sync($user);
        $reserva->carteleras()->sync($cartelera);
        $reserva->horarios()->sync($horario);

        session()->flash('success', 'Reserva creada correctamente.');
        return redirect()->route('admin.carteleras.index');
    }

    public function destroy(Request $request, $id) {
        $user = Auth::user();
        $reservas = DB::select(DB::raw("select DISTINCT r.id, r.cantidad, p.nombre, h.hora, c.fecha, s.id as sala FROM reserva r, reservas_user ru, carteleras_reservas cr, cartelera c, peliculas p, carteleras_peliculas cp, carteleras_horarios ch, horarios h, carteleras_salas cs, sala s WHERE ru.user_id LIKE :user_id AND r.id LIKE ru.reservas_id AND r.id LIKE cr.reservas_id AND c.id LIKE cr.carteleras_id AND cp.carteleras_id LIKE c.id AND p.id LIKE cp.peliculas_id AND c.id LIKE ch.carteleras_id AND ch.horarios_id LIKE h.id AND cs.carteleras_id LIKE c.id AND cs.salas_id LIKE s.id"), array('user_id' => $user->id));

        $reserva = Reservas::find($id);
        if ($reserva->delete()) {
            $request->session()->flash('success', 'Reserva borrada correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible borrar la reserva.');
        }
        return redirect()->route('admin.perfil.index')->with('reservas', $reservas, 'user', $user);
    }

}
