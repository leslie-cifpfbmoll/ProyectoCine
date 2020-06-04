@extends('layouts.layout')

@section('content')
<div class="container" id="show-pelicula">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" >
                <h4 class="card-header text-uppercase">{{ $pelicula->nombre }}</h4>

                <div class="row no-gutters" id="show-body">
                    <div class="col-md-3 d-none d-md-block d-lg-block"> 
                        <img  height="350px" src="{{url('uploads/'.$pelicula->filename)}}" alt="Card image cap" role="img"></img>
                    </div>
                    <div class="col-md-6">
                        <iframe width="100%" height="350px"  src="{{$pelicula->trailer}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-3">
                        <div class="card-body">
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
                <div class="row no-gutters  ">

                    <div class="col-sm-6 m-3">
                        <select name="fecha" id="ffecha" class="custom-select " required>
                           <!-- <option value="" id="ffecha" selected disabled>Cartelera</option>-->
                            @php
                            date_default_timezone_set('Europe/Madrid');
                            setlocale(LC_TIME, 'spanish');
                            @endphp
                            @foreach($fechas as $fecha)
                            <option value="{{$fecha->id}}" @if ($loop->index == 0) selected @endif >{{strftime("%A, %d de %B ", strtotime($fecha->fecha))}} </option>                                                  
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="row no-gutters  ">
                    <div id="cartelera-fecha" class="col-sm-6 m-3">

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
