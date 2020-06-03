@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Editar película</h5></div>
                <div class="card-body">
                    <form action="{{ route('admin.peliculas.update', ['pelicula' => $pelicula->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 col-md-2 col-form-label">Título</label>
                            <div class="col-sm-9 col-md-10">
                                <input id="fname" type="text" name="nombre" class="form-control" value="{{$pelicula->nombre}}">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="festreno" class="col-sm-3 col-md-2 col-form-label">Estreno </label>
                            <div class="col-sm-9 col-md-10">
                                <input id="festreno" type="date" class="form-control" name="estreno" value="{{$pelicula->estreno}}">
                            </div>  
                        </div>  
                        <div class="form-group row">
                            <label for="fduracion" class="col-sm-3 col-md-2 col-form-label">Duración (min.)</label>
                            <div class="col-sm-9 col-md-10">
                                <input id="fduracion" type="number" class="form-control" name="duracion" value="{{$pelicula->duracion}}">
                            </div>  
                        </div> 
                        <div class="form-group row">
                            <label for="fsinopsis" class="col-sm-3 col-md-2 col-form-label">Sinopsis</label>
                            <div class="col-sm-9 col-md-10">
                                <textarea class="form-control" id="fsinopsis" type="text" name="sinopsis" class="form-control"  rows="3" required >{{$pelicula->sinopsis}}</textarea>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 col-form-label" for="fgenero">Géneros</label><br>
                            <div class="col-sm-9 col-md-10">
                                @foreach($generos as $genero)
                                <input type="checkbox" name="generos[]" value="{{ $genero->id }}"
                                       @if($pelicula->generos->pluck('id')->contains($genero->id)) checked @endif>
                                       <label>{{$genero->nombre}} </label>                                             
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fdirector" class="col-sm-3 col-md-2 col-form-label">Director</label>
                            <div class="col-sm-9 col-md-10">
                                <select class="form-control" name="director" id="fdirector">
                                    <option selected="selected" value=" {{ implode(', ', $pelicula->directores()->get()->pluck('id')->toArray()) }}">
                                        {{ implode(', ', $pelicula->directores()->get()->pluck('nombre')->toArray()) }}
                                        {{ implode(', ', $pelicula->directores()->get()->pluck('apellido')->toArray()) }}
                                    </option>

                                    @foreach($directores as $director)
                                    @if (  implode(', ',  $pelicula->directores()->get()->pluck('nombre')->toArray()) !== $director->nombre )

                                    <option value="{{$director->id}}">{{$director->nombre}} {{$director->apellido}}</option>                                                  
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imagen" class="col-sm-3 col-md-2 col-form-label">Image</label>
                            <div class="col-sm-9 col-md-10">
                                <input type="file" class="form-control" name="imagen" value="{{$pelicula->filename}}">
                            </div>
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
