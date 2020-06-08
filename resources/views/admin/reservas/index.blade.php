@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header ">
                   
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route ('welcome')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route ('admin.carteleras.index')}}">Cartelera</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Reservar: {{ implode(', ', $cartelera->peliculas()->get()->pluck('nombre')->toArray()) }}</li>
                        </ol>
                    </nav>

                </div>

                <div class="card-body">
                    <form action="{{ route('admin.reservas.pagar', $cartelera->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('POST')}}
                        <ul class="list-group">
                            <li class="list-group-item">Película: {{ implode(', ', $cartelera->peliculas()->get()->pluck('nombre')->toArray()) }}</li>
                            <li class="list-group-item " >Sala: {{ implode(', ', $cartelera->salas()->get()->pluck('numSala')->toArray()) }}</li>

                            <li class="list-group-item">
                                <label for="precio">Elige hora: </label>
                                @php $horarios = $cartelera->horarios()->get() @endphp

                                <select  class="form-control" id='horario' name="horario">
                                    @foreach($horarios as $horario)
                                    <option value="{{$horario->id}}"> {{ $horario->hora }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li class="list-group-item">Día: {{ $cartelera->fecha }}</li>
                            <li class="list-group-item">Precio: {{ implode(', ', $cartelera->precios()->get()->pluck('precio')->toArray()) }} €</li>
                            <li class="list-group-item"> <label for="precio">Elige cantidad: </label> 
                                <input id="cantidad"  class="form-control" type="number" min="1" max="100" name="cantidad" value="1"></li>
                        </ul>
                        <input type="hidden" id="sala_id" value="{{$cartelera->salas()->get()->pluck('id')}}">
                        <input type="hidden" id="cartelera_id" value="{{$cartelera->id}}">

                        
                        <button type="submite" class="btn btn-primary">
                            Pagar
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
//var ajaxurl = "http://127.0.0.1:8000/reservas/";
var ajaxurl = "http://3.22.174.23/reservas/";
// var ajaxurl= "http://localhost/ProyectoCine/public/reservas/";



    $(document).ready(function () {
        aforo_sala();
        $('select#horario').change(aforo_sala);
    });
    function aforo_sala() {
       
        var horario_id = $('#horario').val();
        var cartelera_id = $('#cartelera_id').val();
        var cantidad = document.querySelector("#cantidad");

        $.get(ajaxurl + "get-aforo?horario_id=" + horario_id + "&cartelera_id=" + cartelera_id, function (respuesta, status) {
            if (status == 'success') {
                cantidad.setAttribute("max", respuesta);
            }


        });


    }

</script>
@endsection
