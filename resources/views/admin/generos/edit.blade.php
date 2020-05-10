@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage {{$genero->nombre}}</div>

                <div class="card-body">
                    <form action="{{ route('admin.generos.update', ['genero' => $genero->id]) }}" method="POST">
                         @csrf
                        {{method_field('PUT')}}
                       
                       
                        <div class="form-check">
                            <label for="fname">Nombre</label>
                            <input id="fname" type="text" name="genero" value="{{$genero->nombre}}">
                            
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
