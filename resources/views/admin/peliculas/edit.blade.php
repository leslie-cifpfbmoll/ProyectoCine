@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> <div class="card-columns">
                        <div class="card border-light"> 
                        <a class="card-body"> Manage {{$pelicula->nombre}}</a>
                        </div>
                       
                    </div></div>

                <div class="card-body">
                    <form action="{{ route('admin.peliculas.update', ['pelicula' => $pelicula->id]) }}" method="POST">
                        @csrf
                        {{method_field('PUT')}}
                 
                            <label for="fname">Título</label>
                                <input id="fname" type="text" name="nombre" value="{{$pelicula->nombre}}">
                            <label for="festreno">Estreno</label>
                            <input id="festreno" type="date" name="estreno" value="{{$pelicula->estreno}}">
                            <label for="fduracion">Duración (min.)</label>
                            <input id="fduracion" type="integer" name="duracion" value="{{$pelicula->duracion}}">
                            <label for="fduracion">Sinópsis</label>
                            <input id="fduracion" type="text" name="sinopsis" value="{{$pelicula->sinopsis}}">
                            
                            <div class="form-group">
                                <label for="fgenero">Género:</label>
                              
                                    @foreach($generos as $genero)
                                   <input type="checkbox" name="generos[]" value="{{ $genero->id }}">
                                    <label>{{$genero->nombre}} </label>                                              
                                    @endforeach
                                
                            </div>
                            <div class="form-group">
                                <label for="fdirector">Director:</label>
                                <select class="form-control" name="director" id="fdirector">
                                    @foreach($directores as $director)
                                    <option value="{{$director->id}}">{{$director->nombre}} {{$director->apellido}}</option>                                                  
                                    @endforeach
                                </select>
                            </div>
                        
                        <button type="submite" class="btn btn-primary">
                           Edit
                        </button>
                    </form>
                
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection