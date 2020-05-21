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
                            <li class="breadcrumb-item active" aria-current="page">Reservar: {{ implode(', ', $reserva->peliculas()->get()->pluck('nombre')->toArray()) }}</li>
                        </ol>
                    </nav>

                </div>
                <div class="card-body">
                    <form>  
                        <ul class="list-group">
                            <li class="list-group-item">Película: {{ implode(', ', $reserva->peliculas()->get()->pluck('nombre')->toArray()) }}</li>
                            <li class="list-group-item">Sala: {{ implode(', ', $reserva->salas()->get()->pluck('id')->toArray()) }}</li>
                            <li class="list-group-item">Hora: {{ implode(', ', $reserva->horarios()->get()->pluck('hora')->toArray()) }}</li>
                              <li class="list-group-item">Día: {{ $reserva->fecha }}</li>
                              <li class="list-group-item">Precio: {{ $reserva->precio }} €</li>
                        </ul>
                       
                        
                  
                        <div class="form-group">
                            <label for="precio">Elige cantidad: </label>
                            <input id="precio" type="number" min="1" max="{{$sitio[0]->sitios}}" name="precio" value="">
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
