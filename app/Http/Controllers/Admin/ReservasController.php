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

    public function index(Request $request, $id) {
        $cartelera = Carteleras::find($id);
        

        $user = Auth::check();
        if ($user) {
           return view('admin.reservas.index')->with('cartelera', $cartelera);
        } else {
            $request->session()->flash('error', 'Inicia sesión para hacer una reserva.');
            return redirect()->route('admin.carteleras.index');
            
        }
        
    }

    public function pagar(Request $request, $id) {
        $carteleras = Carteleras::all();


        return view('admin.carteleras.index', compact('fecha'))->with(['carteleras' => $carteleras]);
        $precio = DB::select(DB::raw("SELECT p.precio FROM precios p, cartelera c, carteleras_precios cp where c.id LIKE '$id' AND cp.carteleras_id LIKE c.id AND cp.precios_id LIKE p.id"));
        $horario = $request->horario;
        $cantidad = $request->cantidad;
        $total = $cantidad * $precio[0]->precio;
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
