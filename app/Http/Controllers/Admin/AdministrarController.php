<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use \App\Carteleras;
use App\Directores;
use \App\Peliculas;
use App\Horarios;
use \App\Salas;
use App\User;
use Illuminate\Http\Request;

class AdministrarController extends Controller {

    public function index(Request $request) {
        if ($request->has('dias') && !empty($request->input('dias'))) {
            $fecha = $request->input('dias');
        } else {
            $fecha = date("Y-m-d");
        }
        $carteleras = Carteleras::where('fecha', $fecha)->paginate(10);
        $horarios = Horarios::all();
        $peliculas = Peliculas::all();
        $salas = Salas::all();
        $users = User::paginate(10);
        return view('admin.administrar.index', compact('fecha'))->with(['carteleras' => $carteleras])
                        ->with(['horarios' => $horarios])->with(['peliculas' => $peliculas])
                        ->with(['salas' => $salas])->with('users', $users);
    }

    public function getUsuarios(Request $request) {
        $nombre = $request->input('buscar');
        $users = User::where('name', 'like', '%' . $nombre . '%')->orderBy('name')->paginate(10);
        return view('admin.administrar.usuarios')->with('users', $users);
    }

    public function getDirectores(Request $request) {
        $nombre = $request->input('buscar');
        $directores = Directores::where('nombre', 'like', '%' . $nombre . '%')->orderBy('apellido')->paginate(10);
        return view('admin.administrar.directores')->with('directores', $directores);
    }

    public function getPeliculas(Request $request) {
        $nombre = $request->input('buscar');
        $peliculas = Peliculas::where('nombre', 'like', '%' . $nombre . '%')->orderBy('estreno')->paginate(5);

        return view('admin.administrar.peliculas')->with('peliculas', $peliculas);
    }

    public function getSalas(Request $request) {
         if ($request->has('buscar') && !empty($request->input('buscar'))) {
            $idsala = $request->input('buscar');
              $salas = Salas::where('id', '=', $idsala)->paginate(10);
        } else {
             $salas = Salas::paginate(10);
        }
        
      
        return view('admin.administrar.salas')->with('salas', $salas);
    }

}
