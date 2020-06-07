<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Peliculas;
use App\Directores;
use App\Generos;
use App\Horarios;
use App\Carteleras;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class PeliculasController extends Controller {

    public function index(Request $request) {
        $fecha = date("Y-m-d");
        $nombre = $request->input('buscar');
        if (!empty($nombre)) {
            $peliculas = Peliculas::where('nombre', 'like', '%' . $nombre . '%')->orderBy('estreno')->paginate(5);
        } else {
            $peliculas = Peliculas::where('estreno', '<=', $fecha)->orderBy('estreno')->paginate(5);
        }

        return view('admin.peliculas.index')->with('peliculas', $peliculas);
    }

    public function estrenos(Request $request) {
        $fecha = date("Y-m-d");
        $nombre = $request->input('buscar');
        if (!empty($nombre)) {
            $peliculas = Peliculas::where('nombre', 'like', '%' . $nombre . '%')->orderBy('estreno')->paginate(5);
        } else {
            $peliculas = Peliculas::where('estreno', '>', $fecha)->orderBy('estreno')->paginate(5);
        }

        return view('admin.peliculas.estrenos')->with('peliculas', $peliculas);
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
        if (!$request->director || !$request->nombre || !$request->estreno || !$request->duracion || !$request->trailer || !$request->sinopsis) {

            $request->session()->flash('error', 'Rellena todos los campos.');

            return back()->withInput($request->all);
        }
        $cover = $request->file('imagen');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put($cover->getFilename() . '.' . $extension, File::get($cover));

        $pelicula = Peliculas::create([
                    'nombre' => $request->nombre,
                    'estreno' => $request->estreno,
                    'duracion' => $request->duracion,
                    'trailer' => $request->trailer,
                    'sinopsis' => $request->sinopsis,
                    'mime' => $cover->getClientMimeType(),
                    'original_filename' => $cover->getClientOriginalName(),
                    'filename' => $cover->getFilename() . '.' . $extension
        ]);

        $pelicula->directores()->sync($request->director);
        $pelicula->generos()->sync($request->generos);

        $request->session()->flash('success', 'Película creada correctamente.');
        return redirect()->route('admin.administrar.getPeliculas')->with(['generos' => $generos])->with(['directores' => $directores])->with(['peliculas' => $peliculas]);
    }

    public function edit($id) {
        $generos = Generos::all();
        $directores = Directores::all();
        $pelicula = Peliculas::find($id);

        return view('admin.peliculas.edit')->with(['generos' => $generos])->with(['directores' => $directores])->with(['pelicula' => $pelicula]);
    }

    public function show($id) {

        $user = Auth::user();
        $today = date("Y-m-d");
        $generos = Generos::all();
        $directores = Directores::all();

        $data_comentarios = DB::select(DB::raw("SELECT c.id id, c.comment comentario, c.user_id user_id, c.name nombre, u.avatar FROM comments c, peliculas p, users u WHERE c.pelicula_id = '$id' AND c.pelicula_id = p.id AND u.id = c.user_id"));
        $data_pelicula = DB::select(DB::raw("select c.id cartelera, cp.peliculas_id pelicula FROM cartelera c, carteleras_peliculas cp WHERE cp.peliculas_id='$id' AND c.id= cp.carteleras_id"));

        if (!empty($data_pelicula)) {
            $pelicula = Peliculas::find($data_pelicula[0]->pelicula);
            
            for ($i = 0; $i < count($data_pelicula); $i++) {
                $carteleras[$i] = Carteleras::find($data_pelicula[$i]->cartelera);
            }
            for ($i = 0; $i < count($data_comentarios); $i++) {
                $comentarios[$i] = $data_comentarios[$i];
            }
           
            if (!empty($data_comentarios)) {
                return view('admin.peliculas.show')->with(['comentarios' => $comentarios])->with(['user' => $user])->with(['generos' => $generos])->with(['today' => $today])->with(['directores' => $directores])->with(['carteleras' => $carteleras])->with(['pelicula' => $pelicula]);
            } else {
                return view('admin.peliculas.show')->with(['user' => $user])->with(['generos' => $generos])->with(['today' => $today])->with(['directores' => $directores])->with(['carteleras' => $carteleras])->with(['pelicula' => $pelicula]);
            }
            
            
        } else {
            $pelicula = Peliculas::find($id);

            for ($i = 0; $i < count($data_comentarios); $i++) {
                $comentarios[$i] = $data_comentarios[$i];
            }

            if (!empty($data_comentarios)) {
                return view('admin.peliculas.show')->with(['comentarios' => $comentarios])->with(['user' => $user])->with(['generos' => $generos])->with(['today' => $today])->with(['directores' => $directores])->with(['pelicula' => $pelicula]);
            } else {
                return view('admin.peliculas.show')->with(['user' => $user])->with(['generos' => $generos])->with(['today' => $today])->with(['directores' => $directores])->with(['pelicula' => $pelicula]);
            }
        }
    }

    public function update(Request $request, $id) {
        $generos = Generos::all();
        $directores = Directores::all();
        $pelicula = Peliculas::find($id);
        if ($request->hasfile('imagen')) {
            $cover = $request->file('imagen');
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename() . '.' . $extension, File::get($cover));
            $pelicula->mime = $cover->getClientMimeType();
            $pelicula->original_filename = $cover->getClientOriginalName();
            $pelicula->filename = $cover->getFilename() . '.' . $extension;
        }

        $pelicula->nombre = $request->nombre;
        $pelicula->estreno = $request->estreno;
        $pelicula->duracion = $request->duracion;
        $pelicula->sinopsis = $request->sinopsis;
        $pelicula->trailer = $request->trailer;
        $pelicula->generos()->sync($request->generos);
        $pelicula->directores()->sync($request->director);

        if ($pelicula->save()) {
            $request->session()->flash('success', 'Película actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar la película.');
        }
        return redirect()->route('admin.administrar.getPeliculas')->with(['generos' => $generos])->with(['directores' => $directores])->with(['peliculas' => $pelicula]);
    }

    public function destroy(Request $request, $id) {
        $pelicula = Peliculas::find($id);
        if ($pelicula->delete()) {

            $request->session()->flash('success', 'Película borrada correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible borrar la película.');
        }


        return redirect()->route('admin.administrar.getPeliculas');
    }

}
