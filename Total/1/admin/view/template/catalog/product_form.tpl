<?php
if (isset($this->request->get['product_id'])) {
				$product_id= $this->request->get['product_id'];
			} else {
				$product_id= 0;
			}
?>
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
    <div class="heading">
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs">
        <a href="#tab-general"><?php echo $tab_general; ?></a>
        <a href="#tab-data"><?php echo $tab_data; ?></a>
        <a href="#tab-links"><?php echo $tab_links; ?></a>
        <a href="#tab-attribute"><?php echo $tab_attribute; ?></a>
        <a href="#tab-option"><?php echo $tab_option; ?></a>
        <!--a href="#tab-discount"><?php echo $tab_discount; ?></a>
        <a href="#tab-special"><?php echo $tab_special; ?></a-->
        <a href="#tab-image"><?php echo $tab_image; ?></a>
        <a href="#tab-reward"><?php echo $tab_reward; ?></a>
        <a href="#tab-design"><?php echo $tab_design; ?></a>
        <a href="#tab-reservacion">Reservaciones</a>
        <a href="#tab-increcoms"><?php echo ($tipoproducto=="Hotel"?'Servicios':'Incluye y Recomendaciones');?></a>
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_name; ?></td>
                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_description; ?></td>
                <td><textarea name="product_description[<?php echo $language['language_id']; ?>][meta_description]" cols="40" rows="5"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_description'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_keyword; ?></td>
                <td><textarea name="product_description[<?php echo $language['language_id']; ?>][meta_keyword]" cols="40" rows="5"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo ($tipoproducto=="Hotel"?'Informaci&oacute;n':'Itinerario');?></td>
                <td><textarea name="product_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['description'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo $entry_tag; ?></td>
                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][tag]" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['tag'] : ''; ?>" size="80" /></td>
              </tr>
            </table>
          </div>
          <?php } ?>
        </div>
        <div id="tab-data">
          <table class="form">
            <tr>
              <td><span class="required">*</span> <?php echo $entry_model; ?></td>
              <td><input type="text" name="model" value="<?php echo $model; ?>" />
                <?php if ($error_model) { ?>
                <span class="error"><?php echo $error_model; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_sku; ?></td>
              <td><input type="text" name="sku" value="<?php echo $sku; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_upc; ?></td>
              <td><input type="text" name="upc" value="<?php echo $upc; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_ean; ?></td>
              <td><input type="text" name="ean" value="<?php echo $ean; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_jan; ?></td>
              <td><input type="text" name="jan" value="<?php echo $jan; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_isbn; ?></td>
              <td><input type="text" name="isbn" value="<?php echo $isbn; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_mpn; ?></td>
              <td><input type="text" name="mpn" value="<?php echo $mpn; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_location; ?></td>
              <td><input type="text" name="location" value="<?php echo $location; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_price; ?></td>
              <td><input type="text" name="price" value="<?php echo $price; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_tax_class; ?></td>
              <td><select name="tax_class_id">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($tax_classes as $tax_class) { ?>
                  <?php if ($tax_class['tax_class_id'] == $tax_class_id) { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_quantity; ?></td>
              <td><input type="text" name="quantity" value="<?php echo $quantity; ?>" size="2" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_minimum; ?></td>
              <td><input type="text" name="minimum" value="<?php echo $minimum; ?>" size="2" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_subtract; ?></td>
              <td><select name="subtract">
                  <?php if ($subtract) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_stock_status; ?></td>
              <td><select name="stock_status_id">
                  <?php foreach ($stock_statuses as $stock_status) { ?>
                  <?php if ($stock_status['stock_status_id'] == $stock_status_id) { ?>
                  <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_shipping; ?></td>
              <td><?php if ($shipping) { ?>
                <input type="radio" name="shipping" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="shipping" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="shipping" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="shipping" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_keyword; ?></td>
              <td><input type="text" name="keyword" value="<?php echo $keyword; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_image; ?></td>
              <td><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" /><br />
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                  <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
            </tr>
            <tr>
              <td><?php echo $entry_date_available; ?></td>
              <td><input type="text" name="date_available" value="<?php echo $date_available; ?>" size="12" class="date" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_dimension; ?></td>
              <td><input type="text" name="length" value="<?php echo $length; ?>" size="4" />
                <input type="text" name="width" value="<?php echo $width; ?>" size="4" />
                <input type="text" name="height" value="<?php echo $height; ?>" size="4" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_length; ?></td>
              <td><select name="length_class_id">
                  <?php foreach ($length_classes as $length_class) { ?>
                  <?php if ($length_class['length_class_id'] == $length_class_id) { ?>
                  <option value="<?php echo $length_class['length_class_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_weight; ?></td>
              <td><input type="text" name="weight" value="<?php echo $weight; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_weight_class; ?></td>
              <td><select name="weight_class_id">
                  <?php foreach ($weight_classes as $weight_class) { ?>
                  <?php if ($weight_class['weight_class_id'] == $weight_class_id) { ?>
                  <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td><select name="status">
                  <?php if ($status) { ?>
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
              <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="2" /></td>
            </tr>
          </table>
        </div>
        <div id="tab-links">
          <table class="form">
            <tr>
              <td><?php echo $entry_manufacturer; ?></td>
              <td><input type="text" name="manufacturer" value="<?php echo $manufacturer ?>" /><input type="hidden" name="manufacturer_id" value="<?php echo $manufacturer_id; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_category; ?></td>
              <td><input type="text" name="category" value="" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div id="product-category" class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($product_categories as $product_category) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="product-category<?php echo $product_category['category_id']; ?>" class="<?php echo $class; ?>"><?php echo $product_category['name']; ?><img src="view/image/delete.png" alt="" />
                    <input type="hidden" name="product_category[]" value="<?php echo $product_category['category_id']; ?>" />
                  </div>
                  <?php } ?>
                </div></td>
            </tr> 
            <tr>
              <td><?php echo $entry_filter; ?></td>
              <td><input type="text" name="filter" value="" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div id="product-filter" class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($product_filters as $product_filter) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="product-filter<?php echo $product_filter['filter_id']; ?>" class="<?php echo $class; ?>"><?php echo $product_filter['name']; ?><img src="view/image/delete.png" alt="" />
                    <input type="hidden" name="product_filter[]" value="<?php echo $product_filter['filter_id']; ?>" />
                  </div>
                  <?php } ?>
                </div></td>
            </tr>                       
            <tr>
              <td><?php echo $entry_store; ?></td>
              <td><div class="scrollbox">
                  <?php $class = 'even'; ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array(0, $product_store)) { ?>
                    <input type="checkbox" name="product_store[]" value="0" checked="checked" />
                    <?php echo $text_default; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="product_store[]" value="0" />
                    <?php echo $text_default; ?>
                    <?php } ?>
                  </div>
                  <?php foreach ($stores as $store) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($store['store_id'], $product_store)) { ?>
                    <input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                    <?php echo $store['name']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" />
                    <?php echo $store['name']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
            <tr>
              <td><?php echo $entry_download; ?></td>
              <td><input type="text" name="download" value="" /></td>
            </tr>			
            <tr>
              <td>&nbsp;</td>
              <td><div id="product-download" class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($product_downloads as $product_download) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="product-download<?php echo $product_download['download_id']; ?>" class="<?php echo $class; ?>"> <?php echo $product_download['name']; ?><img src="view/image/delete.png" alt="" />
                    <input type="hidden" name="product_download[]" value="<?php echo $product_download['download_id']; ?>" />
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
            <tr>
              <td><?php echo $entry_related; ?></td>
              <td><input type="text" name="related" value="" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div id="product-related" class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($product_related as $product_related) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="product-related<?php echo $product_related['product_id']; ?>" class="<?php echo $class; ?>"> <?php echo $product_related['name']; ?><img src="view/image/delete.png" alt="" />
                    <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
          </table>
        </div>
        <div id="tab-attribute">
          <table id="attribute" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_attribute; ?></td>
                <td class="left"><?php echo $entry_text; ?></td>
                <td></td>
              </tr>
            </thead>
            <?php $attribute_row = 0; ?>
            <?php foreach ($product_attributes as $product_attribute) { ?>
            <tbody id="attribute-row<?php echo $attribute_row; ?>">
              <tr>
                <td class="left"><input type="text" name="product_attribute[<?php echo $attribute_row; ?>][name]" value="<?php echo $product_attribute['name']; ?>" />
                  <input type="hidden" name="product_attribute[<?php echo $attribute_row; ?>][attribute_id]" value="<?php echo $product_attribute['attribute_id']; ?>" /></td>
                <td class="left"><?php foreach ($languages as $language) { ?>
                  <textarea name="product_attribute[<?php echo $attribute_row; ?>][product_attribute_description][<?php echo $language['language_id']; ?>][text]" cols="40" rows="5"><?php echo isset($product_attribute['product_attribute_description'][$language['language_id']]) ? $product_attribute['product_attribute_description'][$language['language_id']]['text'] : ''; ?></textarea>
                  <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" align="top" /><br />
                  <?php } ?></td>
                <td class="left"><a onclick="$('#attribute-row<?php echo $attribute_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $attribute_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td class="left"><a onclick="addAttribute();" class="button"><?php echo $button_add_attribute; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div id="tab-option">
          <div id="vtab-option" class="vtabs">
            <?php $option_row = 0; ?>
            <?php foreach ($product_options as $product_option) { ?>
            <a href="#tab-option-<?php echo $option_row; ?>" id="option-<?php echo $option_row; ?>"><?php echo $product_option['name']; ?>&nbsp;<img src="view/image/delete.png" alt="" onclick="$('#option-<?php echo $option_row; ?>').remove(); $('#tab-option-<?php echo $option_row; ?>').remove(); $('#vtabs a:first').trigger('click'); return false;" /></a>
            <?php $option_row++; ?>
            <?php } ?>
            <span id="option-add">
            <input name="option" value="" style="width: 130px;" />
            &nbsp;<img src="view/image/add.png" alt="<?php echo $button_add_option; ?>" title="<?php echo $button_add_option; ?>" /></span></div>
          <?php $option_row = 0; ?>
          <?php $option_value_row = 0; ?>
          <?php foreach ($product_options as $product_option) { ?>
          <div id="tab-option-<?php echo $option_row; ?>" class="vtabs-content">
            <input type="hidden" name="product_option[<?php echo $option_row; ?>][product_option_id]" value="<?php echo $product_option['product_option_id']; ?>" />
            <input type="hidden" name="product_option[<?php echo $option_row; ?>][name]" value="<?php echo $product_option['name']; ?>" />
            <input type="hidden" name="product_option[<?php echo $option_row; ?>][option_id]" value="<?php echo $product_option['option_id']; ?>" />
            <input type="hidden" name="product_option[<?php echo $option_row; ?>][type]" value="<?php echo $product_option['type']; ?>" />
            <table class="form">
              <tr>
                <td><?php echo $entry_required; ?></td>
                <td><select name="product_option[<?php echo $option_row; ?>][required]">
                    <?php if ($product_option['required']) { ?>
                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                    <option value="0"><?php echo $text_no; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_yes; ?></option>
                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                    <?php } ?>
                  </select></td>
              </tr>
              <?php if ($product_option['type'] == 'text') { ?>
              <tr>
                <td><?php echo $entry_option_value; ?></td>
                <td><input type="text" name="product_option[<?php echo $option_row; ?>][option_value]" value="<?php echo $product_option['option_value']; ?>" /></td>
              </tr>
              <?php } ?>
              <?php if ($product_option['type'] == 'textarea') { ?>
              <tr>
                <td><?php echo $entry_option_value; ?></td>
                <td><textarea name="product_option[<?php echo $option_row; ?>][option_value]" cols="40" rows="5"><?php echo $product_option['option_value']; ?></textarea></td>
              </tr>
              <?php } ?>
              <?php if ($product_option['type'] == 'file') { ?>
              <tr style="display: none;">
                <td><?php echo $entry_option_value; ?></td>
                <td><input type="text" name="product_option[<?php echo $option_row; ?>][option_value]" value="<?php echo $product_option['option_value']; ?>" /></td>
              </tr>
              <?php } ?>
              <?php if ($product_option['type'] == 'date') { ?>
              <tr>
                <td><?php echo $entry_option_value; ?></td>
                <td><input type="text" name="product_option[<?php echo $option_row; ?>][option_value]" value="<?php echo $product_option['option_value']; ?>" class="date" /></td>
              </tr>
              <?php } ?>
              <?php if ($product_option['type'] == 'datetime') { ?>
              <tr>
                <td><?php echo $entry_option_value; ?></td>
                <td><input type="text" name="product_option[<?php echo $option_row; ?>][option_value]" value="<?php echo $product_option['option_value']; ?>" class="datetime" /></td>
              </tr>
              <?php } ?>
              <?php if ($product_option['type'] == 'time') { ?>
              <tr>
                <td><?php echo $entry_option_value; ?></td>
                <td><input type="text" name="product_option[<?php echo $option_row; ?>][option_value]" value="<?php echo $product_option['option_value']; ?>" class="time" /></td>
              </tr>
              <?php } ?>
            </table>
            <?php if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') { ?>
            <table id="option-value<?php echo $option_row; ?>" class="list">
              <thead>
                <tr>
                  <td class="left"><?php echo $entry_option_value; ?></td>
                  <td class="right"><?php echo $entry_quantity; ?></td>
                  <td class="left"><?php echo $entry_subtract; ?></td>
                  <td class="right"><?php echo $entry_price; ?></td>
                  <td class="right"><?php echo $entry_option_points; ?></td>
                  <td class="right"><?php echo $entry_weight; ?></td>
                  <td></td>
                </tr>
              </thead>
              <?php foreach ($product_option['product_option_value'] as $product_option_value) { ?>
              <tbody id="option-value-row<?php echo $option_value_row; ?>">
                <tr>
                  <td class="left"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][option_value_id]">
                      <?php if (isset($option_values[$product_option['option_id']])) { ?>
                      <?php foreach ($option_values[$product_option['option_id']] as $option_value) { ?>
                      <?php if ($option_value['option_value_id'] == $product_option_value['option_value_id']) { ?>
                      <option value="<?php echo $option_value['option_value_id']; ?>" selected="selected"><?php echo $option_value['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    <input type="hidden" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][product_option_value_id]" value="<?php echo $product_option_value['product_option_value_id']; ?>" /></td>
                  <td class="right"><input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][quantity]" value="<?php echo $product_option_value['quantity']; ?>" size="3" /></td>
                  <td class="left"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][subtract]">
                      <?php if ($product_option_value['subtract']) { ?>
                      <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                      <option value="0"><?php echo $text_no; ?></option>
                      <?php } else { ?>
                      <option value="1"><?php echo $text_yes; ?></option>
                      <option value="0" selected="selected"><?php echo $text_no; ?></option>
                      <?php } ?>
                    </select></td>
                  <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price_prefix]">
                      <?php if ($product_option_value['price_prefix'] == '+') { ?>
                      <option value="+" selected="selected">+</option>
                      <?php } else { ?>
                      <option value="+">+</option>
                      <?php } ?>
                      <?php if ($product_option_value['price_prefix'] == '-') { ?>
                      <option value="-" selected="selected">-</option>
                      <?php } else { ?>
                      <option value="-">-</option>
                      <?php } ?>
                    </select>
                    <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price]" value="<?php echo $product_option_value['price']; ?>" size="5" /></td>
                  <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points_prefix]">
                      <?php if ($product_option_value['points_prefix'] == '+') { ?>
                      <option value="+" selected="selected">+</option>
                      <?php } else { ?>
                      <option value="+">+</option>
                      <?php } ?>
                      <?php if ($product_option_value['points_prefix'] == '-') { ?>
                      <option value="-" selected="selected">-</option>
                      <?php } else { ?>
                      <option value="-">-</option>
                      <?php } ?>
                    </select>
                    <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points]" value="<?php echo $product_option_value['points']; ?>" size="5" /></td>
                  <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight_prefix]">
                      <?php if ($product_option_value['weight_prefix'] == '+') { ?>
                      <option value="+" selected="selected">+</option>
                      <?php } else { ?>
                      <option value="+">+</option>
                      <?php } ?>
                      <?php if ($product_option_value['weight_prefix'] == '-') { ?>
                      <option value="-" selected="selected">-</option>
                      <?php } else { ?>
                      <option value="-">-</option>
                      <?php } ?>
                    </select>
                    <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight]" value="<?php echo $product_option_value['weight']; ?>" size="5" /></td>
                  <td class="left"><a onclick="$('#option-value-row<?php echo $option_value_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
                </tr>
              </tbody>
              <?php $option_value_row++; ?>
              <?php } ?>
              <tfoot>
                <tr>
                  <td colspan="6"></td>
                  <td class="left"><a onclick="addOptionValue('<?php echo $option_row; ?>');" class="button"><?php echo $button_add_option_value; ?></a></td>
                </tr>
              </tfoot>
            </table>
            <select id="option-values<?php echo $option_row; ?>" style="display: none;">
              <?php if (isset($option_values[$product_option['option_id']])) { ?>
              <?php foreach ($option_values[$product_option['option_id']] as $option_value) { ?>
              <option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
            <?php } ?>
          </div>
          <?php $option_row++; ?>
          <?php } ?>
        </div>

        <!--div id="tab-discount">
          <table id="discount" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_customer_group; ?></td>
                <td class="right"><?php echo $entry_quantity; ?></td>
                <td class="right"><?php echo $entry_priority; ?></td>
                <td class="right"><?php echo $entry_price; ?></td>
                <td class="left"><?php echo $entry_date_start; ?></td>
                <td class="left"><?php echo $entry_date_end; ?></td>
                <td></td>
              </tr>
            </thead>
            <?php $discount_row = 0; ?>
            <?php foreach ($product_discounts as $product_discount) { ?>
            <tbody id="discount-row<?php echo $discount_row; ?>">
              <tr>
                <td class="left"><select name="product_discount[<?php echo $discount_row; ?>][customer_group_id]">
                    <?php foreach ($customer_groups as $customer_group) { ?>
                    <?php if ($customer_group['customer_group_id'] == $product_discount['customer_group_id']) { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
                <td class="right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][quantity]" value="<?php echo $product_discount['quantity']; ?>" size="2" /></td>
                <td class="right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][priority]" value="<?php echo $product_discount['priority']; ?>" size="2" /></td>
                <td class="right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][price]" value="<?php echo $product_discount['price']; ?>" /></td>
                <td class="left"><input type="text" name="product_discount[<?php echo $discount_row; ?>][date_start]" value="<?php echo $product_discount['date_start']; ?>" class="date" /></td>
                <td class="left"><input type="text" name="product_discount[<?php echo $discount_row; ?>][date_end]" value="<?php echo $product_discount['date_end']; ?>" class="date" /></td>
                <td class="left"><a onclick="$('#discount-row<?php echo $discount_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $discount_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="6"></td>
                <td class="left"><a onclick="addDiscount();" class="button"><?php echo $button_add_discount; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div id="tab-special">
          <table id="special" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_customer_group; ?></td>
                <td class="right"><?php echo $entry_priority; ?></td>
                <td class="right"><?php echo $entry_price; ?></td>
                <td class="left"><?php echo $entry_date_start; ?></td>
                <td class="left"><?php echo $entry_date_end; ?></td>
                <td></td>
              </tr>
            </thead>
            <?php $special_row = 0; ?>
            <?php foreach ($product_specials as $product_special) { ?>
            <tbody id="special-row<?php echo $special_row; ?>">
              <tr>
                <td class="left"><select name="product_special[<?php echo $special_row; ?>][customer_group_id]">
                    <?php foreach ($customer_groups as $customer_group) { ?>
                    <?php if ($customer_group['customer_group_id'] == $product_special['customer_group_id']) { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
                <td class="right"><input type="text" name="product_special[<?php echo $special_row; ?>][priority]" value="<?php echo $product_special['priority']; ?>" size="2" /></td>
                <td class="right"><input type="text" name="product_special[<?php echo $special_row; ?>][price]" value="<?php echo $product_special['price']; ?>" /></td>
                <td class="left"><input type="text" name="product_special[<?php echo $special_row; ?>][date_start]" value="<?php echo $product_special['date_start']; ?>" class="date" /></td>
                <td class="left"><input type="text" name="product_special[<?php echo $special_row; ?>][date_end]" value="<?php echo $product_special['date_end']; ?>" class="date" /></td>
                <td class="left"><a onclick="$('#special-row<?php echo $special_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $special_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="5"></td>
                <td class="left"><a onclick="addSpecial();" class="button"><?php echo $button_add_special; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div-->

        <div id="tab-image">
          <table id="images" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_image; ?></td>
                <td class="right"><?php echo $entry_sort_order; ?></td>
                <td></td>
              </tr>
            </thead>
            <?php $image_row = 0; ?>
            <?php foreach ($product_images as $product_image) { ?>
            <tbody id="image-row<?php echo $image_row; ?>">
              <tr>
                <td class="left"><div class="image"><img src="<?php echo $product_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                    <input type="hidden" name="product_image[<?php echo $image_row; ?>][image]" value="<?php echo $product_image['image']; ?>" id="image<?php echo $image_row; ?>" />
                    <br />
                    <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                <td class="right"><input type="text" name="product_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $product_image['sort_order']; ?>" size="2" /></td>
                <td class="left"><a onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $image_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td class="left"><a onclick="addImage();" class="button"><?php echo $button_add_image; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div id="tab-reward">
          <table class="form">
            <tr>
              <td><?php echo $entry_points; ?></td>
              <td><input type="text" name="points" value="<?php echo $points; ?>" /></td>
            </tr>
          </table>
          <table class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_customer_group; ?></td>
                <td class="right"><?php echo $entry_reward; ?></td>
              </tr>
            </thead>
            <?php foreach ($customer_groups as $customer_group) { ?>
            <tbody>
              <tr>
                <td class="left"><?php echo $customer_group['name']; ?></td>
                <td class="right"><input type="text" name="product_reward[<?php echo $customer_group['customer_group_id']; ?>][points]" value="<?php echo isset($product_reward[$customer_group['customer_group_id']]) ? $product_reward[$customer_group['customer_group_id']]['points'] : ''; ?>" /></td>
              </tr>
            </tbody>
            <?php } ?>
          </table>
        </div>
        <div id="tab-design">
          <table class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_store; ?></td>
                <td class="left"><?php echo $entry_layout; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left"><?php echo $text_default; ?></td>
                <td class="left"><select name="product_layout[0][layout_id]">
                    <option value=""></option>
                    <?php foreach ($layouts as $layout) { ?>
                    <?php if (isset($product_layout[0]) && $product_layout[0] == $layout['layout_id']) { ?>
                    <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
              </tr>
            </tbody>
            <?php foreach ($stores as $store) { ?>
            <tbody>
              <tr>
                <td class="left"><?php echo $store['name']; ?></td>
                <td class="left"><select name="product_layout[<?php echo $store['store_id']; ?>][layout_id]">
                    <option value=""></option>
                    <?php foreach ($layouts as $layout) { ?>
                    <?php if (isset($product_layout[$store['store_id']]) && $product_layout[$store['store_id']] == $layout['layout_id']) { ?>
                    <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
              </tr>
            </tbody>
            <?php } ?>
          </table>
        </div>
        
        <div id="tab-reservacion">
          <table >
          <tbody>
            <tr>
              <td class="left"><table class="list">
                <thead>
                  <tr>
                    <td class="left">Opci&oacute;n</td>
                    <td class="left">Valor</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="left">Tipo de producto</td>
                    <td class="left">
                      <select name="tipoproducto">
                        <option  value="Hotel" <?php if($tipoproducto=="Hotel") echo "selected='selected'" ?>>Hotel</option>
                        <option value="Circuito" <?php if($tipoproducto=="Circuito") echo "selected='selected'" ?>>Circuito</option>
                        <option value="Tour" <?php if($tipoproducto=="Tour") echo "selected='selected'" ?>>Tour</option>
                        <option value="Traslado" <?php if($tipoproducto=="Traslado") echo "selected='selected'" ?>>Traslado</option>
                      </select>
                      <?php if($tipoproducto=="Hotel"){
                        $query = $this->db->query("SELECT * FROM hotels_ctgs WHERE idprod=".$product_id  );
                        if($query && count($query->rows)>0){ 
                          $catgthot=$query->rows[0]['catg']; $idhct=$query->rows[0]['idhct'];
                          $horain=$query->rows[0]['hhini'];
                          $horaout=$query->rows[0]['hhsal'];
                        }else{
                          $catgthot='-5'; $idhct=0; $horain=''; $horaout='';
                        } ?>
                        <br />Categoria: <select name="htcatg" id="htcatg">
                          <option  value="0">sin definir</option>
                          <option  value="1" <?php if($catgthot=="1") echo "selected='selected'" ?>>1 estrellas</option>
                          <option  value="2" <?php if($catgthot=="2") echo "selected='selected'" ?>>2 estrellas</option>
                          <option  value="3" <?php if($catgthot=="3") echo "selected='selected'" ?>>3 estrellas</option>
                          <option  value="4" <?php if($catgthot=="4") echo "selected='selected'" ?>>4 estrellas</option>
                          <option  value="5" <?php if($catgthot=="5") echo "selected='selected'" ?>>5 estrellas</option>
                          <option  value="Hostal" <?php if($catgthot=="Hostal") echo "selected='selected'" ?>>Hostal</option>
                        </select>
                        <input type="hidden" id="myidhct" name="myidhct" value="<?php echo $idhct;?>" />
                        <br />Hora de entrada <input type="text" id="hhini" name="hhini" value="<?php echo $horain;?>"/>
                        Hora de salida <input type="text" id="hhsal" name="hhsal" value="<?php echo $horaout;?>"/>
                        <a onclick="saveHHoras()" class="button">Guardar Horas</a>
                      <?php } ?>
                    </td>
                  </tr>
                </tbody>
                
                <?php if($tipoproducto=="Hotel"){ ?>
                <tbody>
                  <tr>
                    <td class="left">Habitaciones</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                        <td>Tipo </td>
                        <td>Precio</td>
                        <td>Fecha Inicio</td>
                        <td>Fecha fin</td>
                        <td>Habilitado</td>
                        <td>Acciones</td>
                      </tr>
                      <tr>
                        <td>
                          <select name="habitacion_htl" id="habitacion_htl">
                            <option value="Sencilla">Sencilla</option>
                            <option value="Doble">Doble</option>
                            <option value="Triple">Triple</option>
                            <option value="Cuadruple">Cuadruple</option>
                          </select>
                        </td>
                        <td><input type="text"  name="precio" id="precio" value="" /></td>
                        <td><input type="text" class="date" name="finicio" id="finicio" value="" /></td>
                        <td><input type="text" class="date" name="ffin" id="ffin" value="" /></td>
                        <td><input name="habilitado" id="habilitado" type="checkbox" value="" /></td>
                        <td><a onclick="AgregarHabitacion()" class="button">Agregar Habitacion</a></td>
                      </tr>
                      <?php $ctrltr=1;
                      foreach ($habitaciones as $habitacion) { ?>
                        <tr>
                          <td>
                            <select name="habitacion_htl<?php echo $ctrltr;?>" id="habitacion_htl<?php echo $ctrltr;?>">
                              <option value="Sencilla"<?php echo ($habitacion['tipo']=='Sencilla'?' selected':'')?>>Sencilla</option>
                              <option value="Doble"<?php echo ($habitacion['tipo']=='Doble'?' selected':'')?>>Doble</option>
                              <option value="Triple"<?php echo ($habitacion['tipo']=='Triple'?' selected':'')?>>Triple</option>
                              <option value="Cuadruple"<?php echo ($habitacion['tipo']=='Cuadruple'?' selected':'')?>>Cuadruple</option>
                            </select>
                          </td>
                          <td>
                            <input type="text" name="precio<?php echo $ctrltr;?>" id="precio<?php echo $ctrltr;?>" value="<?php echo $habitacion['precio'];?>" />
                          </td>
                          <td>
                            <input type="text" class="date" name="finicio<?php echo $ctrltr;?>" id="finicio<?php echo $ctrltr;?>" value="<?php echo $habitacion['finicio'];?>" />
                          </td>
                          <td>
                            <input type="text"  class="date" name="ffin<?php echo $ctrltr;?>" id="ffin<?php echo $ctrltr;?>" value="<?php echo $habitacion['ffin'];?>" />
                          </td>
                          <td>
                            <input name="habitacion<?php echo $ctrltr;?>" id="habitacion<?php echo $ctrltr;?>" type="checkbox"  <?php  if($habitacion['habilitado']) echo "checked='checked'";?> />
                          </td>
                          <td>
                            <a onclick="UpdateHabitacion(<?php echo $habitacion['idhabitaciones'].','.$ctrltr?>)" class="button">Actualizar</a>
                            <a onclick="EliminaHabitacion(<?php echo $habitacion['idhabitaciones']?>)" class="button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr>
                      <?php $ctrltr++; } ?>
                    </table></td>
                  </tr>                  
                  <tr>
                  <td class="left">Descuentos por compra anticipada</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                        <td>Dias </td>
                        <td>Porcentaje</td>
                        <td>Fecha Inicio</td>
                        <td>Fecha fin</td>
                        <td>Acciones</td>
                        </tr>
                        <tr>
                        <td><input type="text" name="dias" id="dias" value="" /></td>
                        <td><input type="text" name="porcentaje" id="porcentaje" value="" /></td>
                        <td><input type="text" class="date" name="descfinicio" id="descfinicio" value="" /></td>
                        <td><input type="text"  class="date" name="descffin" id="descffin" value="" /></td>
                        <td><a onclick="AgregarHabDescAnt()" class="button">Agregar Descuento</a></td>
                      </tr>
                      <?php $ctrltr=1;
                      foreach ($habitacionesDescAnt as $habitacionDescAnt) { ?>                      
                        <tr>
                          <td>
                            <input type="text" name="dias<?php echo $ctrltr;?>" id="dias<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['dias'];?>" />
                          </td>
                          <td>
                            <input type="text" name="porcentaje<?php echo $ctrltr;?>" id="porcentaje<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['porcentaje'];?>" />
                          </td>
                          <td>
                            <input type="text" class="date" name="descfinicio<?php echo $ctrltr;?>" id="descfinicio<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['finicio'];?>" />
                          </td>
                          <td>
                            <input type="text"  class="date" name="descffin<?php echo $ctrltr;?>" id="descffin<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['ffin'];?>" />
                          </td>
                          <td>
                            <a onclick="UpdateHabitacionDescAnt(<?php echo $habitacionDescAnt['idHabDescAnt'].','.$ctrltr?>)" class="  button">Actualizar</a>
                            <a onclick="EliminaHabitacionDescAnt(<?php echo $habitacionDescAnt['idHabDescAnt']?>)" class="button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr>
                      <?php $ctrltr++; } ?>
                    </table>
                    </td >
                  </tr>
                  
                  <tr>
                  <td class="left">Descuentos por N&uacute;mero de Noches</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                        <td width="20%">Noches Totales</td>
                        <td>Noches de Descuento</td>
                        <td>Fecha Inicio</td>
                        <td>Fecha fin</td>
                        <td>Acciones</td>
                        </tr>
                        <tr>
                        <td><input type="text" name="nochestotales" id="nochestotales" value="" /></td>
                        <td><input type="text" name="nochesdescuento" id="nochesdescuento" value="" /></td>
                        <td><input type="text" class="date" name="nochesfinicio" id="nochesfinicio" value="" /></td>
                        <td><input type="text"  class="date" name="nochesffin" id="nochesffin" value="" /></td>
                        <td><a onclick="AgregarHabDescNoches(0,'Noches totales')" class="button">Agregar Descuento</a></td>
                      </tr>
                      <?php $ctrltr=1;
                        foreach ($habitacionesDescNoches as $habitacionDescNoches) { ?>                      
                        <tr>
                          <td>
                            <input type="text" name="nochestotales<?php echo $ctrltr;?>" id="nochestotales<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['nochestotales'];?>" />
                          </td>
                          <td>
                            <input type="text" name="nochesdescuento<?php echo $ctrltr;?>" id="nochesdescuento<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['nochesdescuento'];?>" />
                          </td>
                          <td>
                            <input type="text" class="date" name="nochesfinicio<?php echo $ctrltr;?>" id="nochesfinicio<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['finicio'];?>" />
                          </td>
                          <td>
                            <input type="text"  class="date" name="nochesffin<?php echo $ctrltr;?>" id="nochesffin<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['ffin'];?>" />
                          </td>
                          <td>
                            <a onclick="UpdateHabitacionDescNoches(<?php echo $habitacionDescNoches['idhabdescNoches'].','.$ctrltr?>,0,'Noches totales')" class="button">Actualizar</a>
                            <a onclick="EliminaHabitacionDescNoches(<?php echo $habitacionDescNoches['idhabdescNoches'].','.$ctrltr?>)" class="button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr>
                      <?php $ctrltr++; } ?>
                    </table>
                    </td >
                  </tr>
                </tbody>
                <?php }?>

                <?php if($tipoproducto=="Tour"){ ?>
                <tbody>
                  <tr>
                    <td class="left">Ciudades</td> <td class="left"> <table width="100%"  class="list">
                      <tr> <td width="20%">Ciudad de salida</td> <td width="20%">TUA</td> <td>&nbsp;</td> <td>Acciones</td> </tr>
                      <tr> 
                        <td> <input type="text" name="cddsal" id="cddsal" /> </td>
                        <td> <input type="text" name="tuasal" id="tuasal" /> </td> <td></td>
                        <td><a onclick="ciudades()" class="button">Agregar ciudad</a></td>
                      </tr>
                      <tr> <?php $query = $this->db->query("SELECT * FROM circuitos_cddsal  WHERE idprod=".$product_id  );
                          $ctrltr=1;
                          foreach($query->rows as $cdd_salida){ ?>
                            <tr> 
                              <td>
                                <input type="text" name="cddsal<?php echo $ctrltr;?>" id="cddsal<?php echo $ctrltr;?>" value="<?php echo $cdd_salida['ciudad'];?>" />
                              </td> 
                              <td>
                                <input type="text" name="tuasal<?php echo $ctrltr;?>" id="tuasal<?php echo $ctrltr;?>" value="<?php echo $cdd_salida['tua'];?>" />
                              </td> 
                              <td></td>
                              <td class="left">
                                <a onclick="Updateciudadsalida(<?php echo $cdd_salida['idcsal'].','.$ctrltr?>)" class="button">Actualizar</a>
                                <a onclick="Eliminaciudadsalida(<?php echo $cdd_salida['idcsal']?>)" class="button"><?php echo $button_remove; ?></a>
                              </td>
                            </tr> <?php $ctrltr++; } ?>
                      </tr>
                    </table> </td >
                  </tr>
                  <tr> <td class="left">Salidas</td> <td class="left"><table width="100%"  class="list">
                    <tr>
                      <td width="20%">Ciudad de salida</td> <td width="20%">Fechas disponibles desde</td> <td>Fechas disponibles hasta</td> <td>Acciones</td>
                    </tr>
                    <tr>
                      <td><select name="cddsalida" id="cddsalida">
                        <?php $querycdd = $this->db->query("SELECT * FROM circuitos_cddsal WHERE idprod=".$product_id  );
                        if(count($querycdd->rows)==0){ ?>
                          <option value="0"> No hay ciudaddes de salida </option>
                          <?php }else{
                              foreach ($querycdd->rows as $ciudads){ ?>
                                <option value="<?php echo $ciudads['idcsal'];?>"> <?php echo $ciudads['ciudad'];?> </option>
                              <?php }
                            } ?>
                        </select></td>
                      <td><input type="text" class="date" name="fechainiciosalida" id="fechainiciosalida" value="" /></td>
                      <td><input type="text"  class="date" name="fechafinsalida" id="fechafinsalida" value="" /></td>
                      <td><a onclick="salidas()" class="button">Guardar fecha de salida</a></td>
                    </tr> <?php $sentence="SELECT circuitos_salidas.*,circuitos_cddsal.ciudad FROM circuitos_salidas, circuitos_cddsal WHERE circuitos_salidas.idcdd=circuitos_cddsal.idcsal and id_producto=".$product_id;
                        $query = $this->db->query($sentence); $optssalidas=array();
                        $ctrltr=1;
                        foreach($query->rows as $result){
                          $optssalidas[$result['idcircuitos_salidas']]=$result['ciudad'].' '.
                          date('Y-m-d', strtotime($result['finicio'])).' : '.date('Y-m-d', strtotime($result['ffin'])); ?>
                          <tr>
                            <td>
                              <?php if(count($querycdd->rows)>0){ ?>
                                <select name="cddsalida<?php echo $ctrltr;?>" id="cddsalida<?php echo $ctrltr;?>"> <?php
                                foreach ($querycdd->rows as $ciudads){ ?>
                                  <option value="<?php echo $ciudads['idcsal'];?>"<?php echo ($result['ciudad']==$ciudads['ciudad']?' selected':'');?>> <?php echo $ciudads['ciudad'];?> </option>
                                <?php } ?>
                                </select>
                              <?php }else{
                                echo $result['ciudad'];
                              } ?>
                            </td>
                            <td>
                              <input type="text"  class="date" name="fechainiciosalida<?php echo $ctrltr;?>" id="fechainiciosalida<?php echo $ctrltr;?>" value="<?php echo date('Y-m-d', strtotime($result['finicio']));?>" />
                            </td>
                            <td>
                              <input type="text"  class="date" name="fechafinsalida<?php echo $ctrltr;?>" id="fechafinsalida<?php echo $ctrltr;?>" value="<?php echo date('Y-m-d', strtotime($result['ffin']));?>" />
                            </td>
                            <td>
                              <a onclick="Updatesalidas(<?php echo $result['idcircuitos_salidas'].','.$ctrltr?>)" class="button">Actualizar</a>
                              <a onclick="Eliminasalidas(<?php echo $result['idcircuitos_salidas']?>)" class="button"><?php echo $button_remove; ?></a>
                            </td>
                          </tr>
                        <?php $ctrltr++; } ?>
                      </table> </td >
                    </tr>

                  <tr>
                    <td class="left">Agregar precios por persona</td>
                    <td class="left">
                    <table width="100%"  class="list">
                      <tr>
                        <td width="20%">Persona</td> <td>Precio</td> <td>Salida</td> <td>Acciones</td>
                      </tr>
                      <tr>
                        <td>
                          <select name="tourtipo" id="tourtipo"> <option value="Adulta">Adulta</option> <option value="Menor">Menor</option> <option value="INSEN">INSEN</option> </select>
                        </td>
                        <td> <input type="text"  name="tourprecio" id="tourprecio" value="" /></td>
                        <td> <select id="onleaving">
                          <?php if(count($optssalidas)==0){ ?>
                            <option value="0"> No hay salidas registradas </option>
                          <?php }else{ foreach($optssalidas as $k=>$v){ ?>
                            <option value="<?php echo $k;?>"> <?php echo $v;?> </option>
                          <?php }
                          } ?>
                          </select> 
                        </td>
                        <td><a onclick="AgregarTour()" class="button">Agregar Tour</a></td>
                      </tr>
                      <?php if(isset($Tours)){ $ctrltr=1;
                        foreach($Tours as $tour){ ?> <tr>
                          <td>
                            <select name="tourtipo<?php echo $ctrltr;?>" id="tourtipo<?php echo $ctrltr;?>"> 
                              <option value="Adulta"<?php echo ($tour['tipo']=='Adulta'?' selected':'');?>>Adulta</option>
                              <option value="Menor"<?php echo ($tour['tipo']=='Menor'?' selected':'');?>>Menor</option>
                              <option value="INSEN"<?php echo ($tour['tipo']=='INSEN'?' selected':'');?>>INSEN</option>
                            </select>
                          </td> 
                          <td>
                            <input type="text"  name="tourprecio<?php echo $ctrltr;?>" id="tourprecio<?php echo $ctrltr;?>" value="<?php echo $tour['precio'];?>" />
                          </td>
                          <td> 
                            <?php if( isset($optssalidas[$tour['idsal']]) ){ ?>
                              <select id="onleaving<?php echo $ctrltr;?>">
                                <?php if(count($optssalidas)==0){ ?>
                                  No hay salidas registradas <?php 
                                }else{ 
                                  foreach($optssalidas as $k=>$v){ ?>
                                  <option value="<?php echo $k;?>"<?php echo ($optssalidas[$tour['idsal']]==$v?' selected':'');?>> <?php echo $v;?> </option>
                                <?php }
                                } ?>
                              </select> 
                            <?php }else{
                              echo '&iexcl;Salida no encontrada!';
                            }?> 
                          </td>
                          <td>
                            <a onclick="UpdateTours(<?php echo $tour['idtours'].','.$ctrltr;?>)" class="button">Actualizar</a>
                            <a onclick="EliminaTours(<?php echo $tour['idtours']?>)" class="button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr> <?php $ctrltr++; } 
                      } ?>
                    </table>
                    </td>
                  </tr>

                  <tr>
                  <td class="left">Descuentos por compra anticipada</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                          <td width="20%">Dias de anticipacion </td>
                          <td>Porcentaje</td> <td>Fecha Inicio</td> <td>Fecha fin</td> <td>Acciones</td>
                      </tr>
                      <tr>
                        <td><input type="text" name="dias" id="dias" value="" /></td>
                        <td><input type="text" name="porcentaje" style="width:4em;" id="porcentaje" value="" /></td>
                        <td><input type="text" class="date" name="descfinicio" id="descfinicio" value="" /></td>
                        <td><input type="text"  class="date" name="descffin" id="descffin" value="" /></td>
                        <td><a onclick="AgregarHabDescAnt()" class="button">Agregar Descuento</a></td>
                      </tr>
                      <?php $ctrltr=1;
                        foreach ($habitacionesDescAnt as $habitacionDescAnt) { ?>
                        <tr>
                          <td>
                            <input type="text" name="dias<?php echo $ctrltr;?>" id="dias<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['dias'];?>" />
                          </td>
                          <td>
                            <input type="text" name="porcentaje<?php echo $ctrltr;?>" style="width:4em;" id="porcentaje<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['porcentaje'];?>" />
                          </td>
                          <td>
                            <input type="text" class="date" name="descfinicio<?php echo $ctrltr;?>" id="descfinicio<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['finicio'];?>" />
                          </td>
                          <td>
                            <input type="text"  class="date" name="descffin<?php echo $ctrltr;?>" id="descffin<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['ffin'];?>" />
                          </td>
                          <td>
                            <a onclick="UpdateHabitacionDescAnt(<?php echo $habitacionDescAnt['idHabDescAnt'].','.$ctrltr?>)" class="button">Actualizar</a>
                            <a onclick="EliminaHabitacionDescAnt(<?php echo $habitacionDescAnt['idHabDescAnt']?>)" class="button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr>
                      <?php $ctrltr++; } ?>
                    </table>
                    </td >
                  </tr>
                  
                  <tr>
                  <td class="left">Descuentos por N&uacute;mero de Personas</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                        <td width="20%">Personas Totales</td> <td> %Descuento</td> <td>Fecha Inicio</td> <td>Fecha fin</td> <td>Acciones</td>
                      </tr>
                      <tr>
                        <td><input type="text" name="nochestotales" id="nochestotales" value="" /></td>
                        <td><input type="text" name="nochesdescuento" id="nochesdescuento" value="" /></td>
                        <td><input type="text" class="date" name="nochesfinicio" id="nochesfinicio" value="" /></td>
                        <td><input type="text"  class="date" name="nochesffin" id="nochesffin" value="" /></td>
                        <td><a onclick="AgregarHabDescNoches(0,'Personas totales')" class="button">Agregar Descuento</a></td>
                      </tr>
                      <?php $ctrltr=1;
                        foreach ($habitacionesDescNoches as $habitacionDescNoches) { ?>
                        <tr>
                          <td>
                            <input type="text" name="nochestotales<?php echo $ctrltr;?>" id="nochestotales<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['nochestotales'];?>" />
                          </td>
                          <td>
                            <input type="text" name="nochesdescuento<?php echo $ctrltr;?>" id="nochesdescuento<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['nochesdescuento'];?>" />
                          </td>
                          <td>
                            <input type="text" class="date" name="nochesfinicio<?php echo $ctrltr;?>" id="nochesfinicio<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['finicio'];?>" />
                          </td>
                          <td>
                            <input type="text"  class="date" name="nochesffin<?php echo $ctrltr;?>" id="nochesffin<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['ffin'];?>" />
                          </td>
                          <td>
                            <a onclick="UpdateHabitacionDescNoches(<?php echo $habitacionDescNoches['idhabdescNoches'].','.$ctrltr?>,0,'Personas totales')" class="button">Actualizar</a>
                            <a onclick="EliminaHabitacionDescNoches(<?php echo $habitacionDescNoches['idhabdescNoches']?>)" class="button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr>
                      <?php $ctrltr++; } ?>
                    </table>
                    </td >
                  </tr>

                </tbody>
                <?php } ?>

                <?php if($tipoproducto=="Circuito"){ ?>
                <tbody>     
                  <tr>
                    <td class="left">Ciudades</td> <td class="left"> <table width="100%"  class="list">
                      <tr> <td width="20%">Ciudad de salida</td> <td width="20%">TUA</td> <td>&nbsp;</td> <td>Acciones</td> </tr>
                      <tr> <td> <input type="text" name="cddsal" id="cddsal" /> </td>
                          <td> <input type="text" name="tuasal" id="tuasal" /> </td> <td></td>
                           <td><a onclick="ciudades()" class="button">Agregar ciudad</a></td>
                      </tr>
                      <tr> <?php $query = $this->db->query("SELECT * FROM circuitos_cddsal  WHERE idprod=".$product_id  );
                          $ctrltr=1;
                          foreach($query->rows as $cdd_salida){ ?>
                            <tr> 
                            <td>
                              <input type="text" name="cddsal<?php echo $ctrltr;?>" id="cddsal<?php echo $ctrltr;?>" value="<?php echo $cdd_salida['ciudad'];?>" />
                            </td>
                            <td>
                              <input type="text" name="tuasal<?php echo $ctrltr;?>" id="tuasal<?php echo $ctrltr;?>" value="<?php echo $cdd_salida['tua'];?>" />
                            </td> 
                            <td></td>
                            <td class="left">
                              <a onclick="Updateciudadsalida(<?php echo $cdd_salida['idcsal'].','.$ctrltr?>)" class="button">Actualizar</a>
                              <a onclick="Eliminaciudadsalida(<?php echo $cdd_salida['idcsal']?>)" class="button"><?php echo $button_remove; ?></a>
                            </td>
                            </tr> <?php $ctrltr++; } ?>
                      </tr>
                    </table> </td >
                  </tr>

                  <tr> <td class="left">Salidas</td> <td class="left"><table width="100%"  class="list">
                    <tr>
                      <td width="20%">Ciudad de salida</td> <td width="20%">Fechas disponibles desde</td> <td>Fechas disponibles hasta</td> <td>Acciones</td>
                    </tr>
                    <tr>
                      <td><select name="cddsalida" id="cddsalida">
                        <?php $querycs = $this->db->query("SELECT * FROM circuitos_cddsal WHERE idprod=".$product_id  );
                        if(count($querycs->rows)==0){ ?>
                          <option value="0"> No hay ciudaddes de salida </option>
                          <?php }else{
                              foreach($querycs->rows as $ciudads){ ?>
                                <option value="<?php echo $ciudads['idcsal'];?>"> <?php echo $ciudads['ciudad'];?> </option>
                              <?php }
                            }?>
                        </select></td>
                      <td><input type="text" class="date" name="fechainiciosalida" id="fechainiciosalida" value="" /></td>
                      <td><input type="text"  class="date" name="fechafinsalida" id="fechafinsalida" value="" /></td>
                      <td><a onclick="salidas()" class="button">Guardar fecha de salida</a></td>
                    </tr> <?php $sentence="SELECT circuitos_salidas.*,circuitos_cddsal.ciudad FROM circuitos_salidas,circuitos_cddsal WHERE circuitos_salidas.idcdd=circuitos_cddsal.idcsal and id_producto =".$product_id;
                        $ctrltr=1;
                        $query = $this->db->query($sentence); $optssalidas=array();
                        foreach($query->rows as $result){ $optssalidas[$result['idcircuitos_salidas']]=$result['ciudad'].' '.date('Y-m-d', strtotime($result['finicio'])).' : '.date('Y-m-d', strtotime($result['ffin'])); ?>
                          <tr>
                            <td>
                              <?php if(count($querycs->rows)==0){ ?>
                                No hay ciudades registradas
                              <?php }else{ ?>
                                <select name="cddsalida<?php echo $ctrltr;?>" id="cddsalida<?php echo $ctrltr;?>">
                                  <?php foreach($querycs->rows as $ciudads){ ?>
                                    <option value="<?php echo $ciudads['idcsal'];?>"<?php echo ($ciudads['ciudad']==$result['ciudad']?' selected':'');?>> 
                                      <?php echo $ciudads['ciudad'];?> 
                                    </option>
                                  <?php } ?>
                                </select>
                              <?php } ?>
                            </td>
                            <td>
                              <input type="text" class="date" name="fechainiciosalida<?php echo $ctrltr;?>" id="fechainiciosalida<?php echo $ctrltr;?>" value="<?php echo date('Y-m-d', strtotime($result['finicio']));?>" />
                            </td>
                            <td>
                              <input type="text"  class="date" name="fechafinsalida<?php echo $ctrltr;?>" id="fechafinsalida<?php echo $ctrltr;?>" value="<?php echo date('Y-m-d', strtotime($result['ffin']));?>" />
                            </td>
                            <td>
                              <a onclick="Updatesalidas(<?php echo $result['idcircuitos_salidas'].','.$ctrltr?>)" class="button">Actualizar</a>
                              <a onclick="Eliminasalidas(<?php echo $result['idcircuitos_salidas']?>)" class="button"><?php echo $button_remove; ?></a>
                            </td>
                          </tr>
                        <?php $ctrltr++; } ?>
                      </table> </td >
                  </tr>

                  <tr>
                    <td class="left">Agregar habitacion Circuito</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                        <td width="20%">Tipo </td>
                        <td>Categoria</td>
                        <td>Precio</td>
                        <td>Salida</td>
                        <td>Acciones</td>
                      </tr>
                      <tr>
                        <td>
                          <select name="tipocircuito" id="tipocircuito">
                            <option value="Sencilla">Sencilla</option>
                            <option value="Doble">Doble</option>
                            <option value="Triple">Triple</option>
                            <option value="Cuadruple">Cuadruple</option>
                            <option value="Suplemento">Suplemento Menor</option>
                          </select>
                        </td>
                        <td>
                          <select name="circuitocategoria" id="circuitocategoria">
                            <option value="Hostal">Hostal</option>
                            <option value="2">2 estrellas</option>
                            <option value="3">3 estrellas</option>
                            <option value="4">4 estrellas</option>
                            <option value="5">5 estrellas</option>
                            <option value="Especial">Categoria Especial</option>
                           </select>
                        </td>
                        <td><input type="text"  name="circuitoprecio" id="circuitoprecio" value="" /></td>
                        <td> <select id="onleaving">
                          <?php if(count($optssalidas)==0){ ?>
                            <option value="0"> No hay salidas registradas </option>
                          <?php }else{ foreach($optssalidas as $k=>$v){ ?>
                            <option value="<?php echo $k;?>"> <?php echo $v;?> </option>
                          <?php }
                          } ?>
                        </select> </td>
                        <td><a onclick="AgregarCircuito()" class="button">Agregar Circuito</a></td>
                      </tr>
                      <?php $ctrltr=1;
                        foreach($circuitos as $circuito){ ?>
                        <tr>
                          <td>
                            <select name="tipocircuito<?php echo $ctrltr;?>" id="tipocircuito<?php echo $ctrltr;?>">
                              <option value="Sencilla"<?php echo($circuito['tipo']=='Sencilla'?' selected':'');?>>Sencilla</option>
                              <option value="Doble"<?php echo($circuito['tipo']=='Doble'?' selected':'');?>>Doble</option>
                              <option value="Triple"<?php echo($circuito['tipo']=='Triple'?' selected':'');?>>Triple</option>
                              <option value="Cuadruple"<?php echo($circuito['tipo']=='Cuadruple'?' selected':'');?>>Cuadruple</option>
                              <option value="Suplemento<?php echo($circuito['tipo']=='Suplemento'?' selected':'');?>">Suplemento Menor</option>
                            </select>
                          </td>
                          <td>
                            <select name="circuitocategoria<?php echo $ctrltr;?>" id="circuitocategoria<?php echo $ctrltr;?>">
                              <option value="Hostal"<?php echo($circuito['estrellas']=='Hostal'?' selected':'');?>>Hostal</option>
                              <option value="2"<?php echo($circuito['estrellas']=='2'?' selected':'');?>>2 estrellas</option>
                              <option value="3"<?php echo($circuito['estrellas']=='3'?' selected':'');?>>3 estrellas</option>
                              <option value="4"<?php echo($circuito['estrellas']=='4'?' selected':'');?>>4 estrellas</option>
                              <option value="5"<?php echo($circuito['estrellas']=='5'?' selected':'');?>>5 estrellas</option>
                              <option value="Especial"<?php echo($circuito['estrellas']=='Especial'?' selected':'');?>>Categoria Especial</option>
                            </select>
                          </td>
                          <td>
                            <input type="text"  name="circuitoprecio<?php echo $ctrltr;?>" id="circuitoprecio<?php echo $ctrltr;?>" value="<?php echo $circuito['precio'];?>" />
                          </td>
                          <td>
                            <?php if( isset($optssalidas[$circuito['idsal']]) && count($optssalidas)>0){ ?>
                              <select id="onleaving<?php echo $ctrltr;?>">
                                <?php foreach($optssalidas as $k=>$v){ ?>
                                  <option value="<?php echo $k;?>"<?php echo ($v==$optssalidas[$circuito['idsal']]?' selected':'');?>>
                                    <?php echo $v;?>
                                  </option>
                                <?php } ?>
                              </select>
                            <?php }else{ ?>
                              No se encontro el registro
                            <?php } ?>
                          </td>
                          <td>
                            <a onclick="UpdateCircuito(<?php echo $circuito['idcircuitos'].','.$ctrltr?>)" class="button">Actualizar</a>
                            <a onclick="EliminaCircuito(<?php echo $circuito['idcircuitos']?>)" class="button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr>
                      <?php $ctrltr++; } ?>
                    </table></td>
                  </tr>                  
                  <tr>
                  <td class="left">Descuentos por compra anticipada</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                        <td>Dias de anticipacion </td>
                        <td>Porcentaje</td>
                        <td>Fecha Inicio</td>
                        <td>Fecha fin</td>
                        <td>Acciones</td>
                        </tr>
                        <tr>
                        <td><input type="text" style="width:4em;" name="dias" id="dias" value="" /></td>
                        <td><input type="text" style="width:4em;" name="porcentaje" id="porcentaje" value="" /></td>
                        <td><input type="text" class="date" name="descfinicio" id="descfinicio" value="" /></td>
                        <td><input type="text" class="date" name="descffin" id="descffin" value="" /></td>
                        <td><a onclick="AgregarHabDescAnt()" class="button">Agregar Descuento</a></td>
                      </tr>
                      <?php  $ctrltr=1;
                        foreach ($habitacionesDescAnt as $habitacionDescAnt) { ?>                      
                        <tr>
                          <td>
                            <input type="text" style="width:4em;" name="dias<?php echo $ctrltr;?>" id="dias<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['dias'];?>" />
                          </td>
                          <td>
                            <input type="text" style="width:4em;" name="porcentaje<?php echo $ctrltr;?>" id="porcentaje<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['porcentaje'];?>" />
                          </td>
                          <td>
                            <input type="text" class="date" name="descfinicio<?php echo $ctrltr;?>" id="descfinicio<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['finicio'];?>" />
                          </td>
                          <td>
                            <input type="text" class="date" name="descffin<?php echo $ctrltr;?>" id="descffin<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['ffin'];?>" />
                          </td>
                          <td>
                            <a onclick="UpdateHabitacionDescAnt(<?php echo $habitacionDescAnt['idHabDescAnt'].','.$ctrltr?>)" class= "button">Actualizar</a>
                            <a onclick="EliminaHabitacionDescAnt(<?php echo $habitacionDescAnt['idHabDescAnt']?>)" class= "button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr>
                      <?php $ctrltr++; } ?>
                    </table>
                    </td >
                  </tr>
                  
                  <tr>
                  <td class="left">Descuentos por N&uacute;mero de Personas</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                        <td>Minimo personas</td>
                        <td>Max personas</td>
                        <td> %Descuento</td>
                        <td>Fecha Inicio</td>
                        <td>Fecha fin</td>
                        <td>Acciones</td>
                        </tr>
                        <tr>
                        <td><input type="text" style="width:4em" name="minpersonas" id="minpersonas" value="" /></td>
                        <td><input type="text" style="width:4em" name="nochestotales" id="nochestotales" value="" /></td>
                        <td><input type="text" style="width:4em" name="nochesdescuento" id="nochesdescuento" value="" /></td>
                        <td><input type="text" class="date" name="nochesfinicio" id="nochesfinicio" value="" /></td>
                        <td><input type="text" class="date" name="nochesffin" id="nochesffin" value="" /></td>
                        <td><a onclick="AgregarHabDescNoches(1,'Max personas')" class="button">Agregar Descuento</a></td>
                      </tr>
                      <?php $ctrltr=1;
                      foreach ($habitacionesDescNoches as $habitacionDescNoches) { ?>
                        <tr>
                          <td>
                            <input type="text" style="width:4em" name="minpersonas<?php echo $ctrltr;?>" id="minpersonas<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['minper'];?>" />
                          </td>
                          <td>
                            <input type="text" style="width:4em" name="nochestotales<?php echo $ctrltr;?>" id="nochestotales<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['nochestotales'];?>" />
                          </td>
                          <td>
                            <input type="text" style="width:4em" name="nochesdescuento<?php echo $ctrltr;?>" id="nochesdescuento<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['nochesdescuento'];?>" />
                          </td>
                          <td>
                            <input type="text" class="date" name="nochesfinicio<?php echo $ctrltr;?>" id="nochesfinicio<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['finicio'];?>" />
                          </td>
                          <td>
                            <input type="text"  class="date" name="nochesffin<?php echo $ctrltr;?>" id="nochesffin<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['ffin'];?>" />                            
                          </td>
                          <td>
                            <a onclick="UpdateHabitacionDescNoches(<?php echo $habitacionDescNoches['idhabdescNoches'].','.$ctrltr?>,1,'Max personas')" class="button">Actualizar</a>
                            <a onclick="EliminaHabitacionDescNoches(<?php echo $habitacionDescNoches['idhabdescNoches']?>)" class="button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr>
                      <?php $ctrltr++; } ?>
                    </table>
                    </td >
                  </tr>

                  <tr>
                  <td class="left">Hoteles</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                        <td>Hotel</td>
                        <td>Ciudad</td>
                        <td># de noches</td>
                        <td>Acciones</td>
                        </tr>
                        <tr>
                        <td> <?php
                          $queryhtl=$this->db->query("SELECT oc_product.product_id,name FROM oc_product_description,oc_product WHERE oc_product_description.product_id=oc_product.product_id and tipoproducto='Hotel'");
                          if(count($queryhtl->rows)>0){ ?> 
                            <select name="hotel" id="hotel"> <?php
                            foreach($queryhtl->rows as $hotelespro){ ?>
                              <option value="<?php echo $hotelespro['product_id']?>">
                                <?php echo $hotelespro['name']?>
                              </option>
                            <?php } ?>
                            </select> <?php
                          }else{ ?>
                             No ha registrado hoteles.
                          <?php } ?>
                        </td>
                        <td><input type="text" name="ciudad" id="ciudad" value="" /></td>
                        <td><input type="text" name="nocheshotelciudad" id="nocheshotelciudad" value="" /></td>
                        <td><a onclick="hotelescircuito()" class="button">Agregar hotel</a></td>
                      </tr>
                      <?php
                      $query = $this->db->query("SELECT circuitos_hoteles.*,name FROM circuitos_hoteles,oc_product_description WHERE oc_product_description.product_id=circuitos_hoteles.hotel and id_producto=".$product_id  );
                      $ctrltr=1;
                      foreach ($query->rows as $hotelescircuito) { ?>
                        <tr>
                          <td>
                            <?php if(count($queryhtl->rows)>0){ ?> 
                              <select name="hotel<?php echo $ctrltr;?>" id="hotel<?php echo $ctrltr;?>"> <?php
                                foreach($queryhtl->rows as $hotelespro){ ?>
                                  <option value="<?php echo $hotelespro['product_id']?>"<?php echo ($hotelespro['name']==$hotelescircuito['name']?' selected':'');?>>
                                    <?php echo $hotelespro['name']?>
                                  </option>
                                <?php } ?>
                              </select>
                            <?php } ?>
                          </td>
                          <td>
                            <input type="text" name="ciudad<?php echo $ctrltr;?>" id="ciudad<?php echo $ctrltr;?>" value="<?php echo $hotelescircuito['ciudad'];?>" />
                          </td>
                          <td>
                            <input type="text" name="nocheshotelciudad<?php echo $ctrltr;?>" id="nocheshotelciudad<?php echo $ctrltr;?>" value="<?php echo $hotelescircuito['noches'];?>" />
                          </td>
                          <td>
                            <a onclick="Updatehotelescircuito(<?php echo $hotelescircuito['idcircuitos_hoteles'].','.$ctrltr?>)" class="button">Actualizar</a>
                            <a onclick="Eliminahotelescircuito(<?php echo $hotelescircuito['idcircuitos_hoteles']?>)" class="button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr>
                      <?php $ctrltr++; } ?>
                    </table>
                    </td >
                  </tr>
                </tbody>
                <?php }?>
                
                <?php if($tipoproducto=="Traslado"){ ?>
                <tbody>     
                  <tr> <?php
                    $query=$this->db->query("SELECT * FROM traslados WHERE id_producto=".$product_id);
                    if($query && isset($query->rows[0])){ $traslado=$query->rows[0]; }
                    else{ $traslado=null; } ?>
                    <td class="left">Datos del traslado</td> <td class="left">
                    <table width="100%"  class="list">
                      <tr>
                        <td width="20%">Origen del traslado</td> <td width="20%">Destino del traslado</td> <td>&nbsp;</td> <td>Acciones</td>
                      </tr>
                      <tr> <td> <input type="text" name="origtras" id="origtras" value="<?php echo ($traslado!=null?$traslado['origen']:'')?>"/> </td>
                          <td> <input type="text" name="destras" id="destras" value="<?php echo ($traslado!=null?$traslado['destino']:'')?>"/> </td> <td></td>
                           <td rowspan="5"><a onclick="traslados()" class="button">Guardar</a></td>
                      </tr>
                      <tr>
                        <td width="20%">Persona</td> <td width="20%">Costo</td> <td></td>
                      </tr>
                      <tr> <td>Adulto</td>
                        <td><input type="text" name="trascstadlt" id="trascstadlt" value="<?php echo ($traslado!=null?$traslado['pre_adult']:'')?>"/></td> <td></td>
                      </tr>
                      <tr> <td>Infante</td>
                        <td><input type="text" name="trascstinft" id="trascstinft" value="<?php echo ($traslado!=null?$traslado['pre_inft']:'')?>"/></td> <td></td>
                      </tr>
                      <tr> <td>Insen</td>
                        <td><input type="text" name="trascstinsn" id="trascstinsn" value="<?php echo ($traslado!=null?$traslado['pre_insen']:'')?>"/></td>
                        <td> <?php echo ($traslado!=null?'<input type="hidden" name="idtras" id="idtras" value="'.$traslado['idtraslados'].'"/>':'')?> </td>
                      </tr>
                    </table>
                    </td >
                  </tr>

                  <tr>
                    <td class="left">Horarios de salidas</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                        <td>Fecha</td>
                        <td>En hora</td>
                        <td>Personas minimo</td>
                        <td>Personas maximo</td>
                        <td>Via</td>
                        <td>Acciones</td>
                      </tr>
                      <tr>
                        <td> <input type="text" class="date" name="ftrassale" id="ftrassale" value="" /> </td>
                        <td> <input type="text" name="htrassale" id="htrassale" value="" /> </td>
                        <td> <input type="text" style="width:4em;" name="trasminpers" id="trasminpers" value="" /> </td>
                        <td> <input type="text" style="width:4em;" name="trasmaxpers" id="trasmaxpers" value="" /> </td>
                        <td> 
                          <select name="trassalevia" id="trassalevia">
                            <option value="Aerea">Aerea </option>
                            <option value="Terrestre">Terrestre </option>
                            <option value="Maritima">Maritima </option>
                          </select>
                        </td>
                        <td><a onclick="AgregarFTrasl()" class="button">Agregar fecha</a></td>
                      </tr>
                      <?php 
                      $query=$this->db->query("SELECT * FROM traslados_salidas WHERE id_producto=".$product_id  );
                      $ctrltr=1;
                      foreach($query->rows as $htras){ ?>
                      <tr>
                        <td> 
                          <input type="text" class="date" name="ftrassale<?php echo $ctrltr;?>" id="ftrassale<?php echo $ctrltr;?>" value="<?php echo $htras['fecha']?>" />  
                        </td> 
                        <td> 
                          <input type="text" name="htrassale<?php echo $ctrltr;?>" id="htrassale<?php echo $ctrltr;?>" value="<?php echo $htras['hora']?> " />
                        </td>
                        <td> 
                          <input type="text" style="width:4em;" name="trasminpers<?php echo $ctrltr;?>" id="trasminpers<?php echo $ctrltr;?>" value="<?php echo $htras['minper']?>" /> 
                        </td> 
                        <td> 
                          <input type="text" style="width:4em;" name="trasmaxpers<?php echo $ctrltr;?>" id="trasmaxpers<?php echo $ctrltr;?>" value="<?php echo $htras['maxper']?>" />
                        </td>
                        <td> 
                          <select name="trassalevia<?php echo $ctrltr;?>" id="trassalevia<?php echo $ctrltr;?>">
                            <option value="Aerea"<?php echo ($htras['via']=="Aerea"?" selected":"");?>>Aerea </option>
                            <option value="Terrestre"<?php echo ($htras['via']=="Terrestre"?" selected":"");?>>Terrestre </option>
                            <option value="Maritima"<?php echo ($htras['via']=="Maritima"?" selected":"");?>>Maritima </option>
                          </select>
                        </td>
                        <td class="left">
                          <a onclick="UpdateTrasFH(<?php echo $htras['idtraslados_salidas'].','.$ctrltr?>)" class="button">Actualizar</a>
                          <a onclick="EliminaTrasFH(<?php echo $htras['idtraslados_salidas']?>)" class="button">
                            <?php echo $button_remove; ?>
                          </a>
                        </td>
                      </tr> <?php $ctrltr++; } ?>
                    </table></td>
                  </tr>
                  
                  <tr>
                  <td class="left">Descuentos por compra anticipada</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                        <td>Dias de anticipacion</td>
                        <td>Porcentaje</td>
                        <td>Fecha Inicio</td>
                        <td>Fecha fin</td>
                        <td>Acciones</td>
                        </tr>
                        <tr>
                        <td><input type="text" style="width:4em;" name="dias" id="dias" value="" /></td>
                        <td><input type="text" style="width:4em;" name="porcentaje" id="porcentaje" value="" /></td>
                        <td><input type="text" class="date" name="descfinicio" id="descfinicio" value="" /></td>
                        <td><input type="text" class="date" name="descffin" id="descffin" value="" /></td>
                        <td><a onclick="AgregarHabDescAnt()" class="button">Agregar Descuento</a></td>
                      </tr>
                      <?php $ctrltr=1;
                      foreach ($habitacionesDescAnt as $habitacionDescAnt) { ?>
                        <tr>
                          <td>
                            <input type="text" style="width:4em;" name="dias<?php echo $ctrltr;?>" id="dias<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['dias'];?>" />
                          </td>
                          <td>
                            <input type="text" style="width:4em;" name="porcentaje<?php echo $ctrltr;?>" id="porcentaje<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['porcentaje'];?>" />
                          </td>
                          <td>
                            <input type="text" class="date" name="descfinicio<?php echo $ctrltr;?>" id="descfinicio<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['finicio'];?>" />                            
                          </td>
                          <td>
                            <input type="text"  class="date" name="descffin<?php echo $ctrltr;?>" id="descffin<?php echo $ctrltr;?>" value="<?php echo $habitacionDescAnt['ffin'];?>" />
                          </td>
                          <td>
                            <a onclick="UpdateHabitacionDescAnt(<?php echo $habitacionDescAnt['idHabDescAnt'].','.$ctrltr?>)" class="button">Actualizar</a>
                            <a onclick="EliminaHabitacionDescAnt(<?php echo $habitacionDescAnt['idHabDescAnt']?>)" class="button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr>
                      <?php $ctrltr++; } ?>
                    </table>
                    </td >
                  </tr>
                  
                  <tr>
                  <td class="left">Descuentos por N&uacute;mero de Personas</td>
                    <td class="left"><table width="100%"  class="list">
                      <tr>
                        <td>Minimo personas</td>
                         <td>Max personas</td>
                        <td> %Descuento</td>
                        <td>Fecha Inicio</td>
                        <td>Fecha fin</td>
                        <td>Acciones</td>
                        </tr>
                        <tr>
                        <td><input type="text" style="width:4em;" name="minpersonas" id="minpersonas" value="" /></td>
                        <td><input type="text" style="width:4em;" name="nochestotales" id="nochestotales" value="" /></td>
                        <td><input type="text" style="width:4em;" name="nochesdescuento" id="nochesdescuento" value="" /></td>
                        <td><input type="text" class="date" name="nochesfinicio" id="nochesfinicio" value="" /></td>
                        <td><input type="text"  class="date" name="nochesffin" id="nochesffin" value="" /></td>
                        <td><a onclick="AgregarHabDescNoches(1,'Max personas')" class="button">Agregar Descuento</a></td>
                      </tr>
                      <?php $ctrltr=1;
                      foreach ($habitacionesDescNoches as $habitacionDescNoches) { ?>
                        <tr>
                          <td>
                            <input type="text" style="width:4em;" name="minpersonas<?php echo $ctrltr;?>" id="minpersonas<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['minper'];?>" />
                          </td>
                          <td>
                            <input type="text" style="width:4em;" name="nochestotales<?php echo $ctrltr;?>" id="nochestotales<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['nochestotales'];?>" />
                          </td>
                          <td>
                            <input type="text" style="width:4em;" name="nochesdescuento<?php echo $ctrltr;?>" id="nochesdescuento<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['nochesdescuento'];?>" />
                          </td>
                          <td>
                            <input type="text" class="date" name="nochesfinicio<?php echo $ctrltr;?>" id="nochesfinicio<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['finicio'];?>" />
                          </td>
                          <td>
                            <input type="text"  class="date" name="nochesffin<?php echo $ctrltr;?>" id="nochesffin<?php echo $ctrltr;?>" value="<?php echo $habitacionDescNoches['ffin'];?>" />
                          </td>
                          <td>
                            <a onclick="UpdateHabitacionDescNoches(<?php echo $habitacionDescNoches['idhabdescNoches'].','.$ctrltr?>,1,'Max personas')" class="button">Actualizar</a>
                            <a onclick="EliminaHabitacionDescNoches(<?php echo $habitacionDescNoches['idhabdescNoches']?>)" class="button"><?php echo $button_remove; ?></a>
                          </td>
                        </tr>
                      <?php $ctrltr++; }?>
                    </table>
                    </td >
                  </tr>
                </tbody>
                <?php }?>

              </table></td>
            </tr>
          </tbody>
          </table>
        </div>
        
        <div id="tab-increcoms">
          <?php if($tipoproducto=="Hotel"){
            $query = $this->db->query("SELECT * FROM hoteles_servs WHERE id_producto=".$product_id);
          }else{
            $query = $this->db->query("SELECT * FROM circuitos_incnoinc WHERE id_producto=".$product_id);
          } ?>
          <table class="form">
            <?php if($tipoproducto=="Hotel"){ ?>
              <tr>
                <td>Servicios
                  <input type="hidden" name="idthsprod" value="<?php echo ($query && count($query->rows)>0?$query->rows[0]['idhsr']:'0'); ?>">
                  <input type="hidden" name="idthstheprod" value="<?php echo $product_id; ?>">
                </td>
                <td><textarea name="hservicios" id="hservicios">
                  <?php if($query && count($query->rows)>0){ echo $query->rows[0]['servicios']; }; ?>
                </textarea></td>
              </tr>
            <?php }else{ ?>
              <tr>
                <td>Incluye/No Incluye
                  <input type="hidden" name="idincnoinc" value="<?php echo ($query && count($query->rows)>0?$query->rows[0]['idino']:'0'); ?>">
                  <input type="hidden" name="idthsprod" value="<?php echo $product_id; ?>">
                </td>
                <td><textarea name="incnoinc" id="incnoinc">
                  <?php if($query && count($query->rows)>0){ echo $query->rows[0]['incnoinc']; }; ?>
                </textarea></td>
              </tr>
              <tr>
                <td>Recomendaciones</td>
                <td><textarea name="recomens" id="recomens">
                  <?php if($query && count($query->rows)>0){ echo $query->rows[0]['recomens']; }; ?>
                </textarea></td>
              </tr>
            <?php } ?>
          </table>
        </div>





      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../adds/validate.js"></script>
<script type="text/javascript"><!--
<?php foreach ($languages as $language){ ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } if($tipoproducto=="Hotel"){ ?>
  CKEDITOR.replace('hservicios', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
  });
<?php }else{ ?>
  CKEDITOR.replace('incnoinc', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
  });
  CKEDITOR.replace('recomens', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
  });
<?php } ?>
//--></script>
<script type="text/javascript"><!--

function Eliminasalidas(id){
  $.ajax({
			url: 'index.php?route=catalog/product/Eliminasalidas&token=<?php echo $token; ?>&id='+id,
			dataType: 'json',
			success: function(json) {
					 alert(json['success']);
					location.reload();

			}
		});
}

function salidas(){
	var cddsalida=$('#cddsalida option:selected').val();
	var fechainiciosalida=$('#fechainiciosalida').val();
	var fechafinsalida=$('#fechafinsalida').val();
  var product_id=<?php
  if (isset($this->request->get['product_id'])) {
    echo $this->request->get['product_id'];
  } else { echo  0; } ?>;
  var data2vl=new Array();
  data2vl[0]=[2,fechainiciosalida,"Fecha desde"];
  data2vl[1]=[2,fechafinsalida,"Fecha hasta"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
          url: 'index.php?route=catalog/product/salidas&token=<?php echo $token; ?>&cddsalida='+cddsalida+'&fechainiciosalida='+fechainiciosalida+'&fechafinsalida='+fechafinsalida +'&product_id='+product_id,
          dataType: 'json',
          success: function(json) {
            alert(json['success']);
            location.reload();
          }
  });
} 

function Updatesalidas(id,tr){
  var cddsalida=$('#cddsalida'+tr+' option:selected').val();
  var fechainiciosalida=$('#fechainiciosalida'+tr).val();
  var fechafinsalida=$('#fechafinsalida'+tr).val();
  var data2vl=new Array();
  data2vl[0]=[2,fechainiciosalida,"Fecha desde"];
  data2vl[1]=[2,fechafinsalida,"Fecha hasta"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
          url: 'index.php?route=catalog/product/updatesalidas&token=<?php echo $token; ?>&cddsalida='+cddsalida+'&fechainiciosalida='+fechainiciosalida+'&fechafinsalida='+fechafinsalida +'&idc='+id,
          dataType: 'json',
          success: function(json) {
            alert(json['success']);
          }
  });
} 

function ciudades(){
  var tua=$('#tuasal').val();
  var ciudad=$('#cddsal').val();
  var product_id=<?php
  if (isset($this->request->get['product_id'])) {
    echo $this->request->get['product_id'];
  } else { echo  0; } ?>;
  var data2vl=new Array();
  data2vl[0]=[2,ciudad,"Ciudad"];
  data2vl[1]=[3,tua,"TUA"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/ciudades&token=<?php echo $token; ?>&idprod='+product_id+'&cddsal='+ciudad+'&tua='+tua,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });
}

function Updateciudadsalida(id,tr){
  var tua=$('#tuasal'+tr).val();
  var ciudad=$('#cddsal'+tr).val();
  var data2vl=new Array();
  data2vl[0]=[2,ciudad,"Ciudad"];
  data2vl[1]=[3,tua,"TUA"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/updateCiudades&token=<?php echo $token; ?>&cddsal='+ciudad+'&tua='+tua+'&idc='+id,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });  
}

function Eliminahotelescircuito(id){
  $.ajax({
			url: 'index.php?route=catalog/product/Eliminahotelescircuito&token=<?php echo $token; ?>&id='+id,
			dataType: 'json',
			success: function(json) {						
					 alert(json['success']);				
					location.reload();
				
			}
		});	
}
function hotelescircuito(){
  var nocheshotelciudad=$('#nocheshotelciudad').val();
  var hotel=$('#hotel').val();
  var ciudad=$('#ciudad').val();
  var product_id=<?php 
  if (isset($this->request->get['product_id'])) {
		echo $this->request->get['product_id'];
	} else { echo  0; } ?>;
  var data2vl=new Array();
  data2vl[0]=[2,ciudad,"Ciudad"];
  data2vl[1]=[1,nocheshotelciudad,"Numero de noches"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
			url: 'index.php?route=catalog/product/hotelescircuito&token=<?php echo $token; ?>&nocheshotelciudad='+nocheshotelciudad+'&hotel='+hotel+'&ciudad='+ciudad +'&idh='+id,
			dataType: 'json',
			success: function(json) {		
						alert(json['success']);
						 location.reload();
			}
	});
}
function Updatehotelescircuito(id,tr){
  var nocheshotelciudad=$('#nocheshotelciudad'+tr).val();
  var hotel=$('#hotel'+tr).val();
  var ciudad=$('#ciudad'+tr).val();
  var data2vl=new Array();
  data2vl[0]=[2,ciudad,"Ciudad"];
  data2vl[1]=[1,nocheshotelciudad,"Numero de noches"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
      url: 'index.php?route=catalog/product/updatehotelescircuito&token=<?php echo $token; ?>&nocheshotelciudad='+nocheshotelciudad+'&hotel='+hotel+'&ciudad='+ciudad +'&idhc='+id,
      dataType: 'json',
      success: function(json) {   
        alert(json['success']);
      }
  });
}

//inicio de hoteles
//inicio de hoteles
//inicio de hoteles
//inicio de hoteles
//inicio de hoteles
function EliminaHabitacion(id){
	$.ajax({
			url: 'index.php?route=catalog/product/eliminahabitacion&token=<?php echo $token; ?>&idhabitacion='+id,
			dataType: 'json',
			success: function(json) {
					 alert(json['success']);
					location.reload();
			}
		});
}

function Eliminaciudadsalida(id){	
  $.ajax({
    url: 'index.php?route=catalog/product/eliminaciudadsal&token=<?php echo $token; ?>&idcsal='+id,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });
}

function EliminaHabitacionDescAnt(id)
{
	$.ajax({
			url: 'index.php?route=catalog/product/EliminaHabitacionDescAnt&token=<?php echo $token; ?>&id='+id,
			dataType: 'json',
			success: function(json) {						
					 alert(json['success']);				
					location.reload();
				
			}
		});	
}
function EliminaHabitacionDescNoches(id){
	$.ajax({
			url: 'index.php?route=catalog/product/EliminaHabitacionDescNoches&token=<?php echo $token; ?>&id='+id,
			dataType: 'json',
			success: function(json) {						
					 alert(json['success']);				
					location.reload();
				
			}
		});	
}
function AgregarHabDescNoches(minp,nomNochTot){
  var nochestotales=$('#nochestotales').val();
  var nochesdescuento=$('#nochesdescuento').val();
  var ffin=$('#nochesffin').val();
  var finicio=$('#nochesfinicio').val();
  var minpersonas=$('#minpersonas').val();
  var product_id=<?php
  if (isset($this->request->get['product_id'])) {
    echo $this->request->get['product_id'];
  } else { echo  0; } ?>;
  var data2vl=new Array();
  data2vl[0]=[1,nochesdescuento,"Descuento"];
  data2vl[1]=[2,finicio,"Fecha inicio"];
  data2vl[2]=[2,ffin,"Fecha fin"];
  data2vl[3]=[1,nochestotales,nomNochTot];
  if(minp){
    data2vl[4]=[1,minpersonas,"Minimo personas"];
  }
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/AgregarHabDescNoches&token=<?php echo $token; ?>&nochestotales='+nochestotales+'&nochesdescuento='+nochesdescuento+'&ffin='+ffin+'&finicio='+finicio+'&product_id='+product_id+'&minper='+minpersonas,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });
}
function UpdateHabitacionDescNoches(id,tr,useminp,msjmax){
  var nochestotales=$('#nochestotales'+tr).val();
  var nochesdescuento=$('#nochesdescuento'+tr).val();
  var ffin=$('#nochesffin'+tr).val();
  var finicio=$('#nochesfinicio'+tr).val();
  if(useminp){
    var minpersonas=$('#minpersonas'+tr).val();
  }
  var data2vl=new Array();
  data2vl[0]=[1,nochesdescuento,"Descuento"];
  data2vl[1]=[2,finicio,"Fecha inicio"];
  data2vl[2]=[2,ffin,"Fecha fin"];
  data2vl[3]=[1,nochestotales,msjmax];
  if(useminp){
    data2vl[4]=[1,minpersonas,"Minimo personas"];
  }
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/UpdateHabDescNoches&token=<?php echo $token; ?>&nochestotales='+nochestotales+'&nochesdescuento='+nochesdescuento+'&ffin='+ffin+'&finicio='+finicio+'&minper='+minpersonas+'&idh='+id,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
    }
  });
}

function AgregarHabDescAnt(){
  var dias=$('#dias').val();
  var porcentaje=$('#porcentaje').val();
  var ffin=$('#descffin').val();
  var finicio=$('#descfinicio').val();
  var product_id=<?php
  if (isset($this->request->get['product_id'])) {
    echo $this->request->get['product_id'];
  }else{ echo  0; } ?>;
  var data2vl=new Array();
  data2vl[0]=[1,dias,"Dias anticipacion"];
  data2vl[1]=[1,porcentaje,"Porcentaje"];
  data2vl[2]=[2,finicio,"Fecha inicio"];
  data2vl[3]=[2,ffin,"Fecha fin"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/AgregarHabDescAnt&token=<?php echo $token; ?>&dias='+dias+'&porcentaje='+porcentaje+'&ffin='+ffin+'&finicio='+finicio+'&product_id='+product_id,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });
}

function UpdateHabitacionDescAnt(id,tr){
  var dias=$('#dias'+tr).val();
  var prc=$('#porcentaje'+tr).val();
  var ffin=$('#descffin'+tr).val();
  var fini=$('#descfinicio'+tr).val();
  var data2vl=new Array();
  data2vl[0]=[1,dias,"Dias anticipacion"];
  data2vl[1]=[1,prc,"Porcentaje"];
  data2vl[2]=[2,fini,"Fecha inicio"];
  data2vl[3]=[2,ffin,"Fecha fin"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/UpdateHabDescAnt&token=<?php echo $token; ?>&dias='+dias+'&porcentaje='+prc+'&ffin='+ffin+'&finicio='+fini+'&idh='+id,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
    }
  });
}

function AgregarHabitacion() {
  var tipo=$('#habitacion_htl option:selected').val();
  var precio=$('#precio').val();
  var ffin=$('#ffin').val();
  var finicio=$('#finicio').val();
  var habilitado=$('#habilitado').is(':checked');
  var product_id=<?php
  if (isset($this->request->get['product_id'])) {
    echo $this->request->get['product_id'];
  }else{ echo  0; } ?>;
  var data2vl=new Array();
  data2vl[0]=[3,precio,"Precio"];
  data2vl[1]=[2,finicio,"Fecha Inicio"];
  data2vl[2]=[2,ffin,"Fecha fin"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/gusrdahabitacion&token=<?php echo $token; ?>&tipo='+tipo+'&precio='+precio+'&ffin='+ffin+'&finicio='+finicio+'&habilitado='+habilitado+'&product_id='+product_id,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });
}
function UpdateHabitacion(id,tr) {
  var tipo=$('#habitacion_htl'+tr+' option:selected').val();
  var precio=$('#precio'+tr).val();
  var ffin=$('#ffin'+tr).val();
  var finicio=$('#finicio'+tr).val();
  var habilitado=$('#habilitado'+tr).is(':checked');
  var data2vl=new Array();
  data2vl[0]=[3,precio,"Precio"];
  data2vl[1]=[2,finicio,"Fecha Inicio"];
  data2vl[2]=[2,ffin,"Fecha fin"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/updatehabitacion&token=<?php echo $token; ?>&tipo='+tipo+'&precio='+precio+'&ffin='+ffin+'&finicio='+finicio+'&habilitado='+habilitado+'&idh='+id,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
    }
  });
}
function saveHHoras(){
  var h1=$('#hhini').val();
  var h2=$('#hhsal').val();
  var dhct=$('#myidhct').val();
  var product_id=<?php
  if (isset($this->request->get['product_id'])) {
      echo $this->request->get['product_id'];
  }else{ echo  0; } ?>;
  var data2vl=new Array();
  data2vl[0]=[2,h1,"Hora entrada"];
  data2vl[0]=[2,h2,"Hora salida"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/saveHHors&token=<?php echo $token; ?>&hhini='+h1+'&hhsal='+h2+'&idhct='+dhct+'&idp='+product_id,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });
}
//fin de hoteles

//inicio de Tours
function AgregarTour(){
  var tipo=$('#tourtipo').val();
  var precio=$('#tourprecio').val();
  var onlve=$('#onleaving').val();
  var product_id=<?php echo (isset($this->request->get['product_id'])?$this->request->get['product_id']:0); ?>;
  if(onlve==0){ alert('Salida invalida'); return; }
  var data2vl=new Array();
  data2vl[0]=[3,precio,"Precio"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/AgregarTour&token=<?php echo $token; ?>&tipo='+tipo+'&precio='+precio+'&product_id='+product_id+'&leaving='+onlve,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });
}

function UpdateTours(id,tr){
  var tipo=$('#tourtipo'+tr).val();
  var precio=$('#tourprecio'+tr).val();
  var onlve=$('#onleaving'+tr).val();
  var data2vl=new Array();
  data2vl[0]=[3,precio,"Precio"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/UpdateTour&token=<?php echo $token; ?>&tipo='+tipo+'&precio='+precio+'&idt='+id+'&leaving='+onlve,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
    }
  });
}

function EliminaTours(id){
	$.ajax({
			url: 'index.php?route=catalog/product/EliminaTours&token=<?php echo $token; ?>&id='+id,
			dataType: 'json',
			success: function(json) {						
					 alert(json['success']);				
					location.reload();
				
			}
		});	
}


//fin de Tours
//fin de Tours
//fin de Tours
//fin de Tours
//fin de Tours

//inicio de Circuitos
//inicio de Circuitos
//inicio de Circuitos
//inicio de Circuitos


function AgregarCircuito(){
  var tipo=$('#tipocircuito').val();
  var categoria=$('#circuitocategoria option:selected').val();
  var precio=$('#circuitoprecio').val();
  var onlve=$('#onleaving').val();
  var product_id=<?php
  if (isset($this->request->get['product_id'])) {
    echo $this->request->get['product_id'];
  }else { echo  0; } ?>;
  if(onlve==0){
    alert('Salida invalida');
    return;
  }
  var data2vl=new Array();
  data2vl[0]=[3,precio,"Precio"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/AgregarCircuito&token=<?php echo $token; ?>&tipo='+tipo+'&categoria='+categoria+'&precio='+precio+'&product_id='+product_id+'&leaving='+onlve,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });
}

function UpdateCircuito(id,tr){
  var tipo=$('#tipocircuito'+tr).val();
  var categoria=$('#circuitocategoria'+tr+' option:selected').val();
  var precio=$('#circuitoprecio'+tr).val();
  var onlve=$('#onleaving'+tr).val();
  var data2vl=new Array();
  data2vl[0]=[3,precio,"Precio"];
  data2vl[1]=[1,onlve,"Salida"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/UpdateCircuito&token=<?php echo $token; ?>&tipo='+tipo+'&categoria='+categoria+'&precio='+precio+'&idc='+id+'&leaving='+onlve,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
    }
  });
}

function EliminaCircuito(id)
{
	$.ajax({
			url: 'index.php?route=catalog/product/EliminaCircuito&token=<?php echo $token; ?>&id='+id,
			dataType: 'json',
			success: function(json) {						
					 alert(json['success']);				
					location.reload();
				
			}
		});	
}

//fin de circuitos
//fin de circuitos
//fin de circuitos
//fin de circuitos

//inicio de traslados
function traslados(){
  var org=$('#origtras').val();
  var dst=$('#destras').val();
  var cadlt=$('#trascstadlt').val();
  var cinft=$('#trascstinft').val();
  var cinsn=$('#trascstinsn').val();
  var cinsn=$('#trascstinsn').val();
  var idtras=$('#idtras').val();
  var product_id=<?php
    if (isset($this->request->get['product_id'])) {
      echo $this->request->get['product_id'];
    }else{ echo  0; } ?>;
  var data2vl=new Array();
  data2vl[0]=[2,org,"Origen"];
  data2vl[1]=[2,dst,"Destino"];
  data2vl[2]=[3,cadlt,"Costo adulto"];
  data2vl[3]=[3,cinft,"Costo infante"];
  data2vl[4]=[3,cinsn,"Costo insen"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url:'index.php?route=catalog/product/saveTraslds&token=<?php echo $token; ?>&org='+org+'&dst='+dst+'&cadlt='+cadlt+'&cinft='+cinft+'&cinsn='+cinsn+'&product_id='+product_id+'&idtras='+idtras,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });
}       
function AgregarFTrasl(){
  var fcha=$('#ftrassale').val();
  var hora=$('#htrassale').val();
  var pmin=$('#trasminpers').val();
  var pmax=$('#trasmaxpers').val();
  var via=$('#trassalevia').val();
  var product_id=<?php
    if (isset($this->request->get['product_id'])) {
      echo $this->request->get['product_id'];
    }else{ echo  0; } ?>;
  var data2vl=new Array();
  data2vl[0]=[2,fcha,"Fecha"];
  data2vl[1]=[2,hora,"Hora"];
  data2vl[2]=[1,pmin,"Personas minimo"];
  data2vl[3]=[1,pmax,"Personas maximo"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url:'index.php?route=catalog/product/saveFTraslds&token=<?php echo $token; ?>&fcha='+fcha+'&hora='+hora+'&pmin='+pmin+'&pmax='+pmax+'&via='+via+'&product_id='+product_id,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });
}
function EliminaTrasFH(id){
  $.ajax({
    url: 'index.php?route=catalog/product/EliminatrasFH&token=<?php echo $token; ?>&idfhtras='+id,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
      location.reload();
    }
  });
}

function UpdateTrasFH(id,tr_id){
  var fc=$('#ftrassale'+tr_id).val();
  var hr=$('#htrassale'+tr_id).val();
  var mnp=$('#trasminpers'+tr_id).val();
  var mxp=$('#trasmaxpers'+tr_id).val();
  var trs=$('#trassalevia'+tr_id).val();
  var data2vl=new Array();
  data2vl[0]=[2,fc,"Fecha"];
  data2vl[1]=[2,hr,"Hora"];
  data2vl[2]=[1,mnp,"Personas minimo"];
  data2vl[3]=[1,mxp,"Personas maximo"];
  if( !validateFields(data2vl) ){ return; }
  $.ajax({
    url: 'index.php?route=catalog/product/UpdatetrasFH&token=<?php echo $token; ?>&idfhtras='+id+'&fcha='+fc+'&hr='+hr+'&mnp='+mnp+'&mxp='+mxp+'&trs='+trs,
    dataType: 'json',
    success: function(json) {
      alert(json['success']);
    },error: function(e){ console.error(e); }
  });
}
//fin de traslados



$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
		
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
				
				currentCategory = item.category;
			}
			
			self._renderItem(ul, item);
		});
	}
});

