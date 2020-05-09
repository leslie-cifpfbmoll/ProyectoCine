@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sala número {{$sala->id}}</div>

                <div class="card-body">
                    <form action="{{ route('admin.salas.update', ['sala' => $sala->id]) }}" method="POST">
                         @csrf
                        {{method_field('PUT')}}
                       
                       
                        <div class="form-check">
                            <label for="ffilas">Número de Filas</label>
                            <input id="ffilas" type="integer" name="numFilas" value="{{$sala->numFilas}}">
                            <label for="fcolum">Número de Columnas</label>
                            <input id="fcolum" type="integer" name="numColumnas" value="{{$sala->numColumnas}}">
                            
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
