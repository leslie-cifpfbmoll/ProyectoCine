@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Crear Director</h5></div>

                <div class="card-body">
                    <form action="{{ route('admin.directores.store')}}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="fname" class="col-form-label">Nombre</label>
                            <input id="fname" class="form-control" type="text" name="name">
                            
                        </div>
                        <div class="form-group row">
                            <label for="fsubname" class="col-form-label">Apellido</label>  
                             <input id="fsubname" class="form-control" type="text" name="subname"> 
                            
                        </div>

                        <button type="submite" class="btn btn-primary">
                           Añadir
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
