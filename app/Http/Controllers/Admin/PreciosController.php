<?php

namespace App\Http\Controllers\Admin;
use App\Precios;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreciosController extends Controller
{
     public function index() {
        $precios = Precios::paginate(10);
        return view('admin.precios.index')->with('precios', $precios);
    }

    public function create() {
        return view('admin.precios.create');
    }

    public function store(Request $request) {
        if (!$request->tipo || !$request->precio) {

            $request->session()->flash('error', 'Rellena todos los campos.');
            return view('admin.precios.create');
        }
        Precios::create([
            'tipo' => $request->tipo,
            'precio' => $request->precio
        ]);
        $request->session()->flash('success', 'Precio creado correctamente.');

        return redirect()->route('admin.precios.index');
    }

    public function edit($id) {
        $precio = Precios::find($id);
        $precios = Precios::all();
        return view('admin.precios.edit')->with(['precio' => $precio, 'precios' => $precios]);
    }

    public function update(Request $request, $id) {
        $precio = Precios::find($id);
        $precio->tipo = $request->tipo;
        $precio->precio = $request->precio;
        if ($precio->save()) {
            $request->session()->flash('success', 'Precio actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar el precio.');
        }return redirect()->route('admin.precios.index');
    }

    public function destroy(Request $request, $id) {
        $precio = Precios::find($id);
        if ($precio->delete()) {
            $request->session()->flash('success', 'Precio borrado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible borrar el precio.');
        }

        return redirect()->route('admin.precios.index');
    }

}
