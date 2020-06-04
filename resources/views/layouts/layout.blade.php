
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body>
        <div class="d-flex justify-content-center" >
            <div class="container">
                @include('includes.header')
               
                    @include('partials.alerts')
                    @yield('content')
                

            </div>
        </div>
        @yield('script')
        @yield('script_horarios')
    </body>   
    <footer>
        @include('includes.footer')

    </footer>
</html>