<?php
class ControllerPaymentPagosonline extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/pagosonline');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('pagosonline', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token']);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		

		$this->data['entry_usuarioId'] = $this->language->get('entry_usuarioId');
                $this->data['entry_merchantId'] = $this->language->get('entry_merchantId');
		$this->data['entry_llaveEncripcion'] = $this->language->get('entry_llaveEncripcion');
		
		$this->data['entry_url_pasarela'] = $this->language->get('entry_url_pasarela');
		$this->data['entry_prueba'] = $this->language->get('entry_prueba');	
		
        
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');	
		
		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

        
		
		if (isset($this->error['usuarioId'])) {
			$this->data['error_usuarioId'] = $this->error['usuarioId'];
		} else {
			$this->data['error_usuarioId'] = '';
		}
		
		if (isset($this->error['merchantId'])) {
			$this->data['error_merchantId'] = $this->error['merchantId'];
		} else {
			$this->data['error_merchantId'] = '';
		}

		if (isset($this->error['llaveEncripcion'])) {
			$this->data['error_llaveEncripcion'] = $this->error['llaveEncripcion'];
		} else {
			$this->data['error_llaveEncripcion'] = '';
		}
		if (isset($this->error['url_pasarela'])) {
			$this->data['error_url_pasarela'] = $this->error['url_pasarela'];
		} else {
			$this->data['error_url_pasarela'] = '';
		}
		

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/pagosonline', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = HTTPS_SERVER . 'index.php?route=payment/pagosonline&token=' . $this->session->data['token'];
		
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'];
		
		if (isset($this->request->post['pagosonline_descripcion'])) {
			$this->data['pagosonline_descripcion'] = $this->request->post['pagosonline_descripcion'];
		} else {
			$this->data['pagosonline_descripcion'] = $this->config->get('pagosonline_descripcion');
		}
		
		if (isset($this->request->post['pagosonline_usuarioId'])) {
			$this->data['pagosonline_usuarioId'] = $this->request->post['pagosonline_usuarioId'];
		} else {
			$this->data['pagosonline_usuarioId'] = $this->config->get('pagosonline_usuarioId');
		}
		
		if (isset($this->request->post['pagosonline_merchantId'])) {
			$this->data['pagosonline_merchantId'] = $this->request->post['pagosonline_merchantId'];
		} else {
			$this->data['pagosonline_merchantId'] = $this->config->get('pagosonline_merchantId');
		}

		if (isset($this->request->post['pagosonline_llaveEncripcion'])) {
			$this->data['pagosonline_llaveEncripcion'] = $this->request->post['pagosonline_llaveEncripcion'];
		} else {
			$this->data['pagosonline_llaveEncripcion'] = $this->config->get('pagosonline_llaveEncripcion');
		}
		
		
		if (isset($this->request->post['pagosonline_prueba'])) {
			$this->data['pagosonline_prueba'] = $this->request->post['pagosonline_prueba'];
		} else {
			$this->data['pagosonline_prueba'] = $this->config->get('pagosonline_prueba');
		}
		
	
		


		if (isset($this->request->post['pagosonline_order_status_id'])) {
			$this->data['pagosonline_order_status_id'] = $this->request->post['pagosonline_order_status_id'];
		} else {
			$this->data['pagosonline_order_status_id'] = $this->config->get('pagosonline_order_status_id');
		}

		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		if (isset($this->request->post['pagosonline_status'])) {
			$this->data['pagosonline_status'] = $this->request->post['pagosonline_status'];
		} else {
			$this->data['pagosonline_status'] = $this->config->get('pagosonline_status');
		}

		if (isset($this->request->post['pagosonline_sort_order'])) {
			$this->data['pagosonline_sort_order'] = $this->request->post['pagosonline_sort_order'];
		} else {
			$this->data['pagosonline_sort_order'] = $this->config->get('pagosonline_sort_order');
		}

		$this->template = 'payment/pagosonline.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/pagosonline')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->request->post['pagosonline_usuarioId']) {
			$this->error['usuarioId'] = $this->language->get('error_usuarioId');
		}
		if (!$this->request->post['pagosonline_merchantId']) {
			$this->error['merchantId'] = $this->language->get('error_merchantId');
		}

		if (!$this->request->post['pagosonline_llaveEncripcion']) {
			$this->error['llaveEncripcion'] = $this->language->get('error_llaveEncripcion');
		}
		
		

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>