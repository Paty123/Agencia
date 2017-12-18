<?php
class ControllerCatalogProduct extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->language->load('catalog/product');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('catalog/product');
		
		$this->getList();
  	}
  
  	public function insert() {
    	$this->language->load('catalog/product');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('catalog/product');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product->addProduct($this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
					
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->language->load('catalog/product');
    	$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/product');
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product->editProduct($this->request->get['product_id'], $this->request->post);
			if(isset($this->request->post['incnoinc'])){
                          if($this->request->post['idincnoinc']==0){
                            $this->db->query("INSERT INTO circuitos_incnoinc values(default,'".$this->request->post['idthsprod']."','".html_entity_decode($this->request->post['incnoinc'])."','".html_entity_decode($this->request->post['recomens'])."')");
                          }else{
                            $this->db->query("update circuitos_incnoinc set incnoinc='".html_entity_decode($this->request->post['incnoinc'])."', recomens='".html_entity_decode($this->request->post['recomens'])."' where idino=".$this->request->post['idincnoinc']);
                          }
                        }else if(isset($this->request->post['hservicios'])){
                          if($this->request->post['idthsprod']==0){
                            $this->db->query("INSERT INTO hoteles_servs values(default,'".$this->request->post['idthstheprod']."','".html_entity_decode($this->request->post['hservicios'])."')");
                          }else{
                            $this->db->query("update hoteles_servs set servicios='".html_entity_decode($this->request->post['hservicios'])."' where idhsr=".$this->request->post['idthsprod']);
                          }
                        }
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			$this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
    	$this->getForm();
  	}

  	public function delete() {
    	$this->language->load('catalog/product');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/product');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $product_id) {
				$this->model_catalog_product->deleteProduct($product_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	
		
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
					
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}

  	public function copy() {
    	$this->language->load('catalog/product');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/product');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $product_id) {
				$this->model_catalog_product->copyProduct($product_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		  
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	
		
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
					
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	protected function getList() {				
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}
		
		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = null;
		}

		if (isset($this->request->get['filter_quantity'])) {
			$filter_quantity = $this->request->get['filter_quantity'];
		} else {
			$filter_quantity = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
						
		$url = '';
						
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}		

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
						
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('catalog/product/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('catalog/product/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('catalog/product/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['products'] = array();

		$data = array(
			'filter_name'	  => $filter_name, 
			'filter_model'	  => $filter_model,
			'filter_price'	  => $filter_price,
			'filter_quantity' => $filter_quantity,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$this->load->model('tool/image');
		
		$product_total = $this->model_catalog_product->getTotalProducts($data);
			
		$results = $this->model_catalog_product->getProducts($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
			);
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
	
			$special = false;
			
			$product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);
			
			foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] < date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] > date('Y-m-d'))) {
					$special = $product_special['price'];
			
					break;
				}					
			}
	
      		$this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'name'       => $result['name'],
				'model'      => $result['model'],
				'price'      => $result['price'],
				'special'    => $special,
				'image'      => $image,
				'quantity'   => $result['quantity'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
				'action'     => $action
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		$this->data['text_enabled'] = $this->language->get('text_enabled');		
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');		
			
		$this->data['column_image'] = $this->language->get('column_image');		
		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_model'] = $this->language->get('column_model');		
		$this->data['column_price'] = $this->language->get('column_price');		
		$this->data['column_quantity'] = $this->language->get('column_quantity');		
		$this->data['column_status'] = $this->language->get('column_status');		
		$this->data['column_action'] = $this->language->get('column_action');		
				
		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
								
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_name'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$this->data['sort_model'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$this->data['sort_price'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
		$this->data['sort_quantity'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
				
		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_name'] = $filter_name;
		$this->data['filter_model'] = $filter_model;
		$this->data['filter_price'] = $filter_price;
		$this->data['filter_quantity'] = $filter_quantity;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/product_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}

  	protected function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
 
    	$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
    	$this->data['text_none'] = $this->language->get('text_none');
    	$this->data['text_yes'] = $this->language->get('text_yes');
    	$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_plus'] = $this->language->get('text_plus');
		$this->data['text_minus'] = $this->language->get('text_minus');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_option'] = $this->language->get('text_option');
		$this->data['text_option_value'] = $this->language->get('text_option_value');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_percent'] = $this->language->get('text_percent');
		$this->data['text_amount'] = $this->language->get('text_amount');

		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
    	$this->data['entry_model'] = $this->language->get('entry_model');
		$this->data['entry_sku'] = $this->language->get('entry_sku');
		$this->data['entry_upc'] = $this->language->get('entry_upc');
		$this->data['entry_ean'] = $this->language->get('entry_ean');
		$this->data['entry_jan'] = $this->language->get('entry_jan');
		$this->data['entry_isbn'] = $this->language->get('entry_isbn');
		$this->data['entry_mpn'] = $this->language->get('entry_mpn');
		$this->data['entry_location'] = $this->language->get('entry_location');
		$this->data['entry_minimum'] = $this->language->get('entry_minimum');
		$this->data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
    	$this->data['entry_shipping'] = $this->language->get('entry_shipping');
    	$this->data['entry_date_available'] = $this->language->get('entry_date_available');
    	$this->data['entry_quantity'] = $this->language->get('entry_quantity');
		$this->data['entry_stock_status'] = $this->language->get('entry_stock_status');
    	$this->data['entry_price'] = $this->language->get('entry_price');
		$this->data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$this->data['entry_points'] = $this->language->get('entry_points');
		$this->data['entry_option_points'] = $this->language->get('entry_option_points');
		$this->data['entry_subtract'] = $this->language->get('entry_subtract');
    	$this->data['entry_weight_class'] = $this->language->get('entry_weight_class');
    	$this->data['entry_weight'] = $this->language->get('entry_weight');
		$this->data['entry_dimension'] = $this->language->get('entry_dimension');
		$this->data['entry_length'] = $this->language->get('entry_length');
    	$this->data['entry_image'] = $this->language->get('entry_image');
    	$this->data['entry_download'] = $this->language->get('entry_download');
    	$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_filter'] = $this->language->get('entry_filter');
		$this->data['entry_related'] = $this->language->get('entry_related');
		$this->data['entry_attribute'] = $this->language->get('entry_attribute');
		$this->data['entry_text'] = $this->language->get('entry_text');
		$this->data['entry_option'] = $this->language->get('entry_option');
		$this->data['entry_option_value'] = $this->language->get('entry_option_value');
		$this->data['entry_required'] = $this->language->get('entry_required');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_priority'] = $this->language->get('entry_priority');
		$this->data['entry_tag'] = $this->language->get('entry_tag');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_reward'] = $this->language->get('entry_reward');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
				
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_attribute'] = $this->language->get('button_add_attribute');
		$this->data['button_add_option'] = $this->language->get('button_add_option');
		$this->data['button_add_option_value'] = $this->language->get('button_add_option_value');
		$this->data['button_add_discount'] = $this->language->get('button_add_discount');
		$this->data['button_add_special'] = $this->language->get('button_add_special');
		$this->data['button_add_image'] = $this->language->get('button_add_image');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
    	$this->data['tab_general'] = $this->language->get('tab_general');
    	$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_attribute'] = $this->language->get('tab_attribute');
		$this->data['tab_option'] = $this->language->get('tab_option');		
		$this->data['tab_discount'] = $this->language->get('tab_discount');
		$this->data['tab_special'] = $this->language->get('tab_special');
    	$this->data['tab_image'] = $this->language->get('tab_image');		
		$this->data['tab_links'] = $this->language->get('tab_links');
		$this->data['tab_reward'] = $this->language->get('tab_reward');
		$this->data['tab_design'] = $this->language->get('tab_design');
		 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

 		if (isset($this->error['meta_description'])) {
			$this->data['error_meta_description'] = $this->error['meta_description'];
		} else {
			$this->data['error_meta_description'] = array();
		}		
   
   		if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = array();
		}	
		
   		if (isset($this->error['model'])) {
			$this->data['error_model'] = $this->error['model'];
		} else {
			$this->data['error_model'] = '';
		}		
     	
		if (isset($this->error['date_available'])) {
			$this->data['error_date_available'] = $this->error['date_available'];
		} else {
			$this->data['error_date_available'] = '';
		}	

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}	
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
								
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}


