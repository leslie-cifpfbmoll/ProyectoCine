@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear usuario</div>

                <div class="card-body">
                    <form action="{{ route('admin.directores.store')}}" method="POST">
                         @csrf
                        
                       
                        <div class="form-check">
                            <label for="fname">Nombre</label>
                            <input id="fname" type="text" name="name">
                            <label for="fsubname">Apellido</label>
                            <input id="fsubname" type="text" name="subname">
                            
                            
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
