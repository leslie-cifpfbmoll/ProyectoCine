<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Peliculas;
use App\Directores;
use App\Generos;
use Illuminate\Http\Request;

class PeliculasController extends Controller {

    public function index() {
        $peliculas = Peliculas::paginate(10);
        return view('admin.peliculas.index')->with('peliculas', $peliculas);
    }

    public function create() {
        $generos = Generos::all();
        $directores = Directores::all();
        $peliculas = Peliculas::all();
        return view('admin.peliculas.create')->with(['generos' => $generos])->with(['directores' => $directores])->with(['peliculas' => $peliculas]);
    }

    public function store(Request $request) {
        $generos = Generos::all();
        $directores = Directores::all();
        $peliculas = Peliculas::all();
        if (!$request->director || !$request->nombre || !$request->estreno || !$request->duracion || !$request->sinopsis) {

            $request->session()->flash('error', 'Rellena todos los campos.');

            return view('admin.peliculas.create')->with(['generos' => $generos])->with(['directores' => $directores])->with(['peliculas' => $peliculas]);
        }
        $pelicula = Peliculas::create([
                    'nombre' => $request->nombre,
                    'estreno' => $request->estreno,
                    'duracion' => $request->duracion,
                    'sinopsis' => $request->sinopsis,
                    'imagen' => 'imagen.jpf'
        ]);

        $pelicula->directores()->sync($request->director);
        $pelicula->generos()->sync($request->generos);

        $request->session()->flash('success', 'Película creada correctamente.');
        return redirect()->route('admin.peliculas.index')->with(['generos' => $generos])->with(['directores' => $directores])->with(['peliculas' => $peliculas]);
    }

    public function edit($id) {
        $generos = Generos::all();
        $directores = Directores::all();
        $pelicula = Peliculas::find($id);
        return view('admin.peliculas.edit')->with(['generos' => $generos])->with(['directores' => $directores])->with(['pelicula' => $pelicula]);
    }

    public function update(Request $request, $id) {
        $generos = Generos::all();
        $directores = Directores::all();
        $peliculas = Peliculas::all();

        $pelicula->nombre = $request->nombre;
        $pelicula->estreno = $request->estreno;
        $pelicula->duracion = $request->duracion;
        $pelicula->sinopsis = $request->sinopsis;
        $pelicula->generos()->sync($request->generos);
        $pelicula->directores()->sync($request->director);
        if ($pelicula->save()) {
            $request->session()->flash('success', 'Película actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar la película.');
        }
        return redirect()->route('admin.peliculas.index')->with(['generos' => $generos])->with(['directores' => $directores])->with(['peliculas' => $peliculas]);
    }

    public function destroy(Request $request, $id) {
        $pelicula = Peliculas::find($id);
        if ($pelicula->delete()) {

            $request->session()->flash('success', 'Película borrada correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible borrar la película.');
        }


        return redirect()->route('admin.peliculas.index');
    }

}