// Manufacturer
$('input[name=\'manufacturer\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/manufacturer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.manufacturer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'manufacturer\']').attr('value', ui.item.label);
		$('input[name=\'manufacturer_id\']').attr('value', ui.item.value);
	
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

// Category
$('input[name=\'category\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.category_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-category' + ui.item.value).remove();
		
		$('#product-category').append('<div id="product-category' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_category[]" value="' + ui.item.value + '" /></div>');

		$('#product-category div:odd').attr('class', 'odd');
		$('#product-category div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-category div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-category div:odd').attr('class', 'odd');
	$('#product-category div:even').attr('class', 'even');	
});

// Filter
$('input[name=\'filter\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.filter_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-filter' + ui.item.value).remove();
		
		$('#product-filter').append('<div id="product-filter' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_filter[]" value="' + ui.item.value + '" /></div>');

		$('#product-filter div:odd').attr('class', 'odd');
		$('#product-filter div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-filter div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-filter div:odd').attr('class', 'odd');
	$('#product-filter div:even').attr('class', 'even');	
});

// Downloads
$('input[name=\'download\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/download/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.download_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-download' + ui.item.value).remove();
		
		$('#product-download').append('<div id="product-download' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_download[]" value="' + ui.item.value + '" /></div>');

		$('#product-download div:odd').attr('class', 'odd');
		$('#product-download div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-download div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-download div:odd').attr('class', 'odd');
	$('#product-download div:even').attr('class', 'even');	
});

