@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> <div class="card-columns">


                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.carteleras.update', ['cartelera' => $carteleras->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <label for="fpelicula">Pelicula:</label>

                                <select class="form-control" name="pelicula" id="fpelicula" >
                                    <option selected="selected" value="{{implode(', ', $carteleras->peliculas()->get()->pluck('id')->toArray())}}">
                                        {{ implode(', ', $carteleras->peliculas()->get()->pluck('nombre')->toArray()) }}
                                    </option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fsala">Sala:</label>
                                <select class="form-control" name="sala_id" id="fsala">
                                    <option  id="sselect" selected="selected">
                                        {{ implode(', ', $carteleras->salas()->get()->pluck('id')->toArray()) }}
                                    </option>


                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fhorario">Horario: </label>
                                <div class="form-group" >
                                    @foreach($horarios as $horario)
                                    @if($carteleras->horarios->pluck('id')->contains($horario->id))
                                    <input type="checkbox" name="horarios[]" id="{{ $horario->id }}"  value="{{ $horario->id }}"
                                           @if($carteleras->horarios->pluck('id')->contains($horario->id)) checked @endif>
                                           <label>{{$horario->hora}} </label>    
                                    @endif
                                    @endforeach
                                </div>
                                <label for="fhorario">Horarios Disponibles: </label> <i onclick='horarios_sala()' class='far fa-plus-square'></i>
                                <div class="form-group" id="horarios" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fecha">fecha</label>
                                <input id="fecha" type="date" name="fecha" value="{{$carteleras->fecha}}" >
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input id="precio" type="number" name="precio" value="{{$carteleras->precio}}">
                            </div>
                            <button type="submite" class="btn btn-primary">
                                Edit
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
