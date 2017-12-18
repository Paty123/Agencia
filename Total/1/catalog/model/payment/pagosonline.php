<?php
class ModelPaymentpagosonline extends Model {

  	public function getMethod($address, $total) {
		$this->load->language('payment/pagosonline');
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('pagosonline_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
		
		if ($this->config->get('pagosonline_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('pagosonline_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}	
		
		

		$method_data = array();

		if ($status) {
			if($this->config->get('pagosonline_prueba') == 0 )
			{
				$title = $this->language->get('text_title');
			}
			else
			{
				$title = $this->language->get('text_title')."<b> En Modo De Prueba</b>";
			}
      		$method_data = array(
        		'code'         => 'pagosonline',
        		'title'      => $title,
				'sort_order' => $this->config->get('pagosonline_sort_order')
      		);
    	}
   
    	return $method_data;
  	}
}
?>