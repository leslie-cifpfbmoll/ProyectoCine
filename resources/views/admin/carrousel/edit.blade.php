@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Editar Foto</h5></div>

                <div class="card-body">
                    <form action="{{ route('admin.carrousel.update', ['carrousel' => $foto->id]) }}" method="POST">
                        @csrf
                        {{method_field('PUT')}}


                        
                         <div class="form-group row">
                            <label for="fpelicula" class="col-sm-2 col-form-label">Pelicula:</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="pelicula" id="fpelicula" >
                                    <option selected="selected" value="{{implode(', ', $foto->peliculas()->get()->pluck('id')->toArray())}}">
                                        {{ implode(', ', $foto->peliculas()->get()->pluck('nombre')->toArray()) }}
                                    </option>
                                    @foreach($peliculas as $pelicula)
                                    @if($foto->peliculas()->get()->pluck('nombre')->contains($pelicula->nombre))

                                    @else
                                    <option value="{{$pelicula->id}}">
                                        {{$pelicula->nombre}}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imagen" class="col-sm-3 col-md-2 col-form-label">Foto</label>
                            <div class="col-sm-9 col-md-10">
                                <input type="file" class="form-control" name="imagen" value="{{$foto->filename}}">
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
