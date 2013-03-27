<?php
class Pos_model extends MY_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_items()  
	{
		$query = $this->db->get('Inventory');
		return $query->result_array();
	}
	

}