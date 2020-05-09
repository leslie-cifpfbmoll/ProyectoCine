<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Peliculas;
use App\Directores;
use App\Generos;
use Illuminate\Http\Request;

class PeliculasController extends Controller {

    public function index() {
        return view('admin.peliculas.index')->with('peliculas', Peliculas::paginate(10));
    }

    public function create() {
        return view('admin.peliculas.create')->with(['generos' => Generos::all()])->with(['directores' => Directores::all()])->with(['peliculas' => Peliculas::all()]);
    }

    public function store(Request $request) {
        if (!$request->director) {
            return view('admin.peliculas.create')->with(['generos' => Generos::all()])->with(['directores' => Directores::all()])->with(['peliculas' => Peliculas::all()]);
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
        return redirect()->route('admin.peliculas.index')->with(['generos' => Generos::all()])->with(['directores' => Directores::all()])->with(['peliculas' => Peliculas::all()]);
    }

    public function edit($id) {
        return view('admin.peliculas.edit')->with(['generos' => Generos::all()])->with(['directores' => Directores::all()])->with(['pelicula' => Peliculas::find($id)]);
    }

    public function update(Request $request, $id) {
        $pelicula = Peliculas::find($id);
        $pelicula->nombre = $request->nombre;
        $pelicula->estreno = $request->estreno;
        $pelicula->duracion = $request->duracion;
        $pelicula->sinopsis = $request->sinopsis;
        $pelicula->generos()->sync($request->generos);
        $pelicula->directores()->sync($request->director);
        $pelicula->save();
        return redirect()->route('admin.peliculas.index')->with(['generos' => Generos::all()])->with(['directores' => Directores::all()])->with(['peliculas' => Peliculas::all()]);
        
    }

    public function destroy($id) {
        $pelicula = Peliculas::find($id);
        if ($pelicula) {
            $pelicula->generos()->detach();
            $pelicula->directores()->detach();
            $pelicula->delete();
            return redirect()->route('admin.peliculas.index');
        }


        return redirect()->route('admin.peliculas.index');
    }

}
