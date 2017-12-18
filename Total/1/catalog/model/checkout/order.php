<?php
class ModelCheckoutOrder extends Model {

  private $namefilepdf;

	public function addOrder($data){
                if( substr_count($data['payment_method'],'dineromail.png')>0 ){
                     $data['payment_method']='DineroMail';
                }
		$this->db->query("INSERT INTO `".DB_PREFIX."order` SET invoice_prefix = '".$this->db->escape($data['invoice_prefix']).
                  "', store_id = '".(int)$data['store_id']."', store_name = '".$this->db->escape($data['store_name']).
                  "', store_url = '".$this->db->escape($data['store_url'])."', customer_id = '".(int)$data['customer_id'].
                  "', customer_group_id = '".(int)$data['customer_group_id']."', firstname = '".$this->db->escape($data['firstname']).
                  "', lastname = '".$this->db->escape($data['lastname'])."', email = '".$this->db->escape($data['email']).
                  "', telephone = '".$this->db->escape($data['telephone'])."', fax = '".$this->db->escape($data['fax']).
                  "', payment_firstname = '".$this->db->escape($data['payment_firstname'])."', payment_lastname = '".
                  $this->db->escape($data['payment_lastname'])."', payment_company = '".
                  $this->db->escape($data['payment_company'])."', payment_company_id = '".
                  $this->db->escape($data['payment_company_id'])."', payment_tax_id = '".
                  $this->db->escape($data['payment_tax_id'])."', payment_address_1 = '".
                  $this->db->escape($data['payment_address_1'])."', payment_address_2 = '".
                  $this->db->escape($data['payment_address_2'])."', payment_city = '".$this->db->escape($data['payment_city']).
                  "', payment_postcode = '".$this->db->escape($data['payment_postcode'])."', payment_country = '".
                  $this->db->escape($data['payment_country'])."', payment_country_id = '".(int)$data['payment_country_id'].
                  "', payment_zone = '".$this->db->escape($data['payment_zone'])."', payment_zone_id = '".
                  (int)$data['payment_zone_id'] . "', payment_address_format = '".$this->db->escape($data['payment_address_format']).
                  "', payment_method='".$this->db->escape($data['payment_method'])."', payment_code = '".
                  $this->db->escape($data['payment_code'])."', shipping_firstname = '".
                  $this->db->escape($data['shipping_firstname'])."', shipping_lastname = '".
                  $this->db->escape($data['shipping_lastname'])."', shipping_company = '".
                  $this->db->escape($data['shipping_company'])."', shipping_address_1 = '".
                  $this->db->escape($data['shipping_address_1'])."', shipping_address_2 = '".
                  $this->db->escape($data['shipping_address_2'])."', shipping_city = '".$this->db->escape($data['shipping_city']).
                  "', shipping_postcode = '".$this->db->escape($data['shipping_postcode'])."', shipping_country = '".
                  $this->db->escape($data['shipping_country'])."', shipping_country_id = '".
                  (int)$data['shipping_country_id']."', shipping_zone = '".$this->db->escape($data['shipping_zone']).
                  "', shipping_zone_id = '".(int)$data['shipping_zone_id']."', shipping_address_format = '".
                  $this->db->escape($data['shipping_address_format'])."', shipping_method = '".
                  $this->db->escape($data['shipping_method'])."', shipping_code = '".$this->db->escape($data['shipping_code']).
                  "', comment = '".$this->db->escape($data['comment'])."', total = '".(float)$data['total']."', affiliate_id = '".
                  (int)$data['affiliate_id']."', commission = '".(float)$data['commission']."', language_id = '".
                  (int)$data['language_id'] . "', currency_id = '" . (int)$data['currency_id'] . "', currency_code = '" . $this->db->escape($data['currency_code']) . "', currency_value = '" . (float)$data['currency_value'] . "', ip = '" . $this->db->escape($data['ip']) . "', forwarded_ip = '" .  $this->db->escape($data['forwarded_ip']) . "', user_agent = '" . $this->db->escape($data['user_agent']) . "', accept_language = '" . $this->db->escape($data['accept_language']) . "', date_added = NOW(), date_modified = NOW()");
		$order_id = $this->db->getLastId();
		foreach ($data['products'] as $product){
              //echo '<pre>'; print_r($product); echo '</pre>'; return 0;
			$this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET order_id = '" . (int)$order_id . "', product_id = '" . (int)$product['product_id'] . "', name = '" . $this->db->escape($product['name']) . "', model = '" . $this->db->escape($product['model']) . "', quantity = '" . (int)$product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "', tax = '" . (float)$product['tax'] . "', reward = '" . (int)$product['reward'] . "'");
			$order_product_id=$this->db->getLastId();
			$exdta=$product['extendta'];
                     //echo '<pre>'; print_r($exdta); echo '</pre>'; return 0;
                     // personas
			  for($nkw=0;$nkw<$exdta['npersonas'];$nkw++){
                            $customquery="INSERT INTO personas values(default,$order_id,'".$exdta['nomper'.$nkw]."',";
                            $customquery.="'".$exdta['dirper'.$nkw]."',null,null,null,null,'".$exdta['telper'.$nkw]."','";
                            $customquery.=$exdta['emlper'.$nkw]."',".$exdta['prage'.$nkw].",".$product['product_id'].")";
       			    $this->db->query($customquery);
                          }
			//habitaciones
			if($exdta['kndapro']==1 || $exdta['kndapro']==2){
  			  for($nkw=0;$nkw<$exdta['tthabs'];$nkw++){
                            $customquery="INSERT INTO ord_habs values(default,$order_id,'".$exdta['habtp_'.$nkw]."','".$exdta['habct_'.$nkw];
                            $customquery.="',".$exdta['habcs_'.$nkw].",".$exdta['habnm_'.$nkw].",".$product['product_id'].")";
     			    $this->db->query($customquery);
                          }
                        }
			//general complementario
			$customquery="INSERT INTO ord_resrv values(default,$order_id,'".$exdta['finicio']."',";
                        $customquery.=(isset($exdta['cddsal'])?"'".trim($exdta['cddsal'])."'":'null').",";
                        $customquery.=(isset($exdta['ffin'])?"'".$exdta['ffin']."'":'null').",".$product['product_id'].")";
 			$this->db->query($customquery);
			foreach ($product['option'] as $option) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_option SET order_id = '" . (int)$order_id . "', order_product_id = '" . (int)$order_product_id . "', product_option_id = '" . (int)$option['product_option_id'] . "', product_option_value_id = '" . (int)$option['product_option_value_id'] . "', name = '" . $this->db->escape($option['name']) . "', `value` = '" . $this->db->escape($option['value']) . "', `type` = '" . $this->db->escape($option['type']) . "'");
			}
			foreach ($product['download'] as $download) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_download SET order_id = '" . (int)$order_id . "', order_product_id = '" . (int)$order_product_id . "', name = '" . $this->db->escape($download['name']) . "', filename = '" . $this->db->escape($download['filename']) . "', mask = '" . $this->db->escape($download['mask']) . "', remaining = '" . (int)($download['remaining'] * $product['quantity']) . "'");
			}
		}
                // generar pdf
                $this->createPdf($data['products'],$order_id);
		foreach ($data['vouchers'] as $voucher) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "order_voucher SET order_id = '" . (int)$order_id . "', description = '" . $this->db->escape($voucher['description']) . "', code = '" . $this->db->escape($voucher['code']) . "', from_name = '" . $this->db->escape($voucher['from_name']) . "', from_email = '" . $this->db->escape($voucher['from_email']) . "', to_name = '" . $this->db->escape($voucher['to_name']) . "', to_email = '" . $this->db->escape($voucher['to_email']) . "', voucher_theme_id = '" . (int)$voucher['voucher_theme_id'] . "', message = '" . $this->db->escape($voucher['message']) . "', amount = '" . (float)$voucher['amount'] . "'");
		}
		foreach ($data['totals'] as $total) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "order_total SET order_id = '" . (int)$order_id . "', code = '" . $this->db->escape($total['code']) . "', title = '" . $this->db->escape($total['title']) . "', text = '" . $this->db->escape($total['text']) . "', `value` = '" . (float)$total['value'] . "', sort_order = '" . (int)$total['sort_order'] . "'");
		}
		return $order_id;
	}

        public function createPdf($products,$idorder){
          include(DIR_TCPDF.'tcpdf.php');
          $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
          $pdf->SetCreator(PDF_CREATOR);
          $pdf->SetAuthor( $this->config->get('config_title') );
          $pdf->SetTitle( $this->config->get('config_title').' orden '.$idorder);
          $pdf->SetSubject( $this->config->get('config_title').' orden '.$idorder );
          $pdf->SetHeaderData(null, null, ' Orden '.$idorder,null);
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
          foreach($products as $pro){
   // echo '<pre>'; print_r($pro); echo '</pre>';
            $pro_data=$pro['extendta'];
            $descru=$this->db->query('select description from oc_product_description where product_id='.$pro_data['product_id']);
            $whtml.='<p style="border-top:solid 3px black;width:100%;"></p><br><br>';
            if($pro_data['kndapro']==1){
              if(strlen($this->namefilepdf)==0){ $this->namefilepdf='Circuito_'.str_replace(' ','_',$pro['name']); }
              $increc=$this->db->query('select * from circuitos_incnoinc where id_producto='.$pro_data['product_id']);
              $hotels=$this->db->query('select circuitos_hoteles.*,name,description,servicios,image from circuitos_hoteles left join oc_product_description on oc_product_description.product_id=circuitos_hoteles.hotel left join hoteles_servs on hoteles_servs.id_producto=circuitos_hoteles.hotel left join oc_product_image on oc_product_image.product_id=circuitos_hoteles.hotel where circuitos_hoteles.id_producto='.$pro_data['product_id'].' order by idcircuitos_hoteles');
              $whtml.='<h2>'.$this->string2pdf($pro['name']).'</h2><p>Saliendo de '.trim($pro_data['cddsal']).' en '.trim($pro_data['finicio']).'<br />Para ';
              $whtml.=$pro_data['npersonas'].' personas<br />Habitaciones:</p><table><tr> <td>Habitacion </td> <td>Costo </td> </tr>';
              for($gy=0;$gy<$pro_data['tthabs'];$gy++){ $prshab=1;
                $prshab=(trim($pro_data['habtp_'.$gy])=='Doble'?2:(trim($pro_data['habtp_'.$gy])=='Triple'?3:$prshab));
                $prshab=(trim($pro_data['habtp_'.$gy])=='Cuadruple'?4:$prshab);
                $whtml.='<tr> <td>'.$pro_data['habnm_'.$gy].' '.trim($pro_data['habtp_'.$gy]).'</td> <td>';
                $whtml.=$this->currency->format($pro_data['habnm_'.$gy]*$pro_data['habcs_'.$gy]*$prshab).'</td> </tr>';
              }
              $whtml.='<tr> <td></td> <td>'.$this->currency->format($pro_data['ttcosto']).'</td> </tr> </table> <h3>Itinerario</h3> <div>';
              $whtml.=$this->string2pdf($descru->rows[0]['description']).'</div> <h3>Incluye/No incluye</h3> <div>';
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
            }else if($pro_data['kndapro']==2){
              if(strlen($this->namefilepdf)==0){ $this->namefilepdf='Hotel_'.str_replace(' ','_',$pro['name']); }
              $recoms=$this->db->query('select * from hoteles_servs where id_producto='.$pro_data['product_id']);
              $whtml.='<h2>'.$this->string2pdf($pro['name']).'</h2><p>Inicia en ';
              $whtml.=trim($pro_data['finicio']).' hasta '.trim($pro_data['ffin']).'<br />Para ';
              $nrevdias=$this->diffDays(trim($pro_data['finicio']),trim($pro_data['ffin'])); $gettedhabs=''; $ttperscnt=0;
              for($gy=0;$gy<$pro_data['tthabs'];$gy++){
                if($pro_data['habtp_'.$gy]=='Sencilla'){ $ttperscnt+=$pro_data['habnm_'.$gy]; }
                else if($pro_data['habtp_'.$gy]=='Doble'){ $ttperscnt+=($pro_data['habnm_'.$gy]*2); }
                else if($pro_data['habtp_'.$gy]=='Triple'){ $ttperscnt+=($pro_data['habnm_'.$gy]*3); }
                else if($pro_data['habtp_'.$gy]=='Cuadruple'){ $ttperscnt+=($pro_data['habnm_'.$gy]*4); }
                $gettedhabs.='<tr> <td>'.$pro_data['habnm_'.$gy].' '.trim($pro_data['habtp_'.$gy]).'</td> <td>';
                $gettedhabs.=$this->currency->format($nrevdias*$pro_data['habnm_'.$gy]*$pro_data['habcs_'.$gy]).'</td> </tr>';
              }
              $whtml.=$ttperscnt.' personas<br />Habitaciones:</p><table><tr> <td>Habitacion </td> <td>Costo </td> </tr>'.$gettedhabs;
              $whtml.='<tr> <td></td> <td>'.$this->currency->format($pro_data['ttcosto']).'</td> </tr> </table> <h3>Hotel</h3> <div>';
              $whtml.=$this->string2pdf($descru->rows[0]['description']).'</div> <h3>Servicios</h3> <div>';
              $whtml.=$this->string2pdf($recoms->rows[0]['servicios']).'</div> ';
            }else if($pro_data['kndapro']==3){
              if(strlen($this->namefilepdf)==0){ $this->namefilepdf='Tour_'.str_replace(' ','_',$pro['name']); }
              $increc=$this->db->query('select * from circuitos_incnoinc where id_producto='.$pro_data['product_id']);
              $whtml.='<h2>'.$this->string2pdf($pro['name']).'</h2><p>Saliendo de '.trim($pro_data['cddsal']).' en '.trim($pro_data['finicio']).'<br />Para ';
              $whtml.=$pro_data['npersonas'].' personas<br />Personas:</p><table><tr> <td>Personas </td> <td>Costo </td> </tr>';
              $arrpers=array( 'a'=>array('num'=>0,'cst'=>0), 'm'=>array('num'=>0,'cst'=>0), 'i'=>array('num'=>0,'cst'=>0) );
              for($gy=0;$gy<$pro_data['npersonas'];$gy++){
                if($pro_data['prage'.$gy]==1){ $lttr='a'; }
                else if($pro_data['prage'.$gy]==0){ $lttr='m'; }
                else if($pro_data['prage'.$gy]==2){ $lttr='i'; }
                $arrpers[$lttr]['cst']+=$pro_data['prtpre'.$gy]; $arrpers[$lttr]['num']++;
              }
              if($arrpers['a']['num']>0){
                $whtml.='<tr> <td>'.$arrpers['a']['num'].' Adultos</td> <td>'.$this->currency->format($arrpers['a']['cst']).'</td> </tr>';
              }if($arrpers['m']['num']>0){
                $whtml.='<tr> <td>'.$arrpers['m']['num'].' Menores</td> <td>'.$this->currency->format($arrpers['m']['cst']).'</td> </tr>';
              }if($arrpers['i']['num']>0){
                $whtml.='<tr> <td>'.$arrpers['i']['num'].' INSEN</td> <td>'.$this->currency->format($arrpers['i']['cst']).'</td> </tr>';
              }
              $whtml.='<tr> <td></td> <td>'.$this->currency->format($pro_data['ttcosto']).'</td> </tr> </table> <h3>Itinerario</h3> <div>';
              $whtml.=$this->string2pdf($descru->rows[0]['description']).'</div> <h3>Incluye/No incluye</h3> <div>';
              $whtml.=$this->string2pdf($increc->rows[0]['incnoinc']).'</div> <h3>Recomendaciones</h3> <div>';
              $whtml.=$this->string2pdf($increc->rows[0]['recomens']).'</div> ';
            }else if($pro_data['kndapro']==4){
              if(strlen($this->namefilepdf)==0){ $this->namefilepdf='Traslado_'.str_replace(' ','_',$pro['name']); }
              $whtml.='<h2>'.$this->string2pdf($pro['name']).'</h2><p>Saliendo en '.trim($pro_data['cddsal']).'<br />Para ';
              $whtml.=$pro_data['npersonas'].' personas.</p><table><tr> <td>Personas </td> <td>Costo </td> </tr>';
              $arrpers=array( 'a'=>array('num'=>0,'cst'=>0), 'm'=>array('num'=>0,'cst'=>0), 'i'=>array('num'=>0,'cst'=>0) );
              for($gy=0;$gy<$pro_data['npersonas'];$gy++){
                if($pro_data['prage'.$gy]==1){ $lttr='a'; }
                else if($pro_data['prage'.$gy]==0){ $lttr='m'; }
                else if($pro_data['prage'.$gy]==2){ $lttr='i'; }
                $arrpers[$lttr]['cst']+=$pro_data['prtpre'.$gy]; $arrpers[$lttr]['num']++;
              }
              if($arrpers['a']['num']>0){
                $whtml.='<tr> <td>'.$arrpers['a']['num'].' Adultos</td> <td>'.$this->currency->format($arrpers['a']['cst']).'</td> </tr>';
              }if($arrpers['m']['num']>0){
                $whtml.='<tr> <td>'.$arrpers['m']['num'].' Menores</td> <td>'.$this->currency->format($arrpers['m']['cst']).'</td> </tr>';
              }if($arrpers['i']['num']>0){
                $whtml.='<tr> <td>'.$arrpers['i']['num'].' INSEN</td> <td>'.$this->currency->format($arrpers['i']['cst']).'</td> </tr>';
              }
              $whtml.='<tr> <td></td> <td>'.$this->currency->format($pro_data['ttcosto']).'</td> </tr> </table> <h3>Descripcion</h3> <div>';
              $whtml.=$this->string2pdf($descru->rows[0]['description']).'</div>';
            }
          }
          $pdf->writeHTMLCell(0,0,'','',$whtml,0,1,false,true,'',true);
          $salida=$pdf->Output('orders_pdf/'.$this->string2pdf($this->namefilepdf).'-'.$idorder.'.pdf','F');
          $this->db->query("INSERT INTO orders_pdf values(".$idorder.",'".$this->string2pdf($this->namefilepdf)."-".$idorder.".pdf')");
        //echo 'orders_pdf/order_'.$idorder.'.pdf  -> {'.$salida.'}';
        //echo '<div style="border:solid 2px red;">'.$whtml.'</div>';
        }

        private function string2pdf($cad){
          $step0=trim($cad);
          $step2=preg_replace("/\s|&nbsp;|&amp;nbsp;/",' ',$step0);
          $step0=html_entity_decode($step2,ENT_NOQUOTES);
          return utf8_decode($step0);
        }
        
        private function diffDays($date1,$date2){
          $dt1=explode('-',$date1);
          $dt2=explode('-',$date2);
          $tst1=mktime(0,0,0,$dt1[1],$dt1[2],$dt1[0]);
          $tst2=mktime(0,0,0,$dt2[1],$dt2[2],$dt2[0]);
          $diffsecs=$tst1-$tst2;
          $diffdias=floor(abs($diffsecs/(60*60*24)));
          return $diffdias;
        }

	public function getOrder($order_id) {
		$order_query = $this->db->query("SELECT *, (SELECT os.name FROM `" . DB_PREFIX . "order_status` os WHERE os.order_status_id = o.order_status_id AND os.language_id = o.language_id) AS order_status FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '" . (int)$order_id . "'");
			
		if ($order_query->num_rows) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['payment_country_id'] . "'");
			
			if ($country_query->num_rows) {
				$payment_iso_code_2 = $country_query->row['iso_code_2'];
				$payment_iso_code_3 = $country_query->row['iso_code_3'];
			} else {
				$payment_iso_code_2 = '';
				$payment_iso_code_3 = '';				
			}
			
			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['payment_zone_id'] . "'");
			
			if ($zone_query->num_rows) {
				$payment_zone_code = $zone_query->row['code'];
			} else {
				$payment_zone_code = '';
			}			
			
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['shipping_country_id'] . "'");
			
			if ($country_query->num_rows) {
				$shipping_iso_code_2 = $country_query->row['iso_code_2'];
				$shipping_iso_code_3 = $country_query->row['iso_code_3'];
			} else {
				$shipping_iso_code_2 = '';
				$shipping_iso_code_3 = '';				
			}
			
			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['shipping_zone_id'] . "'");
			
			if ($zone_query->num_rows) {
				$shipping_zone_code = $zone_query->row['code'];
			} else {
				$shipping_zone_code = '';
			}
			
			$this->load->model('localisation/language');
			
			$language_info = $this->model_localisation_language->getLanguage($order_query->row['language_id']);
			
			if ($language_info) {
				$language_code = $language_info['code'];
				$language_filename = $language_info['filename'];
				$language_directory = $language_info['directory'];
			} else {
				$language_code = '';
				$language_filename = '';
				$language_directory = '';
			}
		 			
			return array(
				'order_id'                => $order_query->row['order_id'],
				'invoice_no'              => $order_query->row['invoice_no'],
				'invoice_prefix'          => $order_query->row['invoice_prefix'],
				'store_id'                => $order_query->row['store_id'],
				'store_name'              => $order_query->row['store_name'],
				'store_url'               => $order_query->row['store_url'],				
				'customer_id'             => $order_query->row['customer_id'],
				'firstname'               => $order_query->row['firstname'],
				'lastname'                => $order_query->row['lastname'],
				'telephone'               => $order_query->row['telephone'],
				'fax'                     => $order_query->row['fax'],
				'email'                   => $order_query->row['email'],
				'payment_firstname'       => $order_query->row['payment_firstname'],
				'payment_lastname'        => $order_query->row['payment_lastname'],				
				'payment_company'         => $order_query->row['payment_company'],
				'payment_company_id'      => $order_query->row['payment_company_id'],
				'payment_tax_id'          => $order_query->row['payment_tax_id'],
				'payment_address_1'       => $order_query->row['payment_address_1'],
				'payment_address_2'       => $order_query->row['payment_address_2'],
				'payment_postcode'        => $order_query->row['payment_postcode'],
				'payment_city'            => $order_query->row['payment_city'],
				'payment_zone_id'         => $order_query->row['payment_zone_id'],
				'payment_zone'            => $order_query->row['payment_zone'],
				'payment_zone_code'       => $payment_zone_code,
				'payment_country_id'      => $order_query->row['payment_country_id'],
				'payment_country'         => $order_query->row['payment_country'],	
				'payment_iso_code_2'      => $payment_iso_code_2,
				'payment_iso_code_3'      => $payment_iso_code_3,
				'payment_address_format'  => $order_query->row['payment_address_format'],
				'payment_method'          => $order_query->row['payment_method'],
				'payment_code'            => $order_query->row['payment_code'],
				'shipping_firstname'      => $order_query->row['shipping_firstname'],
				'shipping_lastname'       => $order_query->row['shipping_lastname'],				
				'shipping_company'        => $order_query->row['shipping_company'],
				'shipping_address_1'      => $order_query->row['shipping_address_1'],
				'shipping_address_2'      => $order_query->row['shipping_address_2'],
				'shipping_postcode'       => $order_query->row['shipping_postcode'],
				'shipping_city'           => $order_query->row['shipping_city'],
				'shipping_zone_id'        => $order_query->row['shipping_zone_id'],
				'shipping_zone'           => $order_query->row['shipping_zone'],
				'shipping_zone_code'      => $shipping_zone_code,
				'shipping_country_id'     => $order_query->row['shipping_country_id'],
				'shipping_country'        => $order_query->row['shipping_country'],	
				'shipping_iso_code_2'     => $shipping_iso_code_2,
				'shipping_iso_code_3'     => $shipping_iso_code_3,
				'shipping_address_format' => $order_query->row['shipping_address_format'],
				'shipping_method'         => $order_query->row['shipping_method'],
				'shipping_code'           => $order_query->row['shipping_code'],
				'comment'                 => $order_query->row['comment'],
				'total'                   => $order_query->row['total'],
				'order_status_id'         => $order_query->row['order_status_id'],
				'order_status'            => $order_query->row['order_status'],
				'language_id'             => $order_query->row['language_id'],
				'language_code'           => $language_code,
				'language_filename'       => $language_filename,
				'language_directory'      => $language_directory,
				'currency_id'             => $order_query->row['currency_id'],
				'currency_code'           => $order_query->row['currency_code'],
				'currency_value'          => $order_query->row['currency_value'],
				'ip'                      => $order_query->row['ip'],
				'forwarded_ip'            => $order_query->row['forwarded_ip'], 
				'user_agent'              => $order_query->row['user_agent'],	
				'accept_language'         => $order_query->row['accept_language'],				
				'date_modified'           => $order_query->row['date_modified'],
				'date_added'              => $order_query->row['date_added']
			);
		} else {
			return false;	
		}
	}	

	public function confirm($order_id, $order_status_id, $comment = '', $notify = false) {
		$order_info = $this->getOrder($order_id);
		 
		if ($order_info && !$order_info['order_status_id']) {
			// Fraud Detection
			if ($this->config->get('config_fraud_detection')) {
				$this->load->model('checkout/fraud');
				
				$risk_score = $this->model_checkout_fraud->getFraudScore($order_info);
				
				if ($risk_score > $this->config->get('config_fraud_score')) {
					$order_status_id = $this->config->get('config_fraud_status_id');
				}
			}

			// Ban IP
			$status = false;
			
			$this->load->model('account/customer');
			
			if ($order_info['customer_id']) {
				$results = $this->model_account_customer->getIps($order_info['customer_id']);
				
				foreach ($results as $result) {
					if ($this->model_account_customer->isBanIp($result['ip'])) {
						$status = true;
						
						break;
					}
				}
			} else {
				$status = $this->model_account_customer->isBanIp($order_info['ip']);
			}
			
			if ($status) {
				$order_status_id = $this->config->get('config_order_status_id');
			}		
				
			$this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int)$order_status_id . "', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");

			$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$order_id . "', order_status_id = '" . (int)$order_status_id . "', notify = '1', comment = '" . $this->db->escape(($comment && $notify) ? $comment : '') . "', date_added = NOW()");

			$order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
			
			foreach ($order_product_query->rows as $order_product) {
				$this->db->query("UPDATE " . DB_PREFIX . "product SET quantity = (quantity - " . (int)$order_product['quantity'] . ") WHERE product_id = '" . (int)$order_product['product_id'] . "' AND subtract = '1'");
				
				$order_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product['order_product_id'] . "'");
			
				foreach ($order_option_query->rows as $option) {
					$this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET quantity = (quantity - " . (int)$order_product['quantity'] . ") WHERE product_option_value_id = '" . (int)$option['product_option_value_id'] . "' AND subtract = '1'");
				}
			}
			
			$this->cache->delete('product');
			
			// Downloads
			$order_download_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_download WHERE order_id = '" . (int)$order_id . "'");
			
			// Gift Voucher
			$this->load->model('checkout/voucher');
			
			$order_voucher_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_voucher WHERE order_id = '" . (int)$order_id . "'");
			
			foreach ($order_voucher_query->rows as $order_voucher) {
				$voucher_id = $this->model_checkout_voucher->addVoucher($order_id, $order_voucher);
				
				$this->db->query("UPDATE " . DB_PREFIX . "order_voucher SET voucher_id = '" . (int)$voucher_id . "' WHERE order_voucher_id = '" . (int)$order_voucher['order_voucher_id'] . "'");
			}			
			
			// Send out any gift voucher mails
			if ($this->config->get('config_complete_status_id') == $order_status_id) {
				$this->model_checkout_voucher->confirm($order_id);
			}
					
			// Order Totals			
			$order_total_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$order_id . "' ORDER BY sort_order ASC");
			
			foreach ($order_total_query->rows as $order_total) {
				$this->load->model('total/' . $order_total['code']);
				
				if (method_exists($this->{'model_total_' . $order_total['code']}, 'confirm')) {
					$this->{'model_total_' . $order_total['code']}->confirm($order_info, $order_total);
				}
			}
			
			// Send out order confirmation mail
			$language = new Language($order_info['language_directory']);
			$language->load($order_info['language_filename']);
			$language->load('mail/order');
		 
			$order_status_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_info['language_id'] . "'");
			
			if ($order_status_query->num_rows) {
				$order_status = $order_status_query->row['name'];	
			} else {
				$order_status = '';
			}
			
			$subject = sprintf($language->get('text_new_subject'), $order_info['store_name'], $order_id);
		
			// HTML Mail
			$template = new Template();
			
			$template->data['title'] = sprintf($language->get('text_new_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);
			
			$template->data['text_greeting'] = sprintf($language->get('text_new_greeting'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'));
			$template->data['text_link'] = $language->get('text_new_link');
			$template->data['text_download'] = $language->get('text_new_download');
			$template->data['text_order_detail'] = $language->get('text_new_order_detail');
			$template->data['text_instruction'] = $language->get('text_new_instruction');
			$template->data['text_order_id'] = $language->get('text_new_order_id');
			$template->data['text_date_added'] = $language->get('text_new_date_added');
			$template->data['text_payment_method'] = $language->get('text_new_payment_method');	
			$template->data['text_shipping_method'] = $language->get('text_new_shipping_method');
			$template->data['text_email'] = $language->get('text_new_email');
			$template->data['text_telephone'] = $language->get('text_new_telephone');
			$template->data['text_ip'] = $language->get('text_new_ip');
			$template->data['text_payment_address'] = $language->get('text_new_payment_address');
			$template->data['text_shipping_address'] = $language->get('text_new_shipping_address');
			$template->data['text_product'] = $language->get('text_new_product');
			$template->data['text_model'] = $language->get('text_new_model');
			$template->data['text_quantity'] = $language->get('text_new_quantity');
			$template->data['text_price'] = $language->get('text_new_price');
			$template->data['text_total'] = $language->get('text_new_total');
			$template->data['text_footer'] = $language->get('text_new_footer');
			$template->data['text_powered'] = $language->get('text_new_powered');
			
			$template->data['logo'] = $this->config->get('config_url') . 'image/' . $this->config->get('config_logo');		
			$template->data['store_name'] = $order_info['store_name'];
			$template->data['store_url'] = $order_info['store_url'];
			$template->data['customer_id'] = $order_info['customer_id'];
			$template->data['link'] = $order_info['store_url'] . 'index.php?route=account/order/info&order_id=' . $order_id;
			
			if ($order_download_query->num_rows) {
				$template->data['download'] = $order_info['store_url'] . 'index.php?route=account/download';
			} else {
				$template->data['download'] = '';
			}
			
			$template->data['order_id'] = $order_id;
			$template->data['date_added'] = date($language->get('date_format_short'), strtotime($order_info['date_added']));    	
			$template->data['payment_method'] = $order_info['payment_method'];
			$template->data['shipping_method'] = $order_info['shipping_method'];
			$template->data['email'] = $order_info['email'];
			$template->data['telephone'] = $order_info['telephone'];
			$template->data['ip'] = $order_info['ip'];
			
			if ($comment && $notify) {
				$template->data['comment'] = nl2br($comment);
			} else {
				$template->data['comment'] = '';
			}
						
			if ($order_info['payment_address_format']) {
				$format = $order_info['payment_address_format'];
			} else {
				$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
			}
			
			$find = array(
				'{firstname}',
				'{lastname}',
				'{company}',
				'{address_1}',
				'{address_2}',
				'{city}',
				'{postcode}',
				'{zone}',
				'{zone_code}',
				'{country}'
			);
		
			$replace = array(
				'firstname' => $order_info['payment_firstname'],
				'lastname'  => $order_info['payment_lastname'],
				'company'   => $order_info['payment_company'],
				'address_1' => $order_info['payment_address_1'],
				'address_2' => $order_info['payment_address_2'],
				'city'      => $order_info['payment_city'],
				'postcode'  => $order_info['payment_postcode'],
				'zone'      => $order_info['payment_zone'],
				'zone_code' => $order_info['payment_zone_code'],
				'country'   => $order_info['payment_country']  
			);
		
			$template->data['payment_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));						
									
			if ($order_info['shipping_address_format']) {
				$format = $order_info['shipping_address_format'];
			} else {
				$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
			}
			
			$find = array(
				'{firstname}',
				'{lastname}',
				'{company}',
				'{address_1}',
				'{address_2}',
				'{city}',
				'{postcode}',
				'{zone}',
				'{zone_code}',
				'{country}'
			);
		
			$replace = array(
				'firstname' => $order_info['shipping_firstname'],
				'lastname'  => $order_info['shipping_lastname'],
				'company'   => $order_info['shipping_company'],
				'address_1' => $order_info['shipping_address_1'],
				'address_2' => $order_info['shipping_address_2'],
				'city'      => $order_info['shipping_city'],
				'postcode'  => $order_info['shipping_postcode'],
				'zone'      => $order_info['shipping_zone'],
				'zone_code' => $order_info['shipping_zone_code'],
				'country'   => $order_info['shipping_country']  
			);
		
			$template->data['shipping_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
			
			// Products
			$template->data['products'] = array();
				
			foreach ($order_product_query->rows as $product) {
				$option_data = array();
				
				$order_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$product['order_product_id'] . "'");
				
				foreach ($order_option_query->rows as $option) {
					if ($option['type'] != 'file') {
						$value = $option['value'];
					} else {
						$value = utf8_substr($option['value'], 0, utf8_strrpos($option['value'], '.'));
					}
					
					$option_data[] = array(
						'name'  => $option['name'],
						'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value)
					);					
				}
			  
				$template->data['products'][] = array(
					'name'     => $product['name'],
					'model'    => $product['model'],
					'option'   => $option_data,
					'quantity' => $product['quantity'],
					'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
					'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
				);
			}
	
			// Vouchers
			$template->data['vouchers'] = array();
			
			foreach ($order_voucher_query->rows as $voucher) {
				$template->data['vouchers'][] = array(
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']),
				);
			}
	
			$template->data['totals'] = $order_total_query->rows;
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mail/order.tpl')) {
				$html = $template->fetch($this->config->get('config_template') . '/template/mail/order.tpl');
			} else {
				$html = $template->fetch('default/template/mail/order.tpl');
			}
			
			// Text Mail
			$text  = sprintf($language->get('text_new_greeting'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8')) . "\n\n";
			$text .= $language->get('text_new_order_id') . ' ' . $order_id . "\n";
			$text .= $language->get('text_new_date_added') . ' ' . date($language->get('date_format_short'), strtotime($order_info['date_added'])) . "\n";
			$text .= $language->get('text_new_order_status') . ' ' . $order_status . "\n\n";
			
			if ($comment && $notify) {
				$text .= $language->get('text_new_instruction') . "\n\n";
				$text .= $comment . "\n\n";
			}
			
			// Products
			$text .= $language->get('text_new_products') . "\n";
			
			foreach ($order_product_query->rows as $product) {
				$text .= $product['quantity'] . 'x ' . $product['name'] . ' (' . $product['model'] . ') ' . html_entity_decode($this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']), ENT_NOQUOTES, 'UTF-8') . "\n";
				
				$order_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . $product['order_product_id'] . "'");
				
				foreach ($order_option_query->rows as $option) {
					$text .= chr(9) . '-' . $option['name'] . ' ' . (utf8_strlen($option['value']) > 20 ? utf8_substr($option['value'], 0, 20) . '..' : $option['value']) . "\n";
				}
			}
			
			foreach ($order_voucher_query->rows as $voucher) {
				$text .= '1x ' . $voucher['description'] . ' ' . $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']);
			}
						
			$text .= "\n";
			
			$text .= $language->get('text_new_order_total') . "\n";
			
			foreach ($order_total_query->rows as $total) {
				$text .= $total['title'] . ': ' . html_entity_decode($total['text'], ENT_NOQUOTES, 'UTF-8') . "\n";
			}			
			
			$text .= "\n";
			
			if ($order_info['customer_id']) {
				$text .= $language->get('text_new_link') . "\n";
				$text .= $order_info['store_url'] . 'index.php?route=account/order/info&order_id=' . $order_id . "\n\n";
			}
		
			if ($order_download_query->num_rows) {
				$text .= $language->get('text_new_download') . "\n";
				$text .= $order_info['store_url'] . 'index.php?route=account/download' . "\n\n";
			}
			
			// Comment
			if ($order_info['comment']) {
				$text .= $language->get('text_new_comment') . "\n\n";
				$text .= $order_info['comment'] . "\n\n";
			}

			$text .= $language->get('text_new_footer') . "\n\n";
		
			$mail = new Mail(); 
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');			
			$mail->setTo($order_info['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender($order_info['store_name']);
			$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
			$mail->setHtml($html);
			$mail->setText(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
		      // adding pdf to mail
  		        $namepdf=$this->db->query('select * from orders_pdf where idorder='.$order_id);
			$mail->addAttachment('orders_pdf/'.$namepdf->rows[0]['nampdf']);
			$mail->send();

			// Admin Alert Mail
			if ($this->config->get('config_alert_mail')) {
				$subject = sprintf($language->get('text_new_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'), $order_id);
				
				// Text 
				$text  = $language->get('text_new_received') . "\n\n";
				$text .= $language->get('text_new_order_id') . ' ' . $order_id . "\n";
				$text .= $language->get('text_new_date_added') . ' ' . date($language->get('date_format_short'), strtotime($order_info['date_added'])) . "\n";
				$text .= $language->get('text_new_order_status') . ' ' . $order_status . "\n\n";
				$text .= $language->get('text_new_products') . "\n";
				
				foreach ($order_product_query->rows as $product) {
					$text .= $product['quantity'] . 'x ' . $product['name'] . ' (' . $product['model'] . ') ' . html_entity_decode($this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']), ENT_NOQUOTES, 'UTF-8') . "\n";
					
					$order_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . $product['order_product_id'] . "'");
					
					foreach ($order_option_query->rows as $option) {
						if ($option['type'] != 'file') {
							$value = $option['value'];
						} else {
							$value = utf8_substr($option['value'], 0, utf8_strrpos($option['value'], '.'));
						}
											
						$text .= chr(9) . '-' . $option['name'] . ' ' . (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value) . "\n";
					}
				}
				
				foreach ($order_voucher_query->rows as $voucher) {
					$text .= '1x ' . $voucher['description'] . ' ' . $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']);
				}
							
				$text .= "\n";

				$text .= $language->get('text_new_order_total') . "\n";
				
				foreach ($order_total_query->rows as $total) {
					$text .= $total['title'] . ': ' . html_entity_decode($total['text'], ENT_NOQUOTES, 'UTF-8') . "\n";
				}			
				
				$text .= "\n";
				
				if ($order_info['comment']) {
					$text .= $language->get('text_new_comment') . "\n\n";
					$text .= $order_info['comment'] . "\n\n";
				}
			
				$mail = new Mail(); 
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->hostname = $this->config->get('config_smtp_host');
				$mail->username = $this->config->get('config_smtp_username');
				$mail->password = $this->config->get('config_smtp_password');
				$mail->port = $this->config->get('config_smtp_port');
				$mail->timeout = $this->config->get('config_smtp_timeout');
				$mail->setTo($this->config->get('config_email'));
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender($order_info['store_name']);
				$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
				$mail->setText(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
  			    // adding pdf to mail
				$mail->addAttachment('orders_pdf/'.$namepdf->rows[0]['nampdf']);
				$mail->send();
				
				// Send to additional alert emails
				$emails = explode(',', $this->config->get('config_alert_emails'));
				
				foreach ($emails as $email) {
					if ($email && preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email)) {
						$mail->setTo($email);
						$mail->send();
					}
				}				
			}		
		}
	}
	
	public function update($order_id, $order_status_id, $comment = '', $notify = false) {
		$order_info = $this->getOrder($order_id);

		if ($order_info && $order_info['order_status_id']) {
			// Fraud Detection
			if ($this->config->get('config_fraud_detection')) {
				$this->load->model('checkout/fraud');
				
				$risk_score = $this->model_checkout_fraud->getFraudScore($order_info);
				
				if ($risk_score > $this->config->get('config_fraud_score')) {
					$order_status_id = $this->config->get('config_fraud_status_id');
				}
			}			

			// Ban IP
			$status = false;
			
			$this->load->model('account/customer');
			
			if ($order_info['customer_id']) {
								
				$results = $this->model_account_customer->getIps($order_info['customer_id']);
				
				foreach ($results as $result) {
					if ($this->model_account_customer->isBanIp($result['ip'])) {
						$status = true;
						
						break;
					}
				}
			} else {
				$status = $this->model_account_customer->isBanIp($order_info['ip']);
			}
			
			if ($status) {
				$order_status_id = $this->config->get('config_order_status_id');
			}		
						
			$this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int)$order_status_id . "', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");
		
			$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$order_id . "', order_status_id = '" . (int)$order_status_id . "', notify = '" . (int)$notify . "', comment = '" . $this->db->escape($comment) . "', date_added = NOW()");
	
			// Send out any gift voucher mails
			if ($this->config->get('config_complete_status_id') == $order_status_id) {
				$this->load->model('checkout/voucher');
	
				$this->model_checkout_voucher->confirm($order_id);
			}	
	
			if ($notify) {
				$language = new Language($order_info['language_directory']);
				$language->load($order_info['language_filename']);
				$language->load('mail/order');
			
				$subject = sprintf($language->get('text_update_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);
	
				$message  = $language->get('text_update_order') . ' ' . $order_id . "\n";
				$message .= $language->get('text_update_date_added') . ' ' . date($language->get('date_format_short'), strtotime($order_info['date_added'])) . "\n\n";
				
				$order_status_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_info['language_id'] . "'");
				
				if ($order_status_query->num_rows) {
					$message .= $language->get('text_update_order_status') . "\n\n";
					$message .= $order_status_query->row['name'] . "\n\n";					
				}
				
				if ($order_info['customer_id']) {
					$message .= $language->get('text_update_link') . "\n";
					$message .= $order_info['store_url'] . 'index.php?route=account/order/info&order_id=' . $order_id . "\n\n";
				}
				
				if ($comment) { 
					$message .= $language->get('text_update_comment') . "\n\n";
					$message .= $comment . "\n\n";
				}
					
				$message .= $language->get('text_update_footer');

				$mail = new Mail();
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->hostname = $this->config->get('config_smtp_host');
				$mail->username = $this->config->get('config_smtp_username');
				$mail->password = $this->config->get('config_smtp_password');
				$mail->port = $this->config->get('config_smtp_port');
				$mail->timeout = $this->config->get('config_smtp_timeout');				
				$mail->setTo($order_info['email']);
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender($order_info['store_name']);
				$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
				$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
				$mail->send();
			}
		}
	}
}
?>