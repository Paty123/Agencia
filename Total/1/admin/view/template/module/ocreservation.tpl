<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      
    </div>
    <div class="content">
    <?php if (isset($this->request->get['input'])) { ?>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table id="module" class="list">
          <thead>
            <tr>
         <td><?php echo $entry_product; ?></td>
         <td><?php echo $entry_model; ?></td>
			   <td><?php echo $entry_date; ?></td>
			   <td><?php echo $entry_quantity; ?></td>
			   <td><?php echo $entry_order; ?></td>
            </tr>
          </thead>
		 <?php foreach ($reservations as $reservation) { ?>
			<tr>
			<td> <?php echo $reservation['productname']; ?> </td>
			<td> <?php echo $reservation['modelname']; ?> </td>
			<td> <?php echo $reservation['dateres']; ?> </td>
			<td> <?php echo $reservation['quantity']; ?> </td>
			<td> <?php echo '<a href="' . $url_order . $reservation['order_id']. '&token=' . $this->session->data['token'] . '">Order nummer '. $reservation['order_id'] .'</a>' ; ?> </td>
			</tr>
		 <?php }  ?>

      <?php } elseif (isset($this->request->get['settings'])){ ?>
         <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table id="module" class="list">
          <thead>
            <tr>
            	<td><?php echo $entry_product; ?></td>  
					<td><?php echo $text_type; ?></td>
         			<td><?php echo $text_monday; ?></td>
							<td><?php echo $text_tuesday; ?></td>
							<td><?php echo $text_wednesday; ?></td> 
							<td><?php echo $text_thursday; ?></td> 
							<td><?php echo $text_friday; ?></td> 
							<td><?php echo $text_saturday; ?></td> 
							<td><?php echo $text_sunday; ?></td> 	
							<td></td>
            </tr>
          </thead>
		
	      <?php foreach ($ressetting as $product) { ?>
					<tr>
					<td>  <input type="hidden" name="ocreservation_prodid" value="<?php echo $product['productkey'] ?>"> <?php echo $product['productname']; ?> </td>
					
					<td><select name="ocreservation_type">
                  <?php switch ($product['type']) { 
				  case 0 :?>
				  <option value="2"><?php echo $text_type_nores; ?></option>
				  <option value="1"><?php echo $text_type_multiday; ?></option>
                  <option value="0" selected="selected"><?php echo $text_type_oneday; ?></option>
				  <?php break;
				  case 1: ?>
				  <option value="2"><?php echo $text_type_nores; ?></option>
                  <option value="1" selected="selected"><?php echo $text_type_multiday; ?></option>
                  <option value="0"><?php echo $text_type_oneday; ?></option>
                  <?php break;
				  case 2: ?>
				  <option value="2" selected="selected"><?php echo $text_type_nores; ?></option>
                  <option value="1"><?php echo $text_type_multiday; ?></option>
                  <option value="0"><?php echo $text_type_oneday; ?></option>
				                  
                  <?php break;} ?>
              </select></td>
			  
					
					<td><select name="ocreservation_mon">
                  <?php if ($product['mon']) { ?>
                  <option value="1" selected="selected"><?php echo $text_disabled; ?></option>
                  <option value="0"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_disabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } ?>
              </select></td>
          <td><select name="ocreservation_tue">
                  <?php if ($product['tue']) { ?>
                  <option value="1" selected="selected"><?php echo $text_disabled; ?></option>
                  <option value="0"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_disabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } ?>
              </select></td>
          <td><select name="ocreservation_wed">
                  <?php if ($product['wed']) { ?>
                  <option value="1" selected="selected"><?php echo $text_disabled; ?></option>
                  <option value="0"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_disabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } ?>
              </select></td>
              <td><select name="ocreservation_thu">
                  <?php if ($product['thu']) { ?>
                  <option value="1" selected="selected"><?php echo $text_disabled; ?></option>
                  <option value="0"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_disabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } ?>
              </select></td>
              <td><select name="ocreservation_fri">
                  <?php if ($product['fri']) { ?>
                  <option value="1" selected="selected"><?php echo $text_disabled; ?></option>
                  <option value="0"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_disabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } ?>
              </select></td>
              <td><select name="ocreservation_sat">
                  <?php if ($product['sat']) { ?>
                  <option value="1" selected="selected"><?php echo $text_disabled; ?></option>
                  <option value="0"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_disabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } ?>
              </select></td>
              <td><select name="ocreservation_sun">
                  <?php if ($product['sun']) { ?>
                  <option value="1" selected="selected"><?php echo $text_disabled; ?></option>
                  <option value="0"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_disabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } ?>
              </select></td>
			  <td><div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a></div></td>
					
			  </tr>
					
			 	<?php }  ?>
      
      <?php } else { ?>
	      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table id="module" class="list">
          <thead>
            <tr>
         			<td><?php echo $entry_product; ?></td>
					<td></td>        
					<td></td>   
            </tr>
          </thead>
      
	      <?php foreach ($productreservations as $product) { ?>
					<tr>
					<td> <?php echo $product['productname']; ?> </td>
					<td> <a href="<?php echo $action. '&settings='. $product['productkey'] ; ?> "> Edit Settings</a></td>
					<td> <a href="<?php echo $action. '&input='. $product['productkey'] ; ?> "> <?php echo $entry_showrreservation ?></a></td>
					</tr>
			 	<?php }  ?>
      <?php }  ?>
      
      		 
          
        </table>
      </form>
    </div>
  </div>
</div>

<?php echo $footer; ?>