<?php

namespace App\Http\Controllers\Admin;

use App\Carrousel;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Peliculas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CarrouselController extends Controller {

    public function index() {
        $carrousel = Carrousel::paginate(10);
        return view('admin.carrousel.index')->with('carrousel', $carrousel);
    }

    public function create() {
        $peliculas = Peliculas::all();

        return view('admin.carrousel.create')->with(['peliculas' => $peliculas]);
    }

    public function store(Request $request) {
        if (!$request->imagen || !$request->pelicula) {

            $request->session()->flash('error', 'Rellena todos los campos.');

            return back()->withInput($request->all);
        }
        $cover = $request->file('imagen');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put($cover->getFilename() . '.' . $extension, File::get($cover));
        $carrousel = Carrousel::create([
                    'mime' => $cover->getFilename(),
                    'original_filename' => $cover->getClientOriginalName(),
                    'filename' => $cover->getFilename()
        ]);
        $carrousel->peliculas()->sync($request->pelicula);
        $request->session()->flash('success', 'Foto añadida correctamente.');

        return redirect()->route('admin.carrousel.index');
    }

    public function edit($id) {
        $foto = Carrousel::find($id);
        $carrousel = Carrousel::all();
        $peliculas = Peliculas::all();

        return view('admin.carrousel.edit')->with(['foto' => $foto, 'carrousel' => $carrousel])->with(['peliculas' => $peliculas]);
    }

    public function update(Request $request, $id) {
        $foto = Carrousel::find($id);
        if ($request->hasfile('imagen')) {
            $cover = $request->file('imagen');
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename() . '.' . $extension, File::get($cover));
            $foto->mime = $cover->getClientMimeType();
            $foto->original_filename = $cover->getClientOriginalName();
            $foto->filename = $cover->getFilename() . '.' . $extension;
        }
        $foto->peliculas()->sync($request->pelicula);
        if ($foto->save()) {
            $request->session()->flash('success', 'Foto actualizada correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar la foto.');
        }return redirect()->route('admin.carrousel.index');
    }

    public function destroy(Request $request, $id) {
        $foto = Carrousel::find($id);
        if ($foto->delete()) {
            $request->session()->flash('success', 'Foto borrada correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible borrar la foto.');
        }

        return redirect()->route('admin.carrousel.index');
    }

}
