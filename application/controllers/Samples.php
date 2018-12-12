<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('Base_Controller.php');
class Samples extends Base_Controller {
	function add_item_to_session() {
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$qty = $this->input->post('qty');
		$data = $this->session->userdata('items_for_sample');
		$data[$id] = array(
			'id' => $id,
			'name' => $name,
			'qty' => $qty
		);
		$this->session->set_userdata('items_for_sample', $data);
		$html = '<div class="panel panel-flat">
		<div class="panel-body">
		<table class = "table">
		<tr>
		<th>Name</th>
		<th>Quantity</th>
		<th>Delete Items</th>
		</tr>';
		foreach($data as $row) {
			$html.= '<tr>
			<td>' . $row["name"] . '</td>
			<td>' . $row["qty"] . '</td>
			<td><button type = "button" class = "btn btn-danger" onclick="myItemsId(' . $row['id'] . ')">Delete</button></td>
			</tr>';
		}
		$html.= '</table></div></div>';
		echo $html;
	}

	function add_item_to_purchase_session() {
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$qty = $this->input->post('qty');
		$rate = $this->input->post('rate');
		$data = $this->session->userdata('items_for_purchase');
		$data[$id] = array(
			'id' => $id,
			'name' => $name,
			'qty' => $qty,
			'rate' => $rate
		);
		
		$this->session->set_userdata('items_for_purchase', $data);

		$html = '<div class="panel panel-flat">
		<div class="panel-body">
		<table class = "table">
		<tr>
		<th>Name</th>
		<th>Quantity</th>
		<th>Rate</th>
		<th>Delete Items</th>
		</tr>';
		foreach($data as $row) {
			$html.= '<tr>
			<td>' . $row["name"] . '</td>
			<td>' . $row["qty"] . '</td>
			<td>' . $row["rate"] . '</td>
			<td><button type = "button" class = "btn btn-danger" onclick="myItemsId(' . $row['id'] . ')">Delete</button></td>
			</tr>';
		}
		$html.= '</table></div></div>';
		echo $html;
	}

	function delete_item_from_session() {
		$id = $this->input->post('id');
		$data = $this->session->userdata('items_for_sample');
		unset($data[$id]);
		$this->session->set_userdata('items_for_sample', $data);
		$html = '<div class="panel panel-flat">
		<div class="panel-body">
		<table class = "table">
		<tr>
		<th>Name</th>
		<th>Quantity</th>
		<th>Delete Items</th>
		</tr>';
		foreach($data as $row) {
			$html.= '<tr>
			<td>' . $row["name"] . '</td>
			<td>' . $row["qty"] . '</td>
			<td><button type = "button" class = "btn btn-danger" onclick="myItemsId(' . $row['id'] . ')">Delete</button></td>
			</tr>';
		}
		$html.= '</table></div></div>';
		echo $html;
	}

	function delete_item_from_purchase_session() {
		$id = $this->input->post('id');
		$data = $this->session->userdata('items_for_purchase');
		unset($data[$id]);
		$this->session->set_userdata('items_for_purchase', $data);
		$html = '<div class="panel panel-flat">
		<div class="panel-body">
		<table class = "table">
		<tr>
		<th>Name</th>
		<th>Quantity</th>
		<th>Delete Items</th>
		</tr>';
		foreach($data as $row) {
			$html.= '<tr>
			<td>' . $row["name"] . '</td>
			<td>' . $row["qty"] . '</td>
			<td><button type = "button" class = "btn btn-danger" onclick="myItemsId(' . $row['id'] . ')">Delete</button></td>
			</tr>';
		}
		$html.= '</table></div></div>';
		echo $html;
	}				

	public function list_samples() {
		$this->load->model('model_samples');
		$result = $this->model_samples->get_sample_list_latest_first();
		foreach($result as $row) {
			//$sample_id = $this->model_samples->insert($iname);
			$row->ITEM_COUNT = $this->get_item_count_by_sample_id($row->ID);
		}
		$data['samples'] = $result;
		$this->load_view('sample_list', $data);

	} 

	public function get_item_count_by_sample_id($id) {
		$this->load->model('model_samples');
		$result = $this->model_samples->get_items_by_sample_id($id);
		return count($result);
	}

	public function add_sample() {
		$this->load->model('model_samples');
		$result['items'] = $this->model_samples->fetch_data();
		$this->load_view('add_sample',$result);
	}

	public function submit() {
		$iname  = $this->input->post('iname');
		$createdby = $this->session->userdata('uid');
		$data = $this->session->userdata('items_for_sample');

		$this->form_validation->set_rules('iname', 'Sample Name', 'required|is_unique[samples.NAME]');
		if ($this->form_validation->run() == FALSE) {
			$errors[] = validation_errors();
			$data['errors'] = $errors;
			$data['message'] = "";
			$this->load_view('add_sample',$data);
		} else {
			$this->load->model('model_samples');
			$sample_id = $this->model_samples->insert($iname,$createdby);
			foreach($data as $row) {
				$this->model_samples->transfer($sample_id,$row['id'], $row['qty'],$createdby);
			}
			$this->session->unset_userdata('items_for_sample');
			header('location:/panesar/Samples/add_sample');
		}
	}

	public function delete_sample($sampleid) {
		$this->load->model('model_samples');
		$this->model_samples->delete_sample($sampleid);
		$this->load_view('sample_list',$data);
	}

	public function activate_sample($sampleid) {
		$this->load->model('model_samples');
		$this->model_samples->activate_sample($sampleid);
		$this->load_view('sample_list',$data);
	}

