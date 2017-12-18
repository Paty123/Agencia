
<!DOCTYPE html>


<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ToursPorChiapas</title>



    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <link href="{{ asset('../image/slider/style.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    <script>
        window.Agencia = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
   
 
</head>
<body>
    <div id="app">
         
            <div class="container">

                <div class="navbar-header">

                    
                    

                  <!-- Branding Image -->
                    <a class="" href="{{ url('/') }}">
                        <img src="../image/logo.png"  class="logo" >
                    </a>
                    
                </div>

  <!-- Collapsed Hamburger -->
  
                





                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->

                        
                        @if (Auth::guest())
                            
                        </div>
                        @else
                           <!-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
--> <li ><a  >




                                    {{ Auth::user()->name }} <span ></span>
                                </a></li>

                                <li>
                                        <a   href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>


                                       
                                    </li>
    

   

  </ul>



                           
                        @endif
                   



                </div>
            </div>
      



        @yield('content')

    
    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset ('js/bootstrap.min.js')}}"></script>
    <script src="{{asset ('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset ('js/material.min.js')}}"></script>
    <script src="{{asset ('js/ripples.min.js')}}"></script>
     <script>$.material.init();
    </script>
    <script  src="{{asset ('../image/slider/wowslider.js')}}"></script>
    <script src="{{asset ('../image/slider/script.js')}}"></script>
    <script  src="{{asset ('../image/slider/jquery.js')}}"></script>
    
</body>


</html>



