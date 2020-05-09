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
                            <a  href="{{route('admin.generos.create') }}">
                                <button type="button" class="btn btn-primary btn-sm">Add</button>
                            </a>  
                        </div>
                    </div>
                </div>


                <div class="card-body">
                   <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Número</th>
                                <th scope="col">Género</th>
                                <th scope="col">Actions</th>
                              
                               
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($generos as $genero)
                            <tr>
                                <th>
                               {{ $genero-> id }}</th>
                                <th>
                                {{ $genero->nombre }}</th>
                                 <th>
                                     <a href="{{route('admin.generos.edit', $genero->id) }}" class="float-left">
                                         <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                     </a>  
                                    <form action="{{ route('admin.generos.destroy', ['genero' => $genero->id]) }}" method="POST">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="sumbite" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                 </th>
                        
                            </tr>
                            
                           @endforeach
                        </tbody>
                    </table>
                    {{$generos->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
