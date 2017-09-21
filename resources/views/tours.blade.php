<!--form tour-->
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


        


<div class="container">


  <div class="row">
        <div class="col-md-9 col-md-offset-2">
        <div class="panel panel-default">   
         <div class="well well-sm">     
 <div class="panel-body">
                   
   <div class="form-horizontal">

<form>
<div class="form-group">
<label form="nameT" >Tour:</label>
<select  class="form-control" id="nameT">

<option>Ato-Cañon San Cristóbal </option>
<option>Yaxchilan-Bonampak</option>
<option>Yaxchilan-Bonampak-Lacanja 2 Dias</option>
<option>Cañon del Sumidero</option>
<option>San Juan Chamula y Zinacantan</option>
<option>Lagos de Montebello y Chiflon</option>
<option>Agua-Azul y Palenque</option>
</select>
</div>
<div class="form-group">
<label form="nper" >No. de Personas:</label>
<input type="text"  id="nper">
</div>
</form>


<button  type="submit" class="btn btn-primary">Reservar</button>
<button type="submit" class="btn btn-primary">Cancelar</button>

</div>
            
</div>
</div>
</div>
</div>
</div>
@endsection
