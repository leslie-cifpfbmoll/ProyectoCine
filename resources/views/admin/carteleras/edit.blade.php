@extends('layouts.layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> 
                    <div class="container">

                        <div class="row justify-content-between">
                            <div class="col-lg-10 col-sm-6">
                                <h4>Editar Proyección</h4>
                            </div>
                            <div class="col-lg-2" col-sm-6>
                                @php
                                date_default_timezone_set('Europe/Madrid');
                                setlocale(LC_TIME, 'spanish');
                                @endphp
                                <p>{{strftime("%A, %d de %B ", strtotime($cartelera->fecha))}}</p> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.carteleras.update', ['cartelera' => $cartelera->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group row">
                            <label for="fpelicula" class="col-sm-2 col-form-label">Pelicula:</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="pelicula" id="fpelicula" >
                                    <option selected="selected" value="{{implode(', ', $cartelera->peliculas()->get()->pluck('id')->toArray())}}">
                                        {{ implode(', ', $cartelera->peliculas()->get()->pluck('nombre')->toArray()) }}
                                    </option>
                                    @foreach($peliculas as $pelicula)
                                    @if($cartelera->peliculas()->get()->pluck('nombre')->contains($pelicula->nombre))

                                    @else
                                    <option value="{{$pelicula->id}}">
                                        {{$pelicula->nombre}}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fsala" class="col-sm-2 col-form-label">Sala:</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="salaupdate" value="{{ implode(', ', $cartelera->salas()->get()->pluck('id')->toArray()) }}">
                                <select  class="custom-select" name="sala_id" id="fsala">
                                    <option  id="sselect" selected="selected" value="{{ implode(', ', $cartelera->salas()->get()->pluck('id')->toArray()) }} ">
                                        {{ implode(', ', $cartelera->salas()->get()->pluck('numSala')->toArray()) }} 
                                    </option>
                                    @foreach($salas as $sala)
                                    @if($cartelera->salas()->get()->pluck('numSala')->contains($sala->numSala))

                                    @else
                                    <option value="{{$sala->id}}">
                                        {{$sala->numSala}} 
                                    </option>
                                    @endif
                                    @endforeach


                                </select>
                            </div>
                            <input  id="fecha"  name="fecha" type="hidden"  value="{{$cartelera->fecha}}" >
                        </div>
                        <div class="form-group row" id="horariosDisponibles">
                            <label for="fhorario"  class="col-sm-2 col-form-label">Horarios: </label>
                            <div class="col-sm-10" >
                                @foreach($horarios as $horario)
                                @if($cartelera->horarios->pluck('id')->contains($horario->id))
                                <input type="checkbox" name="horarios[]" id="{{ $horario->id }}" class="marcado" value="{{ $horario->id }}"
                                       @if($cartelera->horarios->pluck('id')->contains($horario->id)) checked @endif>
                                       <label>{{$horario->hora}} </label>    
                                @endif
                                @endforeach
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="fhorario"  class="col-sm-2 col-form-label">Horarios Disponibles: </label>
                            <div class="col-sm-10" id="disponibles" ><i onclick='horarios_sala()' class='far fa-plus-square'></i>
                            </div>                         
                        </div>
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2  pt-0">Precio</legend>
                                <div class="col-sm-10 ">
                                    <div class="form-check">
                                        @foreach($precios as $precio)
                                        <input class="form-check-input" name="precio" type="radio" id="precio" value="{{$precio->id}}"   @if($cartelera->precios->pluck('id')->contains($precio->id)) checked @endif>
                                               <label class="form-check-label" for="precio">
                                            {{$precio->precio}}€
                                        </label><br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <button type="submite" class="btn btn-primary">
                            Edit
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