// Related
$('input[name=\'related\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-related' + ui.item.value).remove();
		
		$('#product-related').append('<div id="product-related' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_related[]" value="' + ui.item.value + '" /></div>');

		$('#product-related div:odd').attr('class', 'odd');
		$('#product-related div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-related div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-related div:odd').attr('class', 'odd');
	$('#product-related div:even').attr('class', 'even');	
});
//--></script> 
<script type="text/javascript"><!--
var attribute_row = <?php echo $attribute_row; ?>;

function addAttribute() {
	html  = '<tbody id="attribute-row' + attribute_row + '">';
    html += '  <tr>';
	html += '    <td class="left"><input type="text" name="product_attribute[' + attribute_row + '][name]" value="" /><input type="hidden" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
	html += '    <td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<textarea name="product_attribute[' + attribute_row + '][product_attribute_description][<?php echo $language['language_id']; ?>][text]" cols="40" rows="5"></textarea><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" align="top" /><br />';
    <?php } ?>
	html += '    </td>';
	html += '    <td class="left"><a onclick="$(\'#attribute-row' + attribute_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
    html += '  </tr>';	
    html += '</tbody>';
	
	$('#attribute tfoot').before(html);
	
	attributeautocomplete(attribute_row);
	
	attribute_row++;
}

function attributeautocomplete(attribute_row) {
	$('input[name=\'product_attribute[' + attribute_row + '][name]\']').catcomplete({
		delay: 500,
		source: function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
				dataType: 'json',
				success: function(json) {	
					response($.map(json, function(item) {
						return {
							category: item.attribute_group,
							label: item.name,
							value: item.attribute_id
						}
					}));
				}
			});
		}, 
		select: function(event, ui) {
			$('input[name=\'product_attribute[' + attribute_row + '][name]\']').attr('value', ui.item.label);
			$('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').attr('value', ui.item.value);
			
			return false;
		},
		focus: function(event, ui) {
      		return false;
   		}
	});
}

