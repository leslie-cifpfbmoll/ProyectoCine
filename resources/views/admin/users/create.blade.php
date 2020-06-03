@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Crear usuario</h5></div>

                <div class="card-body">
                    <form action="{{ route('admin.users.store')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="fname" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="fname" type="text" name="name">
                            </div>
                        </div>
                        <div class="form-group row"> 
                            <label for="fcorreo" class="col-sm-2 col-form-label">Correo</label>
                            <div class="col-sm-10">
                                <input id="fcorreo" class="form-control" type="email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fpass" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input id="fpass" class="form-control" type="password" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="frol" class="col-sm-2 col-form-label">Rol</label>

                            <div class="col-sm-10">
                                @foreach($roles as $role)
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                                <label>{{$role->name}} </label>
                                @endforeach
                            </div>
                        </div>




                        <button type="submite" class="btn btn-primary">
                            Añadir
                        </button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
