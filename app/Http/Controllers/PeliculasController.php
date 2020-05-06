<?php

namespace App\Http\Controllers;
use \App\Peliculas;
use Illuminate\Http\Request;

class PeliculasController extends Controller
{
     public function getAll(){
        $peliculas =Peliculas::all();
        return $peliculas;
    }
     public function add(Request $request){
        $pelicula = Peliculas::create($request->all());
        return $pelicula;
    }
    
    public function get($id){
        $pelicula = Peliculas::find($id);
        return $pelicula;
    }
    
    public function edit($id, Request $request){
        $pelicula = $this->get($id);
        $pelicula->fill($request->all())->save();
        return $pelicula; 
    }
    public function delete($id){
        $pelicula = $this->get($id);
        $pelicula->delete();
        return $pelicula;
    }

}
