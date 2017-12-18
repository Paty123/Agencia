<?php echo $header; ?>
<div id="content">
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a
				href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>
	<?php if ($error_warning) { ?>
	<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?>
	<div class="box">
		<div class="heading">
			<h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>

			<div class="buttons"><a onclick="$('#form').submit();"
									class="button"><span><?php echo $button_save; ?></span></a><a
					onclick="location = '<?php echo $cancel; ?>';"
					class="button"><span><?php echo $button_cancel; ?></span></a></div>
		</div>
		<div class="content">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
				<table class="form">
					<tr>
						<td><span class="required">*</span> <?php echo $entry_merchant; ?></td>
						<td><input type="text" name="dineromail_merchant" value="<?php echo $dineromail_merchant; ?>"/>
							<?php if ($error_merchant) { ?>
								<span class="error"><?php echo $error_merchant; ?></span>
								<?php } ?></td>
					</tr>
					<tr>
						<td><span class="required">*</span> <?php echo $entry_email; ?></td>
						<td><input type="text" name="dineromail_email" value="<?php echo $dineromail_email; ?>"/>
							<?php if ($error_email) { ?>
								<span class="error"><?php echo $error_email; ?></span>
								<?php } ?></td>
					</tr>
					<tr>
						<td><span class="required">*</span><?php echo $entry_geo_zone; ?></td>
						<td><select name="dineromail_geo_zone_id">
							<option value=""><?php echo $text_country; ?></option>
							<option <?php if ($dineromail_geo_zone_id=='1') { echo "selected='selected'"; } ?> value="1">Argentina</option>
							<option <?php if ($dineromail_geo_zone_id=='2') { echo "selected='selected'"; } ?> value="2">Brasil</option>
							<option <?php if ($dineromail_geo_zone_id=='3') { echo "selected='selected'"; } ?> value="3">Chile</option>
							<option <?php if ($dineromail_geo_zone_id=='4') { echo "selected='selected'"; } ?> value="4">México</option>							
						</select>
						<?php if ($error_country) { ?>
								<span class="error"><?php echo $error_country; ?></span>
								<?php } ?></td>
					</tr>
					<tr>
						<td><?php echo $entry_url_logo; ?></td>
						<td><input type="text" name="dineromail_url_logo" value="<?php echo $dineromail_url_logo; ?>"/></td>
					</tr>
					<tr>
						<td><?php echo $entry_callback; ?></td>
						<td><?php echo $callback; ?></td>
					</tr>
					<tr>
						<td><?php echo $entry_ipn_pass; ?></td>
						<td><input type="text" name="dineromail_ipn_pass" value="<?php echo $dineromail_ipn_pass; ?>"/></td>
					</tr>
					<tr>
						<td><?php echo $entry_order_status; ?></td>
						<td><select name="dineromail_order_status_id">
							<?php foreach ($order_statuses as $order_status) { ?>
							<?php if ($order_status['order_status_id'] == $dineromail_order_status_id) { ?>
								<option value="<?php echo $order_status['order_status_id']; ?>"
										selected="selected"><?php echo $order_status['name']; ?></option>
								<?php } else { ?>
								<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
								<?php } ?>
							<?php } ?>
						</select></td>
					</tr>
					
					<tr>
						<td><?php echo $entry_status; ?></td>
						<td><select name="dineromail_status">
							<?php if ($dineromail_status) { ?>
							<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
							<option value="0"><?php echo $text_disabled; ?></option>
							<?php } else { ?>
							<option value="1"><?php echo $text_enabled; ?></option>
							<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<td><?php echo $entry_sort_order; ?></td>
						<td><input type="text" name="dineromail_sort_order" value="<?php echo $dineromail_sort_order; ?>"
								   size="1"/></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php echo $footer; ?>