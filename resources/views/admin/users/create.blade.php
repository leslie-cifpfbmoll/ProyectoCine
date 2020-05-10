@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear usuario</div>

                <div class="card-body">
                    <form action="{{ route('admin.users.store')}}" method="POST">
                         @csrf
                        
                       
                        <div class="form-check">
                            <label for="fname">Nombre</label>
                            <input id="fname" type="text" name="name">
                            <label for="fcorreo">Correo</label>
                            <input id="fcorreo" type="email" name="email">
                            <label for="fpass">Password</label>
                            <input id="fpass" type="password" name="password">
                             @foreach($roles as $role)
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                            <label>{{$role->name}} </label>
                            @endforeach
                            
                        </div>
                        
                        <button type="submite" class="btn btn-primary">
                           Add
                        </button>
                    
                    </form>
                  
                
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
