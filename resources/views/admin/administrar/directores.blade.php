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
                            <a class="nav-link active" href="{{route('admin.administrar.getDirectores') }}" aria-selected="true">Directores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link "  href="{{route('admin.administrar.getUsuarios') }}" aria-selected="false">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.administrar.getSalas') }}" aria-selected="false">Salas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.precios.index') }}" aria-selected="false">Precios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.carrousel.index') }}" aria-selected="false">Carrousel</a>
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
                                        <h2>Directores</h2>
                                    </div>
                                    <div class="col-1">
                                        <a  href="{{route('admin.directores.create') }}">
                                            <button type="button" class="btn btn-primary btn-sm">Add</button>
                                        </a>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <form action="{{ route('admin.administrar.getDirectores') }}" method="GET">
                                            <div class='input-group pull-left w-30-pct'>
                                                <!-- onchange="this.form.submit()" -->
                                                <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search">

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
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Apellido</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($directores as $director)
                                                <tr>
                                                    <td>
                                                        {{ $director->nombre }}</td>
                                                    <td>
                                                        {{ $director->apellido }}</td>
                                                    <td>
                                                        <a href="{{route('admin.directores.edit', $director->id) }}" class="float-left">
                                                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                                        </a>  
                                                        <form action="{{ route('admin.directores.destroy', ['directore' => $director->id]) }}" method="POST">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                            <button type="sumbite" class="btn btn-danger btn-sm">Remove</button>
                                                        </form>

                                                    </td>

                                                </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{$directores->links()}}
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
