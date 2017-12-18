<?php
class ControllerPaymentDineroMail extends Controller {
	protected function index() {
		$this->data['button_confirm'] = $this->language->get('button_confirm');

		$this->load->model('checkout/order');
        
		if(isset($this->session->data['coupon'])){
			$this->load->model('checkout/coupon');
			$coupon_info = $this->model_checkout_coupon->getCoupon($this->session->data['coupon']);
		}	 
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		$this->data['action'] = 'https://checkout.dineromail.com/CheckOut';
		
		$this->data['text_wait'] = 'Espere hasta que sea redirigido a la página de pago de DinheiroMail';
		
		$country = $this->config->get('dineromail_geo_zone_id');		
		
		$this->data['order_countryid'] = $country;				
		if($country==1){
			$this->data['order_currency'] = 'ARS';
			$this->data['order_language'] = 'es';
		}
		elseif($country==2){
			$this->data['order_currency'] = 'BRL';
			$this->data['order_language'] = 'pt';
		}
		elseif($country==3){
			$this->data['order_currency'] = 'CLP';
			$this->data['order_language'] = 'es';
		}
		elseif($country==4){
			$this->data['order_currency'] = 'MXN';
			$this->data['order_language'] = 'es';
		}
		
		$this->data['order_merchant'] = $this->config->get('dineromail_merchant');
		$this->data['order_logo'] = $this->config->get('dineromail_url_logo');
		$this->data['order_sellername'] = $this->config->get('config_name');
		$this->data['order_transactionid'] = $this->session->data['order_id'];
		$this->data['order_cancelurl'] = HTTPS_SERVER . 'index.php?route=payment/dineromail/cancel&order_id='.$this->session->data['order_id'];
		$this->data['order_penokurl'] = $this->url->link('checkout/success', '', 'SSL');
		$this->data['order_name'] = $this->customer->getFirstName();
		$this->data['order_lastname'] = $this->customer->getLastName();
		$this->data['order_email'] = $this->customer->getEmail();
		$this->data['order_fone'] = $this->customer->getTelephone();
		$this->data['order_name'] = $this->customer->getFirstName();
		$this->data['order_name'] = $this->customer->getFirstName();		
		
		$this->data['products'] = array();
        		
		$products = $this->cart->getProducts();
		$taxa = 0;
		$product_price = 0;
		$discount = 0;
		foreach ($products as $product) {
			$this->data['products'][] = array(
				'product_id'  => $product['product_id'],
				'name'        => $product['name'],
				'quantity'    => $product['quantity'],
				'price'		  => $this->currency->format($product['price'], $order_info['currency_code'], $order_info['currency_value'], false)
			);
			$product_price = $product['total'];
			
			if(isset($coupon_info)){
				if ($coupon_info['type'] == 'F') {
					$discount = $discount + $coupon_info['discount'];
					$product_price = $product_price - $coupon_info['discount'];
				} 				
				elseif ($coupon_info['type'] == 'P') {
					$discount = $discount + ($product_price * ($coupon_info['discount']/100));
					$product_price = $product_price - ($product_price * ($coupon_info['discount']/100));
				}
			}
			
			$taxa=$taxa + $this->tax->getTax($product_price, $product['tax_class_id']);
		}
		
		if($this->cart->hasShipping()){
			if ($this->session->data['shipping_method']['tax_class_id']) {
				$tax_rates_shipping = $this->tax->getRates($this->session->data['shipping_method']['cost'], $this->session->data['shipping_method']['tax_class_id']);
				$tx_shipping=0;
				foreach ($tax_rates_shipping as $tax_rate_shipping) {
					$tx_shipping += $tax_rate_shipping['amount'];
				}
				$taxa=$taxa+$tx_shipping;
			}
			
			$shipping_cost=0;
			$shipping_cost += $this->session->data['shipping_method']['cost'];
			$shipping_cost = $this->currency->format($shipping_cost, $order_info['currency_code'], $order_info['currency_value'], FALSE); 
			
			if(isset($coupon_info)){
				if($coupon_info['shipping'] == '1'){
					$discount = $discount + $shipping_cost;
				}	
			}
		}
		
		if(isset($this->session->data['voucher'])){
			$this->load->model('checkout/voucher');			 
			$voucher_info = $this->model_checkout_voucher->getVoucher($this->session->data['voucher']);
			$discount = $discount + $voucher_info['amount'];
			
		}
		
		if ($taxa) {
			$taxa = $this->currency->format($taxa, $order_info['currency_code'], $order_info['currency_value'], false);
			$this->data['products'][] = array(
				'product_id'  => '#IPT',
				'name'        => 'PC - Tasa de Impuestos',
				'quantity'    => '1',
				'price'		  => $taxa
			);				
		}
		
		if (isset($shipping_cost)) {
			$this->data['products'][] = array(
				'product_id'  => '#FRT',
				'name'        => 'PC - Tasa de Servicio',
				'quantity'    => '1',
				'price'		  => $shipping_cost
			);				
		}
			
		$this->data['order_discount'] = 0;		
		if ($discount > 0) {
			$discount = sprintf('%.1f',$discount);
			$this->data['order_discount'] = $discount;					
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/dineromail.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/dineromail.tpl';
		} else {
			$this->template = 'default/template/payment/dineromail.tpl';
		}

		$this->render();
	}

