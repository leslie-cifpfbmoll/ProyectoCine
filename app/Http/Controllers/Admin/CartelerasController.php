<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Carteleras;
use \App\Peliculas;
use App\Horarios;
use \App\Salas;
use App\view;
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
        $peliculas = Peliculas::all();
        $salas = Salas::all();
        $horarios = Horarios::all();
        $horarios_disponibles = DB::select('SELECT * FROM horarios_disponibles hd where ROW(hd.hora, hd.id,hd.horario_id) not in (select hora,salas_id,id from horarios_o where horarios_o.fecha=:fecha) UNION ALL SELECT ho.hora,ho.salas_id,ho.id from horarios_o ho where ROW(ho.hora,ho.salas_id,ho.id) not in ( SELECT hora,id,horario_id from horarios_disponibles) order by id,hora', ['fecha' => $fecha]);
        return view('admin.carteleras.create', compact('fecha'))->with(['horarios_disponibles' => $horarios_disponibles])->with(['peliculas' => $peliculas])->with(['horarios' => $horarios])->with(['salas' => $salas])->with(['carteleras' => $carteleras]);
    }

    public function store(Request $request) {
        $horarios = Horarios::all();
        $peliculas = Peliculas::all();
        $salas = Salas::all();
        $carteleras = Carteleras::all();
        $cartelera = Carteleras::create([
                    'fecha' => $request->fecha,
                    'precio' => $request->precio,
        ]);
        $cartelera->peliculas()->sync($request->pelicula);
        $cartelera->salas()->sync($request->sala);
        $cartelera->horarios()->sync($request->horarios);
        $request->session()->flash('success', 'Proyección creada correctamente.');
        return redirect()->route('admin.carteleras.index')->with(['peliculas' => $peliculas])->with(['horarios' => $horarios])->with(['salas' => $salas])->with(['carteleras' => $cartelera]);
    }

    public function get($id) {
        $cartelera = Carteleras::find($id);
        return $cartelera;
    }

    public function edit($id) {
        $cartelera = Carteleras::find($id);
        $peliculas = Peliculas::all();
        $salas = Salas::all();
        $horarios = Horarios::all();
        return view('admin.carteleras.edit')->with(['peliculas' => $peliculas])->with(['horarios' => $horarios])->with(['salas' => $salas])->with(['carteleras' => $cartelera]);
    }

    public function update(Request $request, $id) {
        $cartelera = Carteleras::find($id);
        $peliculas = Peliculas::all();
        $salas = Salas::all();
        $horarios = Horarios::all();
        $cartelera->fecha = $request->fecha;
        $cartelera->precio = $request->precio;
        $cartelera->peliculas()->sync($request->pelicula);
        $cartelera->salas()->sync($request->sala);
        $cartelera->horarios()->sync($request->horarios);
        if ($cartelera->save()) {
            $request->session()->flash('success', 'Cartelera actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar la proyección.');
        }
        return redirect()->route('admin.carteleras.index')->with(['peliculas' => $peliculas])->with(['horarios' => $horarios])->with(['salas' => $salas])->with(['carteleras' => $cartelera]);
    }

    public function destroy(Request $request, $id) {
        $cartelera = Carteleras::find($id);
        if ($cartelera->delete()) {

            $request->session()->flash('success', 'Proyección borrada correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible borrar la proyección.');
        }
        return redirect()->route('admin.carteleras.index');
    }

}
