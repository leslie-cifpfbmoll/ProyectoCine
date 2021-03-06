<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Carteleras;
use \App\Peliculas;
use App\Horarios;
use \App\Salas;
use App\view;
use App\Precios;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CartelerasController extends Controller {

    public function index(Request $request) {

        if ($request->has('dias') && !empty($request->input('dias'))) {
            $fecha = $request->input('dias');
        } else {
            $fecha = date("Y-m-d");
        }
        $carteleras = Carteleras::where('fecha', $fecha)->get();
        return view('admin.carteleras.index', compact('fecha'))->with(['carteleras' => $carteleras]);
    }

    public function create(Request $request) {

        $fecha = $request->input('fecha');
        $carteleras = Carteleras::all();
        $peliculas = DB::select('select * from peliculas where peliculas.estreno <= "' . $fecha . '"');
        $salas = Salas::all();
        $precios = Precios::all();


        return view('admin.carteleras.create', compact('fecha'))->with(['peliculas' => $peliculas])->with(['salas' => $salas])->with(['carteleras' => $carteleras])->with(['precios' => $precios]);
    }

    public function getHorarios(Request $request) {
        $fecha = $request->fecha;
        $horarios_disponibles = DB::select('SELECT DISTINCT hd.* FROM horarios_disponibles hd
            where ROW(hd.id,hd.horario_id,hd.hora) not in (SELECT h_d.* FROM 
            horarios_disponibles h_d, horarios_o ho where ho.fecha=:fecha and 
            TIME_FORMAT(h_d.hora, "%H:%i:%s")>ho.h_ocupada and TIME_FORMAT(h_d.hora, "%H:%i:%s")<ho.h_fin 
                and h_d.id=ho.salas_id) order by id,hora', ['fecha' => $fecha]);
        return response()->json($horarios_disponibles);
    }

    public function getDuracion(Request $request) {
        $id = $request->id;
        $duracion = DB::select('select * from peliculas where id = :id', ['id' => $id]);
        return response()->json($duracion);
    }

    public function store(Request $request) {
        $horarios = Horarios::all();
        $peliculas = Peliculas::all();
        $salas = Salas::all();
        $precios = Precios::all();
        $carteleras = Carteleras::all();
        if (!$request->pelicula || !$request->sala_id || !$request->horarios || !$request->precio) {

            $request->session()->flash('error', 'Rellena todos los campos.');

            return back()->withInput($request->all);
        }
        $cartelera = Carteleras::create([
                    'fecha' => $request->fecha,
        ]);
        $cartelera->peliculas()->sync($request->pelicula);
        $cartelera->salas()->sync($request->sala_id);

        $cartelera->horarios()->sync($request->horarios);
        $cartelera->precios()->sync($request->precio);

        $request->session()->flash('success', 'Proyección creada correctamente.');
        return redirect()->route('admin.administrar.index')->with(['peliculas' => $peliculas])->with(['precios' => $precios])->with(['horarios' => $horarios])->with(['salas' => $salas])->with(['carteleras' => $cartelera]);
    }

    public function get($id) {
        $cartelera = Carteleras::find($id);
        return $cartelera;
    }

    public function edit($id) {
        $fecha = date("Y-m-d");
        $cartelera = Carteleras::find($id);
        $peliculas = DB::select('select * from peliculas where peliculas.estreno <= "' . $fecha . '"');
        $salas = Salas::all();
        $precios = Precios::all();
        $horarios = Horarios::all();
        return view('admin.carteleras.edit')->with(['peliculas' => $peliculas])->with(['precios' => $precios])->with(['horarios' => $horarios])->with(['salas' => $salas])->with(['cartelera' => $cartelera]);
    }

    public function update(Request $request, $id) {
        $cartelera = Carteleras::find($id);
        $peliculas = Peliculas::all();
        $salas = Salas::all();
        $precios = Precios::all();
        $horarios = Horarios::all();
        $cartelera->peliculas()->sync($request->pelicula);
        $cartelera->salas()->sync($request->sala_id);

        $cartelera->horarios()->sync($request->horarios);
        $cartelera->precios()->sync($request->precio);

        if ($cartelera->save()) {
            $request->session()->flash('success', 'Cartelera actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar la proyección.');
        }
        return redirect()->route('admin.administrar.index')->with(['peliculas' => $peliculas])->with(['precios' => $precios])->with(['horarios' => $horarios])->with(['salas' => $salas])->with(['carteleras' => $cartelera]);
    }

    public function destroy(Request $request, $id) {
        $cartelera = Carteleras::find($id);
        if ($cartelera->delete()) {

            $request->session()->flash('success', 'Proyección borrada correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible borrar la proyección.');
        }
        return redirect()->route('admin.administrar.index');
    }

    public function getAforo(Request $request) {
        $horario_id = $request->horario_id;
        $cartelera_id = $request->cartelera_id;
        $numTotal = DB::select(DB::raw("SELECT aforo as sitios FROM sala where id LIKE (SELECT salas_id FROM carteleras_salas where carteleras_id LIKE '$cartelera_id')"));
        $numReservado = DB::select(DB::raw("SELECT SUM(r.cantidad) as sitios FROM sala s, reserva r, horarios h, cartelera c, carteleras_salas cs, carteleras_reservas cr, horarios_reservas hr, carteleras_horarios ch where 
        hr.horarios_id = h.id AND hr.reservas_id = r.id AND h.id = '$horario_id' AND 
        cs.salas_id = s.id AND cs.carteleras_id=c.id AND c.id='$cartelera_id' AND
        cr.reservas_id = r.id AND cr.carteleras_id = c.id AND
        ch.horarios_id = h.id AND ch.carteleras_id = c.id"));

        $sitio = ($numTotal[0]->sitios - $numReservado[0]->sitios);



        return $sitio;
    }

}
