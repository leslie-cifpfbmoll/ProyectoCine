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
                            <a  href="{{route('admin.users.create') }}">
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
                                <th scope="col">Correo</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Actions</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach($users as $user)
                            <tr>
                                <th>
                                    {{ $user->name }}</th>
                                <th>
                                    {{ $user->email }}</th>
                                <th>
                                    {{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</th>
                                <th>
                                    <a href="{{route('admin.users.edit', $user->id) }}">
                                        <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                    </a>  
                                    <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="sumbite" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </th>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
