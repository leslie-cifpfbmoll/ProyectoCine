@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> <div class="card-columns">


                    </div></div>

                <div class="card-body">
                    <form action="{{ route('admin.carteleras.update', ['cartelera' => $carteleras->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group">
                            <label for="fpelicula">Pelicula:</label>

                            <select class="form-control" name="pelicula" id="fpelicula" >
                                <option selected="selected">
                                    {{ implode(', ', $carteleras->peliculas()->get()->pluck('nombre')->toArray()) }}
                                </option>

                                @foreach($peliculas as $pelicula)
                                @if (  implode(', ', $carteleras->peliculas()->get()->pluck('nombre')->toArray()) !== $pelicula->nombre )
                                <option value="{{$pelicula->id}}">{{$pelicula->nombre}} </option>
                                @endif
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fsala">Sala:</label>
                            <select class="form-control" name="sala" id="fsala">
                                <option selected="selected">
                                    {{ implode(', ', $carteleras->salas()->get()->pluck('id')->toArray()) }}
                                </option>
                                @foreach($salas as $sala)
                                @if (  implode(', ', $carteleras->salas()->get()->pluck('id')->toArray()) !== $sala->id )
                                <option value="{{$sala->id}}">{{$sala->id}} </option>      @endif

                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fhorario">Horario: </label>
         
                            @foreach($horarios as $horario)
                            <input type="checkbox" name="horarios[]" value="{{ $horario->id }}"
                            @if($carteleras->horarios->pluck('id')->contains($horario->id)) checked @endif>
                            <label>{{$horario->hora}} </label> 
                                                                     
                            @endforeach

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
