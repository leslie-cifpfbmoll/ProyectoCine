@extends('layouts.layout')

@section('content')

<!------ Include the above in your HEAD tag ---------->
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="container" id="pagar-container">
            <div class="card">
                <div class="card-header ">
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

                <div class="card-body">

                    <div class="span12 col-md-12">
                        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
                        <div class="container">
                            <div class="row">
                                <aside class="col-sm-12">
                                    <article class="card">
                                        <div class="card-body p-5">

                                            <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                                                        Total a pagar: {{$total}} € por {{$cantidad}}  entradas. </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="nav-tab-card">
                                                    <form role="form">
                                                        <div class="form-group">
                                                            <label for="username">Titular de la tarjeta</label>
                                                            <input type="text" class="form-control" name="username" placeholder="" required="">
                                                        </div> <!-- form-group.// -->

                                                        <div class="form-group">
                                                            <label for="cardNumber">Nº de Tarjeta</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="cardNumber" placeholder="">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text text-muted">
                                                                        <i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>   
                                                                        <i class="fab fa-cc-mastercard"></i> 
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div> <!-- form-group.// -->

                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <div class="form-group">
                                                                    <label><span class="hidden-xs">Fecha de caducidad</span> </label>
                                                                    <div class="controls">
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <select class="form-control">
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
                                                                            <div class="col-5">
                                                                                <select class="form-control">
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
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">(CVV) <i class="fa fa-question-circle"></i></label>
                                                                    <input type="number" class="form-control" required="">
                                                                </div> <!-- form-group.// -->
                                                            </div>
                                                        </div> <!-- row.// -->
                                                        <form action="{{ route('admin.reservas.reservar', ['id' => $cartelera->id, 'cantidad' => $cantidad, 'horario' => $horario]) }}" method="POST">
                                                            @csrf
                                                            {{method_field('POST')}}
                                                            <button type="submit" class="subscribe btn btn-primary btn-block">Pagar </button>
                                                        </form>

                                                    </form>
                                                </div> <!-- tab-pane.// -->
                                            </div> <!-- tab-content .// -->
                                        </div> <!-- card-body.// -->
                                    </article> <!-- card.// -->
                                </aside> <!-- col.// -->
                            </div> <!-- row.// -->
                        </div> 
                        <!--container end.//-->

                        <br><br>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
