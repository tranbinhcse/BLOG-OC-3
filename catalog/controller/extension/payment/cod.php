<?php
class ControllerExtensionPaymentCod extends Controller {
	public function index() {
		$data['text_loading'] = $this->language->get('text_loading');
		
		$data['button_confirm'] = $this->language->get('button_confirm');

		return $this->load->view('extension/payment/cod', $data);
	}

	public function confirm() {
		$json = array();
		
		if ($this->session->data['payment_method']['code'] == 'cod') {
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('payment_cod_order_status_id'));
		
			$json['redirect'] = $this->url->link('checkout/success');
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));		
	}
}