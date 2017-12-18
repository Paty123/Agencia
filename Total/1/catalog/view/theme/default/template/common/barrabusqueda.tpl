<?php 

//verificamos las fechas que se ingresan 

$now = new DateTime();


			if (isset($_REQUEST['finicio'])) {
				$finicio = $_REQUEST['finicio'];
			} else {
				$finicio = Date('Y-m-d', strtotime("+2 days"));;
			}
            if (isset($_REQUEST['ffin'])) {
				$ffin = $_REQUEST['ffin'];
			} else {
				$ffin = Date('Y-m-d', strtotime("+2 days"));;
			}
            
 ?>
    <table width="100%"  border="0" cellpadding="0" cellspacing="0"  class="tablabusqueda">
  <tr>
    <td colspan="3" align="center"><h2>Reserva tu viaje</h2></td>
  </tr>
  <tr>
    <td><p><label>
          <input type="radio" name="tiporeserva" value="Hotel" id="tiporeserva_0" <?php if(isset($_REQUEST['tiporeserva'])) {echo 'checked="checked"';} else { echo 'checked="checked"';}?> />
          Hotel</label></p>
    </td>
    <td colspan="2" align="left" class="celdapaquetes"><p>
      <label>
        <input type="radio" name="tiporeserva" value="Paquetes" id="tiporeserva_1"  />
          Circuitos</label>
        <br />
        <label>
          <input type="radio" name="tiporeserva" value="Tours" id="tiporeserva_2" />
          Tours</label>
        <br />
    </p></td>
  </tr>
  <tr>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td colspan="3"><label id="nombrecampo">Destino:</label><br />
    <input name="destino" id="destino" type="text" size="40" value="<?php if(isset($_REQUEST['destino'])) { echo $_REQUEST['destino'];} else{ echo 'Todos los resultados';}?>" /></td>
  </tr>
  <tr>
    <td><label id="finiciocampo">Fecha de llegada:</label></td>
    <td colspan="2" align="center"><input name="finicio" id="finicio" class="date"   type="text" size="10" value="<?php  echo $finicio;?>" /></td>
  </tr>
  <tr>
    <td><label id="txtfechasalida">Fecha de Salida</label></td>
    <td colspan="2" align="center"><input class="date" id="ffin" name="ffin" type="text" size="10" value="<?php  echo $ffin;?>" /></td>
  </tr>
  <tr>
    <td><label id="lblhabitaciones">Habitaciones:</label></td>
    <td align="center">Adultos</td>
    <td>Menores</td>
  </tr>
  <tr>
    <td><label for="habitaciones"></label>
      <select name="habitaciones" id="habitaciones">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select></td>
    <td align="center"><label for="adultos"></label>
      <select name="adultos" id="adultos">
      	 <option value="0">1</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
    </select></td>
    <td><label for="menores"></label>
      <select name="menores" id="menores">
      	<option value="0">1</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="3"><a class="button" onclick="buscar()">Buscar</a></td>
  </tr>
</table>

<script type="text/javascript"><!--
var idbusqueda=<?php if(isset($_REQUEST['filter'])){
							echo $_REQUEST['filter'];
							}
							else
							{
								echo 0;
							}
							
							?>;
$(document).ready(function() {
	if ($.browser.msie && $.browser.version == 6) {
		$('.date, .datetime, .time').bgIframe();
	}

	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	 
	 
	  
});
function busquedavalida()
{
	 
	
	
return true	
}
function buscar()
{
	if(busquedavalida())
	{
	var fechainiciocompara = Date.parse($('#finicio').val());
	
	var now = new Date();
	now.setDate(now.getDate()+2);
	if(	fechainiciocompara>now)
	{
	var tiporeserva=$('input[name=tiporeserva]:checked').val();
	if(tiporeserva=="Hotel")
	{
	categoria=59;	
	}
	if(tiporeserva=="Paquetes")
	{
	categoria=61;	
	}
	if(tiporeserva=="Tours")
	{
	categoria=60;	
	}
	var busqueda=$('#destino').val();
	var fechas='&finicio='+$('#finicio').val()+'&ffin='+$('#ffin').val();
	var habitaciones='&habitaciones='+$('#habitaciones option:selected' ).text();
	var adultos='&adultos='+$('#adultos option:selected' ).text();
	var menores='&menores='+$('#menores option:selected' ).text();
	location.href='index.php?route=product/category&path='+categoria+'&destino='+busqueda+fechas+habitaciones+adultos+menores+'&tiporeserva='+tiporeserva+'&filter='+idbusqueda;
	}
	else
	{
		alert("Se necesitan al menos 48 horas para realizar una reservación");
	}
	}
}

 $(function(){

$('input:radio').change(
    function(){
		var tiporeserva=$('input[name=tiporeserva]:checked').val();
        if(tiporeserva=="Hotel") {
			$("#nombrecampo").text("Destino");
			$("#finiciocampo").text("Fecha de llegada");
			$("#txtfechasalida").css('visibility','visible');
			$("#ffin").css('visibility','visible');
			$("#habitaciones").css('visibility','visible');
			$("#lblhabitaciones").css('visibility','visible');
			categoria='Hotel';	
		}
		if(tiporeserva=="Paquetes") {
			$("#nombrecampo").text("Seleccione circuito:");
			$("#finiciocampo").text("Fecha de salida");
			$("#txtfechasalida").css('visibility','hidden');
			$("#ffin").css('visibility','hidden');
			$("#habitaciones").css('visibility','hidden');
			$("#lblhabitaciones").css('visibility','hidden');
			
			categoria='Circuito';	
		}
		
		if(tiporeserva=="Tours") {
			$("#nombrecampo").text("Seleccione tour:");
			$("#finiciocampo").text("Fecha de salida");
			$("#txtfechasalida").css('visibility','hidden');
			$("#ffin").css('visibility','hidden');
			$("#habitaciones").css('visibility','hidden');
			$("#lblhabitaciones").css('visibility','hidden');
			categoria='Tour';	
		}
		
		
		 
		 
				 $("#destino").autocomplete({
					source: "index.php?route=product/product/buscarproducto&tiporeservacion="+categoria,
					minLength: 0,//search after two characters
					select: function(event,ui){
					   idbusqueda=(ui.item.id);
				}
				});
    }
);          

});
 
//--></script> 