<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body>
        <div class="d-flex justify-content-center" >
            <div class="container">
                @include('includes.header')
                <div class="row">

                    <div id="carousel-example-2" class="carousel slide carousel-fade col-md-12" data-ride="carousel">
                        <!--Indicators-->
                        <ol class="carousel-indicators">
                            @foreach($carousel as $foto)  
                            <li data-target="#carousel-example{{$loop->index}}" data-slide-to="{{$loop->index}}" @if(($loop->index) == 0)  class="active" @endif"></li>
                            @endforeach
                        </ol>
                        <!--/.Indicators-->
                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">
                            @foreach($carousel as $foto)               
                            <div class="carousel-item @if(($loop->index) == 0) active @endif">
                                <div class="view">
                                    <img src="{{url('uploads/'.$foto->filename)}}" alt="{{$foto->filename}}" class="img-responsive">
                                    <div class="mask rgba-black-light"></div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <!--/.Slides-->
                        <!--Controls-->
                        <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <!--/.Controls-->
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="card col-md-12" id="cartelera">
                        <h5 class="card-header">CARTELERA</h5>
                        <div class="card-body">
                            <div class="container">
                                <div class="row justify-content-between">
                                    @foreach($carteleras as $cartelera) 
                                    <div class="col-xl-2 col-md-3 col-sm-6 col-12">
                                        <div class="hovereffect">
                                            <img class="img-fluid" src="{{url('uploads/'.(implode(', ', $cartelera->peliculas()->get()->pluck('filename')->toArray())))}}" alt="">
                                            
                                            <div class="overlay">
                                                <h2>{{ implode(', ', $cartelera->peliculas()->get()->pluck('nombre')->toArray()) }}</h2>

                                                <p class="card-title"> Sala: {{ implode(', ', $cartelera->salas()->get()->pluck('numSala')->toArray()) }}</p>
                                              
                                                <p class="card-text">Horarios: {{ implode(', ', $cartelera->horarios()->get()->pluck('hora')->toArray()) }}</p>

                                                <p> <div class="row">   
                                                    <div class="col">
                                                        <form action="{{ route('admin.reservas.index', [$cartelera->id, $cartelera->horarios()->get()->pluck('id')]) }}" method="POST">
                                                            @csrf
                                                            {{method_field('POST')}}
                                                            <button type="sumbite" class="btn btn-primary btn-sm">Reservar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                        @if ($loop->index == 4) 
                                            <button type="button" class="btn btn-default btn-circle" ><a href="{{ route ('admin.carteleras.index')}}"><i class="fa fa-plus"></i></a> @endif
                                    </div>
                                    @if ($loop->index == 4) @break @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>             
            </div>
        </div>
    </body>
    <footer>
        @include('includes.footer')

    </footer>

    <!-- Footer -->
</html>
