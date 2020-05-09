@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <div class="card-columns">
                        <div class="card border-light"> 
                            <a class="card-body"> Dashboard</a>
                        </div>
                        <div class="card invisible"></div>
                        <div class="card border-light text-right"> 
                            <a  href="{{route('admin.directores.create') }}">
                                <button type="button" class="btn btn-primary btn-sm">Add</button>
                            </a>  
                        </div>
                    </div> 
                    
                </div>

                <div class="card-body">
                   <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                              
                               
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($directores as $director)
                            <tr>
                                <th>
                               {{ $director->nombre }}</th>
                                <th>
                                {{ $director->apellido }}</th>
                                 <th>
                                     <a href="{{route('admin.directores.edit', $director->id) }}">
                                         <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                     </a>  
                                     <form action="{{ route('admin.directores.destroy', ['directore' => $director->id]) }}" method="POST">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="sumbite" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                    
                                 </th>
                        
                            </tr>
                            
                           @endforeach
                        </tbody>
                    </table>
                    {{$directores->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
