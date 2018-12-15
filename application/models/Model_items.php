<?php

class Model_items extends CI_Model
{

	public function __construct()
	{

		parent::__construct();
	}

	// *********** FUNCTION TO FETCH ITEMS DETAILS FROM DATABASE ****************** //

	public function get_item_list()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `item_list`");
		return $query->result();
	}

	function get_active_items()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `item_list` WHERE STATUS=1");
		return $query->result();
	}

	public function get_item_list_latest_first()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `item_list` ORDER BY ID DESC");
		return $query->result();
	}

	function get_item_list_shortage()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `item_list` WHERE CURRENT_QTY < MIN_THRESHOLD");
		return $query->result();
	}

	function get_item_like($val)
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `item_list` WHERE NAME LIKE '%$val%' ORDER BY NAME ASC");
		return $query->result();
	}

	// ******FUNCTION TO CREATE ITEMS *******//

	function create_item($iname, $unit, $newname, $color, $mthreshold, $createdby)
	{
		$this->load->database();
		$query = $this->db->query("INSERT INTO `item_list` (NAME, UNIT, PHOTO, COLOR, MIN_THRESHOLD, CREATED_BY) VALUES ('$iname', '$unit', '$newname', '$color', '$mthreshold', '$createdby')");
	}
 
	//***** FUNCTION TO DELETE ITEMS *******//

	public function delete_items($itemid)
	{

		$this->load->database();
		$this->db->query("UPDATE `item_list` SET STATUS = 0 WHERE ID = '$itemid'");
		header('location:/panesar/Items/list_items');
	}

	// ********FUNCTION TO ACTIVATE ITEMS FROM ITEMS LIST **************//

	public function activate_items($itemid)
	{

		$this->load->database();
		$this->db->query("UPDATE `item_list` SET STATUS = 1 WHERE ID = '$itemid'");
		header('location:/panesar/Items/list_items');
	}

	public function subtract_qty_item_list($qty, $item_id)
	{
		$this->load->database();
		$query = $this->db->query("UPDATE `item_list` SET CURRENT_QTY = CURRENT_QTY - '$qty' WHERE ID = '$item_id'");
	}

	function get_item_stock_inward_details($id)
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM `stock_item` WHERE ITEM_ID = '$id'");
		$result = $query->result();
		return $result;
	}

	function empty_balance_for_row($id)
	{
		$this->load->database();
		$query = $this->db->query("UPDATE `stock_item` SET BALANCE = 0 WHERE ID = '$id'");
	}

	function subtract_from_balance($id, $qty_required_balance)
	{
		$this->load->database();
		$query = $this->db->query("UPDATE `stock_item` SET BALANCE = BALANCE - '$qty_required_balance' WHERE ID = '$id'");
	}

	// ******* FUNCTION TO DISPLAY THE DETAILS OF THE SELECTED ITEM ********** //

	public function items_details_show($id)
	{

		$this->load->database();
		$query = $this->db->query("SELECT * FROM `item_list` WHERE ID = '$id'");
		$result = $query->result();
		return $result[0];
	}

	// ****** FUNCTION TO FETCH ITEM DETAILS FROM DATABASE USING ITEM ID ************ //

	public function edit_item($id)
	{

		$this->load->database();
		$query = $this->db->query("SELECT * FROM `item_list` WHERE ID = '$id'");
		$result = $query->result();
		return $result[0];
	}

	// **** FUNCTION TO UPDATE DETAILS OF THE ITEM IF PHOTO IS SELECTED *********//

	public function update_item_details_with_photo($id, $iname, $unit, $newname_f, $color, $mthreshold)
	{
		$this->load->database();
		$query = $this->db->query("UPDATE `item_list` SET `NAME`='$iname',`UNIT`='$unit',`PHOTO` = '$newname_f',`COLOR`='$color',`MIN_THRESHOLD`='$mthreshold' WHERE ID = '$id'");

	}


	// ******* FUNCTION TO UPDATE DETAILS OF THE ITEM WHEN PHOTO IS NOT SELECTED ***************//

	public function update_item_details_without_photo($id, $iname, $unit, $color, $mthreshold)
	{
		$this->load->database();
		$query = $this->db->query("UPDATE `item_list` SET `NAME`='$iname',`UNIT`='$unit',`COLOR`='$color',`MIN_THRESHOLD`='$mthreshold' WHERE ID = '$id'");

	}

	public function seller_details_fetch($ID)
	{

		$this->load->database();
		$query = $this->db->query("SELECT * FROM `stock_item` WHERE  ITEM_ID = '$ID'");
		return $query->result();

	}

	public function fetch_sellername_from_stock($stock_id)
	{

		$this->load->database();
		$query = $this->db->query("SELECT * FROM `stock` WHERE ID = '$stock_id'");
		$result = $query->result();
		return $result[0];


	}

	public function get_item_list_from_stock_item($id, $fdate, $tdate)
	{

		$this->load->database();
		$query = $this->db->query("SELECT * FROM `stock_item` WHERE ITEM_ID = '$id' AND CREATED_AT >='$fdate' AND CREATED_AT <= '$tdate'");
		return $query->result();

	}




}
?>
<?php

    // ************************************* END ******************************************* //

?>