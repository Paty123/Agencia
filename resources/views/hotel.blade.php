<!--Form hotel-->
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

<div class="form-group">
<label  form="nameh"  >Hotel:</label>
<select class="form-control" id="nameh">

<option>Casa Vieja</option>
<option>Plaza Palenque</option>
<option>Palace inn San Cristóbal</option>
<option>Tulija Palenque</option>
</select>
</div>

<div class="form-group">
<label form="nper" >No. de Personas:</label>
<input type="text" id="nper">
</div>

<div class="form-group">
<label form="inputName" >Tipo de Habitación:</label>
<select  class="form-control">
<option>Sencilla</option>
<option>Doble</option>
<option>Triple</option>
<option>Cuadruple</option>
</select>
</div>

<div class="form-group">
<label form="adu" >Adultos:</label>
<select class="form-control" id="adu">
<option>0</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
</select>
</div>

<div class="form-group">
<label for="men">Menores(2-11 años):</label>
<select class="form-control" id="men">
<option>0</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
</select>
</div>

<button  type="submit" class="btn btn-primary">Reservar</button>
<button type="submit" class"btn btn-primary">Cancelar</button>

</div>
            
</div>
</div>
</div>
</div>
</div>
@endsection
