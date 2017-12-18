<?php
class ControllerPaymentDineroMail extends Controller {
	private $error = array();

	public function index() {

		$this->load->language('payment/dineromail');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');

			$this->model_setting_setting->editSetting('dineromail', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title']      = $this->language->get('heading_title');

		$this->data['text_enabled']       = $this->language->get('text_enabled');
		$this->data['text_disabled']      = $this->language->get('text_disabled');
		$this->data['text_country']       = $this->language->get('text_country');

		$this->data['entry_merchant']     = $this->language->get('entry_merchant');		
		$this->data['entry_email']        = $this->language->get('entry_email');
		$this->data['entry_geo_zone']     = $this->language->get('entry_geo_zone');
		$this->data['entry_url_logo']     = $this->language->get('entry_url_logo');
		$this->data['entry_ipn_pass']     = $this->language->get('entry_ipn_pass');
		$this->data['entry_callback']     = $this->language->get('entry_callback');
		$this->data['entry_status']       = $this->language->get('entry_status');
		$this->data['entry_sort_order']   = $this->language->get('entry_sort_order');
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');	
			
		$this->data['button_save']        = $this->language->get('button_save');
		$this->data['button_cancel']      = $this->language->get('button_cancel');

		$this->data['tab_general']        = $this->language->get('tab_general');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['merchant'])) {
			$this->data['error_merchant'] = $this->error['merchant'];
		} else {
			$this->data['error_merchant'] = '';
		}

		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}
		
		if (isset($this->error['country'])) {
			$this->data['error_country'] = $this->error['country'];
		} else {
			$this->data['error_country'] = '';
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'text' => $this->language->get('text_home'),
			'separator' => FALSE
		);

		$this->data['breadcrumbs'][] = array(
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
			'text' => $this->language->get('text_payment'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'href' => $this->url->link('payment/dineromail', 'token=' . $this->session->data['token'], 'SSL'),
			'text' => $this->language->get('heading_title'),
			'separator' => ' :: '
		);
		$this->data['action'] =$this->url->link('payment/dineromail', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] =$this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['dineromail_merchant'])) {
			$this->data['dineromail_merchant'] = $this->request->post['dineromail_merchant'];
		} else {
			$this->data['dineromail_merchant'] = $this->config->get('dineromail_merchant');
		}

		if (isset($this->request->post['dineromail_email'])) {
			$this->data['dineromail_email'] = $this->request->post['dineromail_email'];
		} else {
			$this->data['dineromail_email'] = $this->config->get('dineromail_email');
		}

		if (isset($this->request->post['dineromail_geo_zone_id'])) {
			$this->data['dineromail_geo_zone_id'] = $this->request->post['dineromail_geo_zone_id'];
		} else {
			$this->data['dineromail_geo_zone_id'] = $this->config->get('dineromail_geo_zone_id');
		}
		
		if (isset($this->request->post['dineromail_url_logo'])) {
			$this->data['dineromail_url_logo'] = $this->request->post['dineromail_url_logo'];
		} else {
			$this->data['dineromail_url_logo'] = $this->config->get('dineromail_url_logo');
		}
		
		if (isset($this->request->post['dineromail_ipn_pass'])) {
			$this->data['dineromail_ipn_pass'] = $this->request->post['dineromail_ipn_pass'];
		} else {
			$this->data['dineromail_ipn_pass'] = $this->config->get('dineromail_ipn_pass');
		}

		if (isset($this->request->post['dineromail_add_params'])) {
			$this->data['dineromail_add_params'] = $this->request->post['dineromail_add_params'];
		} else {
			$this->data['dineromail_add_params'] = $this->config->get('dineromail_add_params');
		}

		$this->data['callback'] = HTTP_CATALOG . 'index.php?route=payment/dineromail/callback';

		if (isset($this->request->post['dineromail_order_status_id'])) {
			$this->data['dineromail_order_status_id'] = $this->request->post['dineromail_order_status_id'];
		} else {
			$this->data['dineromail_order_status_id'] = $this->config->get('dineromail_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['dineromail_status'])) {
			$this->data['dineromail_status'] = $this->request->post['dineromail_status'];
		} else {
			$this->data['dineromail_status'] = $this->config->get('dineromail_status');
		}

		if (isset($this->request->post['dineromail_sort_order'])) {
			$this->data['dineromail_sort_order'] = $this->request->post['dineromail_sort_order'];
		} else {
			$this->data['dineromail_sort_order'] = $this->config->get('dineromail_sort_order');
		}

		$this->template = 'payment/dineromail.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/dineromail')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['dineromail_merchant']) {
			$this->error['merchant'] = $this->language->get('error_merchant');
		}

		if (!$this->request->post['dineromail_email']) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if (!$this->request->post['dineromail_geo_zone_id']) {
			$this->error['country'] = $this->language->get('error_country');
		}


		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

?>