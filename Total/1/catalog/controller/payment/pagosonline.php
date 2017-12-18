<?php
class ControllerPaymentPagosonline extends Controller {
	protected function index() {
		$this->language->load('payment/pagosonline');
    	$this->data['button_confirm'] = $this->language->get('button_confirm');
		
		//si la transaccion es de prueba cambia las urls
		if($this->config->get('pagosonline_prueba') == 0 )
		{
			$this->data['action'] = "https://gateway.payulatam.com/ppp-web-gateway/";
		}
		else
		{
			$this->data['action'] = "https://stg.gateway.payulatam.com/ppp-web-gateway/";
		}
		
		

		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		$supported_currencies = array('COP','USD','GBP','MXN','EUR','VEB');//adicionar codigo monedas soportadas
		
		if (in_array($order_info['currency_code'], $supported_currencies)) {
			$currency = $order_info['currency_code'];
		} else {
			$currency = 'COP';
			
		}
		
		
		$shipping_total = 0;
		$tax_total = 0;
		//si tiene envio se calcula para adicionarlo al valor total
		if ($this->cart->hasShipping()) {
			
			$shipping_total = $this->currency->format($this->session->data['shipping_method']['text'], $currency, FALSE, FALSE);
			$order_total = $this->session->data['shipping_method']['text'];
			$shipping_cost=$this->session->data['shipping_method']['cost'];
			$shipping_tax_class_id=$this->session->data['shipping_method']['tax_class_id'];
			$shipping_noformat=$this->tax->calculate($shipping_cost, $shipping_tax_class_id, $this->config->get('config_tax'));
			$shipping_total=$this->currency->format($shipping_noformat, $currency, FALSE, FALSE);
			//se le asigna el iva del metodo de envio 
			$tax_total = $shipping_total-$shipping_cost;
		}

	    $valor = $this->currency->format($this->cart->getTotal(), $currency, FALSE, FALSE)+$shipping_total;//ok
		$extra2= $order_info['order_id'];
		$this->data['extra2'] = $extra2;
		$llave_encripcion = $this->config->get('pagosonline_llaveEncripcion');
		$refVenta = time();
		$moneda = $currency;
		$usuarioId = $this->config->get('pagosonline_usuarioId');
		$merchantId = $this->config->get('pagosonline_merchantId');
		// ApiKey~merchantId~referenceCode~amount~currency
		$firma= $llave_encripcion."~".$merchantId."~".$refVenta."~".$valor."~".$moneda;
		$firma = strtoupper(md5($firma));
		$this->data['usuarioId'] = $usuarioId;
		$this->data['merchantId'] = $merchantId;
		$this->data['firma'] = $firma;
		$this->data['refVenta'] = $refVenta;		
		$this->data['prueba'] = $this->config->get('pagosonline_prueba');
        $this->data['emailComprador'] = isset($this->session->data['guest']['email'])? $this->session->data['guest']['email']:$this->customer->getEmail();
        $nom_ape_comprador= isset ($this->session->data['guest']['firstname'])?$this->session->data['guest']['firstname']:$this->customer->getFirstName();
        $nom_ape_comprador.=' ';
        $nom_ape_comprador.= isset ($this->session->data['guest']['lastname'])?$this->session->data['guest']['lastname']:$this->customer->getLastName();
                
        $this->data['nombreComprador'] =$nom_ape_comprador;
        $this->data['telefonoMovil'] = isset ($this->session->data['guest']['telephone'])?$this->session->data['guest']['telephone']:$this->customer->getTelephone();
		
		
		$this->data['url_respuesta'] = $this->url->link('checkout/success');
		
		$this->data['url_confirmacion']=HTTPS_SERVER.'/pol/confirmacion.php';
		
		$this->data['descripcion'] = "Pedido # ".$order_info['order_id']." en ".$this->config->get('config_name');
		$baseDevolucionIva = 0;
        $desc_products = array ();
				
		$taxes = $this->cart->getTaxes();
		foreach ($taxes as $key => $value) 
		{
			$tax_total += $this->currency->format($value, $currency, FALSE, FALSE);
		}	
		//$tax_total es el iva 
		$baseDevolucionIva=$this->currency->format($this->cart->getSubTotal(), $currency, FALSE, FALSE);

		if($tax_total <= 0)$baseDevolucionIva=0;
        
		$this->data['extra1'] = $desc_products;
		$this->data['baseDevolucionIva']=$baseDevolucionIva;
		$this->data['iva'] = $tax_total;	
		$this->data['moneda'] = $currency;
		$this->data['valor'] =  $valor;
		
		if ($shipping_total) {
			$this->data['shipping_cost'] = $shipping_total;
		}
		if ($this->request->get['route'] != 'checkout/guest_step_3') {
			$this->data['url_cancel'] = HTTPS_SERVER . 'index.php?route=checkout/payment';
		} else {
			$this->data['url_cancel'] = HTTPS_SERVER . 'index.php?route=checkout/guest_step_2';
		}
		
		if ($this->request->get['route'] != 'checkout/guest_step_3') {
			$this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/payment';
		} else {
			$this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/guest_step_2';
		}
		
		$this->id = 'payment';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/pagosonline.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/pagosonline.tpl';
		} else {
			$this->template = 'default/template/payment/pagosonline.tpl';
		}	
		$this->model_checkout_order->confirm($order_info['order_id'],$this->config->get('pagosonline_order_status_id'));
		$this->render();		
	}
	
	public function confirm() {
		$this->load->model('checkout/order');
		$this->redirect(HTTPS_SERVER . 'index.php?route=checkout/success');
	}
	
}
?>