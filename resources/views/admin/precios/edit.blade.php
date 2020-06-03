@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Editar Precio</h5></div>

                <div class="card-body">
                    <form action="{{ route('admin.precios.update', ['precio' => $precio->id]) }}" method="POST">
                         @csrf
                        {{method_field('PUT')}}
                       
                       <div class="form-group row">
                               <label for="ftipo" class=" col-sm-3 col-form-label">Tipo</label>
                             <div class="col-sm-9">
                                 <input id="ftipo" class="form-control" type="text" name="tipo" value="{{$precio->tipo}}">
                            </div>
                         </div>
                         <div class="form-group row">
                             <label for="fprecio" class=" col-sm-3 col-form-label">Precio</label>
                             <div class="col-sm-9">
                                 <input id="fprecio" class="form-control" type="integer" name="precio" value="{{$precio->precio}}">
                             </div>
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
