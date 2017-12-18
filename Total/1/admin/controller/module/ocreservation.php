<?php
class ControllerModuleocreservation extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->language->load('module/ocreservation');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('module/ocreservation');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_module_ocreservation->setSetting($this->request->post);		
					
		//$this->session->data['success'] = $this->language->get('text_success');
						
		//	$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['entry_model'] = $this->language->get('entry_model');
		$this->data['entry_date'] = $this->language->get('entry_date');
		$this->data['entry_order'] = $this->language->get('entry_order');
		$this->data['entry_quantity'] = $this->language->get('entry_quantity');
		$this->data['entry_showrreservation'] = $this->language->get('entry_showrreservation');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['text_monday'] = $this->language->get('text_monday');
		$this->data['text_tuesday'] = $this->language->get('text_tuesday');
		$this->data['text_wednesday'] = $this->language->get('text_wednesday');
		$this->data['text_thursday'] = $this->language->get('text_thursday');
		$this->data['text_friday'] = $this->language->get('text_friday');
		$this->data['text_saturday'] = $this->language->get('text_saturday');
		$this->data['text_sunday'] = $this->language->get('text_sunday');
		
		$this->data['text_type'] = $this->language->get('text_type');
		$this->data['text_type_oneday'] = $this->language->get('text_type_oneday');
		$this->data['text_type_multiday'] = $this->language->get('text_type_multiday');
		$this->data['text_type_nores'] = $this->language->get('text_type_nores');
		
		
		$this->data['button_save'] = $this->language->get('button_save');
	
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/ocreservation', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/ocreservation', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['ocreservation_module'])) {
			$this->data['modules'] = $this->request->post['ocreservation_module'];
		} elseif ($this->config->get('ocreservation_module')) { 
			$this->data['modules'] = $this->config->get('ocreservation_module');
		}	
						
		 $this->load->model('module/ocreservation');
		 if (isset($this->request->get['input'])){
		 $this->data['reservations'] = $this->model_module_ocreservation->getReservations($this->request->get['input']); 
		 }
		 
		 if (isset($this->request->get['settings'])){
		 $this->data['ressetting'] = $this->model_module_ocreservation->getSettings($this->request->get['settings']); 
		 }
		 $this->data['url_order'] = (HTTPS_SERVER . 'index.php?route=sale/order/info&order_id=');
		 
	
		 
		 $this->data['productreservations'] =  $this->model_module_ocreservation->getReservationProducts(); 
		
		 
		
		$this->template = 'module/ocreservation.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	public function install() {
       $this->load->model('module/ocreservation');
       $this->model_module_ocreservation->createTable(); 
 
       $this->load->model('setting/setting');
       $this->model_setting_setting->editSetting('ocreservation', array('ocreservation_status'=>1));
   }
   
   public function uninstall() {
        $this->load->model('module/ocreservation');
        $this->model_module_ocreservation->deleteTable();
         
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('ocreservation', array('ocreservation_status'=>0));
    }
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/ocreservation')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
					
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>