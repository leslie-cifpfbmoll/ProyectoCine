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
                                <h5>Añadir Proyección</h5>
                            </div>
                            <div class="col-lg-2" col-sm-6>
                                @php
                                date_default_timezone_set('Europe/Madrid');
                                setlocale(LC_TIME, 'spanish');
                                @endphp
                                <p>{{strftime("%A, %d de %B ", strtotime($fecha))}}</p> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                        <form action="{{ route('admin.carteleras.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="fpelicula" class="col-sm-2 col-md-1 col-form-label">Película: </label>
                                <div class="col-sm-10 col-md-11">
                                    <select name="pelicula" id="fpelicula" class="custom-select" required>
                                         <option value="" id="pselect" selected disabled>Select</option>
                                         
                                        @foreach($peliculas as $pelicula)
                                        <option value="{{$pelicula->id}}">{{$pelicula->nombre}} </option>                                                  
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fsala" class="col-sm-2 col-md-1 col-form-label">Sala:</label>
                                <div class="col-sm-10 col-md-11">
                                    <select name="sala_id" id="fsala" class="custom-select" required>
                                       <option value="" id="sselect" selected disabled>Select</option>
                                        @foreach($salas as $sala)
                                        <option id="sala" value="{{$sala->id}}">{{$sala->numSala}} </option>                                                  
                                        @endforeach

                                </select>
                                <input  id="fecha"  name="fecha" type="hidden" value={{$fecha}}>
                            </div>
                        </div>
                        <div class="form-group row" id="horarios">
                            <label class="col-sm-2 col-md-1 col-form-label">Horarios:</label>
                            <div class="col-sm-10 col-md-11">
                                <div id="disponibles">
                                </div>
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 col-md-1 pt-0">Precio</legend>
                                <div class="col-sm-10 col-md-11">
                                    <div class="form-check">
                                        @foreach($precios as $precio)
                                        <input class="form-check-input" type="radio" name="precio" id="precio" value="{{$precio->id}}" >
                                        <label class="form-check-label" for="precio">
                                            {{$precio->precio}}€ ({{$precio->tipo}})
                                        </label>
                                        <br>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </fieldset>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submite" class="btn btn-primary">
                                    Añadir
                                </button>
                            </div>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>
</div>

@endsection


