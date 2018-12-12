<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('Base_Controller.php');
class Purchases extends Base_Controller {

	public function add_purchase() {
		$data['message']="";
		$this->load->model('model_purchase');
		$this->load_view('add_purchase', $data);
	}

	public function insert_purchase() {
		$name  = $this->input->post('name');
		$desc 	= $this->input->post('desc');
		$created_by = $this->session->userdata('uid');
		
		$this->load->model('model_purchase');
		$stock_id = $this->model_purchase->insert_name($name,$desc,$created_by);
		$items = $this->session->userdata('items_for_purchase');
		foreach($items as $item) {
			$this->model_purchase->transfer_id($stock_id,$item['id'],$item['qty'],$item['qty'],$item['rate'],$created_by);
			$qtys = $this->model_purchase->add_qty($item['id'],$item['qty']);
		}
		$blank = array();
		$this->session->set_userdata('items_for_purchase', $blank);
		$data['message'] = "The Purchase was successful. Your stocks have been updated now.";
		$this->load_view('add_purchase', $data);
	}
}
?>
