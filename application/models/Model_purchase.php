<?php

class Model_purchase extends CI_Model
{

						public function __construct()
						{

							parent::__construct();
						}

// ************** FUNCTION TO FETCH ITEMS LIST FROM ' ITEM_LIST' TABLE ***************//
							public function get_items_for_purchase()	
							{

							$this->load->database();
							$query = $this->db->query("SELECT * FROM `item_list`");
							return $query->result();

							}
	
// ************ FUNCTION TO ADD " NAME " INTO STOCK TABLE ********************//

							public function insert_name($name,$desc,$created_by)

							{
								$this->load->database();
								$this->db->query("INSERT into `stock`(`NAME`,`DESCRIPTION`,`CREATED_BY`) VALUES ('$name','$desc','$created_by')");
								$id =  $this->db->insert_id();
								return $id;
							}
// ******* FUNCTION TO TRANSFER { 'STOCK' TABLE ID } TO TABLE STOCK ITEMS  [ STOCK ID ] COLOUMN ****//					
							public function transfer_id($stock_id,$id,$qty,$bal,$rate,$created_by)
							{
								$this->load->database();
								$this->db->query("INSERT into `stock_item`(`STOCK_ID`, `ITEM_ID` , `QUANTITY` ,`BALANCE`, `RATE`, `CREATED_BY`) VALUES ('$stock_id','$id','$qty','$bal','$rate', '$created_by')");
							}

							public function add_qty($items,$qty)

							{
								$this->load->database();
								$this->db->query("UPDATE `item_list` SET CURRENT_QTY = CURRENT_QTY + '$qty' WHERE ID = '$items'");

							}

							public function get_seller_name($id)
							{
								$this->load->database();
								$query = $this->db->query("SELECT * FROM `stock` WHERE ID = '$id'");
								$result = $query->result();
								return $result[0];

							}

							

}
?>