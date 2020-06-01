@extends('layouts.app')

@section('content')
hola
@include('includes.head')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header ">
                    <div class="card-columns">
                        <div class="card border-light"> 
                            <a class="card-body"> Dashboard</a>
                        </div>
                        <div class="card invisible"></div>
                        <div class="card border-light text-right"> 
                            <a  href="{{route('admin.peliculas.create') }}">
                                <button type="button" class="btn btn-primary btn-sm">Add</button>
                            </a>
                        </div>
                        
                    </div>
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
                                    <div class="d-flex justify-content-end">
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
@endsection
