@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header ">
                    <div class="card-columns">
                        <div class="card border-light"> 
                            <a class="card-body">Mi perfil: {{$user->name}}</a>
                        </div>
                        <div class="card invisible"></div>

                    </div>
                </div>

                <div class="card-body">


                    <div class="container">

                        <br>
                        <!-- Nav pills -->
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#home">Información de usuario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#menu1">Modificar usuario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#menu2">Reservas</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="home" class="container tab-pane active"><br>
                                <ul class="list-group">
                                    <li class="list-group-item">Nombre: {{$user->name}}</li>
                                    <li class="list-group-item">Correo: {{$user->email}}</li>
                                    <li class="list-group-item">Usuario desde: {{$user->created_at}}</li>
                                </ul>
                            </div>
                            <div id="menu1" class="container tab-pane fade"><br>
                                <div class="card-body">
                                    <form action="{{ route('admin.perfil.update', ['perfil' => $user->id]) }}" method="POST">
                                        @csrf
                                        {{method_field('PUT')}}

                                        <div class="form-group row">
                                            <label for="name" class="col-md-2 col-form-label text-md-right">Nombre</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-2 col-form-label text-md-right">Correo</label>


                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus size="5">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="form-group row">
                                            <label for="fpass" class="col-md-2 col-form-label text-md-right">Password</label>
                                            <input id="fpass" type="password" name="password" value="{{$user->password}}">
                                        </div>
                                        <button type="submite" class="btn btn-primary">
                                            Edit
                                        </button>

                                    </form>


                                </div>
                            </div>
                            <div id="menu2" class="container tab-pane fade"><br>
                                <table class="table">
                                    <thead class="thead-dark">
                                    <th scope="col">Película</th>
                                    <th scope="col">Día</th>
                                     <th scope="col">Hora</th>
                                    <th scope="col">Sala</th>
                                    <th scope="col">Nº entradas</th>
                                    </thead>
                                    <tbody>

                                        @foreach ($reservas as $reserva)
                                        <tr>
                                            <td>{{$reserva->nombre}}</td>
                                            <td>{{$reserva->fecha}}</td>
                                            <td>{{$reserva->hora}}</td>
                                            <td>{{$reserva->sala}}</td>
                                            <td>{{$reserva->cantidad}}</td>
                                        </tr>

                                        @endforeach


                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
