<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('Base_Controller.php');
class Sales extends Base_Controller{

	public function add_sale() {
		$this->load->model('model_sales');
		$data['lotlist'] = $this->model_sales->get_lot_list();
		$this->load_view('add_sale',$data);
	}

	public function add_sale_details() {
		$name=$this->input->post('name');
		$lotid=$this->input->post('lotid');
		$qty=$this->input->post('qty');
		$price=$this->input->post('price');
		$current_qty=$this->input->post('qty');
		$this->load->model('model_lots');
		$lot_qty = $this->model_lots->get_lot_list_by_lot_id($lotid);
		if($lot_qty>=$qty) {		
			$balqty = $lot_qty - $qty;
			$this->model_lots->update_current_qty($lotid,$balqty);
		} else {
			echo "bad";
		}
		$this->load->model('model_sales');
		$this->model_sales->add_sale_details($name,$lotid,$qty,$price);
	}

	public function list_sales() {
		$this->load->model('model_lots');
		$this->load->model('model_sales');
		$datalist = $this->model_sales->get_sales_list();
		foreach($datalist as $datalists) {
			$datalists->lot_name=$this->fetch_lot_name_from_id($datalists->LOT_ID);
		}
		$data['list'] = $datalist;
		$this->load_view('list_sales',$data);
	}

	public function fetch_lot_name_from_id($id) {
		$name = $this->model_sales->fetch_lot_name($id);
		return $name;
	}
}
?>