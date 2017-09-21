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

{!! Form::open(['route' => '', 'method' => 'PATCH', 'novalidate']) !!}
                <div class="form-group">
                      {!! Form::label('full_nameT', 'Circuito') !!}
                      {!! Form::text('nameT', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                  </div>
                  <div class="form-group">
                      {!! Form::label('nameT', 'Precio') !!}
                      {!! Form::text('price', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                  </div>
                <div class="form-group">
                      {!! Form::submit('Modificar', ['class' => 'btn btn-success ' ] ) !!}
                  </div>
            {!! Form::close() !!}
 </div>
 </div>
</div>
</div>
 </div>
</div>
</div>
 
@endsection