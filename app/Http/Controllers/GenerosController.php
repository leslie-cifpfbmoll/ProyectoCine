<?php

namespace App\Http\Controllers;
use \App\Generos;
use Illuminate\Http\Request;

class GenerosController extends Controller
{
    public function getAll(){
        $generos =Generos::all();
        return $generos;
    }
    public function add(Request $request){
        $genero = Generos::create($request->all());
        return $genero;
    }
    
    public function get($id){
        $genero = Generos::find($id);
        return $genero;
    }
    
    public function edit($id, Request $request){
        $genero = $this->get($id);
        $genero->fill($request->all())->save();
        return $genero; 
    }
    public function delete($id){
        $genero = $this->get($id);
        $genero->delete();
        return $genero;
    }

}
