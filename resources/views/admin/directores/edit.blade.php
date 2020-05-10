@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage {{$director->nombre}} {{$director->apellido}}</div>
                <div class="card-body">
                    <form action="{{route('admin.directores.update', ['directore' => $director->id])}}" method="POST">
                         @csrf
                        {{method_field('PUT')}}
                       
                       
                        <div class="form-check">
                            <label for="fname">Nombre</label>
                            <input id="fname" type="text" name="nombre" value="{{$director->nombre}}">
                            <label for="fname">Apellido</label>
                            <input id="fname" type="text" name="apellido" value="{{$director->apellido}}">
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
