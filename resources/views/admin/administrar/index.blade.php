@extends('layouts.layout')

@section('content')
<br>
<div class="row justify-content-center">
    <div class="col-md-12">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <br>
        <div class="container">
            <h1>Administración</h1>
            <hr>
            <div class="row">
                <div class="col-md-2 mb-3">
                    <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('admin.administrar.index') }}" aria-selected="true">Carteleras</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.administrar.getPeliculas') }}" aria-selected="false">Películas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.administrar.getDirectores') }}" aria-selected="false">Directores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{route('admin.administrar.getUsuarios') }}" aria-selected="false">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.administrar.getSalas') }}" aria-selected="false">Salas</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.precios.index') }}" aria-selected="false">Precios</a>
                        </li>
                    </ul>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-10">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="cartelera" role="tabpanel" aria-labelledby="home-tab">
                            <div class="container">

                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <h2>Cartelera</h2>
                                    </div>
                                    <div class="col-1">
                                        <form action="{{ route('admin.carteleras.create') }}" method="GET">
                                            <input name="fecha" type="hidden" value={{$fecha}}>
                                            <button type="submit" type='button' class="btn btn-primary btn-sm">Add</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        @php
                                        date_default_timezone_set('Europe/Madrid');
                                        setlocale(LC_TIME, 'spanish');
                                        $mañana=date("Y/m/d", strtotime("+1 days"));
                                        $day3=date("Y/m/d", strtotime("+2 days"));
                                        $day4=date("Y/m/d", strtotime("+3 days"));
                                        $day5=date("Y/m/d", strtotime("+4 days"));
                                        @endphp
                                        <form action="{{ route('admin.administrar.index') }}" method="GET">
                                            <div class='input-group pull-left w-30-pct'>
                                                <!-- onchange="this.form.submit()" -->
                                                <select name="dias" class="form-control" id="fecha" > 
                                                    <option value={{date("Y/m/d")}}>{{date("Y/m/d")}}</option>
                                                    <option value={{$mañana}} @if(isset($fecha) && $fecha==$mañana){{"selected"}} @endif >{{$mañana}}</option>
                                                    <option value={{$day3}} @if(isset($fecha) && $fecha==$day3){{"selected"}} @endif >{{$day3}}</option>
                                                    <option value={{$day4}} @if(isset($fecha) && $fecha==$day4){{"selected"}} @endif>{{$day4}}</option>
                                                    <option value={{$day5}} @if(isset($fecha) && $fecha==$day5){{"selected"}} @endif>{{$day5}}</option>
                                                </select>
                                                <span class='input-group-btn'>
                                                    <button type='submit' class='btn btn-default' type='button'>
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </span>

                                            </div>
                                        </form>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Título</th>
                                                    <th scope="col">Sala</th>
                                                    <th scope="col">Horarios</th>
 						    <th scope="col">Precio</th>
                                                    <th scope="col">Actions</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($carteleras as $cartelera)
                                                <tr>
                                                    <td>
                                                        {{ implode(', ', $cartelera->peliculas()->get()->pluck('nombre')->toArray()) }}</td>
                                                    <td>
                                                        {{ implode(', ', $cartelera->salas()->get()->pluck('id')->toArray()) }}</td>
                                                    <td>
                                                        {{ implode(', ', $cartelera->horario()->get()->pluck('hora')->toArray()) }} </td>

                                                     <td> 
							{{$cartelera->precio }} euros </td>

                                                    <td>
                                                        <a href="{{route('admin.carteleras.edit', $cartelera->id) }}" class="float-left" >
                                                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                                        </a>  
                                                        <form action="{{ route('admin.carteleras.destroy', ['cartelera' =>$cartelera->id]) }}" method="POST">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                            <button type="sumbite" class="btn btn-danger btn-sm">Remove</button>
                                                        </form>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{$carteleras->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.col-md-8 -->
            </div>



        </div>
        <!-- /.container -->
    </div>
</div>
<br>
@endsection
