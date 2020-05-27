
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/miapp.js') }}" defer></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <!--Boostrap-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    </head>
    <body>
        <div class="d-flex justify-content-center" >
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-end col-md-12" >
                        @if (Route::has('login'))  
                        <!-- Pregunta si existe la ruta login  -->
                        <div  class="register links">
                            @auth
                            <!-- Si iniciamos  -->
                            <a href="{{ url('/home') }}"></a>
                            @else
                            <!-- si no es asi   -->
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                            @endif
                            @endauth
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" href="#">
                                <img src="../public/uploads/logo.png" alt="logo" height="40px"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                                <ul class="navbar-nav my-2 my-sm-0">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Películas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Cartelera</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Estrenos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Promociones</a>
                                    </li>


                                </ul>

                            </div>
                        </nav>
                    </div>
                </div>
                <div >@include('partials.alerts')
                @yield('content')</div>
                
            </div>
        </div>
    </div>
</body>
<footer class="page-footer font-small cyan darken-3">

    <!-- Footer Elements -->
    <div class="container">

        <!-- Grid row-->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-12 py-5">
                <div class="mb-5 flex-center">

                    <!-- Facebook -->
                    <a class="fb-ic">
                        <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>
                    <!-- Twitter -->
                    <a class="tw-ic">
                        <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>
                    <!-- Google +-->
                    <a class="gplus-ic">
                        <i class="fab fa-google-plus-g fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>
                    <!--Linkedin -->
                    <a class="li-ic">
                        <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>
                    <!--Instagram-->
                    <a class="ins-ic">
                        <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>
                    <!--Pinterest-->
                    <a class="pin-ic">
                        <i class="fab fa-pinterest fa-lg white-text fa-2x"> </i>
                    </a>
                </div>
            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-4 mx-auto">

                <!-- Content -->
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Footer Content</h5>
                <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
                    consectetur
                    adipisicing elit.</p>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none">

            <!-- Grid column -->
            <div class="col-md-2 mx-auto">

                <!-- Links -->
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="#!">Link 1</a>
                    </li>
                    <li>
                        <a href="#!">Link 2</a>
                    </li>
                    <li>
                        <a href="#!">Link 3</a>
                    </li>
                    <li>
                        <a href="#!">Link 4</a>
                    </li>
                </ul>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none">

            <!-- Grid column -->
            <div class="col-md-2 mx-auto">

                <!-- Links -->
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="#!">Link 1</a>
                    </li>
                    <li>
                        <a href="#!">Link 2</a>
                    </li>
                    <li>
                        <a href="#!">Link 3</a>
                    </li>
                    <li>
                        <a href="#!">Link 4</a>
                    </li>
                </ul>

            </div>


        </div>
        <!-- Grid row -->

    </div>

    <!-- Footer Elements -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
    </div>
    <!-- Copyright -->

</footer>

<!-- Footer -->
</html>