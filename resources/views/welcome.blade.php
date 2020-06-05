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
                                            <form action="{{ route('admin.peliculas.show', $cartelera->peliculas()->get()->pluck('id')->first()) }}" method="POST">
                                                @csrf
                                                {{method_field('POST')}}
                                                <input type="image" width="184px" height="250px" name="cartelera" value="cartelera" alt="cartelera" src="{{url('uploads/'.(implode(', ', $cartelera->peliculas()->get()->pluck('filename')->toArray())))}}">
                                                <div class="middle">
                                                    <div class="text">{{ implode(' ', $cartelera->horarios()->get()->pluck('hora')->toArray()) }}</div>
                                                </div>
                                            </form>
                                            @if ($loop->index == 4) 
                                            <button type="button" class="btn btn-default btn-circle" ><a href="{{ route ('admin.carteleras.index')}}"><i class="fa fa-plus"></i></a> @endif
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
