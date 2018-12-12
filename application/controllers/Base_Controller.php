<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Controller extends CI_Controller{
	//Checking if the user is logged in or not
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata("is_logged_in")) {
			redirect(site_url());
		}
	}
	
	//Creating an array for Units
	private $units = array(
		'1' => 'Kg',
		'2' => 'Meters',
		'3' => 'Pieces',
		'4' => 'Litres'
	);

	//Inputs->NONE, Result->List of active Items
	function get_active_items_count() {
		$this->load->model('model_items');
		$result = $this->model_items->get_active_items();
		return count($result);
	}

	//Inputs->NONE, Result->List of active Samples
	function get_active_samples_count() {
		$this->load->model('model_samples');
		$result = $this->model_samples->get_active_samples();
		return count($result);
	}

	//Inputs->NONE, Result->List of active Lots
	function get_active_lots_count() {
		$this->load->model('model_lots');
		$result = $this->model_lots->get_active_lots();
		return count($result);
	}

	//Function to Load Views based on the user type logged in
	function load_view($content, $content_data = NULL) {
		$data['header'] = $this->load->view('header', NULL, TRUE);
		if($this->session->userdata('type') == 1){
			$data['sidebar'] = $this->load->view('sidebar', NULL, TRUE);
		} else {
			$data['sidebar'] = $this->load->view('sidebar_op', NULL, TRUE);
		}
		$data['content'] = $this->load->view($content, $content_data, TRUE);
		$data['footer'] = $this->load->view('footer', NULL, TRUE);
		$this->load->view('template', $data);
	}

	//Inputs->User ID, Result->User Name
	function get_user_name_by_id($id) {
		$this->load->model('model_users');
		$result = $this->model_users->fetch_user_details($id);
		return $result->NAME;
	}

	//Inputs->Item ID, Result->Item Name
	function get_item_name_from_id($id) {
		$this->load->model('model_items');
		$result = $this->model_items->items_details_show($id);
		return $result->NAME;
	}

	//Inputs->Item ID, Result->Current Quantity of Item in Stock
	function get_current_qty_of_item_from_id($id) {
		$this->load->model('model_items');
		$result = $this->model_items->items_details_show($id);
		return $result->CURRENT_QTY;
	}

	//Inputs->Item ID, Result->Photo of Item
	function get_item_photo_from_id($id) {
		$this->load->model('model_items');
		$result = $this->model_items->items_details_show($id);
		return $result->PHOTO;
	}

	//Function to return all the units
	function getall_units() {
		return $this->units;
	}

	//Inputs->Unit ID, Result->Unit Name
	function get_unit_name_by_id($id) {
		return $this->units[$id];
	}
}