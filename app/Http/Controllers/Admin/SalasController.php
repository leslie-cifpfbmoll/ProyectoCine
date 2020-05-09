<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Salas;
use Illuminate\Http\Request;

class SalasController extends Controller
{
     public function index()
    {
        return view('admin.salas.index')->with('salas', Salas::paginate(10));
    }
     public function getAll(){
        $salas =Salas::all();
        return $salas;
    }
       public function create() {
        return view('admin.salas.create');
    }

    public function store(Request $request) {
        if(!$request->numFilas || !$request->numColumnas){
            return view('admin.salas.create');
        }
        Salas::create([
                    'numFilas' => $request->numFilas,
                    'numColumnas' => $request->numColumnas
        ]);
        return redirect()->route('salas.index');
    }
    

        public function edit($id)
    {
        return view('admin.salas.edit')->with(['sala'=> Salas::find($id), 'salas'=> Salas::all()]);
    }
     
    
    public function update(Request $request, $id){
        $sala = Salas::find($id);
        $sala-> numFilas = $request->numFilas;
        $sala-> numColumnas = $request->numColumnas;
        $sala->save();
        return redirect()->route('admin.salas.index');
    }
    public function destroy($id){
        $sala = Salas::find($id);
        $sala->delete();

        return redirect()->route('admin.salas.index');
    }
   

}
