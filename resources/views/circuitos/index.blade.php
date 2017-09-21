@extends("layouts.app");

@section ("content")

@include('menu')

<div class="big-padding text-center blue-grey white-text">
<h1>Circuitos</h1>
</div>



<div class="container">


<table class="table table-striped">
<thead>
<tr>
    <td>Id</td>
	<td>Nombre</td>
	<td>Precio</td>
	<td>

		


	</td>


</tr>





<tbody>
 
	@foreach ($circuitos as $circuito)
	<tr>

    <td>{{$circuito->id}}</td>
    <td>{{$circuito->nameT}}</td>
    <td>{{$circuito->price}}</td>
    <td><a href="{{url('/productscir/'.$circuito->id.'/edit')}}">Editar</a>


      @include('productscir.delete',['circuito'=>$circuito])

</td>
	</tr>

@endforeach
</tbody>
</thead>
</table>

	</div>

<div class="floating">

<a href="{{ url('/productscir/create') }}" class="btn btn-primary btn-fab">

<i>Agregar</i>

</a>

</div>
	@endsection