$('#attribute tbody').each(function(index, element) {
	attributeautocomplete(index);
});
//--></script> 
<script type="text/javascript"><!--	
var option_row = <?php echo $option_row; ?>;

$('input[name=\'option\']').catcomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/option/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						category: item.category,
						label: item.name,
						value: item.option_id,
						type: item.type,
						option_value: item.option_value
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		html  = '<div id="tab-option-' + option_row + '" class="vtabs-content">';
		html += '	<input type="hidden" name="product_option[' + option_row + '][product_option_id]" value="" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][name]" value="' + ui.item.label + '" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][option_id]" value="' + ui.item.value + '" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][type]" value="' + ui.item.type + '" />';
		html += '	<table class="form">';
		html += '	  <tr>';
		html += '		<td><?php echo $entry_required; ?></td>';
		html += '       <td><select name="product_option[' + option_row + '][required]">';
		html += '	      <option value="1"><?php echo $text_yes; ?></option>';
		html += '	      <option value="0"><?php echo $text_no; ?></option>';
		html += '	    </select></td>';
		html += '     </tr>';
		
		if (ui.item.type == 'text') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" /></td>';
			html += '     </tr>';
		}
		
		if (ui.item.type == 'textarea') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><textarea name="product_option[' + option_row + '][option_value]" cols="40" rows="5"></textarea></td>';
			html += '     </tr>';						
		}
		 
		if (ui.item.type == 'file') {
			html += '     <tr style="display: none;">';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" /></td>';
			html += '     </tr>';			
		}
						
		if (ui.item.type == 'date') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="date" /></td>';
			html += '     </tr>';			
		}
		
		if (ui.item.type == 'datetime') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="datetime" /></td>';
			html += '     </tr>';			
		}
		
		if (ui.item.type == 'time') {
			html += '     <tr>';
			html += '       <td><?php echo $entry_option_value; ?></td>';
			html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="time" /></td>';
			html += '     </tr>';			
		}
		
		html += '  </table>';
			
		if (ui.item.type == 'select' || ui.item.type == 'radio' || ui.item.type == 'checkbox' || ui.item.type == 'image') {
			html += '  <table id="option-value' + option_row + '" class="list">';
			html += '  	 <thead>'; 
			html += '      <tr>';
			html += '        <td class="left"><?php echo $entry_option_value; ?></td>';
			html += '        <td class="right"><?php echo $entry_quantity; ?></td>';
			html += '        <td class="left"><?php echo $entry_subtract; ?></td>';
			html += '        <td class="right"><?php echo $entry_price; ?></td>';
			html += '        <td class="right"><?php echo $entry_option_points; ?></td>';
			html += '        <td class="right"><?php echo $entry_weight; ?></td>';
			html += '        <td></td>';
			html += '      </tr>';
			html += '  	 </thead>';
			html += '    <tfoot>';
			html += '      <tr>';
			html += '        <td colspan="6"></td>';
			html += '        <td class="left"><a onclick="addOptionValue(' + option_row + ');" class="button"><?php echo $button_add_option_value; ?></a></td>';
			html += '      </tr>';
			html += '    </tfoot>';
			html += '  </table>';
            html += '  <select id="option-values' + option_row + '" style="display: none;">';
			
            for (i = 0; i < ui.item.option_value.length; i++) {
				html += '  <option value="' + ui.item.option_value[i]['option_value_id'] + '">' + ui.item.option_value[i]['name'] + '</option>';
            }

            html += '  </select>';			
			html += '</div>';	
		}
		
		$('#tab-option').append(html);
		
		$('#option-add').before('<a href="#tab-option-' + option_row + '" id="option-' + option_row + '">' + ui.item.label + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'#option-' + option_row + '\').remove(); $(\'#tab-option-' + option_row + '\').remove(); $(\'#vtab-option a:first\').trigger(\'click\'); return false;" /></a>');
		
		$('#vtab-option a').tabs();
		
		$('#option-' + option_row).trigger('click');		
		
		$('.date').datepicker({dateFormat: 'yy-mm-dd'});
		$('.datetime').datetimepicker({
			dateFormat: 'yy-mm-dd',
			timeFormat: 'h:m'
		});	
			
		$('.time').timepicker({timeFormat: 'h:m'});	
				
		option_row++;
		
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});
//--></script> 
<script type="text/javascript"><!--		
var option_value_row = <?php echo $option_value_row; ?>;

