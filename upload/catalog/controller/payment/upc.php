<?php
class ControllerPaymentUPC extends Controller {	
	
	public function index() {

	$data['button_confirm'] = $this->language->get('button_confirm');

	$this->load->model('checkout/order');
	$this->load->language('payment/upc');

	// form action
	if ($this->config->get('upc_server') == 'live') {
		$data['action'] = 'https://secure.upc.ua/go/enter';
	} else if( $this->config->get('upc_server') == 'test'){
		$data['action'] = 'https://secure.upc.ua/ecgtest/enter';		
	}	

	$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
	
	$data['merchant_id'] = $this->config->get('upc_merch_id');
	$data['terminal_id'] = $this->config->get('upc_terminal_id');

	
	$path_merchant_key = $this->config->get('upc_key_merchant');	
	$data['order_id'] = $this->session->data['order_id'];	
	
 	$text_order_upc = html_entity_decode($this->language->get('text_order_upc'), ENT_QUOTES, 'UTF-8');
	
	$data['description'] = html_entity_decode($this->config->get('config_name').' '.$text_order_upc.''.$order_info['order_id'], ENT_QUOTES, 'UTF-8');
	
	$uah_code = "UAH";
	$uah_order_total = $this->currency->convert($order_info['total'], $order_info['currency_code'], $uah_code);
	$data['amount'] = $this->currency->format($uah_order_total, $uah_code, $order_info['currency_value'], FALSE)*100;
	$data['curr'] = '980';	
	$data['time'] = date('ymdHis');
	
	$lang = $this->session->data['language'];
	
	switch ($lang){
		case 'ru':
			$data['language'] = 'ru';
			break;
		case 'ua':
		case 'uk':
			$data['language'] = 'uk';
			break;
		case 'hr':
			$data['language'] = 'hr';
			break;
		case 'fr':
			$data['language'] = 'fr';
			break;
		case 'de':
			$data['language'] = 'de';
			break;
		default:
			$data['language'] = 'en';
	}
	
	// vars
	$merchant_id = $this->config->get('upc_merch_id');
	$terminal_id = $this->config->get('upc_terminal_id');	
	$time = date('ymdHis');	
	$order_id = $this->session->data['order_id'];	
	$curr = '980';
	$amount = $this->currency->format($uah_order_total, $uah_code, $order_info['currency_value'], FALSE)*100;	
	
	$udata = "$merchant_id;$terminal_id;$time;$order_id;$curr;$amount;;";
	
	$fp = fopen($path_merchant_key, "r");
	$pkey = fread($fp, 8192); 
	fclose($fp);
	$pkeyid = openssl_get_privatekey($pkey);
	openssl_sign($udata , $signature, $pkeyid);
	openssl_free_key($pkeyid);
	$data['b64sign'] = base64_encode($signature);
	

	 
	
if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/upc.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/upc.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/upc.tpl', $data);
		}
		
}

	
	public function fail() {
	
		$this->response->redirect($this->url->link('checkout/payment', '', 'SSL'));
		
		return TRUE;
	}
	
	public function success() {
		
		$order_id = (int)$this->request->post['OrderID'];
		
		$this->load->model('checkout/order');
		
		$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('upc_order_status_id'), 'UPC');
		
		$this->response->redirect($this->url->link('checkout/success', '', 'SSL'));
		
		return TRUE;
		
	}
	
	public function callback(){
	
		$MerchantID      = $this->request->post['MerchantID'];
		$TerminalID      = $this->request->post['TerminalID'];
		$PurchaseTime    = $this->request->post['PurchaseTime'];
		$OrderID         = $this->request->post['OrderID'];
		$CurrencyID      = $this->request->post['Currency'];
		$TotalAmount     = $this->request->post['TotalAmount'];
		$ApprovalCode    = $this->request->post['ApprovalCode'];
		$XID             = $this->request->post['XID'];
		$TranCode        = $this->request->post['TranCode'];
		
	if ($this->request->post['TranCode'] == "000")
	{			
		$udata = "$MerchantID;$TerminalID;$PurchaseTime;$OrderID;$XID;$CurrencyID;$TotalAmount;;$TranCode;$ApprovalCode;";		
		$signature = base64_decode($this->request->post['Signature']);	
		
		$path_server_key = $this->config->get('upc_key_server');
		
		$fp = fopen($path_server_key, "r"); 
		$pkey = fread($fp, 8192); 
		fclose($fp);

		$pubkeyid = openssl_get_publickey($pkey);
		$ok = openssl_verify($udata, $signature, $pubkeyid);
			
		if ($ok == 1)
		{
			echo "<b>good</b>";
		} 
		else if ($ok == 0) 
		{
			echo "<b>bad</b>";
		}
		else
		{
			echo "ugly, error checking signature";
		}

		openssl_free_key($pubkeyid);
	}
	
	print
	"MerchantID=".$MerchantID."\n".
	"TerminalID=".$TerminalID."\n".
	"OrderID=".$OrderID."\n".
	"Currency=".$CurrencyID."\n".
	"TotalAmount=".$TotalAmount."\n".
	"XID=".$XID."\n".
	"PurchaseTime=".$PurchaseTime."\n\n".
	"Response.action=approve\n".
	"Response.reason=\n".
	"Response.forwardUrl=";

	exit;
	
	}

}
?>