<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <link rel="shortcut icon" href="img/sena.png">
    <link rel="stylesheet" href="css/plantilla.css">
    <title>SenaSoft</title>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app">

        <header class="app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
              <span class="navbar-toggler-icon"></span>
              
            </button>
            
            <ul class="nav navbar-nav ml-auto">            
                <button class="navbar-toggler  d-md-down-none" type="button">
          
                  
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Cerrar sesión</a>
        
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </button>
 
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="img/avatars/7.jpg" class="img-avatar">
                        <span class="d-md-down-none">{{Auth::user()->usuario}} </span>
                    </a>
               
          
            </ul>
        </header>
        <div class="app-body">
            <!-- Contenido Principal -->
            
           
            @if(Auth::check())
            @if (Auth::user()->id_roles == 1)
                @include('plantilla.sidebar')          
            @endif

        @endif
            @yield('contenido')
        </div>
    </div>
    <footer class="app-footer">
        <span><a href="#">ADSI</a> &copy; 2020</span>
        <span class="ml-auto">Desarrollado por <a href="#">ADSI</a> <i class="fa fa-group"></i></span>
    </footer>
    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
</body>

</html>
