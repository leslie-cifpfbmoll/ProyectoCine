<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Carteleras;
use \App\Peliculas;
use App\Horarios;
use \App\Salas;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CartelerasController extends Controller {

    public function index() {
        $fecha = date("Y-m-d");
        $carteleras = Carteleras::where('fecha', $fecha)->get();
        return view('admin.carteleras.index')->with(['carteleras' => $carteleras]);
    }

    public function find() {
        $fecha = "2020-05-13";
        $carteleras = Carteleras::where('fecha', $fecha)->get();

        return view('admin.carteleras.find')->with(['carteleras' => $carteleras]);
    }

    public function create() {
        $carteleras = Carteleras::all();
        $peliculas = Peliculas::all();
        $salas = Salas::all();
        $horarios = Horarios::all();
        return view('admin.carteleras.create')->with(['peliculas' => $peliculas])->with(['horarios' => $horarios])->with(['salas' => $salas])->with(['carteleras' => $carteleras]);
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
