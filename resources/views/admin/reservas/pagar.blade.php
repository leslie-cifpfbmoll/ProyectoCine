@extends('layouts.layout')

@section('content')
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="container">
            <div class="card">

                <div class="card-header ">

                    <div class="card border-light"> 
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item"><a href="/carteleras">Cartelera</a></li>
                                <li class="breadcrumb-item ">
                                    <form action="{{ route('admin.reservas.index', [$cartelera->id, $horario]) }}" method="POST">
                                        @csrf
                                        {{method_field('POST')}}
                                        <button type="submit"  class="btn-link">Reservar: {{ implode(', ', $cartelera->peliculas()->get()->pluck('nombre')->toArray()) }} </button>
                                    </form></li>
                                <li class="breadcrumb-item active">Pagar</li>
                            </ol>
                        </nav>
                    </div>



                </div>

                <div class="row">

                    <div class="span12 col-md-6">

              
                            <fieldset>

                                <legend>Total a pagar: {{$total}} € por {{$cantidad}} entradas. </legend>

                                <div class="control-group">
                                    <label class="control-label">Titular de la tarjeta</label>
                                    <div class="controls">
                                        <input type="text" class="input-block-level" pattern="\w+ \w+.*" title="Fill your first and last name" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Nº de Tarjeta</label>
                                    <div class="controls">
                                        <div class="row-fluid">
                                            <div class="span3">
                                                <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="First four digits" required>
                                            </div>
                                            <div class="span3">
                                                <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Second four digits" required>
                                            </div>
                                            <div class="span3">
                                                <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Third four digits" required>
                                            </div>
                                            <div class="span3">
                                                <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Fourth four digits" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Fecha de caducidad</label>
                                    <div class="controls">
                                        <div class="row-fluid">
                                            <div class="span9">
                                                <select class="input-block-level">
                                                    <option>Enero</option>
                                                    <option>Febrero</option>
                                                    <option>Marzo</option>
                                                    <option>Abril</option>
                                                    <option>Mayo</option>
                                                    <option>Junio</option>
                                                    <option>Julio</option>
                                                    <option>Agosto</option>
                                                    <option>Septiembre</option>
                                                    <option>Octubre</option>
                                                    <option>Noviembre</option>
                                                    <option>Diciembre</option>


                                                </select>
                                            </div>
                                            <div class="span3">
                                                <select class="input-block-level">
                                                    <option>2020</option>
                                                    <option>2021</option>
                                                    <option>2022</option>
                                                    <option>2023</option>
                                                    <option>2024</option>
                                                    <option>2025</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Código de Seguridad (CVV)</label>
                                    <div class="controls">
                                        <div class="row-fluid">
                                            <div class="span3">
                                                <input type="text" class="input-block-level" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required>
                                            </div>
                                            <div class="span8">
                                                <!-- screenshot may be here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <form action="{{ route('admin.reservas.reservar', ['id' => $cartelera->id, 'cantidad' => $cantidad, 'horario' => $horario]) }}" method="POST">
                                        @csrf
                                        {{method_field('POST')}}
                                        <button type="submit" class="btn btn-primary">Pagar </button>
                                    </form>
                                    <button type="reset" class="btn btn-secondary">Borrar</button>
                                </div>
                            </fieldset>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
