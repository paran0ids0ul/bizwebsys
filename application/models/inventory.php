<?php
class News_model extends MY_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	
	public function get_item_list()
	{
		
			$query = $this->db->get('inventory');
			return $query->result_array();
		
	}
	
	
	
}