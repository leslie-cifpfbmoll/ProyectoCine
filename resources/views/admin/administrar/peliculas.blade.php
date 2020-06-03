@extends('layouts.layout')

@section('content')
<br>
<div class="row justify-content-center">
    <div class="col-md-12">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <br>
        <div class="container">
            <h1>Administración</h1>
            <hr>
            <div class="row">
                <div class="col-md-2 mb-3">
                    <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('admin.administrar.index') }}" aria-selected="false">Carteleras</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('admin.administrar.getPeliculas') }}" aria-selected="true">Películas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.administrar.getDirectores') }}" aria-selected="false">Directores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{route('admin.administrar.getUsuarios') }}" aria-selected="false">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.administrar.getSalas') }}" aria-selected="false">Salas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.precios.index') }}" aria-selected="false">Precios</a>
                        </li>
                    </ul>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-10">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="cartelera" role="tabpanel" aria-labelledby="home-tab">
                            <div class="container">

                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <h2>Peliculas</h2>
                                    </div>
                                    <div class="col-1">
                                        <a  href="{{route('admin.peliculas.create') }}">
                                            <button type="button" class="btn btn-primary btn-sm">Add</button>
                                        </a>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <form action="{{ route('admin.administrar.getPeliculas') }}" method="GET">
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
                                </div>
                                <div class="row">
                                    <div class="col-12" id="admpeliculas">
                                        @foreach($peliculas as $pelicula)

                                        <div class="card text-white bg-dark mb-3">
                                            <div class="row no-gutters">
                                                <div class="col-md-3 "> 

                                                    <img  height="300px" src="{{url('uploads/'.$pelicula->filename)}}" alt="Card image cap" role="img"></img>

                                                </div>
                                                <div class="col-md-9">
                                                    <div class="card-body">
                                                        <div class="row justify-content-between">
                                                            <div class="col-6">
                                                                <h5 class="card-title text-center">{{ $pelicula->nombre }}</h5>
                                                            </div>
                                                            <div class="col-3">
                                                                <a href="{{route('admin.peliculas.edit', $pelicula->id) }}" class="float-left">
                                                                    <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                                                </a>  
                                                                <form action="{{ route('admin.peliculas.destroy', ['pelicula' => $pelicula->id]) }}" method="POST">
                                                                    @csrf
                                                                    {{method_field('DELETE')}}
                                                                    <button type="sumbite" class="btn btn-danger btn-sm">Remove</button>
                                                                </form>
                                                            </div>
                                                        </div>


                                                        <p class="card-text">Género: {{ implode(', ', $pelicula->generos()->get()->pluck('nombre')->toArray()) }}</p>
                                                        <p class="card-text">Director: {{ implode(', ', $pelicula->directores()->get()->pluck('nombre')->toArray()) }}
                                                            {{ implode(', ', $pelicula->directores()->get()->pluck('apellido')->toArray()) }}</p>
                                                        <p class="card-text">Estreno: {{ $pelicula->estreno }}</p>
                                                        <p class="card-text">Duración: {{ $pelicula->duracion }}(min.)</p>
                                                        <p class="card-text">Sinopsis: {{ $pelicula->sinopsis }}</p>
                                                        <p class="card-text"><small class="text-muted">Last updated: {{ $pelicula->updated_at }}</small></p>
                                                        <div class="d-flex justify-content-end">

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        {{$peliculas->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.col-md-8 -->
            </div>



        </div>
        <!-- /.container -->
    </div>
</div>
<br>
@endsection
