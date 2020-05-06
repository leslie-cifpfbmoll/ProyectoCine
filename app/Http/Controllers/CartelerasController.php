<?php

namespace App\Http\Controllers;
use \App\Carteleras;
use Illuminate\Http\Request;

class CartelerasController extends Controller
{
     public function getAll(){
        $carteleras =Carteleras::all();
        return $carteleras;
    }
    public function add(Request $request){
        $cartelera = Carteleras::create($request->all());
        return $cartelera;
    }
    
    public function get($id){
        $cartelera = Carteleras::find($id);
        return $cartelera;
    }
    
    public function edit($id, Request $request){
        $cartelera = $this->get($id);
        $cartelera->fill($request->all())->save();
        return $cartelera; 
    }
    public function delete($id){
        $cartelera = $this->get($id);
        $cartelera->delete();
        return $cartelera;
    }
}