<?php

class Model_samples extends CI_Model
{

	public function __construct()
	{

		parent::__construct();
	}


	public function get_sample_list()
	{

		$this->load->database();
		$query=$this->db->query("SELECT * FROM `samples`");
		return $query->result();
	}

	function item_exists_in_sample($item, $sample) {
		$this->load->database();
		$query=$this->db->query("SELECT * FROM `sample_list` WHERE SAMPLE_ID = '$sample' AND ITEM_ID = '$item'");
		return $query->result();
	}

	function update_qty($item_id, $item_qty, $sample_id) {
		$this->load->database();
		$query = $this->db->query("UPDATE `sample_list` SET QUANTITY = '$item_qty' WHERE ITEM_ID = '$item_id' AND SAMPLE_ID = '$sample_id'");
	}

	public function get_sample_list_latest_first()
	{

		$this->load->database();
		$query=$this->db->query("SELECT * FROM `samples` ORDER BY ID DESC");
		return $query->result();
	}

	function get_active_samples()
	{

		$this->load->database();
		$query=$this->db->query("SELECT * FROM `samples` WHERE STATUS=1");
		return $query->result();
	}

	function get_items_by_sample_id($id){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `sample_list` WHERE `SAMPLE_ID` = $id");
		return $query->result();		
	}

	// ******  FETCH data from database and display in the form of checkboxes ********//////

	public function fetch_data()
	{

		$this->load->database();
		$query = $this->db->query("SELECT * FROM `item_list` ORDER BY NAME ASC ");
		return $query->result();

	}

	// ******* INSERT NEW sample NAME into samples table  ******************//

	public function insert($iname,$createdby)

	{
		$this->load->database();
		$this->db->query("INSERT into `samples`(`NAME`,`CREATED_BY`) VALUES ('$iname','$createdby')");
		$id =  $this->db->insert_id();
		return $id;
	}

	public function transfer($id,$item_id, $qty, $createdby)
	{
		$this->load->database();
		$this->db->query("INSERT into `sample_list`(`SAMPLE_ID`, `ITEM_ID`, `QUANTITY`, `CREATED_BY`) VALUES ('$id','$item_id', '$qty', '$createdby')");
	}

	//**************** DELETE sample function   ****************************// 
	
	public function delete_sample($sampleid)
	{

		$this->load->database();
		$this->db->query("UPDATE `samples` SET STATUS = 0 WHERE `ID` = '$sampleid'");
		header('location:/panesar/Samples/list_samples'); 
	}

	public function activate_sample($sampleid)
	{

		$this->load->database();
		$this->db->query("UPDATE `samples` SET STATUS = 1 WHERE `ID` = '$sampleid'");
		header('location:/panesar/Samples/list_samples'); 
	}

	public function sample_details_m($id)
	{

		$this->load->database();
		$query = $this->db->query("SELECT * FROM `samples` WHERE ID = '$id' ");
		$result = $query->result();
		return $result[0];
	}


	
	public function sample_items_details_show($id)
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `sample_list` WHERE SAMPLE_ID = '$id'");
		return  $query->result();
		//return $result[0];

	}

	public function update_sample_m($id,$name)
	{

		$this->load->database();
		$query = $this->db->query("UPDATE `samples` SET `NAME` = '$name' WHERE ID = '$id'");

	}

	public function get_sample_name_by_sampleid($id)
	{

		$this->load->database();
		$query = $this->db->query("SELECT * FROM `samples` WHERE ID = '$id'");
		$result = $query->result();
		return $result[0];

	}

	function delete_item_from_sample($item, $sample) {
		$this->load->database();
		$query = $this->db->query("DELETE FROM `sample_list` WHERE SAMPLE_ID = '$sample' AND ITEM_ID = '$item'");
	}



}

?>
