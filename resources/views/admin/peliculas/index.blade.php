@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header ">
                    <form action="{{ route('admin.peliculas.index') }}" method="GET">
                        <div class='input-group pull-left w-30-pct'>
                            <!-- onchange="this.form.submit()" -->
                            <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search">

                            <span class='input-group-btn'>
                                <button type='submit' class='btn btn-default' type='button'>
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>

                        </div>
                    </form>  
                </div>

                <div class="card-body">
                    @foreach($peliculas as $pelicula)

                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-md-3 "> 
                                <a href="{{route('admin.peliculas.show', $pelicula->id) }}"> 
                                    <img  height="300px" src="{{url('uploads/'.$pelicula->filename)}}" alt="Card image cap" role="img"></img>
                                </a>


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
                                    @can('administrar')
                                    <p class="card-text"><small class="text-muted">Last updated: {{ $pelicula->updated_at }}</small></p>
                                    @endcan        
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
