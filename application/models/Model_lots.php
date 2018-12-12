<?php

class Model_lots extends CI_Model
{

						public function __construct()
						{

							parent::__construct();
						}

						public function sample_name_list()
						{

							$this->load->database();
							$query = $this->db->query("SELECT * FROM `samples` ");
							return $query->result();
						
						}

						function get_active_lots() {
							$this->load->database();
							$query = $this->db->query("SELECT * FROM `lot_list` WHERE STATUS=1");
							return $query->result();
						}



						public function add_lot_model($lname,$samples,$qty,$currt_qty)
							{
								$this->load->database();
								$query = $this->db->query("INSERT into `lot_list`(`NAME` , `SAMPLE_ID` , `QUANTITY` , `CURRENT_QUANTITY` ) VALUES ('$lname' , '$samples' , '$qty' , '$currt_qty') ");
								//return $query->lot_id('ID');

								return $this->db->insert_id();
								

							}

						public function fetch_lot_list()
						{
							$this->load->database();
							$query = $this->db->query("SELECT * FROM `lot_list`");
							return $query->result();

						}	

						public function get_samplelist_details($result)
						{

							$this->load->database();
							$query = $this->db->query("SELECT * FROM `sample_list` WHERE SAMPLE_ID = '$result'");
							return $query->sampleid('ITEM_ID');


						}

						public function update_qty_item_list($qty)
						{
							$this->load->database();
							$query = $this->db->query("UPDATE `item_list` SET CURRENT_QTY = CURRENT_QTY - '$qty' ");

						}


						public function add_lot_details_into_stock_outward($id,$item_id,$qty, $rate)
						{
							$this->load->database();
							$query = $this->db->query("INSERT INTO `stock_outward` (`LOT_ID`,`ITEM_ID`,`QUANTITY`, `RATE`) VALUES ('$id','$item_id','$qty', '$rate')");

						}	

						public function checkbalance($samples)
						{
							$this->load->database();
							$query = $this->db->query("SELECT * FROM `stock_item` WHERE STOCK_ID = '$samples'");
							return $query->result();

						}

						public function lot_details($ID)
						{

							$this->load->database();
							$query = $this->db->query("SELECT * FROM `stock_outward` WHERE ITEM_ID = '$ID'");
							return $query->result();
						
						}

						public function fetch_lotname_from_lotlist($lot_id)
						{

							$this->load->database();
							$query= $this->db->query("SELECT * FROM `lot_list` WHERE ID = '$lot_id'");
							$result = $query->result();
							return $result[0]->NAME;


						}
						public function get_lot_list_by_lot_id($lotid)
						{
							$this->load->database();
							$query = $this->db->query("SELECT * FROM `lot_list` WHERE ID = '$lotid' ");
							$result = $query->result();
							return $result[0]->CURRENT_QUANTITY;

						}
						public function update_current_qty($lotid,$balqty)
						{
							$this->load->database();
							$query = $this->db->query("UPDATE `lot_list` SET CURRENT_QUANTITY = '$balqty' WHERE ID = '$lotid'");


						}

						public function get_lot_details_by_lot_id($id)
						{

							$this->load->database();
							$query = $this->db->query("SELECT * FROM `lot_list` WHERE ID = '$id'");
							return $query->result();
						}

						public function get_lot_name_by_lot_id($id)
						{

							$this->load->database();
							$query = $this->db->query("SELECT * FROM `lot_list` WHERE ID = '$id'");
							//return $query->result();

							$result = $query->result();
							return $result[0]->NAME;
						}

					}



					?>