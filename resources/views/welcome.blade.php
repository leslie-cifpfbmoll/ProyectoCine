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
                                        <div class="container_img">
                                            <img src="{{url('uploads/'.(implode(', ', $cartelera->peliculas()->get()->pluck('filename')->toArray())))}}" alt="Avatar" class="image" style="width:100%">
                                            <div class="middle">
                                                <div class="text">{{ implode(' ', $cartelera->horarios()->get()->pluck('hora')->toArray()) }}</div>
                                            </div>
                                            @if ($loop->index == 4) 
                                            <button type="button" class="btn btn-default btn-circle" ><a href="{{ route ('admin.carteleras.index')}}"><i class="fa fa-plus"></i></a> @endif
                                        </div>
                                    </div>
                                    @if ($loop->index == 4) @break @endif
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card col-md-12" id="cartelera">

                        <h5 class="card-header">LOS ESTRENOS MÁS ESPERADOS</h5>
                        <div class="card-body">

                            <!--Accordion wrapper-->
                            <div class="accordion md-accordion" id="accordionEx1" role="tablist" aria-multiselectable="true">
                                @foreach($estrenos as $estreno)
                                <!-- Accordion card -->
                                <div class="card">

                                    <!-- Card header -->
                                    <div class="card-header" role="tab" id="headingTwo{{$loop->index}}">
                                        @if ($loop->index == 0)
                                        <a  data-toggle="collapse" data-parent="#accordionEx1" href="#collapseTwo{{$loop->index}}"
                                            aria-expanded="true" aria-controls="collapseTwo{{$loop->index}}">
                                            @else
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapseTwo{{$loop->index}}"
                                               aria-expanded="false" aria-controls="collapseTwo{{$loop->index}}">
                                                @endif
                                                <h5 class="mb-0">
                                                    {{ $estreno->nombre }} <i class="fas fa-angle-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                    </div>

                                    <!-- Card body -->

                                    @if ($loop->index == 0)
                                    <div id="collapseTwo{{$loop->index}}" class="collapse show" role="tabpanel" aria-labelledby="headingTwo{{$loop->index}}"
                                         data-parent="#accordionEx1"> @else
                                        <div id="collapseTwo{{$loop->index}}" class="collapse" role="tabpanel" aria-labelledby="headingTwo{{$loop->index}}"
                                             data-parent="#accordionEx1">
                                            @endif
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-6 col-12">
                                                        <img src="{{url('uploads/'.$estreno->filename)}}" alt="Avatar" class="image" style="width:100%">
                                                    </div>
                                                    <div class="col-md-5 col-sm-6 col-12 d-flex justify-content-center">
                                                        {{$estreno->sinopsis}}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Accordion card -->
                                    @endforeach

                                </div>
                                <!-- Accordion wrapper -->

                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
    </body>
    <footer>
        @include('includes.footer')

    </footer>

    <!-- Footer -->
</html>
