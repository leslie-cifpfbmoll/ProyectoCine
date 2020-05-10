@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear género</div>

                <div class="card-body">
                    <form action="{{ route('admin.generos.store')}}" method="POST">
                         @csrf
                        
                       
                        <div class="form-check">
                            <label for="fname">Género</label>
                            <input id="fname" type="text" name="name">
                            
                            
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
