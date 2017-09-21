@extends("layout.app");

@section ("content")

<div class="big-padding text-center blue-grey white-text">
<h1>Circuitos</h1>
</div>



<div class="container">

<table class="table table-bordered">
<thead>
<tr>

	<td>Nombre</td>
	<td>Precio</td>


</tr>





<tbody>
 
	@foreach ($circuitos as $circuito)
	<tr>

    <td>{{$circuito->id}}</td>
    <td>{{$circuito->name}}</td>
    <td>{{$circuito->price}}</td>
    <td>Acciones</td>
	</tr>

@endforeach
</tbody>
</thead>
</table>

	</div>


	@endsection