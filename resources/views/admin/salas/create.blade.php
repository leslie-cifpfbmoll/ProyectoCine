@extends('layouts.layout')

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
                               <label for="fnumSala" class="col-sm-3 col-form-label">Número de Sala</label>      
                             <div class="col-sm-9">
                                 <input id="fnumSala" class="form-control" type="integer" name="numSala" >
                            </div>
                         </div>
                         <div class="form-group row">
                             <label for="faforo" class="col-sm-3 col-form-label">Aforo</label>
                             <div class="col-sm-9">
                                 <input id="faforo" class="form-control" type="integer" name="aforo">
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
