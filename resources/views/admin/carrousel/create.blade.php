@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Crear Precio</h5></div>

                <div class="card-body">
                    <form action="{{ route('admin.carrousel.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row">
                            <label for="fpelicula" class="col-sm-2 col-md-1 col-form-label">Película: </label>
                            <div class="col-sm-10 col-md-11">
                                <select name="pelicula" id="fpelicula" class="custom-select" required>
                                    <option value="" id="pselect" selected disabled>Select</option>

                                    @foreach($peliculas as $pelicula)
                                    <option value="{{$pelicula->id}}">{{$pelicula->nombre}} </option>                                                  
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imagen" class="col-sm-2 col-md-1 col-form-label">Imagen</label>
                            <div class="col-sm-10 col-md-11">
                                <input type="file" class="form-control" name="imagen" required>
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
