@extends('layouts.app')

@section('content')

       
   <!--menu-->    

        <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
           </div>
        

            
            <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('/home') }}">Inicio</a></li>
                <li><a href="{{ url('productscir/2') }}">Circuitos</a></li>
                <li><a href="{{ url('/tours') }}">Tours</a></li>
                <li><a href="{{ url('/hotel') }}">Hotel</a></li>
                <li><a href="#">Ayuda</a></li>
            </ul>

            <ul  class="nav navbar-nav navbar-right">
                <li><a href=""<span class="glyphicon glyphicon-user"></span>Cuenta</a></li>
                <li><a href=""<span class="glyphicon glyphicon-shopping-cart"></span>Compras</a></li>

            </ul>
        </div>

</div>



</nav>



   
<!--Slider-->


<div id="wowslider-container1">
    <div class="ws_images"><ul>
        
    <li><img src="../image/slider/banner_canion-980x280.png" alt="jquery slideshow" id="wows1_1"/></a></li>
    <li><img src="../image/slider/banner_pal-980x280.png" alt="banner_pal-980x280"  id="wows1_2"/></li>
    </ul>

</div>

    
     

</div>



<div id="all">

        <div id="content">

            <div class="container">
                <div class="col-md-12">
                    <div id="main-slider">
                        <div class="item">
                            <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/main-slider2.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/main-slider3.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/main-slider4.jpg" alt="">
                        </div>
                    </div>
                    <!-- /#main-slider -->
                </div>
            </div>




@endsection