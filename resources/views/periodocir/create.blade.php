@extends('layouts.admin')




@section('content')

<div class="container">
 <div class="row">
        <div class="col-md-9 col-md-offset-2">
        <div class="panel panel-default">   
         <div class="well well-sm">     
 <div class="panel-body">
                   
   <div class="form-horizontal">
 
<h1   class='titlename'>Agregar Periodo para los Circuitos</h1>

@include('periodocir.form',['periodocir'=>$periodocir,'url'=>'/periodocir','method'=> 'POST'])


 </div>
 </div>
</div>
</div>
 </div>
</div>
</div>
 
@endsection
