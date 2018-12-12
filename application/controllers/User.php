<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('Base_Controller.php');
class User extends Base_Controller {
	public function dashboard() {
		$this->load->model('model_items');
		$result = $this->model_items->get_item_list_shortage();
		foreach($result as $row) {
			$row->CREATOR_NAME = $this->get_user_name_by_id($row->CREATED_BY);
			$row->UNIT_NAME = $this->get_unit_name_by_id($row->UNIT);
		}
		$data['shortage'] = $result;
		$data['items_count'] = $this->get_active_items_count();
		$data['samples_count'] = $this->get_active_samples_count();
		$data['lots_count'] = $this->get_active_lots_count();
		$this->load_view('content', $data);
	}

	public function lists() {
		$this->load->model('model_users');
		$data['users'] = $this->model_users->get_all_users();
		$this->load_view('users_list', $data);
	}

	public function add() {
		$this->load->library('encrypt');
		$data['errors'] = array();
		$this->load_view('add_user', $data);
	}

	public function create_user() {
		$name = $this->input->post('name');
		$uname = $this->input->post('uname');
		$pass = $this->input->post('pass');
	    $rpass = $this->input->post('rpass');
		$type = $this->input->post('type');
		$created_by = $this->session->userdata('uid');

		$this->form_validation->set_rules('name', 'Full Name', 'required');
		$this->form_validation->set_rules('uname', 'Username', 'required');
    	$this->form_validation->set_rules('pass', 'Password', 'required');
    	$this->form_validation->set_rules('rpass', 'Repeat Password', 'required|matches[pass]');

    	if ($this->form_validation->run() == FALSE) {
      		$errors[] = validation_errors();
      		$data['errors'] = $errors;
      		$this->load_view('add_user',$data);
      	} else {
			$intermediatesalt = md5(uniqid(rand(),true));
			$salt = substr($intermediatesalt, 0 ,16);
			$hash = hash("sha256" , $pass . $salt);
			$this->load->model('model_users');
			$this->model_users->create_user($name,$uname,$hash,$type,$salt, $created_by);
			redirect(site_url('user/lists'));
		}
	}

	public function delete($userid) {
		$this->load->model('model_users');
		$this->model_users->delete_user($userid);
		$this->load_view('users_list', $data);
	}

	public function activate_user($userid) {
		$this->load->model('model_users');
		$this->model_users->activate_user($userid);
		$this->load_view('users_list', $data);
	}

	public function logout() {
		$this->load->model('model_users');
		$this->model_users->logout_user();
		header('location:/panesar');	
	}

	public function add_purchase() {
		$this->load_view('add_purchase');
	}
}
?>