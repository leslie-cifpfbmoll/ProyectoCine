@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header ">
                    <div class="card-columns">
                        <div class="card border-light"> 
                            <a class="card-body"> Dashboard</a>
                        </div>
                        <div class="card invisible"></div>
                        <div class="card border-light text-right"> 
                            <form action="{{ route('admin.carteleras.create') }}" method="GET">
                                <input name="fecha" type="hidden" value={{$fecha}}>
                                    <button type="submit" type='button' class="btn btn-primary btn-sm">Add</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @php
                    $mañana=date("Y-m-d", strtotime("+1 days"));
                    $day3=date("Y-m-d", strtotime("+2 days"));
                    $day4=date("Y-m-d", strtotime("+3 days"));
                    $day5=date("Y-m-d", strtotime("+4 days"));
                    @endphp
                    <form action="{{ route('admin.carteleras.index') }}" method="GET">
                        <div class='input-group pull-left w-30-pct'>
                            <!-- onchange="this.form.submit()" -->
                            <select name="dias" class="form-control" id="fecha" > 
                                <option value={{date("Y-m-d")}}>Hoy</option>
                                <option value={{$mañana}} @if(isset($fecha) && $fecha==$mañana){{"selected"}} @endif >Mañana</option>
                                <option value={{$day3}} @if(isset($fecha) && $fecha==$day3){{"selected"}} @endif >{{date("l",strtotime($day3))}}</option>
                                <option value={{$day4}} @if(isset($fecha) && $fecha==$day4){{"selected"}} @endif>{{date("l",strtotime($day4))}}</option>
                                <option value={{$day5}} @if(isset($fecha) && $fecha==$day5){{"selected"}} @endif>{{date("l",strtotime($day5))}}</option>
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

                    @foreach($carteleras as $cartelera)
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-md-3 "> 

                                <img  height="300px" src="{{url('uploads/'.(implode(', ', $cartelera->peliculas()->get()->pluck('filename')->toArray())))}}" alt="Card image cap" role="img"></img>

                            </div>
                            <div class="col-md-8">
                                <div class="card-body">

                                    <h5 class="card-title">{{ implode(', ', $cartelera->peliculas()->get()->pluck('nombre')->toArray()) }}</h5>
                                    <br>
                                        <p class="card-title"> Sala: {{ implode(', ', $cartelera->salas()->get()->pluck('id')->toArray()) }}</p><br>
                                            <p class="card-text"> Duración: {{ implode(', ', $cartelera->peliculas()->get()->pluck('duracion')->toArray()) }} min. </p>

                                            <p class="card-text">Horarios: {{ implode(', ', $cartelera->horarios()->get()->pluck('hora')->toArray()) }}</p>
                                            <div class="d-flex justify-content-end">
                                                <a href="{{route('admin.carteleras.edit', $cartelera->id) }}" class="float-left">
                                                    <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                                </a>  
                                                <form action="{{ route('admin.carteleras.destroy', ['cartelera' => $cartelera->id]) }}" method="POST">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="sumbite" class="btn btn-danger btn-sm">Remove</button>
                                                </form>
                                            </div>


                                            </div>
                                            </div>
                                            </div>
                                            </div>

                                            @endforeach

                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            @endsection
