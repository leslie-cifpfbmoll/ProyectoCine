<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Directores;
use Illuminate\Http\Request;

class DirectoresController extends Controller {

    public function index() {
        $directores = Directores::paginate(10);
        return view('admin.directores.index')->with('directores', $directores);
    }

    public function create() {
        return view('admin.directores.create');
    }

    public function store(Request $request) {
        if (!$request->name) {
            return view('admin.directores.create');
        }
        Directores::create([
            'nombre' => $request->name,
            'apellido' => $request->subname,
        ]);
        $request->session()->flash('success', 'Director creado correctamente.');
        return redirect()->route('admin.administrar.getDirectores');
    }

    public function edit($id) {
        $director = Directores::find($id);
        $directores = Directores::all();
        return view('admin.directores.edit')->with(['director' => $director, 'directores' => $directores]);
    }

    public function update(Request $request, $id) {
        $director = Directores::find($id);
        $director->nombre = $request->nombre;
        $director->apellido = $request->apellido;
        if($director->save()){
             $request->session()->flash('success', 'Director actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar el director.');
        }
        return redirect()->route('admin.administrar.getDirectores');
    }

    public function destroy(Request $request, $id) {
        $director = Directores::find($id);
        if ($director->delete()) {
            $request->session()->flash('success', 'Director borrado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible borrar el director.');
        }
        return redirect()->route('admin.administrar.getDirectores');
    }

}
