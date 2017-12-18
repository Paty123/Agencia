<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<?php echo $content_top; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<body>

<div border="0" cellpadding="0" cellspacing="0"  class="tablacontenidoshome">
  

 
  <tr>
    <td class="columna_izq">
    <!-- inicio de tabla busqueda-->
<?php include("barrabusqueda.tpl");?>
<!-- fin de tabla busqueda-->
</td>
    <td class="columna_der"><div id="content">
        
        <?php echo $content_bottom; ?></div>
     </td>
  </tr>

</body>
<?php echo $footer; ?>
