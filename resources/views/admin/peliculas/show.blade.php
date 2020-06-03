@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container">
                <div class="row col-md-12 justify-content-md-center">
                    <h4 class="text-center">{{ $pelicula->nombre }}</h4>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-3 "> 
                        <img  height="350px" src="{{url('uploads/'.$pelicula->filename)}}" alt="Card image cap" role="img"></img>
                    </div>
                    <div class="col-md-6">
                        <iframe width="100%" height="350px"  src="{{$pelicula->trailer}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-3">
                        <div class="card-body">
                            <p class="card-text">Género: {{ implode(', ', $pelicula->generos()->get()->pluck('nombre')->toArray()) }}</p>
                            <p class="card-text">Director: {{ implode(', ', $pelicula->directores()->get()->pluck('nombre')->toArray()) }}
                                {{ implode(', ', $pelicula->directores()->get()->pluck('apellido')->toArray()) }}</p>
                            <p class="card-text">Estreno: {{ $pelicula->estreno }}</p>
                            <p class="card-text">Duración: {{ $pelicula->duracion }}(min.)</p>
                            <p class="card-text">Sinopsis: {{ $pelicula->sinopsis }}</p>
                            @can('administrar')
                            <p class="card-text"><small class="text-muted">Last updated: {{ $pelicula->updated_at }}</small></p>
                            @endcan        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