	public function callback() {		
		
		ini_set("allow_url_fopen", 1); 
    	ini_set("allow_url_include", 1);
		
		$notificacion = htmlspecialchars_decode($_REQUEST['Notificacion']);
        $notificacion = str_replace("<?xml version='1.0'encoding='ISO-8859-1'?>", "", $notificacion);
        $notificacion = str_replace("<?xml version=\'1.0\'encoding=\'ISO-8859-1\'?>", "", $notificacion);
        $notificacion = str_replace("<?xmlversion=\'1.0\'encoding=\'ISO-8859-1\'?>", "", $notificacion);
        $notificacion = str_replace("<?xmlversion='1.0'encoding='ISO-8859-1'?>", "", $notificacion);
        $notificacion = str_replace("<?xml version='1.0' encoding='ISO-8859-1'?>", "", $notificacion);
        $notificacion = str_replace("<?xml version=\'1.0\' encoding=\'ISO-8859-1\'?>", "", $notificacion);		
		
		$doc = new SimpleXMLElement($notificacion);		
		
		foreach ($doc ->operaciones ->operacion  as  $operacion) {			    
			$id_operacion = $operacion->id; 			
			$this->consultaIpn($id_operacion);
		}
		
	}

	public function confirm() {
		$this->load->model('checkout/order');
		$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('dineromail_order_status_id'));
		$this->redirect(HTTPS_SERVER . 'index.php?route=checkout/success');
	}
	public function cancel() {
		$this->load->model('checkout/order');
		$this->model_checkout_order->update($_REQUEST['order_id'], 7);
		$this->redirect(HTTPS_SERVER . 'index.php?route=checkout/checkout');
	}
	
	public function consultaIpn($id_operacion){
		
		$this->load->model('checkout/order');
		$this->load->model('account/order');
				
		$email=$this->config->get('dineromail_email');
		$nrocta=$this->config->get('dineromail_merchant');
		$senhaipn=$this->config->get('dineromail_ipn_pass');
		$country=$this->config->get('dineromail_geo_zone_id');
		
		if($country==1){
			$url="https://argentina.dineromail.com/Vender/Consulta_IPN.asp";			
		}
		elseif($country==2){
			$url="https://brasil.dineromail.com/Vender/Consulta_IPN.asp";
		}
		elseif($country==3){
			$url="https://chile.dineromail.com/Vender/Consulta_IPN.asp";
		}
		elseif($country==4){
			$url="https://mexico.dineromail.com/Vender/Consulta_IPN.asp";
		}	
				
		$data = 'DATA=<REPORTE><NROCTA>'.$nrocta.'</NROCTA><DETALLE><CONSULTA><CLAVE>'.$senhaipn.'</CLAVE><TIPO>1</TIPO><OPERACIONES><ID>'.$id_operacion.'</ID></OPERACIONES></CONSULTA></DETALLE></REPORTE>';

		$url = parse_url($url);
		$host = $url['host'];
		$path = $url['path'];		
		$fp = fsockopen($host, 80);	
		fputs($fp, "POST $path HTTP/1.1\r\n");
		fputs($fp, "Host: $host\r\n");
		//fputs($fp, "Referer: $referer\r\n");
		fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
		fputs($fp, "Content-length: ". strlen($data) ."\r\n");
		fputs($fp, "Connection: close\r\n\r\n");
		fputs($fp, $data);
		$result = ''; 
        
		while(!feof($fp)) {
			// resultado del request
			$result .= fgets($fp, 128);
		}
		
		// cierra conexion
		fclose($fp);

		// separa el header del content
		$result = explode("\r\n\r\n", $result, 2);

		//$header = isset($result[0]) ? $result[0] : '';
		
		$content = isset($result[1]) ? $result[1] : '';	

		$xml = new SimpleXMLElement($content);

		$estadoxml = $xml ->ESTADOREPORTE;
		if($estadoxml==1){
			
			foreach ($xml ->DETALLE->OPERACIONES->OPERACION  as  $OPERACION) {
				$trx_id      = $OPERACION->ID;  
				$estadotrans = $OPERACION->ESTADO; 
				$data        = $OPERACION->FECHA; 
				
				
				$status=$this->model_checkout_order->getOrder($trx_id);
				$idstatus = $status['order_status_id'];
				
				$verify=2;
				$verify_quantity=0;
				foreach ($OPERACION->ITEMS->ITEM  as  $ITEM) {
					$verify_quantity++;					
					
					$description = $ITEM->DESCRIPCION;
					$value_unit  = $ITEM->PRECIOUNITARIO;
					$quantit     = $ITEM->CANTIDAD;
					
					$order_products = $this->model_account_order->getOrderProducts($trx_id);					
					foreach ($order_products as $order_product) {
							
						if(($order_product['name']==$description)&&($order_product['quantity']==$quantit)&&($order_product['price']==$value_unit)){
							$verify++;
						}						
					}							
				}
				if($verify==$verify_quantity){
					if($estadotrans==2){
						$this->model_checkout_order->update($trx_id, 5);	 			     	
					}
					elseif($estadotrans==1){
						if($idstatus!=5){
							$this->model_checkout_order->update($trx_id, 1);
						}						 					
										
					}
					elseif($estadotrans==3){
						if($idstatus!=5){
							$this->model_checkout_order->update($trx_id, 7);
						}					
					}	
				}	
				else{
					       
					 $body='Puede haber un intento de fraude en el número de transacción '.$trx_id.'. Dado que el(los) valor(es) de el(los) producto(s) en la tienda no és(son) igual(es) con el(los) valor(es) pago(s) en Dineromail.';
					 
					 $mail = new Mail();
					 $mail->protocol = $this->config->get('config_mail_protocol');
					 $mail->parameter = $this->config->get('config_mail_parameter');
					 $mail->hostname = $this->config->get('config_smtp_host');
					 $mail->username = $this->config->get('config_smtp_username');
					 $mail->password = $this->config->get('config_smtp_password');
					 $mail->port = $this->config->get('config_smtp_port');
					 $mail->timeout = $this->config->get('config_smtp_timeout');				
					 $mail->setTo($this->config->get('dineromail_email'));
					 $mail->setFrom($this->config->get('dineromail_email'));
					 $mail->setSender($this->config->get('config_name'));
					 $mail->setSubject('Possível Tentativa de Fraude');
					 $mail->setText(html_entity_decode($body, ENT_QUOTES, 'UTF-8'));
					 $mail->send();				 
				
				}	
			}
		}
		
	}

}

?>