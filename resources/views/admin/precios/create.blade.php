@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Crear Precio</h5></div>

                <div class="card-body">
                    <form action="{{ route('admin.precios.store')}}" method="POST">
                         @csrf
                        
                         <div class="form-group row">
                               <label for="ftipo" class="col-sm-3 col-form-label">Tipo</label>      
                             <div class="col-sm-9">
                                 <input id="ftipo" class="form-control" type="text" name="tipo" >
                            </div>
                         </div>
                         <div class="form-group row">
                             <label for="fprecio" class="col-sm-3 col-form-label">Precio</label>
                             <div class="col-sm-9">
                                 <input id="fprecio" class="form-control" min="1" type="integer" name="precio">
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
