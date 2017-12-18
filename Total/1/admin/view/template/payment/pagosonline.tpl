<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location='<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
    <table class="form">
      <tr>
        <td width="25%"><span class="required">*</span> <?php echo $entry_merchantId; ?></td>
        <td><input type="text" name="pagosonline_merchantId" value="<?php echo $pagosonline_merchantId; ?>" /></td>
      </tr>

      <tr>
        <td width="25%"><span class="required">*</span> <?php echo $entry_usuarioId; ?></td>
        <td><input type="text" name="pagosonline_usuarioId" value="<?php echo $pagosonline_usuarioId; ?>" /></td>
      </tr>
	  
      <tr>
        <td><span class="required">*</span> <?php echo $entry_llaveEncripcion; ?></td>
        <td><input type="text" name="pagosonline_llaveEncripcion" value="<?php echo $pagosonline_llaveEncripcion; ?>" /></td>
      </tr>

	  
	  <tr>
        <td><?php echo $entry_status; ?></td>
        <td><select name="pagosonline_status">
            <?php if ($pagosonline_status) { ?>
            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
            <option value="0"><?php echo $text_disabled; ?></option>
            <?php } else { ?>
            <option value="1"><?php echo $text_enabled; ?></option>
            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
            <?php } ?>
          </select></td>
      </tr>
	  
	  
	  <tr>
        <td><?php echo $entry_order_status; ?></td>
        <td><select name="pagosonline_order_status_id">
            <?php foreach ($order_statuses as $order_status) { ?>
            <?php if ($order_status['order_status_id'] == $pagosonline_order_status_id) { ?>
            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></td>
      </tr>  
	  <tr>
        <td><?php echo $entry_sort_order; ?></td>
        <td><input type="text" name="pagosonline_sort_order" value="<?php echo $pagosonline_sort_order; ?>" size="1" /></td>
      </tr>
	  
	  <tr>
        <td><?php echo $entry_prueba; ?></td>
        <td>
		<label>Si<input type="radio" name="pagosonline_prueba" value="1" <?php echo $pagosonline_prueba=="1"?"checked":"" ?>/></label>
		<label>No<input type="radio" name="pagosonline_prueba" value="0" <?php echo $pagosonline_prueba!="1"?"checked":"" ?> /></label>
		</td>
      </tr>
    </table>
  </div>
</form>
</div>
<?php echo $footer; ?>