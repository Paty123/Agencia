<?php
class ControllerCheckoutConfirm extends Controller { 
	public function index() {
		$redirect = '';
		
		if ($this->cart->hasShipping()) {
			// Validate if shipping address has been set.		
			$this->load->model('account/address');
	
			if ($this->customer->isLogged() && isset($this->session->data['shipping_address_id'])) {					
				$shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);		
			} elseif (isset($this->session->data['guest'])) {
				$shipping_address = $this->session->data['guest']['shipping'];
			}
			
			if (empty($shipping_address)) {								
				$redirect = $this->url->link('checkout/checkout', '', 'SSL');
			}
			
			// Validate if shipping method has been set.	
			if (!isset($this->session->data['shipping_method'])) {
				$redirect = $this->url->link('checkout/checkout', '', 'SSL');
			}
		} else {
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
		}
		
		// Validate if payment address has been set.
		$this->load->model('account/address');
		
		if ($this->customer->isLogged() && isset($this->session->data['payment_address_id'])) {
			$payment_address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);		
		} elseif (isset($this->session->data['guest'])) {
			$payment_address = $this->session->data['guest']['payment'];
		}	
				
		if (empty($payment_address)) {
			$redirect = $this->url->link('checkout/checkout', '', 'SSL');
		}			
		
		// Validate if payment method has been set.	
		if (!isset($this->session->data['payment_method'])) {
			$redirect = $this->url->link('checkout/checkout', '', 'SSL');
		}
					
		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$redirect = $this->url->link('checkout/cart');				
		}	
		
		// Validate minimum quantity requirments.			
		$products = $this->cart->getProducts();
				
		foreach ($products as $product) {
			$product_total = 0;
				
			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}		
			
			if ($product['minimum'] > $product_total) {
				$redirect = $this->url->link('checkout/cart');
				
				break;
			}				
		}
						
		if (!$redirect) {
			$total_data = array();
			$total = 0;
			$taxes = $this->cart->getTaxes();
			 
			$this->load->model('setting/extension');
			
			$sort_order = array(); 
			
			$results = $this->model_setting_extension->getExtensions('total');
			
			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}
			
			array_multisort($sort_order, SORT_ASC, $results);
			
			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);
		
					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}
			
			$sort_order = array(); 
		  
			foreach ($total_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}
	
			array_multisort($sort_order, SORT_ASC, $total_data);
	
			$this->language->load('checkout/checkout');
			
			$data = array();
			
			$data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
			$data['store_id'] = $this->config->get('config_store_id');
			$data['store_name'] = $this->config->get('config_name');
			
			if ($data['store_id']) {
				$data['store_url'] = $this->config->get('config_url');		
			} else {
				$data['store_url'] = HTTP_SERVER;	
			}
			
			if ($this->customer->isLogged()) {
				$data['customer_id'] = $this->customer->getId();
				$data['customer_group_id'] = $this->customer->getCustomerGroupId();
				$data['firstname'] = $this->customer->getFirstName();
				$data['lastname'] = $this->customer->getLastName();
				$data['email'] = $this->customer->getEmail();
				$data['telephone'] = $this->customer->getTelephone();
				$data['fax'] = $this->customer->getFax();
			
				$this->load->model('account/address');
				
				$payment_address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
			} elseif (isset($this->session->data['guest'])) {
				$data['customer_id'] = 0;
				$data['customer_group_id'] = $this->session->data['guest']['customer_group_id'];
				$data['firstname'] = $this->session->data['guest']['firstname'];
				$data['lastname'] = $this->session->data['guest']['lastname'];
				$data['email'] = $this->session->data['guest']['email'];
				$data['telephone'] = $this->session->data['guest']['telephone'];
				$data['fax'] = $this->session->data['guest']['fax'];
				
				$payment_address = $this->session->data['guest']['payment'];
			}
			
			$data['payment_firstname'] = $payment_address['firstname'];
			$data['payment_lastname'] = $payment_address['lastname'];	
			$data['payment_company'] = $payment_address['company'];	
			$data['payment_company_id'] = $payment_address['company_id'];	
			$data['payment_tax_id'] = $payment_address['tax_id'];	
			$data['payment_address_1'] = $payment_address['address_1'];
			$data['payment_address_2'] = $payment_address['address_2'];
			$data['payment_city'] = $payment_address['city'];
			$data['payment_postcode'] = $payment_address['postcode'];
			$data['payment_zone'] = $payment_address['zone'];
			$data['payment_zone_id'] = $payment_address['zone_id'];
			$data['payment_country'] = $payment_address['country'];
			$data['payment_country_id'] = $payment_address['country_id'];
			$data['payment_address_format'] = $payment_address['address_format'];
		
			if (isset($this->session->data['payment_method']['title'])) {
				$data['payment_method'] = $this->session->data['payment_method']['title'];
			} else {
				$data['payment_method'] = '';
			}
			
			if (isset($this->session->data['payment_method']['code'])) {
				$data['payment_code'] = $this->session->data['payment_method']['code'];
			} else {
				$data['payment_code'] = '';
			}
						
			if ($this->cart->hasShipping()) {
				if ($this->customer->isLogged()) {
					$this->load->model('account/address');
					
					$shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);	
				} elseif (isset($this->session->data['guest'])) {
					$shipping_address = $this->session->data['guest']['shipping'];
				}			
				
				$data['shipping_firstname'] = $shipping_address['firstname'];
				$data['shipping_lastname'] = $shipping_address['lastname'];	
				$data['shipping_company'] = $shipping_address['company'];	
				$data['shipping_address_1'] = $shipping_address['address_1'];
				$data['shipping_address_2'] = $shipping_address['address_2'];
				$data['shipping_city'] = $shipping_address['city'];
				$data['shipping_postcode'] = $shipping_address['postcode'];
				$data['shipping_zone'] = $shipping_address['zone'];
				$data['shipping_zone_id'] = $shipping_address['zone_id'];
				$data['shipping_country'] = $shipping_address['country'];
				$data['shipping_country_id'] = $shipping_address['country_id'];
				$data['shipping_address_format'] = $shipping_address['address_format'];
			
				if (isset($this->session->data['shipping_method']['title'])) {
					$data['shipping_method'] = $this->session->data['shipping_method']['title'];
				} else {
					$data['shipping_method'] = '';
				}
				
				if (isset($this->session->data['shipping_method']['code'])) {
					$data['shipping_code'] = $this->session->data['shipping_method']['code'];
				} else {
					$data['shipping_code'] = '';
				}				
			} else {
				$data['shipping_firstname'] = '';
				$data['shipping_lastname'] = '';	
				$data['shipping_company'] = '';	
				$data['shipping_address_1'] = '';
				$data['shipping_address_2'] = '';
				$data['shipping_city'] = '';
				$data['shipping_postcode'] = '';
				$data['shipping_zone'] = '';
				$data['shipping_zone_id'] = '';
				$data['shipping_country'] = '';
				$data['shipping_country_id'] = '';
				$data['shipping_address_format'] = '';
				$data['shipping_method'] = '';
				$data['shipping_code'] = '';
			}
			
			$product_data = array();
		
			foreach ($this->cart->getProducts() as $product) {
				$option_data = array();
	
				foreach ($product['option'] as $option) {
					if ($option['type'] != 'file') {
						$value = $option['option_value'];	
					} else {
						$value = $this->encryption->decrypt($option['option_value']);
					}	
					
					$option_data[] = array(
						'product_option_id'       => $option['product_option_id'],
						'product_option_value_id' => $option['product_option_value_id'],
						'option_id'               => $option['option_id'],
						'option_value_id'         => $option['option_value_id'],								   
						'name'                    => $option['name'],
						'value'                   => $value,
						'type'                    => $option['type']
					);					
				}
	 
				$product_data[] = array(
					'product_id' => $product['product_id'],
					'name'       => $product['name'],
					'model'      => $product['model'],
					'option'     => $option_data,
					'download'   => $product['download'],
					'extendta'   => $product['extendta'],
					'quantity'   => $product['quantity'],
					'subtract'   => $product['subtract'],
					'price'      => $product['price'],
					'total'      => $product['total'],
					'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
					'reward'     => $product['reward']
				); 
			}
			
			// Gift Voucher
			$voucher_data = array();
			
			if (!empty($this->session->data['vouchers'])) {
				foreach ($this->session->data['vouchers'] as $voucher) {
					$voucher_data[] = array(
						'description'      => $voucher['description'],
						'code'             => substr(md5(mt_rand()), 0, 10),
						'to_name'          => $voucher['to_name'],
						'to_email'         => $voucher['to_email'],
						'from_name'        => $voucher['from_name'],
						'from_email'       => $voucher['from_email'],
						'voucher_theme_id' => $voucher['voucher_theme_id'],
						'message'          => $voucher['message'],						
						'amount'           => $voucher['amount']
					);
				}
			}  
						
			$data['products'] = $product_data;
			$data['vouchers'] = $voucher_data;
			$data['totals'] = $total_data;
			$data['comment'] = $this->session->data['comment'];
			$data['total'] = $total;
			
			if (isset($this->request->cookie['tracking'])) {
				$this->load->model('affiliate/affiliate');
				
				$affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);
				$subtotal = $this->cart->getSubTotal();
				
				if ($affiliate_info) {
					$data['affiliate_id'] = $affiliate_info['affiliate_id']; 
					$data['commission'] = ($subtotal / 100) * $affiliate_info['commission']; 
				} else {
					$data['affiliate_id'] = 0;
					$data['commission'] = 0;
				}
			} else {
				$data['affiliate_id'] = 0;
				$data['commission'] = 0;
			}
			
			$data['language_id'] = $this->config->get('config_language_id');
			$data['currency_id'] = $this->currency->getId();
			$data['currency_code'] = $this->currency->getCode();
			$data['currency_value'] = $this->currency->getValue($this->currency->getCode());
			$data['ip'] = $this->request->server['REMOTE_ADDR'];
			
			if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
				$data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];	
			} elseif(!empty($this->request->server['HTTP_CLIENT_IP'])) {
				$data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];	
			} else {
				$data['forwarded_ip'] = '';
			}
			
			if (isset($this->request->server['HTTP_USER_AGENT'])) {
				$data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];	
			} else {
				$data['user_agent'] = '';
			}
			
			if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
				$data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];	
			} else {
				$data['accept_language'] = '';
			}

			$this->load->model('checkout/order');

			$this->session->data['order_id'] = $this->model_checkout_order->addOrder($data);
			
			$this->data['column_name'] = $this->language->get('column_name');
			$this->data['column_model'] = $this->language->get('column_model');
			$this->data['column_quantity'] = $this->language->get('column_quantity');
			$this->data['column_price'] = $this->language->get('column_price');
			$this->data['column_total'] = $this->language->get('column_total');
	
			$this->data['products'] = array();
	
			foreach ($this->cart->getProducts() as $product) {
				$option_data = array();
	
				foreach ($product['option'] as $option) {
					if ($option['type'] != 'file') {
						$value = $option['option_value'];	
					} else {
						$filename = $this->encryption->decrypt($option['option_value']);
						
						$value = utf8_substr($filename, 0, utf8_strrpos($filename, '.'));
					}
										
					$option_data[] = array(
						'name'  => $option['name'],
						'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value)
					);
				}  

				$this->data['products'][] = array(
					'product_id' => $product['product_id'],
					'name'       => $product['name'],
					'model'      => $product['model'],
					'option'     => $option_data,
					'quantity'   => $product['quantity'],
					'subtract'   => $product['subtract'],
					'price'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'))),
					'total'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']),
					'href'       => $this->url->link('product/product', 'product_id=' . $product['product_id'])
				); 
			} 
			
			// Gift Voucher
			$this->data['vouchers'] = array();
			
			if (!empty($this->session->data['vouchers'])) {
				foreach ($this->session->data['vouchers'] as $voucher) {
					$this->data['vouchers'][] = array(
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount'])
					);
				}
			}  
						
			$this->data['totals'] = $total_data;
	
			$this->data['payment'] = $this->getChild('payment/' . $this->session->data['payment_method']['code']);
		} else {
			$this->data['redirect'] = $redirect;
		}			
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/confirm.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/checkout/confirm.tpl';
		} else {
			$this->template = 'default/template/checkout/confirm.tpl';
		}
		
		$this->response->setOutput($this->render());	
  	}

	public function downpdf(){
          header('Set-Cookie: fileDownload=true; path=/');
          header('Cache-Control: max-age=60, must-revalidate');
          header("Content-type: application/pdf");
          $rfile=$this->createInfoPdf($this->request->get['type'],$this->request->get['prid']);
          if($rfile){
            $jname=explode('/',$rfile);
            header('Content-Disposition: attachment; filename="'.$jname[1].'"');
            readfile($rfile);
          }
        }

        private function createInfoPdf($kinda,$idpro){
          include(DIR_TCPDF.'tcpdf.php');
          $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
          $pdf->SetCreator(PDF_CREATOR);
          $pdf->SetAuthor( $this->config->get('config_title') );
          $pdf->SetTitle( $this->config->get('config_title').' Informacion '.$idpro);
          $pdf->SetSubject( $this->config->get('config_title').' Informacion '.$idpro );
          $pdf->SetHeaderData(null, null, ' Informacion '.$idpro,null);
          $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
          $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
          $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
          $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
          $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
          $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
          $pdf->AddPage();
          $whtml='<table><tr><td><h1 style="text-align:center;">'.$this->string2pdf($this->config->get('config_title')).'</h1><p>';
          $whtml.=$this->string2pdf($this->config->get('config_owner')).'</p></td> <td><img src="image/data/logo web.png"></td>';
          $whtml.='</tr><tr><td colspan="2"><p>'.$this->string2pdf($this->config->get('config_address'));
          $whtml.='<br />'.$this->string2pdf($this->config->get('config_telephone')).'</p></td></tr></table>';
          $this->namefilepdf='';

            $info=$this->db->query('select name,description from oc_product_description where product_id='.$idpro);
            if(!$info){ return false; }
            $whtml.='<p style="border-top:solid 3px black;width:100%;"></p><br><br>';
            if($kinda==1){
              if(strlen($this->namefilepdf)==0){ $this->namefilepdf='Informacion_Circuito_'.str_replace(' ','_',$info->rows[0]['name']); }
              $increc=$this->db->query('select * from circuitos_incnoinc where id_producto='.$idpro);
              $hotels=$this->db->query('select circuitos_hoteles.*,name,description,servicios,image from circuitos_hoteles
                left join oc_product_description on oc_product_description.product_id=circuitos_hoteles.hotel
                left join hoteles_servs on hoteles_servs.id_producto=circuitos_hoteles.hotel
                left join oc_product_image on oc_product_image.product_id=circuitos_hoteles.hotel
                where circuitos_hoteles.id_producto='.$idpro.' order by idcircuitos_hoteles');
              $whtml.='<h1 style="text-align:center;">'.$this->string2pdf($info->rows[0]['name']).'</h1> <p>Salidas y costos:';
              $types=array(0=>'Sencilla',1=>'Doble',2=>'Triple',3=>'Cuadruple',4=>'Suplemento');
              $consulta="SELECT tipo, estrellas, finicio, ffin, ciudad,precio FROM circuitos,circuitos_salidas,circuitos_cddsal ";
              $consulta.="WHERE circuitos.id_producto='".$idpro."' and circuitos.id_producto=circuitos_salidas.id_producto and ";
              $consulta.="circuitos.idsalida=circuitos_salidas.idcircuitos_salidas and circuitos_salidas.idcdd=";
              $consulta.="circuitos_cddsal.idcsal order by estrellas asc";
              $query = $this->db->query($consulta);
              if(!$increc || !$hotels || !$query){ return false; }
              for($row=0;$row<count($query->rows);$row++){
                $catgst=$query->rows[$row]['estrellas'];
                $result=$query->rows[$row];
                $dataopc=array();
                $dataopc['estrellas']=$catgst;
                $dataopc['finicio']=$this->formatDate($result['finicio']);
                $dataopc['ffin']=$this->formatDate($result['ffin']);
                $dataopc['ciudad']=$result['ciudad'];
                while($catgst==$result['estrellas']){
                  $result=$query->rows[$row];
                  $dataopc[$result['tipo']]=$result['precio'];
                  $catgst=($row+1<count($query->rows)?$query->rows[++$row]['estrellas']:-1);
                }
                if($catgst!=-1 && $row<count($query->rows) && $query->rows[$row]['estrellas']!=$query->rows[$row-1]['estrellas']){ $row--; }
                  $whtml.='<div><h4>Desde '.$dataopc['ciudad'].' hospedaje categoria: '.$dataopc['estrellas'].'*</h4><ul>';
                  for($fgh=0;$fgh<count($types);$fgh++){
                    if( isset($dataopc[$types[$fgh]]) ){
                      $tprecio=$dataopc[$types[$fgh]];
                      $whtml.='<li>Habitacion '.$types[$fgh].' x '.$this->currency->format($tprecio).'</li>';
                    }
                  }
                  $whtml.='</ul>(Durante '.$dataopc['finicio'].' a '.$dataopc['ffin'].')</div>';
              }
              $whtml.='</p><h3>Itinerario</h3> <div>';
              $whtml.=$this->string2pdf($info->rows[0]['description']).'</div> <h3>Incluye/No incluye</h3> <div>';
              $whtml.=(isset($increc->rows[0]['incnoinc'])?$this->string2pdf($increc->rows[0]['incnoinc']):'').'</div> <h3>Recomendaciones</h3> <div>';
              $whtml.=(isset($increc->rows[0]['recomens'])?$this->string2pdf($increc->rows[0]['recomens']):'').'</div> <h3>Hoteles</h3> <div>';
              for($cp=0;$cp<count($hotels->rows);$cp++){
                $whtml.=$this->string2pdf($hotels->rows[$cp]['name'].' en '.$hotels->rows[$cp]['ciudad']).'<br />';
                do{
                  if($hotels->rows[$cp]['image']!=null && $hotels->rows[$cp]['image']!=''){
                    $whtml.='<img src="image/'.$hotels->rows[$cp]['image'].'" /> <br />';
                  }
                  $cp++;
                }while( $cp<count($hotels->rows) && $hotels->rows[$cp-1]['idcircuitos_hoteles']==$hotels->rows[$cp]['idcircuitos_hoteles']);
                $cp--;
                if($hotels->rows[$cp]['description']!=null){
                  $whtml.='<div>'.$this->string2pdf($hotels->rows[$cp]['description']).'</div>';
                }if($hotels->rows[$cp]['servicios']!=null){
                  $whtml.='<div>'.$this->string2pdf($hotels->rows[$cp]['servicios']).'</div>';
                }
              } $whtml.='</div>';
            }else if($kinda==2){
              if(strlen($this->namefilepdf)==0){ $this->namefilepdf='Informacion_Hotel_'.str_replace(' ','_',$info->rows[0]['name']); }
              $recoms=$this->db->query('select * from hoteles_servs where id_producto='.$idpro);
              $catghr=$this->db->query('select * from hotels_ctgs where idprod='.$idpro);
              $whtml.='<h1>'.$this->string2pdf($info->rows[0]['name']).' '.$catghr->rows[0]['catg'].'*</h1><div>Costo de habitaciones';
              $whtml.='<br />(Hora de entrada: '.$catghr->rows[0]['hhini'].', hora de salida: '.$catghr->rows[0]['hhsal'].')<br />';
              $consulta="SELECT tipo,precio,finicio,ffin FROM  habitaciones WHERE id_producto='".$idpro."' and habilitado=1";
              $query = $this->db->query($consulta);
              if(!$recoms || !$catghr || !$query){ return false; }
              $whtml.='<table border="1"><tr> <td style="text-align:center;">Sencilla</td>';
              $whtml.='<td style="text-align:center;">Doble</td> <td style="text-align:center;">Triple</td>';
              $whtml.='<td style="text-align:center;">Cuadruple</td> </tr> ';
              $datas=array( );
              $cnt1=0; $cnt2=0; $cnt3=0; $cnt4=0;
              foreach($query->rows as $result){
                if($result['tipo']=='Sencilla'){
                  $datas[$cnt1][1]=$result; $cnt1++;
                }else if($result['tipo']=='Doble'){
                  $datas[$cnt2][2]=$result; $cnt2++;
                }else if($result['tipo']=='Triple'){
                  $datas[$cnt3][3]=$result; $cnt3++;
                }else if($result['tipo']=='Cuadruple'){
                  $datas[$cnt4][4]=$result; $cnt4++;
                }
              }
              foreach($datas as $rowhabitn){
                $whtml.='<tr>';
                if(isset($rowhabitn[1])){
                  $whtml.='<td style="text-align:center;">'.$this->currency->format($rowhabitn[1]['precio']).'<br />(Vigente:<br />';
                  $whtml.=$this->formatDate($rowhabitn[1]['finicio']).'<br />'.$this->formatDate($rowhabitn[1]['ffin']).') </td>';
                }else if(!isset($rowhabitn[1])){ $whtml.='<td> </td>'; }
                if(isset($rowhabitn[2])){
                  $whtml.='<td style="text-align:center;">'.$this->currency->format($rowhabitn[2]['precio']).'<br />(Vigente:<br />';
                  $whtml.=$this->formatDate($rowhabitn[2]['finicio']).'<br />'.$this->formatDate($rowhabitn[2]['ffin']).') </td>';
                }else if(!isset($rowhabitn[2])){ $whtml.='<td> </td>'; }
                if(isset($rowhabitn[3])){
                  $whtml.='<td style="text-align:center;">'.$this->currency->format($rowhabitn[3]['precio']).'<br />(Vigente:<br />';
                  $whtml.=$this->formatDate($rowhabitn[3]['finicio']).'<br />'.$this->formatDate($rowhabitn[3]['ffin']).') </td>';
                }else if(!isset($rowhabitn[3])){ $whtml.='<td> </td>'; }
                      if(isset($rowhabitn[4])){
                  $whtml.='<td style="text-align:center;">'.$this->currency->format($rowhabitn[4]['precio']).'<br />(Vigente:<br />';
                  $whtml.=$this->formatDate($rowhabitn[4]['finicio']).'<br />'.$this->formatDate($rowhabitn[4]['ffin']).') </td>';
                }else if(!isset($rowhabitn[4])){ $whtml.='<td> </td>'; }
                $whtml.='</tr>';
              } $whtml.='</table>';

              $whtml.='</div><h3>Hotel</h3> <div>';
              $whtml.=$this->string2pdf($info->rows[0]['description']).'</div> <h3>Servicios</h3> <div>';
              $whtml.=$this->string2pdf($recoms->rows[0]['servicios']).'</div> ';
            }else if($kinda==3){
              if(strlen($this->namefilepdf)==0){ $this->namefilepdf='Informacion_Tour_'.str_replace(' ','_',$info->rows[0]['name']); }
              $increc=$this->db->query('select * from circuitos_incnoinc where id_producto='.$idpro);
              $whtml.='<h2>'.$this->string2pdf($info->rows[0]['name']).'</h2><p>Salidas y costos</p>';
              $types=array(0=>'Adulta',1=>'INSEN',2=>'Menor');
              $consulta="SELECT tours.tipo, tours.precio, circuitos_salidas.finicio, circuitos_salidas.ffin, ciudad FROM tours,";
              $consulta.="circuitos_salidas,circuitos_cddsal WHERE circuitos_cddsal.idprod='".$idpro."'  and circuitos_salidas.idcdd=";
              $consulta.="circuitos_cddsal.idcsal and tours.id_producto=circuitos_salidas.id_producto AND circuitos_cddsal.idprod=tours.";
              $consulta.="id_producto and tours.idsalida=circuitos_salidas.idcircuitos_salidas group by idtours order by ciudad,tipo";
              $query = $this->db->query($consulta);
              if(!$increc || !$query){ return false; }
              $dataopc=array();
              for($row=0;$row<count($query->rows);$row++){
                $cityc=$query->rows[$row]['ciudad'];
                $result=$query->rows[$row];
                $dataopc=array();
                $dataopc['ciudad']=$cityc;
                $dataopc['finicio']=$this->formatDate($result['finicio']);
                $dataopc['ffin']=$this->formatDate($result['ffin']);
                $dataopc['precio']=$result['precio'];
                while($cityc==$result['ciudad']){
                  $result=$query->rows[$row];
                  $dataopc[$result['tipo']]=$result['precio'];
                  $cityc=($row+1<count($query->rows)?$query->rows[++$row]['ciudad']:-1);
                }
                if($row<count($query->rows) && $query->rows[$row]['ciudad']!=$query->rows[$row-1]['ciudad']){ $row--; }
                  $whtml.='<div><h4>Desde '.$this->string2pdf($dataopc['ciudad']).'</h4><ul>';
                  for($fgh=0;$fgh<count($types);$fgh++){
                    if( isset($dataopc[$types[$fgh]]) ){
                      $tprecio=$dataopc[$types[$fgh]];
                      $whtml.='<li>Persona '.$types[$fgh].' x '.$this->currency->format($tprecio).'</li>';
                    }
                  }
                  $whtml.='</ul>(Durante '.$dataopc['finicio'].' a '.$dataopc['ffin'].')</div>';
              }
              $whtml.='<h3>Itinerario</h3> <div>';
              $whtml.=$this->string2pdf($info->rows[0]['description']).'</div> <h3>Incluye/No incluye</h3> <div>';
              $whtml.=$this->string2pdf($increc->rows[0]['incnoinc']).'</div> <h3>Recomendaciones</h3> <div>';
              $whtml.=$this->string2pdf($increc->rows[0]['recomens']).'</div> ';
            }else if($kinda==4){
              if(strlen($this->namefilepdf)==0){ $this->namefilepdf='Informacion_Traslado_'.str_replace(' ','_',$info->rows[0]['name']); }
              $whtml.='<h2>'.$this->string2pdf($info->rows[0]['name']).'</h2><p>Costos y salidas</p>';
              $consulta="SELECT * FROM traslados WHERE id_producto=".$idpro;
              $sentence="SELECT * FROM traslados_salidas WHERE id_producto=".$idpro;
              $data=$this->db->query($consulta);
              $saliendos=$this->db->query($sentence);
              if(!$data || !$saliendos){ return false; }
              $whtml.='<div>Desde '.$data->rows[0]['origen'].' hacia '.$data->rows[0]['destino'].', costos: ';
              $whtml.='<ul> <li>Adulto '.$this->currency->format($data->rows[0]['pre_adult']).'</li> <li>Infante ';
              $whtml.=$this->currency->format($data->rows[0]['pre_inft']).'</li> <li>Insen ';
              $whtml.=$this->currency->format($data->rows[0]['pre_insen']).'</ul> Salidas <ul>';
              for($row=0;$row<count($saliendos->rows);$row++){
                  $whtml.='<li>Fecha '.$this->formatDate($saliendos->rows[$row]['fecha']).' a las '.$saliendos->rows[$row]['hora'];
                  $whtml.=', via '.$saliendos->rows[$row]['via'].'</li>';
              }
              $whtml.='</ul></div><h3>Descripcion</h3> <div>';
              $whtml.=$this->string2pdf($info->rows[0]['description']).'</div>';
            }
          $pdf->writeHTMLCell(0,0,'','',$whtml,0,1,false,true,'',true);
          $pdf->Output('orders_pdf/'.$this->namefilepdf.'.pdf','F');
          return 'orders_pdf/'.$this->namefilepdf.'.pdf';
        }

        private function string2pdf($cad){
          $step0=trim($cad);
          $step2=preg_replace("/\s|&nbsp;|&amp;nbsp;/",' ',$step0);
          $step0=html_entity_decode($step2,ENT_NOQUOTES);
          return utf8_decode($step0);
        }
        
        private function formatDate($date){
          $tks=explode(' ',$date);
          return $tks[0];
        }


	public function send2MailInfoPdf(){
          // create pdf, send pdf by mail
          $json = array();
          $remit=$this->request->post['remit'];
          $nameDest=$this->request->post['ddest'];
          $mailDest=$this->request->post['tomail'];
          $ides=$this->request->post['idsn'];
          $captcha=$this->request->post['captcha'];
          if(trim($remit)==''){
            $json['error']='Indique su nombre';
          }else if(trim($nameDest)==''){
            $json['error']='Indique nombre del destinatario';
          }else if(trim($mailDest)==''){
            $json['error']='Indique email del destinatario';
          }else if( empty($this->session->data['captcha']) || ($this->session->data['captcha']!=$captcha) ){
            $json['error']='Captcha incorrecto';
          }else{
            $ids=explode('_',$ides);
            $rfile=$this->createInfoPdf($ids[0],$ids[1]);
            if($rfile){
              $this->sendPdfInfoToMail($rfile,$remit,$nameDest,$mailDest);
              $json['success']='Informacion enviada a '.$mailDest;
            }else{
              $json['error']='Error al concentrar informacion';
            }
          }
          $this->response->setOutput(json_encode($json));
        }

        private function sendPdfInfoToMail($pathfile,$nameFrom,$nameTo,$mailTo){
            $mail = new Mail();
            $subject=$nameFrom.' ha compartido esto contigo';
            $html=$nameFrom.' ha compartido esta informaci&oacute;n contigo, desde '.$this->config->get('config_title');
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->hostname = $this->config->get('config_smtp_host');
            $mail->username = $this->config->get('config_smtp_username');
            $mail->password = $this->config->get('config_smtp_password');
            $mail->port = $this->config->get('config_smtp_port');
            $mail->timeout = $this->config->get('config_smtp_timeout');
            $mail->setTo($mailTo);
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender($mailTo);
            $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
            $mail->setHtml($html);
            $mail->setText(html_entity_decode($html, ENT_QUOTES, 'UTF-8'));
              // adding pdf to mail
            $mail->addAttachment($pathfile);
            $mail->send();
        }
}
?>