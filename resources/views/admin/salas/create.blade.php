@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear sala</div>

                <div class="card-body">
                    <form action="{{ route('admin.salas.store')}}" method="POST">
                         @csrf
                        
                       
                        <div class="form-check">
                             <label for="ffilas">Número de Filas</label>
                            <input id="ffilas" type="integer" name="numFilas" >
                            <label for="fcolum">Número de Columnas</label>
                            <input id="fcolum" type="integer" name="numColumnas">
                            
                            
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
