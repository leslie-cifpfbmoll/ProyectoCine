@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Añadir Proyección</div>

                <div class="card-body">
                    <form action="{{ route('admin.carteleras.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="fpelicula">Pelicula:</label>
                            <select class="form-control" name="pelicula" id="fpelicula">
                                @foreach($peliculas as $pelicula)
                                <option value="{{$pelicula->id}}">{{$pelicula->nombre}} </option>                                                  
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fsala">Sala:</label>
                            <select class="form-control" name="sala" id="fsala">
                                @foreach($salas as $sala)
                                <option value="{{$sala->id}}">{{$sala->id}} </option>                                                  
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fhorario">Horario: </label>

                            @foreach($horarios as $horario)
                            <input type="checkbox" name="horarios[]" value="{{ $horario->id }}">
                            <label>{{$horario->hora}} </label>                                              
                            @endforeach

                        </div>
                        <div class="form-group">
                            <label for="fecha">fecha</label>
                            <input id="fecha" type="date" name="fecha" value="{{date("Y-m-d")}}">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input id="precio" type="number" name="precio">
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
