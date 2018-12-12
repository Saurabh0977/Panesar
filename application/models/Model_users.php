<?php

class Model_users extends CI_Model
{

	public function __construct()
	{

		parent::__construct();
	}


	public function get_user($username)
	{
		$this->load->database();
		$query=$this->db->query("SELECT * FROM `users` WHERE `USERNAME`='$username'");
		return $query->result();
	}

	function fetch_user_details($id) {
		$this->load->database();
		$query=$this->db->query("SELECT * FROM `users` WHERE `ID`='$id'");
		$result = $query->result();
		return $result[0];
	}

	public function get_all_users()
	{

		$this->load->database();
		$query=$this->db->query("SELECT * FROM `users`");
		return $query->result();
	}

	public function delete_user($userid)
	{

		$this->load->database();
		$this->db->query("UPDATE `users` SET STATUS = 0 WHERE ID = '$userid'");
		header('location:/panesar/User/lists'); 
	
	}

	public function activate_user($userid)
	{
		$this->load->database();
		$this->db->query("UPDATE `users` SET STATUS = 1 WHERE ID = '$userid'");
		header('location:/panesar/User/lists'); 

	}


	function create_user($name,$uname,$hash,$type,$salt,$created_by)
	{
		$this->load->database();
		$query=$this->db->query("INSERT INTO `users` ( NAME,USERNAME,PASSWORD,TYPE,SALT,CREATED_BY) VALUES ('$name','$uname', '$hash','$type','$salt','$created_by')");
	}

	

	// ************** LOGOUT function ***********************//

	public function logout_user()
	{
		$this->load->library('session');
		$this->session->set_userdata('is_logged_in',FALSE);
		
	}


} 


?>