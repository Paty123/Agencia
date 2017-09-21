

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
                <li><a href="{{ url('/circuitos') }}">Circuitos</a></li>
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

@endsection

@extends('layouts/app');
