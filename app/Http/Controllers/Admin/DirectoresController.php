<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Directores;
use Illuminate\Http\Request;

class DirectoresController extends Controller {

    public function index() {
        return view('admin.directores.index')->with('directores', Directores::paginate(10));
    }

    public function getAll() {
        $directores = Directores::all();
        return $directores;
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
        return redirect()->route('admin.directores.index');
    }

    public function edit($id) {
        return view('admin.directores.edit')->with(['director' => Directores::find($id), 'directores' => Directores::all()]);
    }

    public function update(Request $request, $id) {
        $director = Directores::find($id);
        $director->nombre = $request->nombre;
        $director->apellido = $request->apellido;
        $director->save();
        return redirect()->route('admin.directores.index');
    }

    public function destroy($id) {
        $director = Directores::find($id);
        $director->delete();
        return redirect()->route('admin.directores.index');
    }

}
