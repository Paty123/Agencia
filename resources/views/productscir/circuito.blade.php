
<!DOCTYPE html>

<html>
<head>
<title>AutoComplete</title>
<link rel="stylesheet"  href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>


<div class="row">
<div class="col-md-6 col-md-offset-3">

<section  class="panel panel-default">
<header class="panel-heading">
<input type="text" name="searchname" class="form-control" id="searchname" placeholder="">

</header>

<div class="panel-body">

<table>
<tr>
<td>ID</td>
<td><input type="text" name="id" id="id" class="form-control" placeholder="id"></td>
</tr>
<tr>
	<td></td>
	<td><br></td>
<tr>
<td>Nombre</td>
<td><input type="text" name="name" id="name" class="form-control" placeholder="name"></td>
</tr>
</tr>

</table>

</div>


<div class="span12"> Indique numero de personas: </div>

$personas=2;
$persona=0;
                    			@foreach( $personas as $persona )
                    				<div class="span4 altoright">
		                    			<label for="persona_{{ $persona[0] }}">{{ $persona[1] }}:</label>
		                    		</div>
		                    		<div class="span6">
		                    			{{-- */ $namevalpersona='persona_'.$persona[0].'val'  /* --}}
		                    			<input class="form-control numpers" name="persona_{{ $persona[0] }}" 
		                    				type="number" id="persona_{{ $persona[0] }}" 
			                    				@if( !empty($$namevalpersona) )
			                    					value="{{ $$namevalpersona }}"
			                    				@else
			                    					value="0" 
			                    				@endif 
		                    				/>
		                    			<input name="namepersona_{{ $persona[0] }}" type="hidden" value="{{ $persona[1] }}" />
		                    		</div>
		                    		{{-- */ $ctrlp.=$persona[0].'-';  /* --}}
                    			@endforeach





</section>
</div>

</div>

</body>


<script type="text/javascript">
$('#searchname').autocomplete({
	source:'{!!URL::route('autocomplete')!!}',
       minlenght:1,
       autofocus:true,
       select:function (e,ui){
       	$('#id').val(ui.item.id);
       	$('#name').val(ui.item.value);
       }
});


</script>
</html>