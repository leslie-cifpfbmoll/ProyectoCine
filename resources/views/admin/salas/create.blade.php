@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Crear sala</h5></div>

                <div class="card-body">
                    <form action="{{ route('admin.salas.store')}}" method="POST">
                         @csrf
                        
                         <div class="form-group row">
                               <label for="ffilas" class="col-sm-3 col-form-label">Número de Filas</label>      
                             <div class="col-sm-9">
                                 <input id="ffilas" class="form-control" type="integer" name="numFilas" >
                            </div>
                         </div>
                         <div class="form-group row">
                             <label for="fcolum" class="col-sm-3 col-form-label">Número de Columnas</label>
                             <div class="col-sm-9">
                                 <input id="fcolum" class="form-control" type="integer" name="numColumnas">
                             </div>
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
