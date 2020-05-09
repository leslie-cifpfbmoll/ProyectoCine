@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> <div class="card-columns">
                        <div class="card border-light"> 
                        <a class="card-body"> Manage {{$user->name}}</a>
                        </div>
                       
                    </div></div>

                <div class="card-body">
                    <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        {{method_field('PUT')}}
                        @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                   {{ $user->hasAnyRole($role->name)? 'checked' : ''}} >
                            <label>{{$role->name}} </label>
                        
                        </div>
                        @endforeach
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
