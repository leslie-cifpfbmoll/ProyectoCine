<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use \App\Generos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerosController extends Controller {

    public function index() {
        $generos = Generos::paginate(10);
        return view('admin.generos.index')->with('generos', $generos);
    }


    public function create() {
        return view('admin.generos.create');
    }

    public function store(Request $request) {
        if (!$request->name) {
            $request->session()->flash('error', 'Rellena todos los campos.');
            return view('admin.generos.create');
        }
        Generos::create([
            'nombre' => $request->name,
        ]);
        $request->session()->flash('success', 'Género creado correctamente.');
        return redirect()->route('admin.generos.index');
    }

    public function edit($id) {
        $generos = Generos::all();
        $genero = Generos::find($id);
        return view('admin.generos.edit')->with(['genero' => $genero, 'generos' => $generos]);
    }

    public function update(Request $request, $id) {
        $genero = Generos::find($id);
        $genero->nombre = $request->genero;
        if($genero->save()){
             $request->session()->flash('success', 'Género actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar el género.');
        }
        return redirect()->route('admin.generos.index');
    }

    public function destroy(Request $request, $id) {
        $genero = Generos::find($id);
        if($genero->delete()){
             $request->session()->flash('success', 'Género borrado correctamente.');
        }else{
              $request->session()->flash('error', 'No ha sido posible borrar el género.');
        }
        
        return redirect()->route('admin.generos.index');
    }

}
