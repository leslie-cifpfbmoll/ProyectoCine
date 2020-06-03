@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Sala número {{$sala->id}}</h5></div>

                <div class="card-body">
                    <form action="{{ route('admin.salas.update', ['sala' => $sala->id]) }}" method="POST">
                         @csrf
                        {{method_field('PUT')}}
                       
                       <div class="form-group row">
                               <label for="fnumSala" class=" col-sm-3 col-form-label">Número de Sala</label>
                             <div class="col-sm-9">
                                 <input id="fnumSala" class="form-control" type="integer" name="numSala" value="{{$sala->numSala}}">
                            </div>
                         </div>
                         <div class="form-group row">
                             <label for="faforo" class=" col-sm-3 col-form-label">Aforo</label>
                             <div class="col-sm-9">
                                 <input id="faforo" class="form-control" type="integer" name="aforo" value="{{$sala->aforo}}">
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
