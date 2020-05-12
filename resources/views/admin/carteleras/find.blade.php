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
                            <a  href="{{route('admin.carteleras.create') }}">
                                <button type="button" class="btn btn-primary btn-sm">Add</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @php
                    $hoy = date("Y-m-d");
                    @endphp

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('admin.carteleras.index', '2020-05-12') }}">
                            <button type="button" class="btn btn-secondary">Hoy</button>
                        </a>  
                        <a href="{{route('admin.carteleras.find', '2020-05-13') }}">
                            <button type="button" class="btn btn-secondary">Mañana</button>
                        </a> 

                    </div>
                    @foreach($carteleras as $cartelera)
                    
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-md-3 "> 

                                <img  height="300px" src="{{url('uploads/'.(implode(', ', $cartelera->peliculas()->get()->pluck('filename')->toArray())))}}" alt="Card image cap" role="img"></img>

                            </div>
                            <div class="col-md-8">
                                <div class="card-body">

                                    <h5 class="card-title">{{ implode(', ', $cartelera->peliculas()->get()->pluck('nombre')->toArray()) }}</h5><br>
                                    <p class="card-title"> Sala: {{ implode(', ', $cartelera->salas()->get()->pluck('id')->toArray()) }}</p<br>
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
