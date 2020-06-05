@extends('layouts.layout')

@section('content')
<div class="container" id="show-pelicula">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container">
                <div class="row col-md-12 justify-content-md-center">
                    <h4 class="text-center"> </h4>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-3 "> 



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
                        
                        <select id="cartelera">
                            @foreach($carteleras as $cartelera)
                            @php 
                            $cartelera["horarios_id"] = implode(', ', $cartelera->horarios()->get()->pluck('id')->toArray()); @endphp
                            
                            @if($cartelera->fecha >= $today)   
                            <option data-value="{{$cartelera}}">
                                {{$cartelera->fecha}}
                            </option>
                            @endif
                            @endforeach
                        </select>

                        <form id="dynamic_form" action="" method="POST">
                            @csrf
                            {{method_field('POST')}}
                            <button type="sumbite" class="btn btn-primary btn-sm">Reservar</button>
                        </form>




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
@section ('script_reserva')
<script>


    $(document).ready(function () {

    });
    $('#dynamic_form').submit(function () {
        var cartelera_id = $("#cartelera").find(":selected").data("value").id;
        var horarios_id = $("#cartelera").find(":selected").data("value").horarios_id;
        var url = "{{ route("admin.reservas.index", ["cartelera_id","horarios_id"])}}";
        var url_view = url;
        url_view = url_view.replace("horarios_id", horarios_id);
        url_view = url_view.replace("cartelera_id", cartelera_id);
        $(this).attr('action', url_view);


        return true;

    });





</script>
@endsection
