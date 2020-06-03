<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Reservas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();
        
        $reservas = DB::select(DB::raw("select DISTINCT r.id, r.cantidad, p.nombre, h.hora, c.fecha, s.numSala as sala FROM reserva r, reservas_user ru, carteleras_reservas cr, cartelera c, peliculas p, carteleras_peliculas cp, carteleras_horarios ch, horarios h, carteleras_salas cs, sala s, horarios_reservas hr WHERE ru.user_id LIKE :user_id AND r.id LIKE ru.reservas_id AND r.id LIKE cr.reservas_id AND c.id LIKE cr.carteleras_id AND cp.carteleras_id LIKE c.id AND p.id LIKE cp.peliculas_id AND c.id LIKE ch.carteleras_id AND ch.horarios_id LIKE h.id AND cs.carteleras_id LIKE c.id AND cs.salas_id LIKE s.id AND hr.reservas_id LIKE r.id AND hr.horarios_id LIKE h.id"), array('user_id' => $user->id));

        return view('admin.perfil.index')->with('user', $user)->with('reservas', $reservas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::find($id);


        if (!$request->name || !$request->email) {
            $request->session()->flash('error', 'Rellena todos los campos.');
            return view('admin.perfil.index')->with(['user' => $user]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($user->password != $request->password) {
            $user->password = Hash::make($request->password);
        }
        if ($user->save()) {
            $request->session()->flash('success', 'Usuario actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar el usuario.');
        }

        return redirect()->route('admin.perfil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
//
    }

}
