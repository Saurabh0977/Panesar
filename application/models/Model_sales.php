<?php

class Model_sales extends CI_Model
{

						public function __construct()
						{

							parent::__construct();
						}

						public function get_lot_list()
						{
						
							$this->load->database();
							$query = $this->db->query("SELECT * FROM `lot_list`");
							return $query->result();

						}

						public function add_sale_details($name,$lotid,$qty,$price)
						{
							$this->load->database();
							$query = $this->db->query("INSERT INTO `SALES` (NAME,LOT_ID,QUANTITY,PRICE) VALUES ('$name','$lotid','$qty','$price')");

						}

						public function get_sales_list()
						{
							$this->load->database();
							$query = $this->db->query("SELECT * FROM `SALES`");
							return $query->result();

						}

						public function fetch_lot_name($id)
						{

							$this->load->database();
							$query = $this->db->query("SELECT * from `lot_list` WHERE ID = '$id' ");
							$result = $query->result();
							return $result[0]->NAME;
						}

						public function get_lotname_by_lot_id($id)
						{
							$this->load->database();
							$query = $this->db->query("SELECT * FROM `sales` WHERE LOT_ID = '$id'");
							return $query->result();

						}

						public function get_sales_list_by_id($id)
						{
							$this->load->database();
							$query = $this->db->query("SELECT * FROM `sales` WHERE ID = '$id'");
							return $query->result();

						}

}

?>