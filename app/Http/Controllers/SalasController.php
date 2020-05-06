<?php

namespace App\Http\Controllers;
use \App\Salas;
use Illuminate\Http\Request;

class SalasController extends Controller
{
     public function getAll(){
        $salas =Salas::all();
        return $salas;
    }
      public function add(Request $request){
        $sala = Salas::create($request->all());
        return $sala;
    }
    
    public function get($id){
        $sala = Salas::find($id);
        return $sala;
    }
    
    public function edit($id, Request $request){
        $sala = $this->get($id);
        $sala->fill($request->all())->save();
        return $sala; 
    }
    public function delete($id){
        $sala = $this->get($id);
        $sala->delete();
        return $sala;
    }
   

}
