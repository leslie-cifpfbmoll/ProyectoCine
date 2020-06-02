@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Editar Director</h5></div>
                <div class="card-body">
                    <form action="{{route('admin.directores.update', ['directore' => $director->id])}}" method="POST">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group row">
                            <label for="fname" class="col-form-label">Nombre</label>
                            <input id="fname" type="text" class="form-control" name="nombre" value="{{$director->nombre}}">  </div>
                        <div class="form-group row">
                            <label for="fsubname" class="col-form-label">Apellido</label>  
                             <input id="fsubname" type="text" class="form-control" name="apellido" value="{{$director->apellido}}">
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
