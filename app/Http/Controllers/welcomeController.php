<?php

namespace App\Http\Controllers;
use \App\Carteleras;
use \App\Peliculas;
use App\Horarios;
use App\Carrousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class welcomeController extends Controller {

    public function index(Request $request) {
        $fecha = date("Y-m-d");
        $carousel = Carrousel::all();
        $carteleras = Carteleras::where('fecha', $fecha)->get();
        $estrenos = DB::select('select * from peliculas where peliculas.estreno > "'.$fecha.'"' );
        
        return view('welcome', compact('fecha'))->with(['carteleras' => $carteleras])->with(['carousel' => $carousel])->with(['estrenos' => $estrenos]);
    }

}
