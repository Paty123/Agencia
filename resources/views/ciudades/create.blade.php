@extends('layouts.admin')


@section('content')

<div class="container">
 <div class="row">
        <div class="col-md-9 col-md-offset-2">
        <div class="panel panel-default">   
         <div class="well well-sm">     
 <div class="panel-body">
                   
   <div class="form-horizontal">
 
<h1>Agregar Ciudades</h1>

@include('ciudades.form',['ciudades'=>$ciudades,'url'=>'/ciudades','method'=> 'POST'])


 </div>
 </div>
</div>
</div>
 </div>
</div>
</div>
 
@endsection