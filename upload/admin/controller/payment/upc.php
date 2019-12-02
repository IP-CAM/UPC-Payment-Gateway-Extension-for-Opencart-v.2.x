<?php
class ControllerPaymentUPC extends Controller{
	
	private $error = array();
	
	public function index(){
		
	$this->load->language('payment/upc');
	
	$this->document->setTitle($this->language->get('heading_title'));
	
	$this->load->model('setting/setting');
	
	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()){
		
			$this->model_setting_setting->editSetting('upc', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		
		}
		
	$data['heading_title'] = $this->language->get('heading_title');
	$data['text_edit'] = $this->language->get('text_edit');
	$data['entry_merch_id'] = $this->language->get('entry_merch_id');
	$data['entry_terminal_id'] = $this->language->get('entry_terminal_id');
	$data['entry_key_merchant'] = $this->language->get('entry_key_merchant');
	$data['entry_key_server'] = $this->language->get('entry_key_server');
	$data['entry_result_url'] = $this->language->get('entry_result_url');
	$data['entry_success_url'] = $this->language->get('entry_success_url');
	$data['entry_fail_url'] = $this->language->get('entry_fail_url');
	
	$data['text_enabled'] = $this->language->get('text_enabled');
	$data['text_disabled'] = $this->language->get('text_disabled');
	$data['text_all_zones'] = $this->language->get('text_all_zones');	
	$data['text_test'] = $this->language->get('text_test');
	$data['text_live'] = $this->language->get('text_live');
	
	$data['entry_server'] = $this->language->get('entry_server');
	$data['entry_order_status'] = $this->language->get('entry_order_status');
	$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
	$data['entry_status'] = $this->language->get('entry_status');
	$data['entry_sort_order'] = $this->language->get('entry_sort_order');
	$data['entry_dev'] = $this->language->get('entry_dev');
		
	$data['button_save'] = $this->language->get('button_save');
	$data['button_cancel'] = $this->language->get('button_cancel');
	$data['tab_general'] = $this->language->get('tab_general');
	
	if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
	} else {
			$data['error_warning'] = '';
	}
	
	if (isset($this->error['merch_id'])) {
			$data['error_merch_id'] = $this->error['merch_id'];
	} else {
			$data['error_merch_id'] = '';
	}
	
	if (isset($this->error['terminal_id'])) {
			$data['error_terminal_id'] = $this->error['terminal_id'];
	} else {
			$data['error_terminal_id'] = '';
	}
	
	if (isset($this->error['key_merchant'])) {
			$data['error_key_merchant'] = $this->error['key_merchant'];
	} else {
			$data['error_key_merchant'] = '';
	}
	
	if (isset($this->error['key_server'])) {
			$data['error_key_server'] = $this->error['key_server'];
	} else {
			$data['error_key_server'] = '';
	}
	
	$data['breadcrumbs'] = array();

   	$data['breadcrumbs'][] = array(
       	'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      	'separator' => false
   	);
	
	$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   	);

   	$data['breadcrumbs'][] = array(
        'text'      => $this->language->get('heading_title'),
		'href'      => $this->url->link('payment/upc', 'token=' . $this->session->data['token'], 'SSL'),      		
      	'separator' => ' :: '
   	);
	
	$data['action'] = $this->url->link('payment/upc', 'token=' . $this->session->data['token'], 'SSL');
		
	$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
	
	//Merchant ID
	if (isset($this->request->post['upc_merch_id'])) {
		$data['upc_merch_id'] = $this->request->post['upc_merch_id'];
	} else {
		$data['upc_merch_id'] = $this->config->get('upc_merch_id');
	}
	
	//Terminal ID
	if (isset($this->request->post['upc_terminal_id'])) {
		$data['upc_terminal_id'] = $this->request->post['upc_terminal_id'];
	} else {
		$data['upc_terminal_id'] = $this->config->get('upc_terminal_id');
	}

	if (isset($this->request->post['upc_key_merchant'])) {
		$data['upc_key_merchant'] = $this->request->post['upc_key_merchant'];
	} else {
		$data['upc_key_merchant'] = $this->config->get('upc_key_merchant');
	}
	
	if (isset($this->request->post['upc_key_server'])) {
		$data['upc_key_server'] = $this->request->post['upc_key_server'];
	} else {
		$data['upc_key_server'] = $this->config->get('upc_key_server');
	}
	
	if (isset($this->request->post['upc_server'])) {
		$data['upc_server'] = $this->request->post['upc_server'];
	} else {
		$data['upc_server'] = $this->config->get('upc_server');
	}
	
	
	// URLs
	$data['upc_result_url'] 	= HTTP_CATALOG . 'index.php?route=payment/upc/callback';
	$data['upc_success_url'] 	= HTTP_CATALOG . 'index.php?route=payment/upc/success';
	$data['upc_fail_url'] 	= HTTP_CATALOG . 'index.php?route=payment/upc/fail';
	
	if (isset($this->request->post['upc_order_status_id'])) {
		$data['upc_order_status_id'] = $this->request->post['upc_order_status_id'];
	} else {
		$data['upc_order_status_id'] = $this->config->get('upc_order_status_id'); 
	}
		
	$this->load->model('localisation/order_status');
	
	$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
	if (isset($this->request->post['upc_geo_zone_id'])) {
		$data['upc_geo_zone_id'] = $this->request->post['upc_geo_zone_id'];
	} else {
		$data['upc_geo_zone_id'] = $this->config->get('upc_geo_zone_id'); 
	}
	
	$this->load->model('localisation/geo_zone');
		
	$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
	
	if (isset($this->request->post['upc_status'])) {
		$data['upc_status'] = $this->request->post['upc_status'];
	} else {
		$data['upc_status'] = $this->config->get('upc_status');
	}
		
	if (isset($this->request->post['upc_sort_order'])) {
		$data['upc_sort_order'] = $this->request->post['upc_sort_order'];
	} else {
		$data['upc_sort_order'] = $this->config->get('upc_sort_order');
	}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/upc.tpl', $data));
	
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/upc')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['upc_merch_id']) {
			$this->error['merch_id'] = $this->language->get('error_merch_id');
		}
		
		if (!$this->request->post['upc_terminal_id']) {
			$this->error['terminal_id'] = $this->language->get('error_terminal_id');
		}
		
		if (!$this->request->post['upc_key_merchant']) {
			$this->error['key_merchant'] = $this->language->get('error_key_merchant');
		}
		
		if (!$this->request->post['upc_key_server']) {
			$this->error['key_server'] = $this->language->get('error_key_server');
		}
		
		return !$this->error;
	}
}
?>