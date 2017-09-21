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
                <li><a href="{{ url('productscir/') }}">Catalogo</a></li>
                
                <li><a href="#">Ayuda</a></li>
            </ul>

            
        </div>

</div>



</nav>



   <div>
<h3>Catalago de Productos</h3>
<ul>

<li><a href="{{ url('/insert') }}">Insertar</a></li>
<li>Actualizar</li>
<li>Borrar</li>
</ul>
   </div> 


@endsection