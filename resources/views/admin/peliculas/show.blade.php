@extends('layouts.layout')

@section('content')
<div class="container">
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
                <div class="row no-gutters  row align-items-center">

                    <div class="col-sm-6 m-3">
                        @if (isset($carteleras))
                        <select name="fecha" id="cartelera" class="custom-select " required>
                            @foreach($carteleras as $cartelera)
                            <!-- <option value="" id="ffecha" selected disabled>Cartelera</option>-->
                            @php
                            date_default_timezone_set('Europe/Madrid');
                            setlocale(LC_TIME, 'es_ES.UTF-8');
                            @endphp
                            $cartelera["horarios_id"] = implode(', ', $cartelera->horarios()->get()->pluck('id')->toArray()); @endphp

                            @if($cartelera->fecha >= $today)  

                            <option data-value="{{$cartelera}}">
                                @php
                                setlocale(LC_TIME, "spanish");
                                $fecha = $cartelera->fecha;
                                $fecha = str_replace("/", "-", $fecha);			
                                $newDate = date("Y-m-d", strtotime($fecha));				
                                $mesDesc = strftime("%d de %B ", strtotime($newDate)); @endphp
                                {{$mesDesc}} {{implode(' o ', $cartelera->horarios()->get()->pluck('hora')->toArray())}}
                            </option>
                            @endif
                            @endforeach
                        </select>


                    </div>
                    <div class="col-sm-5">
                        <form id="dynamic_form" action="" method="POST">
                            @csrf
                            {{method_field('POST')}}
                            <button type="sumbit" class="btn btn-primary btn-sm">Reservar</button>
                        </form>
                        @else 
                        <div class="alert alert-danger" role="alert">
                            RESERVA NO DISPONIBLE
                        </div>

                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-5"></div>
        <div class="col-5"> <h2>COMENTARIOS</h2></div>
       
    </div>
   
    <div class="row">
        
        
        <div id="comment-form" class="col-12">
            @if(isset($user->id))
            <form action="{{ route('admin.comments.store', [$pelicula->id, $user->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{method_field('POST')}}

                <div class="row">
                    <div class="col-md-1">
                        <img src="http://localhost/ProyectoCine/public/uploads/avatars/{{$user->avatar}}" style="width: 50px; height: 50px; border-radius: 50%; float:left;">
                        <!--<img src="http://http://127.0.0.1:8000/uploads/avatars/{{$user->avatar}}" style="width: 150px; height: 150px; border-radius: 50%; float:left;">-->
                    </div>
                    <div class="col-md-6">
                        <div class="row-cols-3">
                            <strong>{{$user->name}}</strong></div>
                        <div class="row-cols-9">

                            <textarea id="comment" minlength="5" placeholder="Añade un comentario público"  class="form-control" name="comentario"  rows="4" cols="70" required></textarea>
                        </div>

                    </div>
                    <div class="col-3 mt-5">  
                        <button type="sumbit" class="btn btn-primary btn-sm">Comentar</button> 
                    </div>






                </div>

            </form>
            @endif
            @if (isset($comentarios))
            @foreach($comentarios as $comentario)
            <div class="row mt-3 mb-3">
            <!--<img src="http://http://127.0.0.1:8000/uploads/avatars/{{$comentario->avatar}}" style="width: 50px; height: 50px; border-radius: 50%; float:left;">-->
                <div class="col-md-1">
                    <img src="http://localhost/ProyectoCine/public/uploads/avatars/{{$comentario->avatar}}" style="width: 50px; height: 50px; border-radius: 50%; float:left;">
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <strong>{{$comentario->nombre}}</strong></div>
                    <div class="row">
                        {{$comentario->comentario}}</div>
                </div>
                @if(isset($user->id))
                @if($user->id == $comentario->user_id )
                <form action="{{ route('admin.comments.destroy', [$pelicula->id, $comentario->id]) }}" method="POST">
                    @csrf
                    {{method_field('POST')}}
                    <button type="sumbite" class="btn btn-danger btn-sm">Borrar comentario</button>
                </form>

                @endif
                @endif
            </div>
            @endforeach
            @endif
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