@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
        <div class="col-md-9 col-md-offset-2">
        <div class="panel panel-default">   
         <div class="well well-sm">     
 <div class="panel-body">
                   
   <div class="form-horizontal">
 
<h1>Modificar Circuito</h1>

@include('productscir.form',['circuito'=>$circuito,'url'=>'/productscir/'.$circuito->id,'method'=> 'PATCH'])


 </div>
 </div>
</div>
</div>
 </div>
</div>
</div>
 
@endsection