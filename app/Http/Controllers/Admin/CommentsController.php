<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\Peliculas;
use App\User;
use App\Generos;
use App\Directores;
use App\Carteleras;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $pelicula_id, $user_id) {

        $today = date("Y-m-d");
        $generos = Generos::all();
        $directores = Directores::all();
        $user = User::find($user_id);
        $pelicula = Peliculas::find($pelicula_id);



        $comment = new Comment();
        $comment->name = $user->name;
        $comment->email = $user->email;
        $comment->comment = $request->comentario;
        $comment->pelicula()->associate($pelicula);
        $comment->user()->associate($user);
        $comment->save();

        $data_comentarios = DB::select(DB::raw("SELECT c.id id, c.comment comentario, c.user_id user_id, c.name nombre, u.avatar FROM comments c, peliculas p, users u WHERE c.pelicula_id = '$pelicula_id' AND c.pelicula_id = p.id AND u.id = c.user_id"));
        $data_pelicula = DB::select(DB::raw("select c.id cartelera, cp.peliculas_id pelicula FROM cartelera c, carteleras_peliculas cp WHERE cp.peliculas_id='$pelicula_id' AND c.id= cp.carteleras_id"));

        if (!empty($data_pelicula)) {
            $pelicula = Peliculas::find($data_pelicula[0]->pelicula);

            for ($i = 0; $i < count($data_pelicula); $i++) {
                $carteleras[$i] = Carteleras::find($data_pelicula[$i]->cartelera);
            }
            for ($i = 0; $i < count($data_comentarios); $i++) {
                $comentarios[$i] = $data_comentarios[$i];
            }

            if (!empty($data_comentarios)) {
                return view('admin.peliculas.show')->with(['comentarios' => $comentarios])->with(['user' => $user])->with(['generos' => $generos])->with(['today' => $today])->with(['directores' => $directores])->with(['carteleras' => $carteleras])->with(['pelicula' => $pelicula]);
            } else {
                return view('admin.peliculas.show')->with(['user' => $user])->with(['generos' => $generos])->with(['today' => $today])->with(['directores' => $directores])->with(['carteleras' => $carteleras])->with(['pelicula' => $pelicula]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $pelicula_id, $comment_id) {
        $today = date("Y-m-d");
        $generos = Generos::all();
        $directores = Directores::all();
        $user = Auth::user();
        $pelicula = Peliculas::find($pelicula_id);
        $comentario = Comment::find($comment_id);


        if ($comentario->delete()) {
            $data_comentarios = DB::select(DB::raw("SELECT c.id id, c.comment comentario, c.user_id user_id, c.name nombre, u.avatar FROM comments c, peliculas p, users u WHERE c.pelicula_id = '$pelicula_id' AND c.pelicula_id = p.id AND u.id = c.user_id"));
            $data_pelicula = DB::select(DB::raw("select c.id cartelera, cp.peliculas_id pelicula FROM cartelera c, carteleras_peliculas cp WHERE cp.peliculas_id='$pelicula_id' AND c.id= cp.carteleras_id"));

            $request->session()->flash('success', 'Comentario borrado correctamente.');
            if (!empty($data_pelicula)) {
                $pelicula = Peliculas::find($data_pelicula[0]->pelicula);

                for ($i = 0; $i < count($data_pelicula); $i++) {
                    $carteleras[$i] = Carteleras::find($data_pelicula[$i]->cartelera);
                }
                for ($i = 0; $i < count($data_comentarios); $i++) {
                    $comentarios[$i] = $data_comentarios[$i];
                }

                if (!empty($data_comentarios)) {
                    return view('admin.peliculas.show')->with(['comentarios' => $comentarios])->with(['user' => $user])->with(['generos' => $generos])->with(['today' => $today])->with(['directores' => $directores])->with(['carteleras' => $carteleras])->with(['pelicula' => $pelicula]);
                } else {
                    return view('admin.peliculas.show')->with(['user' => $user])->with(['generos' => $generos])->with(['today' => $today])->with(['directores' => $directores])->with(['carteleras' => $carteleras])->with(['pelicula' => $pelicula]);
                }
            }
        } else {
            $request->session()->flash('error', 'No ha sido posible borrar el comentario.');
        }
    }

}