if(!isset($this->request->get['product_id']))
{
	$producto=0;
}
else
{
	$producto=$this->request->get['product_id'];
}
//inicio de habitaciones
$this->data['habitaciones'] = array();
$this->data['habitacionesDescAnt']= array();
$this->data['habitacionesDescNoches']= array();
if (isset($this->request->get['product_id'])) {
		$results = $this->model_catalog_product->getHabitaciones($producto);
				    	
		foreach ($results as $result) {
			$action = array();
			
$this->data['habitaciones'][] = array(
       		'idhabitaciones'      => $result['idhabitaciones'],
			'id_producto'      => $result['id_producto'],
			'tipo' => $result['tipo'],
			'precio' => $result['precio'],
			'finicio' => date('Y-m-d', strtotime($result['finicio'])),
			'ffin' => date('Y-m-d', strtotime($result['ffin'])),
			'habilitado' => $result['habilitado'],
   		);
		}
		
		//descuentos por dias anticipados
		$results = $this->model_catalog_product->getHabitacionesDescuentosAnticipados($producto);
		
		foreach ($results as $result) {
			$action = array();
			
$this->data['habitacionesDescAnt'][] = array(
       		'idHabDescAnt'      => $result['idHabDescAnt'],
			'id_producto'      => $result['id_producto'],
			'dias' => $result['dias'],
			'porcentaje' => $result['porcentaje'],
			'finicio' => date('Y-m-d', strtotime($result['finicio'])),
			'ffin' => date('Y-m-d', strtotime($result['ffin'])),
			 
   		);
		}
		
		
		
		//descuentos por noches
		$results = $this->model_catalog_product->getHabitacionesDescuentosNoches($producto);
		
		foreach ($results as $result) {
			$action = array();
			
$this->data['habitacionesDescNoches'][] = array(
       		'idhabdescNoches'      => $result['idhabdescNoches'],
			'id_producto'      => $result['id_producto'],
			'nochestotales' => $result['nochestotales'],
			'minper' => $result['minper'],
			'nochesdescuento' => $result['nochesdescuento'],
			'finicio' => date('Y-m-d', strtotime($result['finicio'])),
			'ffin' => date('Y-m-d', strtotime($result['ffin'])),
			 
   		);
		}
		
		
		
}
//fin de habitaciones






//inicio de Tours
$this->data['tours'] = array();
//descuentos por noches

		$results = $this->model_catalog_product->getTours($producto);
		
		foreach ($results as $result) {
			$action = array();
			
$this->data['Tours'][] = array(
       		'idtours'      => $result['idtours'],
			'id_producto'      => $result['id_producto'],
			'tipo' => $result['tipo'],
			'precio' => $result['precio'],
			'idsal' => $result['idsalida'],
   		);
		}
//fin de Tours



//inicio de Circuitos
$this->data['circuitos'] = array();
//descuentos por noches
		$results = $this->model_catalog_product->getCircuitos($producto);

		foreach ($results as $result) {
			$action = array();

$this->data['circuitos'][] = array(
       		'idcircuitos'      => $result['idcircuitos'],
			'id_producto'      => $result['id_producto'],
			'tipo' => $result['tipo'],
			'estrellas' => $result['estrellas'],
			'precio' => $result['precio'],
			'idsal' => $result['idsalida']

   		);
		}
		
		
		
		 
