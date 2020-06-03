@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> 
                    <h5> Editar Usuario</h5>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label ">Email</label>
                        <div class="col-sm-10">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-10">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="roles" class="col-md-2 col-form-label">Roles</label>
                        <div class="col-md-10">
                            @foreach($roles as $role)
                            <div class="form-check">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                       @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                       <label>{{$role->name}} </label>
                            </div>
                            @endforeach
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
@endsection
