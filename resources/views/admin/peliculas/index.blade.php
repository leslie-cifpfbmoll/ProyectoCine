@extends('layouts.app')

@section('content')
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
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Género</th>
                                <th scope="col">Director</th>
                                <th scope="col">Estreno</th>
                                <th scope="col">Duración</th>
                                <th scope="col">Sinópsis</th>
                                <th scope="col">Actions</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($peliculas as $pelicula)
                            <tr>
                                <th>
                                    {{ $pelicula->nombre }}</th>
                                <th>
                                    {{ implode(', ', $pelicula->generos()->get()->pluck('nombre')->toArray()) }}
                                </th>
                                <th>
                                    {{ implode(', ', $pelicula->directores()->get()->pluck('nombre')->toArray()) }}
                                    {{ implode(', ', $pelicula->directores()->get()->pluck('apellido')->toArray()) }}</th>
                                <th>
                                    {{ $pelicula->estreno }}</th>
                                <th>
                                    {{ $pelicula->duracion }}(min.)</th>
                                <th>
                                    {{ $pelicula->sinopsis }}</th>
                                 <th>
                                    <a href="{{route('admin.peliculas.edit', $pelicula->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                    </a>  
                                    <form action="{{ route('admin.peliculas.destroy', ['pelicula' => $pelicula->id]) }}" method="POST">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="sumbite" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </th>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$peliculas->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
