<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('Base_Controller.php');
class Lot extends Base_Controller{

	public function add_lot(){
		$this->load->model('model_lots');
		$result['samples'] = $this->model_lots->sample_name_list();
		$this->load_view('add_lot',$result);	
	}

	public function add_lot_details(){
		$lname = $this->input->post('lname');
		$samples = $this->input->post('samples');
		$qty = $this->input->post('qty');
		$currt_qty = $this->input->post('qty');
		
		$this->load->model('model_samples');
		$this->load->model('model_lots');

		$sampleitems = $this->model_samples->get_items_by_sample_id($samples);
		$flag = 1;

		foreach($sampleitems as $item) {
			$qty_required = $qty * $item->QUANTITY;
			$current_qty = $this->get_current_qty_for_item($item->ITEM_ID);
			if($current_qty >= $qty_required) {
			} else {
				$flag = 0;
				break;
			}
		}

		if($flag == 1) {
			$lot_id = $this->model_lots->add_lot_model($lname,$samples,$qty,$currt_qty);
			foreach($sampleitems as $item) {
				$qty_required = $qty * $item->QUANTITY;
				$qty_required_balance = $qty_required;
				$result = $this->get_item_stock_inward_details($item->ITEM_ID);
				foreach($result as $row) {
					if($qty_required_balance != 0) {
						if($row->BALANCE <= $qty_required_balance) {
							$this->empty_balance_for_row($row->ID);
							$qty_required_balance = $qty_required_balance - $row->BALANCE;
							$this->model_lots->add_lot_details_into_stock_outward($lot_id,$item->ITEM_ID,$row->BALANCE, $row->RATE);
						} else {
							$this->subtract_from_balance($row->ID, $qty_required_balance);
							$this->model_lots->add_lot_details_into_stock_outward($lot_id,$item->ITEM_ID,$qty_required_balance, $row->RATE);
							$qty_required_balance = 0;
						}
					} else {
						break;
					}
				}
				$this->model_items->subtract_qty_item_list($qty_required, $item->ITEM_ID);
				redirect(site_url('lot/list_lots'));
			}			
		} else {
			echo "Insufficient Stock";
		}
	}

	function subtract_from_balance($id, $qty_required_balance) {
		$this->load->model('model_items');
		$result = $this->model_items->subtract_from_balance($id, $qty_required_balance);
		return $result;	
	}

	function empty_balance_for_row($id) {
		$this->load->model('model_items');
		$result = $this->model_items->empty_balance_for_row($id);
		return $result;	
	}

	function get_item_stock_inward_details($id) {
		$this->load->model('model_items');
		$result = $this->model_items->get_item_stock_inward_details($id);
		return $result;	
	}

	function get_current_qty_for_item($id) {
		$this->load->model('model_items');
		$result = $this->model_items->items_details_show($id);
		return $result->CURRENT_QTY;
	}

	public function list_lots() {
		$this->load->model('model_lots');
		$result = $this->model_lots->fetch_lot_list();
		foreach($result as $row) {
			$row->sample_name = $this->get_samplename_by_sampleid($row->SAMPLE_ID);
		}
		$res['lot'] = $result;
		$this->load_view('list_lots',$res);
	}

	public function get_samplename_by_sampleid($id) {
		$this->load->model('model_samples');
		$result = $this->model_samples->get_sample_name_by_sampleid($id);
		return $result;
	}
}
?>