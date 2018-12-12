<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('Base_Controller.php');
class Items extends Base_Controller {
	//Function to fetch an item like the search string and display results using ajax. Stored for Sample.
	function get_item_like() {
		$this->load->model('model_items');
		$val = $this->input->post('val');
		$result = $this->model_items->get_item_like($val);
		$html = "";
		$i = 1;
		if(count($result) > 0) {
			foreach($result as $row) {
				$html.='<div class = "row form-group">
				<div class = "col-md-6">'. $row->NAME .'</div>
				<div class = "col-md-2">
				<input type="text" id = "qty'. $i .'" name="qty[]" class= "form-control" placeholder = "Qty">
				</div>
				<div class = "col-md-4">
				<button type = "button" class = "btn btn-primary" onclick="myItems('. "'" . $row->NAME . "'" . ','. "'" . $row->ID . "'" . ',' . $i . ')">Add to Sample</button>
				</div>
				</div>
				';
				$i++;
			}
		} else {
			$html.="No Items Found with the keyword <strong>". $val ."</strong> in it. Try again with some other keyword.";
		}
		echo $html;
	}

	//Function to fetch an item like the search string and display results using ajax. Stored for Purchase.
	function get_item_like_purchase() {
		$this->load->model('model_items');
		$val = $this->input->post('val');
		$result = $this->model_items->get_item_like($val);
		$html = "";
		$i = 1;
	 	if(count($result) > 0) {
			foreach($result as $row) {
				$html.='<div class = "row form-group">
				<div class = "col-md-4">'. $row->NAME .'</div>
				<div class = "col-md-2">
				<input type="text" id = "qty'. $i .'" name="qty[]" class= "form-control" placeholder = "Qty">
				</div>
				<div class = "col-md-2">
				<input type="text" id = "rate'. $i .'" name="rate[]" class= "form-control" placeholder = "Rate">
				</div>
				<div class = "col-md-4">
				<button type = "button" class = "btn btn-primary" onclick="myItems('. "'" . $row->NAME . "'" . ','. "'" . $row->ID . "'" . ',' . $i . ')">Add to Purchase</button>
				</div>
				</div>
				';
				$i++;
			}
		} else {
			$html.="No Items Found with the keyword <strong>". $val ."</strong> in it. Try again with some other keyword.";
		}
		echo $html;
	}

	//Function to return the view with items list.
	public function list_items() {
		$this->load->model('model_items');
		$result = $this->model_items->get_item_list_latest_first();
		foreach($result as $row) {
			$row->CREATOR_NAME = $this->get_user_name_by_id($row->CREATED_BY);
			$row->UNIT_NAME = $this->get_unit_name_by_id($row->UNIT);
		}
		$data['items'] = $result;
		$this->load_view('items_list', $data);
	} 

	//Function to load view with Add Item Form.
	public function add_item() {
		$data['message'] = "";
		$data['errors'] = array();
		$data['units'] = $this->getall_units();
		$this->load_view('add_item', $data);
	}

	//Function to create a new item.
	public function create_item() {
		$iname = $this->input->post('iname');
		$unit = $this->input->post('unit');
		$color = $this->input->post('color');
		$mthreshold = $this->input->post('mthreshold');
		$createdby = $this->session->userdata('uid');
		$this->form_validation->set_rules('iname', 'Item Name', 'required|is_unique[item_list.NAME]');
		if ($this->form_validation->run() == FALSE) {
			$errors[] = validation_errors();
			$data['errors'] = $errors;
			$data['message'] = "";
			$data['units'] = $this->getall_units();
			$this->load_view('add_item',$data);
		} else {
			$config = array(
				'upload_path' => './uploads/',
				'allowed_types' => 'jpg|png',
				'max_size' => '0',
				'overwrite' => FALSE
			);

			$this->load->library('upload',$config);
			if($_FILES['userfile']['name'] != '') {
				$filename = $_FILES['userfile']['name'];
				$filename_array = explode(".", $filename);
				$extension = end($filename_array);
				$newname = md5(uniqid(rand(),true));
				$newname_f = $newname . "." . $extension;
				$_FILES['userfile']['name'] = $newname_f;
				if($this->upload->do_upload('userfile')) {
				} else {
					$errors = $this->upload->display_errors();
					var_dump($errors);
				}
			} else {
				$newname_f = "";
			}
			$this->load->model('model_items');
			$this->model_items->create_item($iname,$unit,$newname_f,$color,$mthreshold,$createdby);
			$data['errors'] = array();
			$data['message'] = "The item <strong>" . $iname . "</strong> has been added successfully!";
			$data['units'] = $this->getall_units();
			$this->load_view('add_item', $data);
		}
	}

	//delete an item
	public function delete_items($itemid) {
		$this->load->model('model_items');
		$this->model_items->delete_items($itemid);
		$this->load_view('items_list',$data);
	}

	//Activate an Item
	public function activate_items($itemid) {
		$this->load->model('model_items');
		$this->model_items->activate_items($itemid);
		$this->load_view('items_list');
	}

	//Fetch item Details
	public function item_details($ID) {
		$this->load->model('model_items');
		$this->load->model('model_lots');
		$result = $this->model_lots->lot_details($ID);
		foreach($result as $row)
		{
			$row->SOLD=$this->fetch_lot_name_by_itemid($row->LOT_ID);
		}

		$data['lot'] = $result;			

		$result = $this->model_items->seller_details_fetch($ID);
		foreach($result as $row)
		{
			$row->SELLER=$this->fetch_sellername_from_stockid($row->STOCK_ID);
		}

		$data['stock'] = $result;
		$result = $this->model_items->items_details_show($ID);
		$result->UNIT_NAME = $this->get_unit_name_by_id($result->UNIT);
		$data['item'] = $result;
		$this->load_view('details', $data);
	}

	public function update_item($id) {
		$this->load->model('model_items');
		$result = $this->model_items->edit_item($id);
		$data['item'] = $result;
		$data['units'] = $this->getall_units();
		$this->load_view('edit_item' , $data);	
	}

	public function update_item_data($id) {
		$iname = $this->input->post('iname');
		$unit = $this->input->post('unit');
		$color = $this->input->post('color');
		$mthreshold = $this->input->post('mthreshold');
		if($_FILES['userfile']['name'] != '') {
			$config = array(
				'upload_path' => './uploads/',
				'allowed_types' => 'jpg|png',
				'max_size' => '0',
				'overwrite' => TRUE
			);
			$this->load->library('upload', $config);
			$filename = $_FILES['userfile']['name'];
			$filename_array = explode(".", $filename);
			$extension = end($filename_array);
			$newname = md5(uniqid(rand(),true));
			$newname_f = $newname . "." . $extension;
			$_FILES['userfile']['name'] = $newname_f;
			$this->upload->do_upload('userfile');
			$this->load->model('model_items');
			$this->model_items->update_item_details_with_photo($id,$iname,$unit,$newname_f,$color,$mthreshold);
			redirect(site_url('Items/item_details/' . $id));
		} else {
			$this->load->model('model_items');
			$this->model_items->update_item_details_without_photo($id,$iname,$unit,$color,$mthreshold);
			redirect(site_url('Items/item_details/' . $id));
		}
	}

	public function fetch_sellername_from_stockid($stock_id) {
		$this->load->model('model_items');
		$result =$this->model_items->fetch_sellername_from_stock($stock_id);
		return $result;
	}	

	public function fetch_lot_name_by_itemid($lot_id) {
		$this->load->model('model_lots');
		$result = $this->model_lots->fetch_lotname_from_lotlist($lot_id);
		return $result;
	}
}
?>
