@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Añadir película</h5></div>
                <div class="card-body">
                    <form action="{{ route('admin.peliculas.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="fname"  class="col-sm-3 col-md-2 col-form-label">Título</label>
                            <div class="col-sm-9 col-md-10">
                                <input id="fname" type="text" name="nombre" class="form-control" value="{{old('nombre')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="festreno" class="col-sm-3 col-md-2 col-form-label">Estreno </label>
                            <div class="col-sm-9 col-md-10">
                                <input id="festreno" type="date" name="estreno" class="form-control" value="{{old('estreno')}}" required>
                            </div>  
                        </div>  
                        <div class="form-group row">
                            <label for="fduracion" class="col-sm-3 col-md-2 col-form-label">Duración (min.)</label>
                            <div class="col-sm-9 col-md-10">
                                <input id="fduracion" type="number" min="1" name="duracion" class="form-control" value="{{old('duracion')}}" required>
                            </div>  
                        </div> 
                        <div class="form-group row">
                            <label for="fsinopsis" class="col-sm-3 col-md-2 col-form-label">Sinópsis</label>
                            <div class="col-sm-9 col-md-10">
                                <textarea class="form-control" id="fsinopsis" type="text" name="sinopsis" class="form-control" value="{{old('sinpsis')}}" rows="3" required ></textarea>
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-md-2 col-form-label" for="fgenero">Géneros</label><br>
                            <div class="col-sm-9 col-md-10">
                                @foreach($generos as $genero)
                                <input type="checkbox" name="generos[]" value="{{ $genero->id }}">
                                <label>{{$genero->nombre}} </label>                                              
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fdirector" class="col-sm-3 col-md-2 col-form-label">Director</label>
                            <div class="col-sm-9 col-md-10">
                                <select class="form-control" name="director" id="fdirector">
                                    <option value="" id="dselect" selected disabled>Select</option>
                                    @foreach($directores as $director)
                                    <option value="{{$director->id}}">{{$director->nombre}} {{$director->apellido}}</option>                                                  
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imagen" class="col-sm-3 col-md-2 col-form-label">Image</label>
                            <div class="col-sm-9 col-md-10">
                                <input type="file" class="form-control" name="imagen" required>
                            </div>
                        </div>


                        <button type="submite" class="btn btn-primary">
                            Añadir
                        </button>

                    </form>


                </div>
                </html>
            </div>
        </div>
    </div>
</div>
@endsection
