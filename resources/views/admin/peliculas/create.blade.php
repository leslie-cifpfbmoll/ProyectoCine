@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Añadir película</div>

                <div class="card-body">
                    <form action="{{ route('admin.peliculas.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-check">
                            <div class="form-group">
                                <label for="fname">Título</label>
                                <input id="fname" type="text" name="nombre" value="{{old('nombre')}}">
                            </div>
                            <div class="form-group">
                                <label for="festreno">Estreno </label>
                                <input id="festreno" type="date" name="estreno" value="{{old('estreno')}}">
                            </div>  
                            <div class="form-group">
                                <label for="fduracion">Duración (min.)</label>
                                <input id="fduracion" type="number" name="duracion" value="{{old('duracion')}}">
                            </div> 
                            <div class="form-group">
                                <label for="fduracion">Sinópsis</label>
                                <input id="fduracion" type="text" name="sinopsis" value="{{old('sinpsis')}}">
                            </div>
                            <div class="form-group">
                                <label for="fgenero">Géneros:</label><br>

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
                            <div class="form-group">
                                <label for="imagen" >Image</label>
                                <input type="file" class="form-control" name="imagen">
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
