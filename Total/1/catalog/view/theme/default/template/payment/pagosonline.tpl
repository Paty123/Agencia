<form method="post" action="<?php echo $action; ?>" id="payment">
   <input name="merchantId" type="hidden" value="<?php echo $merchantId; ?>">
   <input name="accountId" type="hidden" value="<?php echo $usuarioId; ?>">
   <input name="description" type="hidden" value="<?php echo $descripcion; ?>">
  <input name="extra1" type="hidden" value="<?php foreach ($extra1 as $ext)echo $ext."\n"; ?>">
  <input name="extra2" type="hidden" value="<?php echo $extra2; ?>">
   <input name="test" type="hidden" value="<?php echo $prueba; ?>">
   <input name="referenceCode" id="refVenta" type="hidden" value="<?php echo $refVenta ?>">
   <input name="amount" id="valor" type="hidden" value="<?php echo $valor; ?>">
   <input name="taxReturnBase" type="hidden" value="<?php echo $baseDevolucionIva; ?>">
   <input name="tax" type="hidden" value="<?php echo $iva; ?>">
   <input name="currency" id="moneda" type="hidden" value="<?php echo $moneda; ?>">
   <input name="signature" type="hidden" value="<?php echo $firma; ?>">
   <input name="responseUrl" type="hidden" value="<?php echo $url_respuesta; ?>">
   <input name="confirmUrl" type="hidden" value="<?php echo $url_confirmacion; ?>">
   <input name="buyerEmail" type="hidden" value="<?php echo  $emailComprador;?>">
   <input name="lng" type="hidden" value="es">
  <input name="nombreComprador" type="hidden" value="<?php echo $nombreComprador;?>">
  <input name="telefonoMovil" type="hidden" value="<?php echo $telefonoMovil?>">
</form>

<div class="buttons">
  <table>
    <tr>
      <td align="right"><a onclick="$('#payment').submit();" class="button"><span><?php echo $button_confirm; ?></span></a></td>
    </tr>
  </table>
</div>