	public function sample_details_c($id) {
		$this->load->model('model_samples');
		$sample = $this->model_samples->sample_details_m($id);
		$sample->CREATOR_NAME = $this->get_user_name_by_id($sample->CREATED_BY);
		$data['sample'] = $sample;
		$result = $this->model_samples->sample_items_details_show($id);
		foreach($result as $row) {
			$row->ITEM_NAME = $this->get_item_name_from_id($row->ITEM_ID);
			$row->ITEM_PHOTO = $this->get_item_photo_from_id($row->ITEM_ID);
		}
		$data['sample_item'] = $result;
		$this->load_view('sample_details', $data);
	}

	function get_sample_by_id() {
		$sample_id  = $this->input->post('sample_id');
		$this->load->model('model_samples');
		$html = "";
		$html.='<tr>
		<th width="30%">Item Name</th>
		<th width="15%">Quantity</th>
		<th width="15%">Lot Qty</th>
		<th width="20%">Total Required</th>
		<th width="20%">Current Available</th>
		</tr>';
		$result = $this->model_samples->sample_items_details_show($sample_id);
		foreach($result as $row) {
			$row->ITEM_NAME = $this->get_item_name_from_id($row->ITEM_ID);
			$row->ITEM_PHOTO = $this->get_item_photo_from_id($row->ITEM_ID);
			$row->CURRENT_QTY = $this->get_current_qty_of_item_from_id($row->ITEM_ID);
			$html.='<tr>
			<td>'. $row->ITEM_NAME .'</td>
			<td>'. $row->QUANTITY.'</td>
			<td>0</td>
			<td>0</td>
			<td>'. $row->CURRENT_QTY .'</td>
			</tr>';
		}
		echo $html;
	}

	function get_sample_by_id_with_qty() {
		$sample_id  = $this->input->post('sample_id');
		$qty  = $this->input->post('qty');
		$this->load->model('model_samples');
		$html = "";
		$html.='<tr>
		<th width="30%">Item Name</th>
		<th width="15%">Quantity</th>
		<th width="15%">Lot Qty</th>
		<th width="20%">Total Required</th>
		<th width="20%">Current Available</th>
		</tr>';
		$result = $this->model_samples->sample_items_details_show($sample_id);
		foreach($result as $row) {
			$row->ITEM_NAME = $this->get_item_name_from_id($row->ITEM_ID);
			$row->ITEM_PHOTO = $this->get_item_photo_from_id($row->ITEM_ID);
			$row->CURRENT_QTY = $this->get_current_qty_of_item_from_id($row->ITEM_ID);
			$required = $qty*$row->QUANTITY;
			if($required > $row->CURRENT_QTY) {
				$html.='<tr style="background-color:red;color:#fff;">';
			} else {
				$html.='<tr>';
			}
			$html.='<td>'. $row->ITEM_NAME .'</td>
			<td>'. $row->QUANTITY.'</td>
			<td>'. $qty .'</td>
			<td>'. $required .'</td>
			<td>'. $row->CURRENT_QTY .'</td>
			</tr>';
		}
		echo $html;
	}

	function can_lot_be_created() {
		$sample_id  = $this->input->post('sample_id');
		$qty  = $this->input->post('qty');
		$this->load->model('model_samples');
		$response = 1;
		$result = $this->model_samples->sample_items_details_show($sample_id);
		foreach($result as $row) {
			$row->CURRENT_QTY = $this->get_current_qty_of_item_from_id($row->ITEM_ID);
			$required = $qty*$row->QUANTITY;
			if($required > $row->CURRENT_QTY) {
				$response = 0;
			}
		}
		echo $response;
	}

	public function edit_sample_c($id) {
		$this->load->model('model_samples');
		$result = $this->model_samples->sample_details_m($id);
		$data['sample'] = $result;
		$result = $this->model_samples->sample_items_details_show($id);
		$session = $this->session->userdata('items_for_sample');
		foreach($result as $row) {
			$row->ITEM_NAME = $this->get_item_name_from_id($row->ITEM_ID);
			$row->ITEM_PHOTO = $this->get_item_photo_from_id($row->ITEM_ID);
			$session[$row->ITEM_ID] = array(
				'id'=>$row->ITEM_ID,
				'name' => $row->ITEM_NAME,
				'qty' => $row->QUANTITY
			);
		}
		$this->session->set_userdata('items_for_sample', $session);
		$data['items'] = $result;
		$this->load_view('edit_sample', $data);
	}

	function item_exists_in_sample($item, $sample) {
		$this->load->model('model_samples');
		$result = $this->model_samples->item_exists_in_sample($item, $sample);
		if(count($result) > 0) {
			return TRUE;
		}
		return FALSE;
	}

	public function update_sample($id) {
		$name = $this->input->post('iname');
		$this->load->model('model_samples');
		$this->model_samples->update_sample_m($id,$name);
		$items = $this->session->userdata('items_for_sample');
		$items_in_sample = $this->model_samples->get_items_by_sample_id($id);
		$session_item_ids = array();
		foreach($items as $item) {
			$session_item_ids[] = $item['id'];
			if($this->item_exists_in_sample($item['id'], $id)) {
				$this->model_samples->update_qty($item['id'], $item['qty'], $id);
			} else {
				$this->model_samples->transfer($id,$item['id'], $item['qty']);
			}
		}
		foreach($items_in_sample as $item) {
			if(!in_array($item->ITEM_ID, $session_item_ids)) {
				$this->model_samples->delete_item_from_sample($item->ITEM_ID, $id);
			}
		}
		header('location:/panesar/samples/list_samples');
	}
}
?>