function addOptionValue(option_row) {	
	html  = '<tbody id="option-value-row' + option_value_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]">';
	html += $('#option-values' + option_row).html();
	html += '    </select><input type="hidden" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
	html += '    <td class="right"><input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][quantity]" value="" size="3" /></td>'; 
	html += '    <td class="left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][subtract]">';
	html += '      <option value="1"><?php echo $text_yes; ?></option>';
	html += '      <option value="0"><?php echo $text_no; ?></option>';
	html += '    </select></td>';
	html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price]" value="" size="5" /></td>';
	html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points]" value="" size="5" /></td>';	
	html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight_prefix]">';
	html += '      <option value="+">+</option>';
	html += '      <option value="-">-</option>';
	html += '    </select>';
	html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight]" value="" size="5" /></td>';
	html += '    <td class="left"><a onclick="$(\'#option-value-row' + option_value_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#option-value' + option_row + ' tfoot').before(html);

	option_value_row++;
}
//--></script> 
<script type="text/javascript"><!--
var discount_row = <?php echo $discount_row; ?>;

function addDiscount() {
	html  = '<tbody id="discount-row' + discount_row + '">';
	html += '  <tr>'; 
    html += '    <td class="left"><select name="product_discount[' + discount_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][quantity]" value="" size="2" /></td>';
    html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][priority]" value="" size="2" /></td>';
	html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][price]" value="" /></td>';
    html += '    <td class="left"><input type="text" name="product_discount[' + discount_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td class="left"><input type="text" name="product_discount[' + discount_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td class="left"><a onclick="$(\'#discount-row' + discount_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';	
    html += '</tbody>';
	
	$('#discount tfoot').before(html);
		
	$('#discount-row' + discount_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});
	
	discount_row++;
}
//--></script> 
<script type="text/javascript"><!--
var special_row = <?php echo $special_row; ?>;

