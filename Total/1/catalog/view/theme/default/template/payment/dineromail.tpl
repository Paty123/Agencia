<form action="<?php echo $action ?>" method="post" id="payment" >
  <input type="hidden" name="tool" value="button" />
  <input type="hidden" name="payment_method_available" value="all" />
  <input type="hidden" name="change_quantity" value="0" />
  <input type="hidden" name="merchant" value="<?php echo $order_merchant; ?>" />
  <input type="hidden" name="country_id" value="<?php echo $order_countryid; ?>" />
  <input type="hidden" name="header_image" value="<?php echo $order_logo; ?>" />
  <input type="hidden" name="language" value="<?php echo $order_language; ?>" />
  <input type="hidden" name="currency" value="<?php echo $order_currency; ?>" />
  <input type="hidden" name="seller_name" value="<?php echo $order_sellername; ?>" />
  <input type="hidden" name="transaction_id" value="<?php echo $order_transactionid; ?>" />
  <input type="hidden" name="ok_url" value="<?php echo $order_penokurl; ?>" />
  <input type="hidden" name="pending_url" value="<?php echo $order_penokurl; ?>" />
  <input type="hidden" name="error_url" value="<?php echo $order_cancelurl; ?>" />
  <input type="hidden" name="buyer_name" value="<?php echo $order_name; ?>" />
  <input type="hidden" name="buyer_lastname" value="<?php echo $order_lastname; ?>" />
  <input type="hidden" name="buyer_email" value="<?php echo $order_email; ?>" />
  <input type="hidden" name="buyer_phone" value="<?php echo $order_fone; ?>" />  
  <?php if($order_discount > 0) { ?>
  	<input type="hidden" name="display_additional_charge" value="1" />
    <input type="hidden" name="additional_fixed_charge" value="<?php echo $order_discount; ?>-" />
    <input type="hidden" name="additional_fixed_charge_currency" value="<?php echo $order_currency; ?>" />
  <?php } ?>
  <?php $i = 1; ?>
  <?php foreach ($products as $product) { ?>
  	<input type="hidden" name="item_code_<?php echo $i; ?>" value="<?php echo $product['product_id']; ?>" />
  	<input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $product['name']; ?>" />
 	 <input type="hidden" name="item_quantity_<?php echo $i; ?>" value="<?php echo $product['quantity']; ?>" />
  	<input type="hidden" name="item_ammount_<?php echo $i; ?>" value="<?php echo ($product['price']*100); ?>" />
  	<input type="hidden" name="item_currency_<?php echo $i; ?>" value="<?php echo $order_currency; ?>" />
  	<?php $i++; ?>
  <?php } ?>  	
</form>
<div class="buttons">
	<div class="right">
      <a id="button-confirm" class="button"><span><?php echo $button_confirm; ?></span></a>
	</div>
</div>
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
	$.ajax({ 
		type: 'GET',
		url: 'index.php?route=payment/dineromail/confirm',
		beforeSend: function() {
			$('#button-confirm').attr('disabled', true);
			
			$('#payment').before('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		success: function() {
			$('#payment').submit();
		}		
	});
});
//--></script> 
