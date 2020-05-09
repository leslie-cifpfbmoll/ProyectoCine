<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Salas;
use Illuminate\Http\Request;

class SalasController extends Controller {

    public function index() {
        $salas = Salas::paginate(10);
        return view('admin.salas.index')->with('salas', $salas);
    }

    public function create() {
        return view('admin.salas.create');
    }

    public function store(Request $request) {
        if (!$request->numFilas || !$request->numColumnas) {

            $request->session()->flash('error', 'Rellena todos los campos.');
            return view('admin.salas.create');
        }
        Salas::create([
            'numFilas' => $request->numFilas,
            'numColumnas' => $request->numColumnas
        ]);
        $request->session()->flash('success', 'Sala creada correctamente.');

        return redirect()->route('admin.salas.index');
    }

    public function edit($id) {
        $sala = Salas::find($id);
        $salas = Salas::all();
        return view('admin.salas.edit')->with(['sala' => $sala, 'salas' => $salas]);
    }

    public function update(Request $request, $id) {
        $sala = Salas::find($id);
        $sala->numFilas = $request->numFilas;
        $sala->numColumnas = $request->numColumnas;
        if ($sala->save()) {
            $request->session()->flash('success', 'Sala actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar la sala.');
        }return redirect()->route('admin.salas.index');
    }

    public function destroy(Request $request, $id) {
        $sala = Salas::find($id);
        if ($sala->delete()) {
            $request->session()->flash('success', 'Sala borrada correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible borrar la sala.');
        }

        return redirect()->route('admin.salas.index');
    }

}