//fin de Tours



  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['product_id'])) {
			$this->data['action'] = $this->url->link('catalog/product/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);
    	}

		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['product_description'])) {
			$this->data['product_description'] = $this->request->post['product_description'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_description'] = $this->model_catalog_product->getProductDescriptions($this->request->get['product_id']);
		} else {
			$this->data['product_description'] = array();
		}
		
		if (isset($this->request->post['model'])) {
      		$this->data['model'] = $this->request->post['model'];
    	} elseif (!empty($product_info)) {
			$this->data['model'] = $product_info['model'];
		} else {
      		$this->data['model'] = '';
    	}

		if (isset($this->request->post['sku'])) {
      		$this->data['sku'] = $this->request->post['sku'];
    	} elseif (!empty($product_info)) {
			$this->data['sku'] = $product_info['sku'];
		} else {
      		$this->data['sku'] = '';
    	}
		
		if (isset($this->request->post['upc'])) {
      		$this->data['upc'] = $this->request->post['upc'];
    	} elseif (!empty($product_info)) {
			$this->data['upc'] = $product_info['upc'];
		} else {
      		$this->data['upc'] = '';
    	}
		
		if (isset($this->request->post['ean'])) {
      		$this->data['ean'] = $this->request->post['ean'];
    	} elseif (!empty($product_info)) {
			$this->data['ean'] = $product_info['ean'];
		} else {
      		$this->data['ean'] = '';
    	}
		
		if (isset($this->request->post['jan'])) {
      		$this->data['jan'] = $this->request->post['jan'];
    	} elseif (!empty($product_info)) {
			$this->data['jan'] = $product_info['jan'];
		} else {
      		$this->data['jan'] = '';
    	}
		
		if (isset($this->request->post['isbn'])) {
      		$this->data['isbn'] = $this->request->post['isbn'];
    	} elseif (!empty($product_info)) {
			$this->data['isbn'] = $product_info['isbn'];
		} else {
      		$this->data['isbn'] = '';
    	}
		
		if (isset($this->request->post['tipoproducto'])) {
      		$this->data['tipoproducto'] = $this->request->post['tipoproducto'];
    	} elseif (!empty($product_info)) {
			$this->data['tipoproducto'] = $product_info['tipoproducto'];
		} else {
      		$this->data['tipoproducto'] = '';
    	}
		
		if (isset($this->request->post['mpn'])) {
      		$this->data['mpn'] = $this->request->post['mpn'];
    	} elseif (!empty($product_info)) {
			$this->data['mpn'] = $product_info['mpn'];
		} else {
      		$this->data['mpn'] = '';
    	}								
				
		if (isset($this->request->post['location'])) {
      		$this->data['location'] = $this->request->post['location'];
    	} elseif (!empty($product_info)) {
			$this->data['location'] = $product_info['location'];
		} else {
      		$this->data['location'] = '';
    	}

		$this->load->model('setting/store');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
		
		if (isset($this->request->post['product_store'])) {
			$this->data['product_store'] = $this->request->post['product_store'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_store'] = $this->model_catalog_product->getProductStores($this->request->get['product_id']);
		} else {
			$this->data['product_store'] = array(0);
		}	
		
		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($product_info)) {
			$this->data['keyword'] = $product_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}
		
		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($product_info)) {
			$this->data['image'] = $product_info['image'];
		} else {
			$this->data['image'] = '';
		}
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($product_info) && $product_info['image'] && file_exists(DIR_IMAGE . $product_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
    	if (isset($this->request->post['shipping'])) {
      		$this->data['shipping'] = $this->request->post['shipping'];
    	} elseif (!empty($product_info)) {
      		$this->data['shipping'] = $product_info['shipping'];
    	} else {
			$this->data['shipping'] = 1;
		}
		
    	if (isset($this->request->post['price'])) {
      		$this->data['price'] = $this->request->post['price'];
    	} elseif (!empty($product_info)) {
			$this->data['price'] = $product_info['price'];
		} else {
      		$this->data['price'] = '';
    	}
		
		$this->load->model('localisation/tax_class');
		
		$this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
    	
		if (isset($this->request->post['tax_class_id'])) {
      		$this->data['tax_class_id'] = $this->request->post['tax_class_id'];
    	} elseif (!empty($product_info)) {
			$this->data['tax_class_id'] = $product_info['tax_class_id'];
		} else {
      		$this->data['tax_class_id'] = 0;
    	}
		      	
		if (isset($this->request->post['date_available'])) {
       		$this->data['date_available'] = $this->request->post['date_available'];
		} elseif (!empty($product_info)) {
			$this->data['date_available'] = date('Y-m-d', strtotime($product_info['date_available']));
		} else {
			$this->data['date_available'] = date('Y-m-d', time() - 86400);
		}
											
    	if (isset($this->request->post['quantity'])) {
      		$this->data['quantity'] = $this->request->post['quantity'];
    	} elseif (!empty($product_info)) {
      		$this->data['quantity'] = $product_info['quantity'];
    	} else {
			$this->data['quantity'] = 1;
		}
		
		if (isset($this->request->post['minimum'])) {
      		$this->data['minimum'] = $this->request->post['minimum'];
    	} elseif (!empty($product_info)) {
      		$this->data['minimum'] = $product_info['minimum'];
    	} else {
			$this->data['minimum'] = 1;
		}
		
		if (isset($this->request->post['subtract'])) {
      		$this->data['subtract'] = $this->request->post['subtract'];
    	} elseif (!empty($product_info)) {
      		$this->data['subtract'] = $product_info['subtract'];
    	} else {
			$this->data['subtract'] = 1;
		}
		
		if (isset($this->request->post['sort_order'])) {
      		$this->data['sort_order'] = $this->request->post['sort_order'];
    	} elseif (!empty($product_info)) {
      		$this->data['sort_order'] = $product_info['sort_order'];
    	} else {
			$this->data['sort_order'] = 1;
		}

		$this->load->model('localisation/stock_status');
		
		$this->data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();
    	
		if (isset($this->request->post['stock_status_id'])) {
      		$this->data['stock_status_id'] = $this->request->post['stock_status_id'];
    	} elseif (!empty($product_info)) {
      		$this->data['stock_status_id'] = $product_info['stock_status_id'];
    	} else {
			$this->data['stock_status_id'] = $this->config->get('config_stock_status_id');
		}
				
    	if (isset($this->request->post['status'])) {
      		$this->data['status'] = $this->request->post['status'];
    	} elseif (!empty($product_info)) {
			$this->data['status'] = $product_info['status'];
		} else {
      		$this->data['status'] = 1;
    	}

    	if (isset($this->request->post['weight'])) {
      		$this->data['weight'] = $this->request->post['weight'];
		} elseif (!empty($product_info)) {
			$this->data['weight'] = $product_info['weight'];
    	} else {
      		$this->data['weight'] = '';
    	} 
		
		$this->load->model('localisation/weight_class');
		
		$this->data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();
    	
		if (isset($this->request->post['weight_class_id'])) {
      		$this->data['weight_class_id'] = $this->request->post['weight_class_id'];
    	} elseif (!empty($product_info)) {
      		$this->data['weight_class_id'] = $product_info['weight_class_id'];
		} else {
      		$this->data['weight_class_id'] = $this->config->get('config_weight_class_id');
    	}
		
		if (isset($this->request->post['length'])) {
      		$this->data['length'] = $this->request->post['length'];
    	} elseif (!empty($product_info)) {
			$this->data['length'] = $product_info['length'];
		} else {
      		$this->data['length'] = '';
    	}
		
		if (isset($this->request->post['width'])) {
      		$this->data['width'] = $this->request->post['width'];
		} elseif (!empty($product_info)) {	
			$this->data['width'] = $product_info['width'];
    	} else {
      		$this->data['width'] = '';
    	}
		
		if (isset($this->request->post['height'])) {
      		$this->data['height'] = $this->request->post['height'];
		} elseif (!empty($product_info)) {
			$this->data['height'] = $product_info['height'];
    	} else {
      		$this->data['height'] = '';
    	}

		$this->load->model('localisation/length_class');
		
		$this->data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		if (isset($this->request->post['length_class_id'])) {
      		$this->data['length_class_id'] = $this->request->post['length_class_id'];
    	} elseif (!empty($product_info)) {
      		$this->data['length_class_id'] = $product_info['length_class_id'];
    	} else {
      		$this->data['length_class_id'] = $this->config->get('config_length_class_id');
		}

		$this->load->model('catalog/manufacturer');
		
    	if (isset($this->request->post['manufacturer_id'])) {
      		$this->data['manufacturer_id'] = $this->request->post['manufacturer_id'];
		} elseif (!empty($product_info)) {
			$this->data['manufacturer_id'] = $product_info['manufacturer_id'];
		} else {
      		$this->data['manufacturer_id'] = 0;
    	} 		
		
    	if (isset($this->request->post['manufacturer'])) {
      		$this->data['manufacturer'] = $this->request->post['manufacturer'];
		} elseif (!empty($product_info)) {
			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($product_info['manufacturer_id']);
			
			if ($manufacturer_info) {		
				$this->data['manufacturer'] = $manufacturer_info['name'];
			} else {
				$this->data['manufacturer'] = '';
			}	
		} else {
      		$this->data['manufacturer'] = '';
    	} 
		
		// Categories
		$this->load->model('catalog/category');
		
		if (isset($this->request->post['product_category'])) {
			$categories = $this->request->post['product_category'];
		} elseif (isset($this->request->get['product_id'])) {		
			$categories = $this->model_catalog_product->getProductCategories($this->request->get['product_id']);
		} else {
			$categories = array();
		}
	
		$this->data['product_categories'] = array();
		
		foreach ($categories as $category_id) {
			$category_info = $this->model_catalog_category->getCategory($category_id);
			
			if ($category_info) {
				$this->data['product_categories'][] = array(
					'category_id' => $category_info['category_id'],
					'name'        => ($category_info['path'] ? $category_info['path'] . ' &gt; ' : '') . $category_info['name']
				);
			}
		}
		
		// Filters
		$this->load->model('catalog/filter');
		
		if (isset($this->request->post['product_filter'])) {
			$filters = $this->request->post['product_filter'];
		} elseif (isset($this->request->get['product_id'])) {
			$filters = $this->model_catalog_product->getProductFilters($this->request->get['product_id']);
		} else {
			$filters = array();
		}
		
		$this->data['product_filters'] = array();
		
		foreach ($filters as $filter_id) {
			$filter_info = $this->model_catalog_filter->getFilter($filter_id);
			
			if ($filter_info) {
				$this->data['product_filters'][] = array(
					'filter_id' => $filter_info['filter_id'],
					'name'      => $filter_info['group'] . ' &gt; ' . $filter_info['name']
				);
			}
		}		
		
		// Attributes
		$this->load->model('catalog/attribute');
		
		if (isset($this->request->post['product_attribute'])) {
			$product_attributes = $this->request->post['product_attribute'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_attributes = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
		} else {
			$product_attributes = array();
		}
		
		$this->data['product_attributes'] = array();
		
		foreach ($product_attributes as $product_attribute) {
			$attribute_info = $this->model_catalog_attribute->getAttribute($product_attribute['attribute_id']);
			
			if ($attribute_info) {
				$this->data['product_attributes'][] = array(
					'attribute_id'                  => $product_attribute['attribute_id'],
					'name'                          => $attribute_info['name'],
					'product_attribute_description' => $product_attribute['product_attribute_description']
				);
			}
		}		
		
		// Options
		$this->load->model('catalog/option');
		
		if (isset($this->request->post['product_option'])) {
			$product_options = $this->request->post['product_option'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_options = $this->model_catalog_product->getProductOptions($this->request->get['product_id']);			
		} else {
			$product_options = array();
		}			
		
		$this->data['product_options'] = array();
			
		foreach ($product_options as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				$product_option_value_data = array();
				
				foreach ($product_option['product_option_value'] as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => $product_option_value['product_option_value_id'],
						'option_value_id'         => $product_option_value['option_value_id'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'points'                  => $product_option_value['points'],
						'points_prefix'           => $product_option_value['points_prefix'],						
						'weight'                  => $product_option_value['weight'],
						'weight_prefix'           => $product_option_value['weight_prefix']	
					);
				}
				
				$this->data['product_options'][] = array(
					'product_option_id'    => $product_option['product_option_id'],
					'product_option_value' => $product_option_value_data,
					'option_id'            => $product_option['option_id'],
					'name'                 => $product_option['name'],
					'type'                 => $product_option['type'],
					'required'             => $product_option['required']
				);				
			} else {
				$this->data['product_options'][] = array(
					'product_option_id' => $product_option['product_option_id'],
					'option_id'         => $product_option['option_id'],
					'name'              => $product_option['name'],
					'type'              => $product_option['type'],
					'option_value'      => $product_option['option_value'],
					'required'          => $product_option['required']
				);				
			}
		}
		
		$this->data['option_values'] = array();
		
		foreach ($this->data['product_options'] as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				if (!isset($this->data['option_values'][$product_option['option_id']])) {
					$this->data['option_values'][$product_option['option_id']] = $this->model_catalog_option->getOptionValues($product_option['option_id']);
				}
			}
		}
		
		$this->load->model('sale/customer_group');
		
		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		
		if (isset($this->request->post['product_discount'])) {
			$this->data['product_discounts'] = $this->request->post['product_discount'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_discounts'] = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);
		} else {
			$this->data['product_discounts'] = array();
		}

		if (isset($this->request->post['product_special'])) {
			$this->data['product_specials'] = $this->request->post['product_special'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_specials'] = $this->model_catalog_product->getProductSpecials($this->request->get['product_id']);
		} else {
			$this->data['product_specials'] = array();
		}
		
		// Images
		if (isset($this->request->post['product_image'])) {
			$product_images = $this->request->post['product_image'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_images = $this->model_catalog_product->getProductImages($this->request->get['product_id']);
		} else {
			$product_images = array();
		}
		
		$this->data['product_images'] = array();
		
		foreach ($product_images as $product_image) {
			if ($product_image['image'] && file_exists(DIR_IMAGE . $product_image['image'])) {
				$image = $product_image['image'];
			} else {
				$image = 'no_image.jpg';
			}
			
			$this->data['product_images'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($image, 100, 100),
				'sort_order' => $product_image['sort_order']
			);
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		// Downloads
		$this->load->model('catalog/download');
		
		if (isset($this->request->post['product_download'])) {
			$product_downloads = $this->request->post['product_download'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_downloads = $this->model_catalog_product->getProductDownloads($this->request->get['product_id']);
		} else {
			$product_downloads = array();
		}
			
		$this->data['product_downloads'] = array();
		
		foreach ($product_downloads as $download_id) {
			$download_info = $this->model_catalog_download->getDownload($download_id);
			
			if ($download_info) {
				$this->data['product_downloads'][] = array(
					'download_id' => $download_info['download_id'],
					'name'        => $download_info['name']
				);
			}
		}
		
		if (isset($this->request->post['product_related'])) {
			$products = $this->request->post['product_related'];
		} elseif (isset($this->request->get['product_id'])) {		
			$products = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);
		} else {
			$products = array();
		}
	
		$this->data['product_related'] = array();
		
		foreach ($products as $product_id) {
			$related_info = $this->model_catalog_product->getProduct($product_id);
			
			if ($related_info) {
				$this->data['product_related'][] = array(
					'product_id' => $related_info['product_id'],
					'name'       => $related_info['name']
				);
			}
		}

    	if (isset($this->request->post['points'])) {
      		$this->data['points'] = $this->request->post['points'];
    	} elseif (!empty($product_info)) {
			$this->data['points'] = $product_info['points'];
		} else {
      		$this->data['points'] = '';
    	}
						
		if (isset($this->request->post['product_reward'])) {
			$this->data['product_reward'] = $this->request->post['product_reward'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_reward'] = $this->model_catalog_product->getProductRewards($this->request->get['product_id']);
		} else {
			$this->data['product_reward'] = array();
		}
		
		if (isset($this->request->post['product_layout'])) {
			$this->data['product_layout'] = $this->request->post['product_layout'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_layout'] = $this->model_catalog_product->getProductLayouts($this->request->get['product_id']);
		} else {
			$this->data['product_layout'] = array();
		}

		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
										
		$this->template = 'catalog/product_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	protected function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'catalog/product')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	foreach ($this->request->post['product_description'] as $language_id => $value) {
      		if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
        		$this->error['name'][$language_id] = $this->language->get('error_name');
      		}
    	}
		
    	if ((utf8_strlen($this->request->post['model']) < 1) || (utf8_strlen($this->request->post['model']) > 64)) {
      		$this->error['model'] = $this->language->get('error_model');
    	}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
					
    	if (!$this->error) {
			return true;
    	} else {
      		return false;
    	}
  	}
	
  	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'catalog/product')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	protected function validateCopy() {
    	if (!$this->user->hasPermission('modify', 'catalog/product')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
		
	public function autocomplete() {
		$json = array();
		
		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_category_id'])) {
			$this->load->model('catalog/product');
			$this->load->model('catalog/option');
			
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}
			
			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}
			
			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 20;	
			}			
						
			$data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);
			
			$results = $this->model_catalog_product->getProducts($data);
			
			foreach ($results as $result) {
				$option_data = array();
				
				$product_options = $this->model_catalog_product->getProductOptions($result['product_id']);	
				
				foreach ($product_options as $product_option) {
					$option_info = $this->model_catalog_option->getOption($product_option['option_id']);
					
					if ($option_info) {				
						if ($option_info['type'] == 'select' || $option_info['type'] == 'radio' || $option_info['type'] == 'checkbox' || $option_info['type'] == 'image') {
							$option_value_data = array();
							
							foreach ($product_option['product_option_value'] as $product_option_value) {
								$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);
						
								if ($option_value_info) {
									$option_value_data[] = array(
										'product_option_value_id' => $product_option_value['product_option_value_id'],
										'option_value_id'         => $product_option_value['option_value_id'],
										'name'                    => $option_value_info['name'],
										'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
										'price_prefix'            => $product_option_value['price_prefix']
									);
								}
							}
						
							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $option_value_data,
								'required'          => $product_option['required']
							);	
						} else {
							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $product_option['option_value'],
								'required'          => $product_option['required']
							);				
						}
					}
				}
					
				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'model'      => $result['model'],
					'option'     => $option_data,
					'price'      => $result['price']
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}
	
	public function eliminahabitacion() {
		if (isset($this->request->get['idhabitacion'])) {
				$idhabitacion = $this->request->get['idhabitacion'];

				$this->db->query("delete from habitaciones where  idhabitaciones = '" . $idhabitacion . "'");
			} else {
				$idhabitacion = '';
			}

			$json['success'] = 'Habitaci&oacute;n Eliminada';
     $this->response->setOutput(json_encode($json));

	}
	                
	public function EliminatrasFH() {
          if (isset($this->request->get['idfhtras'])) {
            $idfhtras = $this->request->get['idfhtras'];
            $this->db->query("delete from traslados_salidas where idtraslados_salidas='".$idfhtras."'");
            $json['success'] = 'Fecha de traslado eliminada';
            $this->response->setOutput(json_encode($json));
          }
	}
	
	public function UpdatetrasFH() {
          if ( isset($this->request->get['idfhtras']) && isset($this->request->get['fcha']) ) {
            $idfhtras = $this->request->get['idfhtras'];
            $query="update traslados_salidas set fecha='".$this->request->get['fcha'];
            $query.="', hora='".$this->request->get['hr'];
            $query.="', minper=".$this->request->get['mnp'];
            $query.=", maxper=".$this->request->get['mxp'];
            $query.=", via='".$this->request->get['trs'];
            $query.="' where idtraslados_salidas=".$idfhtras;
            $this->db->query($query);
            $json['success'] = 'Fecha de traslado actualizada';
            $this->response->setOutput(json_encode($json));
          }
	}

	public function eliminaciudadsal(){
		if (isset($this->request->get['idcsal'])) {
				$idcsal=$this->request->get['idcsal'];
				$this->db->query("delete from circuitos_cddsal where idcsal='".$idcsal."'");
			} else {
				$idcsal='';
			}

			$json['success'] = 'Ciudad Eliminada';
                        $this->response->setOutput(json_encode($json));
        }

        public function asignacatg2hot(){
		if (isset($this->request->get['catg']) && isset($this->request->get['idp']) && isset($this->request->get['idhct'])) {
                  $catg=$this->request->get['catg'];
                  $idp=$this->request->get['idp'];
                  $idhct=$this->request->get['idhct'];
                  if($idhct==0){
                    $this->db->query("insert into hotels_ctgs values(default,'".$idp."','".$catg."',null,null)");
                  }else{
                    $this->db->query("update hotels_ctgs set catg='".$catg."' where idhct='".$idhct."'");
                  }
                }
                $json['success'] = 'Categoria asignada';
                $this->response->setOutput(json_encode($json));
        }

        public function saveHHors(){
		if (isset($this->request->get['hhini']) && isset($this->request->get['hhsal']) && isset($this->request->get['idhct'])) {
                  $hhini=$this->request->get['hhini'];
                  $hhsal=$this->request->get['hhsal'];
                  $idhct=$this->request->get['idhct'];
                  $idp=$this->request->get['idp'];
                  if($idhct==0){
                    $this->db->query("insert into hotels_ctgs values(default,'".$idp."','1','".$hhini."','".$hhsal."')");
                  }else{
                    $this->db->query("update hotels_ctgs set hhini='".$hhini."', hhsal='".$hhsal."' where idhct='".$idhct."'");
                  }
                }
                $json['success']='Horario guardado';
                $this->response->setOutput(json_encode($json));
        }

        public function saveTraslds(){
		if (isset($this->request->get['org']) && isset($this->request->get['dst']) && isset($this->request->get['cinsn'])
                  && isset($this->request->get['cadlt']) && isset($this->request->get['cinft'])
                  && isset($this->request->get['product_id']) && isset($this->request->get['idtras']) ) {
                  $org=$this->request->get['org'];
                  $dst=$this->request->get['dst'];
                  $cadlt=$this->request->get['cadlt'];
                  $cinft=$this->request->get['cinft'];
                  $cinsn=$this->request->get['cinsn'];
                  $idpro=$this->request->get['product_id'];
                  $idtras=$this->request->get['idtras'];
                  if($idtras==0){
                    $this->db->query("insert into traslados values(default,'".$idpro."','".$org."','".$dst."','".$cadlt."','".$cinft."','".$cinsn."')");
                  }else{
                    $this->db->query("update traslados set origen='".$org."', destino='".$dst."', pre_adult='".$cadlt."', pre_inft='".$cinft."', pre_insen='".$cinsn."' where idtraslados='".$idtras."'");
                  }
                }
                $json['success']='Datos de traslado guardados';
                $this->response->setOutput(json_encode($json));
        }

        public function saveFTraslds(){
		if (isset($this->request->get['fcha']) && isset($this->request->get['hora']) && isset($this->request->get['pmin'])
                  && isset($this->request->get['pmax']) && isset($this->request->get['via'])
                  && isset($this->request->get['product_id']) ) {
                  $fcha=$this->request->get['fcha'];
                  $hora=$this->request->get['hora'];
                  $pmin=$this->request->get['pmin'];
                  $pmax=$this->request->get['pmax'];
                  $via=$this->request->get['via'];
                  $idpro=$this->request->get['product_id'];
                  $this->db->query("insert into traslados_salidas values(default,'".$idpro."','".$fcha."','".$hora."','".$pmin."','".$pmax."','".$via."')");
                  $json['success']='Horario de traslado agregado';
                  $this->response->setOutput(json_encode($json));
                }
        }

	public function gusrdahabitacion(){
		if (isset($this->request->get['tipo'])) {
                  $tipo = $this->request->get['tipo'];
                } else { $tipo = ''; }
		if (isset($this->request->get['precio'])) {
				$precio = $this->request->get['precio'];
			} else { $precio = ''; }
		if (isset($this->request->get['ffin'])) {
				$ffin = $this->request->get['ffin'];
			} else { $ffin = ''; }
		if (isset($this->request->get['finicio'])) {
				$finicio = $this->request->get['finicio'];
			} else { $finicio = ''; }
		if (isset($this->request->get['habilitado'])) {
				$habilitado = $this->request->get['habilitado'];
			} else { $habilitado = ''; }
		if (isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];
			} else { $product_id = ''; }
		$this->db->query("INSERT INTO habitaciones SET id_producto = '" . $product_id . "', tipo = '" . $tipo . "', ffin = '" . $ffin . "', finicio = '" . $finicio . "', habilitado = '" . (boolean)$habilitado . "', precio='".$precio."'");
		$json[] = array(
			'respuesta' => $tipo,
		);
		$json['success'] = 'Habitación Registrada';
     	$this->response->setOutput(json_encode($json));
	}
	
	public function UpdateHabitacion(){
		if (isset($this->request->get['tipo'])&&isset($this->request->get['precio'])&&isset($this->request->get['ffin'])&&isset($this->request->get['finicio'])) {
            $tipo = $this->request->get['tipo'];
            $precio = $this->request->get['precio'];
            $ffin = $this->request->get['ffin'];
            $finicio = $this->request->get['finicio'];
            $habilitado = (isset($this->request->get['habilitado'])?$this->request->get['habilitado']:0);
            $idh = $this->request->get['idh'];
            $this->db->query("update habitaciones SET tipo='".$tipo."', ffin='".$ffin."', finicio='".$finicio."', habilitado='".(boolean)$habilitado."', precio='".$precio."' where idhabitaciones=".$idh);
			$json['success'] = 'Habitación Registrada';
     		$this->response->setOutput(json_encode($json));
        }
	}
	
	
	public function AgregarHabDescAnt() {
		if (isset($this->request->get['dias'])) {
				$dias = $this->request->get['dias'];
			} else { $dias = '0'; }
		if (isset($this->request->get['porcentaje'])) {
				$porcentaje = $this->request->get['porcentaje'];
			} else { $porcentaje = '0'; }			
			if (isset($this->request->get['ffin'])) {
				$ffin = $this->request->get['ffin'];
			} else { $ffin = ''; }
			if (isset($this->request->get['finicio'])) {
				$finicio = $this->request->get['finicio'];
			} else { $finicio = ''; }
			if (isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];
			} else { $product_id = ''; }	
			$this->db->query("INSERT INTO habdescant SET id_producto = '" . $product_id . "', dias = '" . $dias . "', ffin = '" . $ffin . "', finicio = '" . $finicio . "', porcentaje='".$porcentaje."'");						
				$json['success'] = 'Descuento Registrado';
		$this->response->setOutput(json_encode($json));
	}

	public function UpdateHabDescAnt() {
		if (isset($this->request->get['dias'])) {
				$dias = $this->request->get['dias'];
			} else { $dias = '0'; }
		if (isset($this->request->get['porcentaje'])) {
				$porcentaje = $this->request->get['porcentaje'];
			} else { $porcentaje = '0'; }			
			if (isset($this->request->get['ffin'])) {
				$ffin = $this->request->get['ffin'];
			} else { $ffin = ''; }
			if (isset($this->request->get['finicio'])) {
				$finicio = $this->request->get['finicio'];
			} else { $finicio = ''; }
			$idh = $this->request->get['idh'];
			$query="update habdescant SET dias='".$dias."', ffin='".$ffin."', finicio='".$finicio."', porcentaje='".$porcentaje."' where idHabDescAnt=".$idh;
			$this->db->query($query);
		$json['success'] = 'Descuento Registrado';
		$this->response->setOutput(json_encode($json));
	}
	
	public function EliminaHabitacionDescAnt() {
		if (isset($this->request->get['id'])) {
				$id = $this->request->get['id'];
				
				$this->db->query("delete from habdescant where  idHabDescAnt = '" . $id . "'");
			} else {
				$id = '';
			}
			
			$json['success'] = 'Descuento Eliminado';
     $this->response->setOutput(json_encode($json));
			
	}
	
	//descuento noches totales
	
	
	public function AgregarHabDescNoches() {
		if (isset($this->request->get['nochestotales'])) {
				$nochestotales = $this->request->get['nochestotales'];
			} else { $nochestotales = '0'; }
		if (isset($this->request->get['nochesdescuento'])) {
				$nochesdescuento = $this->request->get['nochesdescuento'];
			} else { $nochesdescuento = '0'; }
			if (isset($this->request->get['ffin'])) {
				$ffin = $this->request->get['ffin'];
			} else { $ffin = ''; }
			if (isset($this->request->get['finicio'])) {
				$finicio = $this->request->get['finicio'];
			} else { $finicio = ''; }			 
			if (isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];
			} else { $product_id = ''; }			
			if (isset($this->request->get['minper'])) {
				$minper = $this->request->get['minper'];
			} else { $minper = '0'; }
			$this->db->query("INSERT INTO habdescnoches SET id_producto = '" . $product_id . "', nochestotales = '" . $nochestotales . "', ffin = '" . $ffin . "', finicio = '" . $finicio . "', nochesdescuento='".$nochesdescuento."'". ", minper='".$minper."'");
			$json['success'] = 'Descuento Registrado';
     $this->response->setOutput(json_encode($json));
	}

	public function UpdateHabDescNoches() {
		if (isset($this->request->get['nochestotales'])) {
				$nochestotales = $this->request->get['nochestotales'];
			} else { $nochestotales = '0'; }
		if (isset($this->request->get['nochesdescuento'])) {
				$nochesdescuento = $this->request->get['nochesdescuento'];
			} else { $nochesdescuento = '0'; }
		if (isset($this->request->get['ffin'])) {
				$ffin = $this->request->get['ffin'];
			} else { $ffin = ''; }
		if (isset($this->request->get['finicio'])) {
				$finicio = $this->request->get['finicio'];
			} else { $finicio = ''; }			 
		if (isset($this->request->get['minper'])) {
				$minper = $this->request->get['minper'];
			} else { $minper = '0'; }
		$idh=$this->request->get['idh'];
		$query="update habdescnoches SET nochestotales='".$nochestotales."', ffin='".$ffin."', finicio='".$finicio."', nochesdescuento='".$nochesdescuento."'". ", minper='".$minper."' where idhabdescNoches=".$idh;
		$this->db->query($query);
		$json['success'] = 'Descuento Registrado';
     	$this->response->setOutput(json_encode($json));
	}
	
	public function EliminaHabitacionDescNoches() {
		if (isset($this->request->get['id'])) {
				$id = $this->request->get['id'];
				
				$this->db->query("delete from habdescnoches where  idhabdescNoches = '" . $id . "'");
			} else {
				$id = '';
			}
			
			$json['success'] = 'Descuento Eliminado';
     $this->response->setOutput(json_encode($json));
			
	}
	//fin de hoteles
	
	
	//inicio de Tours

	public function AgregarTour(){
		if (isset($this->request->get['tipo'])) {
                  $tipo = $this->request->get['tipo'];
                } else { $tipo = ''; }
                if (isset($this->request->get['precio'])) {
                  $precio = $this->request->get['precio'];
                } else { $precio = ''; }
                if (isset($this->request->get['habilitado'])) {
                  $habilitado = $this->request->get['habilitado'];
                } else { $habilitado = ''; }
                if (isset($this->request->get['product_id'])) {
                  $product_id = $this->request->get['product_id'];
                } else { $product_id = ''; }
                if (isset($this->request->get['leaving'])) {
                  $leaving=$this->request->get['leaving'];
                } else { $leaving=0; }
                $this->db->query("INSERT INTO tours SET id_producto = '" . $product_id . "', tipo = '" . $tipo . "', precio='".$precio."', idsalida=".$leaving);
                $json[] = array( 'respuesta' => $tipo );
                $json['success'] = 'Precio del tour registrado';
                $this->response->setOutput(json_encode($json));
    }

    public function UpdateTour(){
		if ( isset($this->request->get['tipo']) && isset($this->request->get['precio']) && isset($this->request->get['leaving'])) {
            $tipo = $this->request->get['tipo'];
            $precio = $this->request->get['precio'];
            $leaving=$this->request->get['leaving'];
            $idt=$this->request->get['idt'];
            $this->db->query("update tours SET tipo='".$tipo."', precio='".$precio."', idsalida=".$leaving." where idtours=".$idt);
            $json['success']='Precio del tour actualizado';
            $this->response->setOutput(json_encode($json));
        }
    }
	
	public function EliminaTours() {
		if (isset($this->request->get['id'])) {
				$id = $this->request->get['id'];
				
				$this->db->query("delete from tours where  idtours = '" . $id . "'");
			} else {
				$id = '';
			}
			
			$json['success'] = 'Precio de tour eliminado';
     $this->response->setOutput(json_encode($json));
			
	}
	//fin de Tours
	
	
	
	
	
	
	
	//inicio de circuitos
	public function AgregarCircuito() {
		if (isset($this->request->get['tipo'])) {
				$tipo = $this->request->get['tipo'];
			} else { $tipo = ''; }
			if (isset($this->request->get['categoria'])) {
				$categoria = $this->request->get['categoria'];
			} else { $categoria = ''; }
		if (isset($this->request->get['precio'])) {
				$precio = $this->request->get['precio'];
			} else { $precio = ''; }
			if (isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];
			} else { $product_id = ''; }
		if (isset($this->request->get['leaving'])) {
			$leaving=$this->request->get['leaving'];
        } else { $leaving=0; }
        $this->db->query("INSERT INTO circuitos SET id_producto = '" . $product_id . "', tipo = '" . $tipo ."', estrellas = '" . $categoria . "', precio='".$precio."', idsalida=".$leaving);
        $json['success'] = 'Circuito registrado';
        $this->response->setOutput(json_encode($json));
	}

	public function UpdateCircuito() {
		if (isset($this->request->get['tipo']) && isset($this->request->get['categoria'])&&isset($this->request->get['precio'])&&isset($this->request->get['leaving'])) {
			$tipo=$this->request->get['tipo'];
			$categoria=$this->request->get['categoria'];
			$precio=$this->request->get['precio'];
			$leaving=$this->request->get['leaving'];
			$idc=$this->request->get['idc'];
		}
        $this->db->query("UPDATE circuitos SET tipo='".$tipo."', estrellas='".$categoria."', precio='".$precio."', idsalida=".$leaving." where idcircuitos=".$idc);
        $json['success'] = 'Habitacion precio actualizado';
        $this->response->setOutput(json_encode($json));
	}
	
	public function EliminaCircuito() {
		if (isset($this->request->get['id'])) {
				$id = $this->request->get['id'];
				
				$this->db->query("delete from circuitos where  idcircuitos = '" . $id . "'");
			} else {
				$id = '';
			}
			
			$json['success'] = 'Circuito eliminado';
     $this->response->setOutput(json_encode($json));
			
	}
	
	
	public function hotelescircuito() {
          if (isset($this->request->get['nocheshotelciudad'])) {
            $nocheshotelciudad = $this->request->get['nocheshotelciudad'];
          } else { $nocheshotelciudad = '0'; }
          if (isset($this->request->get['hotel'])) {
            $hotel = $this->request->get['hotel'];
          } else { $hotel = ''; }
          if (isset($this->request->get['ciudad'])) {
            $ciudad = $this->request->get['ciudad'];
          } else { $ciudad = ''; }
          if (isset($this->request->get['product_id'])) {
            $product_id = $this->request->get['product_id'];
          } else { $product_id = ''; }
          $this->db->query("INSERT INTO circuitos_hoteles SET id_producto = '" . $product_id . "', hotel = '" . $hotel ."', ciudad = '" . $ciudad . "', noches = '" . $nocheshotelciudad . "' ");
          $json['success'] = 'Hote registrado';
          $this->response->setOutput(json_encode($json));
	}

	public function updatehotelescircuito() {
          if (isset($this->request->get['nocheshotelciudad']) && isset($this->request->get['hotel']) && isset($this->request->get['ciudad'])){
            $nocheshotelciudad = $this->request->get['nocheshotelciudad'];
            $hotel = $this->request->get['hotel'];
            $ciudad = $this->request->get['ciudad'];
            $idh= $this->request->get['idhc'];
            $this->db->query("Update circuitos_hoteles SET hotel='".$hotel."', ciudad='".$ciudad."', noches='".$nocheshotelciudad."' where idcircuitos_hoteles=".$idh);
          	$json['success'] = 'Hotel registrado';
          	$this->response->setOutput(json_encode($json));
          }
	}
	
	
	public function Eliminahotelescircuito() {
		if (isset($this->request->get['id'])) {
				$id = $this->request->get['id'];
				$this->db->query("delete from circuitos_hoteles where  idcircuitos_hoteles = '" . $id . "'");
			} else {
				$id = '';
			}
			
			$json['success'] = 'Hotel del Circuito eliminado';
     $this->response->setOutput(json_encode($json));
			
	}
	
	
	public function ciudades() {
		$idprod=$this->request->get['idprod'];
		$cddsal=$this->request->get['cddsal'];
		$tua=$this->request->get['tua'];
        $this->db->query("INSERT INTO circuitos_cddsal SET idprod='".$idprod."', ciudad='".$cddsal."', tua='".$tua."'");
        $json['success'] = 'Ciudad agregada';
        $this->response->setOutput(json_encode($json));
	}
	public function updateCiudades() {
		$idc=$this->request->get['idc'];
		$cddsal=$this->request->get['cddsal'];
		$tua=$this->request->get['tua'];
        $this->db->query("Update circuitos_cddsal SET ciudad='".$cddsal."', tua='".$tua."' where idcsal=".$idc);
        $json['success'] = 'Ciudad actualizada';
        $this->response->setOutput(json_encode($json));
	}


	public function salidas() {
		if (isset($this->request->get['cddsalida'])) {
				$cddsalida = $this->request->get['cddsalida'];
			} else { $cddsalida = '0'; }
			if (isset($this->request->get['fechainiciosalida'])) {
				$fechainiciosalida = $this->request->get['fechainiciosalida'];
			} else { $fechainiciosalida = ''; }
		 if (isset($this->request->get['fechafinsalida'])) {
				$fechafinsalida = $this->request->get['fechafinsalida'];
			} else { $fechafinsalida = ''; }
			if (isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];
			} else { $product_id = ''; }
		$this->db->query("insert into circuitos_salidas   SET  idcdd='".$cddsalida."',  finicio = '" . $fechainiciosalida . "',  ffin = '" . $fechafinsalida . "', id_producto = '" . $product_id . "'");
        $json['success'] = 'Salida registrada';
        $this->response->setOutput(json_encode($json));
	}

	public function updatesalidas() {
		if (isset($this->request->get['cddsalida']) && isset($this->request->get['fechainiciosalida']) && isset($this->request->get['fechafinsalida']) && isset($this->request->get['idc'])) {
			$cddsalida = $this->request->get['cddsalida'];
			$fechainiciosalida = $this->request->get['fechainiciosalida'];
			$fechafinsalida = $this->request->get['fechafinsalida'];
			$idc = $this->request->get['idc'];
			$this->db->query("update circuitos_salidas SET finicio='".$fechainiciosalida."',  ffin='".$fechafinsalida."', idcdd='".$cddsalida."' where idcircuitos_salidas=".$idc);
        	$json['success'] = 'Salida registrada';
        	$this->response->setOutput(json_encode($json));
        }
	}


	public function Eliminasalidas() {
		if (isset($this->request->get['id'])) {
				$id = $this->request->get['id'];
				
				$this->db->query("delete from circuitos_salidas where  idcircuitos_salidas = '" . $id . "'");
			} else {
				$id = '';
			}
			
			$json['success'] = 'Salida eliminada';
     $this->response->setOutput(json_encode($json));
			
	}
}
?>
