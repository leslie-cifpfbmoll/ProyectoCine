<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Generos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerosController extends Controller {

    public function index() {
        return view('admin.generos.index')->with('generos', Generos::paginate(10));
    }

    public function getAll() {
        $generos = Generos::all();
        return $generos;
    }

    public function create() {
        return view('admin.generos.create');
    }

    public function store(Request $request) {
        if (!$request->name) {
            return view('admin.generos.create');
        }
        Generos::create([
            'nombre' => $request->name,
        ]);
        return redirect()->route('admin.generos.index');
    }

    public function edit($id) {
        return view('admin.generos.edit')->with(['genero' => Generos::find($id), 'generos' => Generos::all()]);
    }

    public function update(Request $request, $id) {
        $genero = Generos::find($id);
        $genero->nombre = $request->genero;
        $genero->save();
        return redirect()->route('admin.generos.index');
    }

    public function destroy($id) {
        $genero = Generos::find($id);
        $genero->delete();

        return redirect()->route('admin.generos.index');
    }

}