function addSpecial() {
	html  = '<tbody id="special-row' + special_row + '">';
	html += '  <tr>'; 
    html += '    <td class="left"><select name="product_special[' + special_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td class="right"><input type="text" name="product_special[' + special_row + '][priority]" value="" size="2" /></td>';
	html += '    <td class="right"><input type="text" name="product_special[' + special_row + '][price]" value="" /></td>';
    html += '    <td class="left"><input type="text" name="product_special[' + special_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td class="left"><input type="text" name="product_special[' + special_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td class="left"><a onclick="$(\'#special-row' + special_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
    html += '</tbody>';
	
	$('#special tfoot').before(html);
 
	$('#special-row' + special_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});
	
	special_row++;
}
//--></script> 
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(text) {
						$('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
    html  = '<tbody id="image-row' + image_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
	html += '    <td class="right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" size="2" /></td>';
	html += '    <td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#images tfoot').before(html);
	
	image_row++;
}
//--></script> 
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
$('#vtab-option a').tabs();


$(function() {
    var availableTags = [
	
	<?php 
	$sql="SELECT distinct od.attribute_id,opd.name  FROM oc_attribute o, oc_product_attribute op, oc_product op1, oc_attribute_description od,  oc_product_description opd
WHERE op.attribute_id=o.attribute_id AND op1.product_id=op.product_id AND od.attribute_id=o.attribute_id AND opd.product_id=op.product_id AND
opd.language_id=op.language_id and op1.tipoproducto='hotel'; ";
 



$query = $this->db->query($sql);
//echo $sql;
	
				 
				 $json[] = array(
				'id' =>0,
				'value' => 'Todos los resultados');
		 foreach ($query->rows as $result) { 
		 
		 echo "'".$result['name']."',";
				
		 }
		 ?>
      
       
    ];
    $( "#hotel" ).autocomplete({
      source: availableTags
    });
	
	
	
	
	var availableTags2 = [
	
	<?php 
	$sql="SELECT distinct od.name  FROM oc_attribute o, oc_product_attribute op, oc_product op1, oc_attribute_description od,  oc_product_description opd
WHERE op.attribute_id=o.attribute_id AND op1.product_id=op.product_id AND od.attribute_id=o.attribute_id AND opd.product_id=op.product_id AND
opd.language_id=op.language_id ;";
 



$query = $this->db->query($sql);
//echo $sql;
	
				 
				 $json[] = array(
				'id' =>0,
				'value' => 'Todos los resultados');
		 foreach ($query->rows as $result) { 
		 
		 echo "'".$result['name']."',";
				
		 }
		 ?>
      
       
    ];
    $( "#ciudad" ).autocomplete({
      source: availableTags2
    });
	
	
	
  }); 
//--></script> 
<script type="text/javascript">
  $('#htcatg').bind('change', function(){
    var catg=$('#htcatg option:selected').val();
    var tidhct=$('#myidhct').val();
    var product_id=<?php
    if (isset($this->request->get['product_id'])) {
      echo $this->request->get['product_id'];
    }else{ echo  0; } ?>;
    $.ajax({
      url: 'index.php?route=catalog/product/asignacatg2hot&token=<?php echo $token; ?>&idp='+product_id+'&catg='+catg+'&idhct='+tidhct,
      dataType: 'json',
      success: function(json) {
        //alert(json);
        alert(json['success']);
        location.reload();
      }
    });
  });
</script>

<?php echo $footer; ?>
