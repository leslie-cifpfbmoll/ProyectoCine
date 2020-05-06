<?php

namespace App\Http\Controllers;
use \App\Directores;
use Illuminate\Http\Request;

class DirectoresController extends Controller
{
     public function getAll(){
        $directores = Directores::all();
        return $directores;
    }
    public function add(Request $request){
        $director = Directores::create($request->all());
        return $director;
    }
    
    public function get($id){
        $director = Directores::find($id);
        return $director;
    }
    
    public function edit($id, Request $request){
        $director = $this->get($id);
        $director->fill($request->all())->save();
        return $director; 
    }
    public function delete($id){
        $director = $this->get($id);
        $director->delete();
        return $director;
    }
    
}
