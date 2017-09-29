@extends('layouts.app')




@section('content')

<div class="container">
 <div class="row">
        <div class="col-md-9 col-md-offset-2">
        <div class="panel panel-default">   
         <div class="well well-sm">     
 <div class="panel-body">
                   
   <div class="form-horizontal">
 
<h1   class='titlename'>Agregar Tipo de Habitaciones</h1>

@include('tipohabitaciones.form',['tipohab'=>$tipohab,'url'=>'/tipohabitaciones','method'=> 'POST'])


 </div>
 </div>
</div>
</div>
 </div>
</div>
</div>
 
@endsection
