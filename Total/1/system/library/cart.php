<?php
class Cart {
	private $config;
	private $db;
	private $data = array();
	
  	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->customer = $registry->get('customer');
		$this->session = $registry->get('session');
		$this->db = $registry->get('db');
		$this->tax = $registry->get('tax');
		$this->weight = $registry->get('weight');

		if (!isset($this->session->data['cart']) || !is_array($this->session->data['cart'])) {
      		$this->session->data['cart'] = array();
    	}
	}

  	public function getProducts(){
		if (!$this->data){
			foreach ($this->session->data['cart'] as $key=>$quantity) {
                    //echo '<pre>'; print_r($this->session->data['cart']); echo '</pre> ***** <br />'; return;
				$comprob=explode('_',$key);
                                if($comprob[count($comprob)-1]=='wd'){ continue; }
                                if($this->session->data['cart'][$key.'_wd']['kndapro']<3 && !isset($this->session->data['cart'][$key.'_wd']['habtp_0'])){
                                  unset($this->session->data['cart'][$key.'_wd']);
                                  unset($this->session->data['cart'][$key]); continue;
                                }
                                $product = explode(':', $key);
				$product_idx = explode('-', $product[0]);;
				//echo $product[0];
				$product_id=$product_idx[0];
				//$precioid=$product_idx[1];
				$stock = true;
				// Options if (isset($product[1])) { $options = unserialize(base64_decode($product[1])); } else {
                                $options = array(); //}
				$product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.date_available <= NOW() AND p.status = '1'");
				if ($product_query->num_rows){
					$option_price = 0; $option_points = 0; $option_weight = 0; $option_data = array();
				     // SE BORRO foreach ($options as $product_option_id => $option_value){}
					if ($this->customer->isLogged()) { $customer_group_id = $this->customer->getCustomerGroupId(); }
                                        else { $customer_group_id = $this->config->get('config_customer_group_id'); }
					$price = $product_query->row['price'];
				     // Se borran secciones comentadas Product Discounts, Product Specials, Reward Points, Downloads
					// Stock
					if (!$product_query->row['quantity'] || ($product_query->row['quantity'] < $quantity)) { $stock = false; }
                                     // precios de paquetes
                                        $extd=$this->session->data['cart'][$key.'_wd'];
                                        if($extd['kndapro']==1 || $extd['kndapro']==3){
                                          $detallaso=$extd['npersonas'].' personas, saliendo de '.$extd['cddsal'].' en '.$extd['finicio'];
                                        }else if($extd['kndapro']==2){
                                          $detallaso='Entrando en: '.$extd['finicio'].' hasta: '.$extd['ffin'];
                                        }else if($extd['kndapro']==4){
                                          $detallaso='Salida: '.$extd['tsalfecha'].', '.$extd['npersonas'].' personas';
                                        }
					$this->data[$key] = array(
						'key'             => $key,
						'product_id'      => $extd['product_id'],
						'name'            => $product_query->row['name'],
						'detalle'         => $detallaso,
						'tipoproducto'    => $product_query->row['tipoproducto'],
						'model'           => $product_query->row['model'],
						'shipping'        => $product_query->row['shipping'],
						'image'           => $product_query->row['image'],
						'option'          => $option_data,
						'download'        => array(),
						'quantity'        => $quantity,
						'extendta'        => $extd,
						'minimum'         => $product_query->row['minimum'],
						'subtract'        => $product_query->row['subtract'],
						'stock'           => $stock,
						'price'           => $extd['ttcosto'],
						'total'           => $extd['ttcosto'],
						'reward'          => 0,
						'points'          => ($product_query->row['points'] ? ($product_query->row['points'] + $option_points) * $quantity : 0),
						'tax_class_id'    => $product_query->row['tax_class_id'],
						'weight'          => ($product_query->row['weight'] + $option_weight) * $quantity,
						'weight_class_id' => $product_query->row['weight_class_id'],
						'length'          => $product_query->row['length'],
						'width'           => $product_query->row['width'],
						'height'          => $product_query->row['height'],
						'length_class_id' => $product_query->row['length_class_id']
					);
				}else{ $this->remove($key); }
			}
		}
		return $this->data;
  	}

  	public function add($product_id, $qty = 1, $option = array(),$wdata=array()){
          $cnt=((int)count($this->session->data['cart']));
          if(!$option) { $key = (int)$product_id; }
          else{ $key = (int)$product_id . ':' . base64_encode(serialize($option)); }
          $key.='-'.$cnt;
          if((int)$qty && ((int)$qty > 0)){
            if (!isset($this->session->data['cart'][$key])){
              $this->session->data['cart'][$key] = $qty;
              $this->session->data['cart'][$key.'_wd'] = $wdata;
            }else{
              $this->session->data['cart'][$key] += (int)$qty;
              $this->session->data['cart'][$key.'_wd'] = $wdata;
            }
          }
          $this->data = array();
  	}

  	public function update($key, $qty) {
    	if ((int)$qty && ((int)$qty > 0)) {
      		$this->session->data['cart'][$key] = (int)$qty;
    	} else {
	  		$this->remove($key);
		}
		
		$this->data = array();
  	}

  	public function remove($key) {
		if (isset($this->session->data['cart'][$key])) {
     		unset($this->session->data['cart'][$key]);
  		}
		
		$this->data = array();
	}
	
  	public function clear() {
		$this->session->data['cart'] = array();
		$this->data = array();
  	}
	
  	public function getWeight() {
		$weight = 0;
	
    	foreach ($this->getProducts() as $product) {
			if ($product['shipping']) {
      			$weight += $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
			}
		}
	
		return $weight;
	}
	
  	public function getSubTotal() {
		$total = 0;
		foreach ($this->getProducts() as $product) {
			$total += $product['total'];
		}
		return $total;
  	}

	public function getTaxes(){
		$tax_data = array();
		foreach ($this->getProducts() as $product) {
			if ($product['tax_class_id']) {
				$tax_rates = $this->tax->getRates($product['price'], $product['tax_class_id']);
				foreach ($tax_rates as $tax_rate){
					if (!isset($tax_data[$tax_rate['tax_rate_id']])) {
						$tax_data[$tax_rate['tax_rate_id']] = ($tax_rate['amount'] * $product['quantity']);
					} else {
						$tax_data[$tax_rate['tax_rate_id']] += ($tax_rate['amount'] * $product['quantity']);
					}
				}
			}
		}
		return $tax_data;
  	}

  	public function getTotal() {
		$total = 0;
		
		foreach ($this->getProducts() as $product) {
			$total += $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'];
		}

		return $total;
  	}
	  	
  	public function countProducts() {
		$product_total = 0;
		$products = $this->getProducts();
		foreach ($products as $product) {
			$product_total += $product['quantity'];
		}
		return $product_total;
	}
	  
  	public function hasProducts() {
    	return count($this->session->data['cart']);
  	}
  
  	public function hasStock() {
		$stock = true;
		
		foreach ($this->getProducts() as $product) {
			if (!$product['stock']) {
	    		$stock = false;
			}
		}
		
    	return $stock;
  	}
  
  	public function hasShipping() {
		$shipping = false;
		foreach ($this->getProducts() as $product) {
	  		if ($product['shipping']) {
	    		$shipping = true;

				break;
	  		}
		}
		return $shipping;
	}
	
  	public function hasDownload() {
		$download = false;
		
		foreach ($this->getProducts() as $product) {
	  		if ($product['download']) {
	    		$download = true;
				
				break;
	  		}		
		}
		
		return $download;
	}	
}
?>