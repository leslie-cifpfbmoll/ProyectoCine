@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header ">
                    <div class="card-columns">
                        <div class="card border-light"> 
                            <a class="card-body">Reservar</a>
                        </div>


                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/admin/carteleras">Cartelera</a></li>

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
                            <li class="list-group-item">Sala: {{ implode(', ', $cartelera->salas()->get()->pluck('id')->toArray()) }}</li>
                            <li class="list-group-item">
                                <label for="precio">Elige hora: </label>
                                @php $horarios = $cartelera->horario()->get() @endphp

                                <select class="form-control" name="horario">
                                    @foreach($horarios as $horario)
                                   
                                    <option value="{{$horario->id}}"> {{ $horario->hora }}</option>
                                    @endforeach

                                </select>



                            </li>
                            <li class="list-group-item">Día: {{ $cartelera->fecha }}</li>
                            <li class="list-group-item">Precio: {{ implode(', ', $cartelera->precios()->get()->pluck('precio')->toArray()) }} €</li>
                        </ul>


                        <div class="form-group">
                            <label for="precio">Elige cantidad: </label>
                            <input id="cantidad" type="number" min="1" max="{{$sitio[0]->sitios}}" name="cantidad" value="1">
                        </div>
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
