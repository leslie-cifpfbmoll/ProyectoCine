@extends('layouts.layout')

@section('content')
<div class="container">
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
                        @if (isset($carteleras))
                        <select id="cartelera">
                            @foreach($carteleras as $cartelera)
                            @php 
                            date_default_timezone_set('Europe/Madrid');
                            setlocale(LC_TIME, 'es_ES.UTF-8');
                            
                            $cartelera["horarios_id"] = implode(', ', $cartelera->horarios()->get()->pluck('id')->toArray()); @endphp

                            @if($cartelera->fecha >= $today)  
                           @php  $fecha = utf8_decode(strtotime($cartelera->fecha)); @endphp
                            <option data-value="{{$cartelera}}">
                                
                                {{strftime("%A, %d de %B ", $fecha)}} {{implode(' o ', $cartelera->horarios()->get()->pluck('hora')->toArray())}}
                            </option>
                            @endif
                            @endforeach
                        </select>

                        <form id="dynamic_form" action="" method="POST">
                            @csrf
                            {{method_field('POST')}}
                            <button type="sumbite" class="btn btn-primary btn-sm">Reservar</button>
                        </form>
                        @else RESERVA NO DISPONIBLE

                        @endif



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
        var url = "{{ route("admin.reservas.index", ["cartelera_id"])}}";
        var url_view = url;
        url_view = url_view.replace("cartelera_id", cartelera_id);
        $(this).attr('action', url_view);


        return true;

    });





</script>
@endsection
