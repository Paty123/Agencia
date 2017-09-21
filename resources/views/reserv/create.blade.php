
@include('menu')
<!DOCTYPE html>

<html>
<head>
<title>AutoComplete</title>

<script src="//code.jquery.com/jquery-3.2.1.js"></script>

<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<!--formden.js communicates with FormDen server to validate fields and submit via AJAX -->
<script type="text/javascript" src="https://formden.com/static/cdn/formden.js"></script>

<!-- Special version of Bootstrap that is isolated to content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

<link rel="stylesheet"  href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-3.2.1.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>



<body>




  <!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>





<div class="row">
<div class="col-md-6 col-md-offset-3">

<section  class="panel panel-default">
<header class="panel-heading">


</header>

<div class="panel-body">
<form  class="form-horizontal" >
<div class="form-group ">  
<label class="control-label col-sm-2">Destino</label>
<div class="col-sm-10">
<input type="text" name="searchname" class="form-control" id="searchname" placeholder="search">
</div>
</div>

<div class="form-group ">
<label class="control-label col-sm-2">ID</label>
<div class="col-sm-10">
<input type="text" name="id" id="id" class="form-control" placeholder="id">
</div>
</div>
 
  <div class="form-group ">

<label class="control-label col-sm-2">Nombre</label>
<div class="col-sm-10">
<input type="text" name="name" id="name" class="form-control" placeholder="name">

</div>


</div>

<div class="form-group ">
      <label class="control-label col-sm-2 requiredField" for="date">
      Fecha de Inicio
       <span class="asteriskField">
        *
       </span>
      </label>
      <div class="col-sm-10">
       <div class="input-group">
        <div class="input-group-addon">
         <i class="fa fa-calendar">
         </i>
        </div>
        <input class="form-control" id="date" name="date" placeholder="DD/MM/YYYY" type="text"/>
       </div>
      </div>
     </div>



<div class="form-group ">
      <label class="control-label col-sm-2 requiredField" for="date">
      Fecha de Salida
       <span class="asteriskField">
        *
       </span>
      </label>
      <div class="col-sm-10">
       <div class="input-group">
        <div class="input-group-addon">
         <i class="fa fa-calendar">
         </i>
        </div>
        <input class="form-control" id="date" name="date" placeholder="DD/MM/YYYY" type="text"/>
       </div>
      </div>
     </div>






<div class="form-group">

  <label class="control-label col-sm-2">No. de Pasajeros</label>
<div class="col-sm-10">
<input type="text" name="num" id="num" class="form-control" placeholder="numero">

</div>


  </div>

<div class="form-group">

<button type="submit" class="btn btn-form">Consultar Reserva</button>
</div>


<?php



$name= 1;

for( $i=0;$i<$name;$i++){

    echo("<div class='form-group'>

  <label class='control-label col-sm-2'>No. de Pasajeros</label>
<div class='col-sm-10'>
<input type='text' name='name' id='name' class='form-control' placeholder='name'>

</div>


  </div>");
  }
  ?>

</section>
</div>




</div>



</form>
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

<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.es.min.js"></script>
<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        
        date_input.datepicker({
            format: 'dd/mm/yyyy',
           
            todayHighlight: true,
            language:'es',
            autoclose: true,

        })

    })
</script>


</html>