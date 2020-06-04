@extends('layouts.layout')

@section('content')                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12" id="perfil">
                            <div class="card">

                                <div class="card-header ">

                                    <div class="row">   
                                        <div class="col-md-3 col-4 card border-light"> 
                                            <!--<img src="http://3.22.174.23/uploads/avatars/{{$user->avatar}}" style="width: 150px; height: 150px; border-radius: 50%; float:left;">-->
                                            <img src="http://http://127.0.0.1:8000/uploads/avatars/{{$user->avatar}}" style="width: 150px; height: 150px; border-radius: 50%; float:left;">

                                        </div>

                                        <div class="col-md-4 col-8">
                                            <ul class="list-group-flush ">
                                                <li class="list-group-item">Nombre: {{$user->name}}</li>
                                                <li class="list-group-item">Correo: {{$user->email}}</li>
                                                <li class="list-group-item">Usuario desde: {{$user->created_at}}</li>
                                            </ul>
                                        </div>
                                       
                                    </div>


                                </div>

                                <div class="card-body">


                                    <div class="container">

                                        <br>
                                        <!-- Nav pills -->
                                        <ul class="nav nav-pills" role="tablist">
                                            <li class="nav-item ">
                                                <a class="nav-link active" data-toggle="pill" href="#menu1">Modificar usuario</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#menu2">Reservas</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#menu3">Editar foto de perfil</a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">

                                            <div id="menu1" class="container tab-pane active">
                                                <div class="card-body">
                                                    <form action="{{ route('admin.perfil.update', ['perfil' => $user->id]) }}" method="POST">
                                                        @csrf
                                                        {{method_field('PUT')}}

                                                        <div class="form-group row">
                                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                                                                @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                                                                @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                       <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{$user->password}}" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                                        <button type="submite" class="btn btn-primary">
                                                            Edit
                                                        </button>

                                                    </form>


                                                </div>
                                            </div>
                                            <div id="menu2" class="container tab-pane fade">
                                                <table class="table">
                                                    <thead class="thead-dark">
                                                    <th scope="col">Película</th>
                                                    <th scope="col">Día</th>
                                                    <th scope="col">Hora</th>
                                                    <th scope="col">Sala</th>
                                                    <th scope="col">Nº entradas</th>
                                                    <th scope="col"></th>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($reservas as $reserva)
                                                        <tr>
                                                            <td>{{$reserva->nombre}}</td>
                                                            <td>{{$reserva->fecha}}</td>
                                                            <td>{{$reserva->hora}}</td>
                                                            <td>{{$reserva->sala}}</td>
                                                            <td>{{$reserva->cantidad}}</td>
                                                            <td>
                                                                <form action="{{ route('admin.reservas.destroy', ['reserva' => $reserva->id]) }}" method="POST">
                                                                    @csrf
                                                                    {{method_field('DELETE')}}
                                                                    <button type="sumbite" class="btn btn-danger btn-sm">Eliminar reserva</button>
                                                                </form>

                                                            </td>
                                                        </tr>

                                                        @endforeach


                                                    </tbody>
                                                </table>


                                            </div>
                                            <div id="menu3" class="container tab-pane fade">
                                                <div class="card-body">
                                                    <form enctype="multipart/form-data" action="/admin/perfil" method="POST">
                                                        <img src="http://3.22.174.23/uploads/avatars/{{$user->avatar}}" style="width:150px; height: 150px; float:bottom; border-radius: 50%;margin-right: 25px;">
                                                        <input type="file" name="avatar">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <input type="submit" class="pull-right btn btn-sm btn-primary">

                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 @endsection