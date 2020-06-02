@extends('layouts.layout')

@section('content')

@include('includes.head')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header ">
                    <h3>Películas</h3>
                </div>

                <div class="card-body">
                    @foreach($peliculas as $pelicula)

                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-md-3 "> 

                                <img  height="300px" src="{{url('uploads/'.$pelicula->filename)}}" alt="Card image cap" role="img"></img>

                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ $pelicula->nombre }}</h5>
                                    <p class="card-text">Género: {{ implode(', ', $pelicula->generos()->get()->pluck('nombre')->toArray()) }}</p>
                                    <p class="card-text">Director: {{ implode(', ', $pelicula->directores()->get()->pluck('nombre')->toArray()) }}
                                        {{ implode(', ', $pelicula->directores()->get()->pluck('apellido')->toArray()) }}</p>
                                    <p class="card-text">Estreno: {{ $pelicula->estreno }}</p>
                                    <p class="card-text">Duración: {{ $pelicula->duracion }}(min.)</p>
                                    <p class="card-text">Sinopsis: {{ $pelicula->sinopsis }}</p>
                                    <p class="card-text"><small class="text-muted">Last updated: {{ $pelicula->updated_at }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach

                    {{$peliculas->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
