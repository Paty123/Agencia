
<!DOCTYPE html>

<html>
<head>
<title>AutoComplete</title>
<link rel="stylesheet"  href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://formden.com/static/cdn/formden.js"></script>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}

</style>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

@include('menu');
</head>


<body>

 


<div class="row">
<div class="col-md-6 col-md-offset-3">



<section  class="panel panel-default">
<header class="panel-heading">
 



</header>


<div class="panel-body">




  <div>
    


<form class="form-horizontal">

  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Circuitos:</label>
    <div class="col-sm-10">
      <input type="text" name="searchname" class="form-control" id="searchname" placeholder="">
    </div>
  </div>

   



<div class="form-group">  
  <label class="control-label col-sm-2" for="email">Ida:</label> 
  <div class="col-sm-10">

       <div class="input-group">
        <div class="input-group-addon">
         <i class="fa fa-calendar">
         </i>
        </div>
        <input class="form-control" id="date" name="date" placeholder="DD/MM/YYYY" type="text"/>
       </div>
     </div>
    
     <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
       <input name="_honey" style="display:none" type="text"/>
     </div>
   </div>


  </div>



 <div class="form-group">  
  <label class="control-label col-sm-2" for="email">Regreso:</label> 
  <div class="col-sm-10">

   <div class="input-group">
        <div class="input-group-addon">
         <i class="fa fa-calendar">
         </i>
        </div>
        <input class="form-control" id="date" name="date" placeholder="DD/MM/YYYY" type="text"/>
       </div>
     
     <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
       <input name="_honey" style="display:none" type="text"/>
     </div>
   </div>

  </div>
</div>


 <div class="form-group">
    <label class="control-label col-sm-2" for="email">Tipo de Habitacion:</label>
    <div class="col-sm-10">
      <select>
      
  <option>Sencilla</option>
  <option>Doble</option>
  <option>Triple</option>

    </select>

    </div>
  </div>


  
   <div class="form-group">
    <label class="control-label col-sm-2" for="email">Adultos:</label>
    <div class="col-sm-10">
      <select>
      
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
    </select>

    </div>
  </div>


  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Menores:</label>
    <div class="col-sm-10">
      <select>
      
    <option>0</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    </select>

    </div>
  </div>

      

    

    


<div class="botones">
  
<button  class="btn btn-primary " name="res" type="res">
        Reservar
       </button>

<button class="btn btn-primary " name="can" type="can">Cancelar</button>


</div>


  
  
  
       </form>
 
</section>

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



<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.es.min.js"></script>



<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            
            todayHighlight: true,
            language:'es',
            autoclose: true,

        })

    })
</script>
</html>