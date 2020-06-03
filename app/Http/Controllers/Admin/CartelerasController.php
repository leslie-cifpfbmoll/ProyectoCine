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
        $peliculas= DB::select('select * from peliculas where peliculas.estreno <= "'.$fecha.'"' );
        $salas = Salas::all();

        return view('admin.carteleras.create', compact('fecha'))->with(['peliculas' => $peliculas])->with(['salas' => $salas])->with(['carteleras' => $carteleras])->with(['fecha' => $fecha]);

    }
    public function getHorarios(Request $request){
        $fecha=$request->fecha;
        $horarios_disponibles = DB::select('SELECT DISTINCT hd.* FROM horarios_disponibles hd
            where ROW(hd.id,hd.horario_id,hd.hora) not in (SELECT h_d.* FROM 
            horarios_disponibles h_d, horarios_o ho where ho.fecha=:fecha and 
            TIME_FORMAT(h_d.hora, "%H:%i:%s")>ho.h_ocupada and TIME_FORMAT(h_d.hora, "%H:%i:%s")<ho.h_fin 
                and h_d.id=ho.salas_id) order by id,hora', ['fecha'=>$fecha]);
        return response()->json($horarios_disponibles);
    }
   public function getDuracion(Request $request){
        $id=$request->id;
        $duracion = DB::select('select * from peliculas where id = :id', ['id' => $id]);
        return response()->json($duracion);
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
        $cartelera->salas()->sync($request->sala_id);
        $cartelera->horario()->sync($request->horarios);
        $request->session()->flash('success', 'Proyección creada correctamente.');
        return redirect()->route('admin.administrar.index')->with(['peliculas' => $peliculas])->with(['horarios' => $horarios])->with(['salas' => $salas])->with(['carteleras' => $cartelera]);
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
        $cartelera->salas()->sync($request->sala_id);
        $cartelera->horario()->sync($request->horarios);
        if ($cartelera->save()) {
            $request->session()->flash('success', 'Cartelera actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar la proyección.');
        }
        return redirect()->route('admin.administrar.index')->with(['peliculas' => $peliculas])->with(['horarios' => $horarios])->with(['salas' => $salas])->with(['carteleras' => $cartelera]);
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

}
