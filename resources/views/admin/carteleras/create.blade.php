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

                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Sala</th>
                                    <th scope="col">Horarios</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($horarios_disponibles as $horario_disponible)
                                <tr>
                                    <th>
                                        {{ $horario_disponible-> id }}</th>
                                    <th>
                                        <input name="sala" type="hidden" value="{{$horario_disponible->id}}">
                                        <input type="checkbox" name="horarios[]" value="{{ $horario_disponible->horario_id }}">
                                        <label>{{ $horario_disponible->hora }} </label>   
                                    </th>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>



                        <div class="form-group">
                            <label for="fsala">Sala:</label>
                            <select class="form-control" name="sala" id="fsala">
                                @foreach($salas as $sala)
                                <option value="{{$sala->id}}" >{{$sala->id}} </option>                                                  
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input id="fecha" type="date" name="fecha" value={{$fecha}}>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input id="precio"  type="number" name="precio">
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
