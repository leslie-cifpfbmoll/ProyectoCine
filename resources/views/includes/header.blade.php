<div class="row">
    <div class="d-flex justify-content-end col-md-12" >
        @if (Route::has('login'))  
        <!-- Pregunta si existe la ruta login  -->
        <div  class="register links">
            @auth
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </a>
                    @can('administrar')

                    <a class="dropdown-item" href="{{ route ('admin.administrar.index')}}"> <i class="fas fa-cogs"></i> Administrar</a>
                    <!-- <a class="dropdown-item" href="{{ route ('admin.users.index')}}"> Users</a>
                     <a class="dropdown-item" href="{{ route ('admin.generos.index')}}"> Géneros</a>
                     <a class="dropdown-item" href="{{ route ('admin.directores.index')}}"> Directores</a>
                     <a class="dropdown-item" href="{{ route ('admin.salas.index')}}"> Salas</a>
                     <a class="dropdown-item" href="{{ route ('admin.peliculas.index')}}"> Peliculas</a>-->
                    @endcan
                    <!-- <a class="dropdown-item" href="{{ route ('admin.carteleras.index')}}"> Cartelera</a>-->
                    <a class="dropdown-item" href="{{ route ('admin.perfil.index')}}"><i class="fas fa-user-alt"></i> Mi perfil</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
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
            <a class="navbar-brand" href="{{ route ('welcome')}}">
                <!---    <img src="http://127.0.0.1:8000/uploads/logo.png" alt="logo" height="40px">-->
                <!--<img src="http://3.22.174.23/uploads/logo.png" alt="logo" height="40px">-->
                <img src="http://localhost/ProyectoCine/public/uploads/logo.png" alt="logo" height="40px">

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @php $route = Route::current();  @endphp
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav my-2 my-sm-0">
                    <li class="nav-item @if($route->uri == '/') active @endif">
                        <a class="nav-link" href="{{ route ('welcome')}}">Inicio </a>
                    </li>
                    <li class="nav-item @if($route->uri == 'admin/peliculas') active @endif">

                        <a class="nav-link" href="{{ route ('admin.peliculas.index')}}">Películas </a>
                    </li>
                    <li class="nav-item @if($route->uri == 'admin/carteleras') active @endif">
                        <a class="nav-link" href="{{ route ('admin.carteleras.index')}}">Cartelera </a>
                    </li>
                    <li class="nav-item @if($route->uri == 'admin/estrenos') active @endif">
                        <a class="nav-link" href="#">Estrenos</a>
                    </li>



                </ul>

            </div>
        </nav>
    </div>
</div>