<?php
class Main extends CI_Controller
{
	public function index()
	{
		if($this->session->userdata('is_logged_in') == TRUE) {
			redirect('User/dashboard');
		} else {
			$data['title'] = PROJECT_NAME . " | Login to Continue";
			$data['message'] = "";
    		$this->load->view('login', $data);
		}
	}

	public function process_login() {
		$username = $this->input->post('uname');
		$password = $this->input->post('pass');

		$this->load->model('model_users');
		$result = $this->model_users->get_user($username);

		if(count($result)>0) {	
			$salt = substr($result[0]->SALT,0,16);
			$hash = hash("sha256",$password . $result[0]->SALT);
			if($result[0]->PASSWORD==$hash) {
				if($result[0]->STATUS == 1) {	
					$sess = array('is_logged_in' => TRUE ,'uname' => $result[0]->USERNAME, 'uid' => $result[0]->ID, 'type'=> $result[0]->TYPE);
					$this->session->set_userdata($sess);
					redirect(site_url('User/dashboard'));
				} else {
				$data['message'] = "Your account has been deleted. Please contact the Admin.";
				$data['title'] = PROJECT_NAME . " | Login to Continue";
				$this->load->view('login', $data);
				}
			} else {
				$data['message'] = "Invalid Username or Password. Please try again.";
				$data['title'] = PROJECT_NAME . " | Login to Continue";
				$this->load->view('login', $data);
			}
		} else {
			$data['message'] = "Invalid Username or Password. Please try again.";
			$data['title'] = PROJECT_NAME . " | Login to Continue";
			$this->load->view('login', $data);
		}
	}
}
?>