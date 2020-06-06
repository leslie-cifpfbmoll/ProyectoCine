@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card-header ">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            @php
                            $mañana=date("Y/m/d", strtotime("+1 days"));
                            $day3=date("Y/m/d", strtotime("+2 days"));
                            $day4=date("Y/m/d", strtotime("+3 days"));
                            $day5=date("Y/m/d", strtotime("+4 days"));
                            @endphp

                            <form  action="{{ route('admin.carteleras.index') }}" method="GET">
                                <div class='input-group pull-left w-30-pct'>
                                    <!-- onchange="this.form.submit()" -->

                                    <select name="dias" onchange="this.form.submit()" class="form-control" id="fecha" > 
                                        <option type="submit" value={{date("Y/m/d")}}>{{date("Y/m/d")}}</option>
                                        <option type="submit" value={{$mañana}} @if(isset($fecha) && $fecha==$mañana){{"selected"}} @endif >{{$mañana}}</option>
                                        <option type="submit" value={{$day3}} @if(isset($fecha) && $fecha==$day3){{"selected"}} @endif >{{$day3}}</option>
                                        <option type="submit" value={{$day4}} @if(isset($fecha) && $fecha==$day4){{"selected"}} @endif>{{$day4}}</option>
                                        <option type="submit" value={{$day5}} @if(isset($fecha) && $fecha==$day5){{"selected"}} @endif>{{$day5}}</option>
                                    </select>
                                    <span class='input-group-btn'>
                                        <button type='submit' class='btn btn-default' type='button'>
                                            <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </span>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <div class="row justify-content-around"> 
                    @php $contador = 0; @endphp
                    @foreach($carteleras ?? '' as $cartelera)
                    @php $contador++; @endphp
                    @if($contador == 5 )
                    @php $contador = 1; @endphp
                </div>

                <div class="row justify-content-between mt-2">
                    @endif

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="hovereffect">
                            <img class="img-fluid" src="{{url('uploads/'.(implode(', ', $cartelera->peliculas()->get()->pluck('filename')->toArray())))}}" alt="">
                                <div class="overlay">
                                    <h2>{{ implode(', ', $cartelera->peliculas()->get()->pluck('nombre')->toArray()) }}</h2>

                                    <p class="card-title"> Sala: {{ implode(', ', $cartelera->salas()->get()->pluck('numSala')->toArray()) }}</p>
                                    <p class="card-text"> Duración: {{ implode(', ', $cartelera->peliculas()->get()->pluck('duracion')->toArray()) }} min. </p>

                                    <p class="card-text">Horarios: {{ implode(', ', $cartelera->horarios()->get()->pluck('hora')->toArray()) }}</p>

                                    <p> <div class="row">   
                                            <div class="col">
                                                <form action="{{ route('admin.reservas.index', [$cartelera->id, $cartelera->horarios()->get()->pluck('id')]) }}" method="POST">
                                                    @csrf
                                                    {{method_field('POST')}}
                                                    <button type="sumbite" class="btn btn-primary btn-sm">Reservar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
@endsection
