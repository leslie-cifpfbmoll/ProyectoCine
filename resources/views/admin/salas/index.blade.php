@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <div class="card-columns">
                        <div class="card border-light"> 
                            <a class="card-body"> Dashboard</a>
                        </div>
                        <div class="card invisible"></div>
                        <div class="card border-light text-right"> 
                            <a  href="{{route('admin.salas.create') }}">
                                <button type="button" class="btn btn-primary btn-sm">Add</button>
                            </a>  
                        </div>
                    </div>
                </div>


                <div class="card-body">
                   <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Número de Sala</th>
                                <th scope="col">Número de filas</th>
                                <th scope="col">Número de columnas</th>
                                <th scope="col">Actions</th>
                              
                               
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($salas as $sala)
                            <tr>
                                <th>
                               {{ $sala-> id }}</th>
                                <th>
                                {{ $sala->numFilas }}</th>
                                 <th>
                                {{ $sala->numColumnas }}</th>
                                 <th>
                                     <a href="{{route('admin.salas.edit', $sala->id) }}" class="float-left">
                                         <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                     </a>  
                                    <form action="{{ route('admin.salas.destroy', ['sala' => $sala->id]) }}" method="POST">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="sumbite" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                 </th>
                        
                            </tr>
                            
                           @endforeach
                        </tbody>
                    </table>
                    {{$salas->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
