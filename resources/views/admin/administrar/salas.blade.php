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
                            <a class="nav-link " href="{{route('admin.administrar.index') }}" aria-selected="false">Carteleras</a>
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
                            <a class="nav-link active" href="{{route('admin.administrar.getSalas') }}" aria-selected="true">Salas</a>
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
                                        <h2>Salas</h2>
                                    </div>
                                    <div class="col-1">
                                        <a  href="{{route('admin.salas.create') }}">
                                            <button type="button" class="btn btn-primary btn-sm">Add</button>
                                        </a>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <form action="{{ route('admin.administrar.getSalas') }}" method="GET">
                                            <div class='input-group pull-left w-30-pct'>
                                                <!-- onchange="this.form.submit()" -->
                                                <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar por id" aria-label="Search">

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
                                                    <th scope="col">Número de Sala</th>
                                                    <th scope="col">Número de filas</th>
                                                    <th scope="col">Número de columnas</th>
                                                    <th scope="col">Actions</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($salas as $sala)
                                                <tr>
                                                    <td>
                                                        {{ $sala-> id }}</td>
                                                    <td>
                                                        {{ $sala->numFilas }}</td>
                                                    <td>
                                                        {{ $sala->numColumnas }}</td>
                                                    <td>
                                                        <a href="{{route('admin.salas.edit', $sala->id) }}" class="float-left">
                                                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                                        </a>  
                                                        <form action="{{ route('admin.salas.destroy', ['sala' => $sala->id]) }}" method="POST">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                            <button type="sumbite" class="btn btn-danger btn-sm">Remove</button>
                                                        </form>
                                                    </td>

                                                </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{$salas->links()}}
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
