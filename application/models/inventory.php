<?php
class News_model extends MY_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	
	public function get_item_list()
	{
		
			$query = $this->db->get('Inventory');
			return $query->result_array();
		
	}
	
	public function set_item() 
	{
//		$this->load->helper('url');
	
	
	//	$data = array(
		//	'ItemTypeID' => $this->input->post('title'),
//			'slug' => $slug,
//			'text' => $this->input->post('text')
//		);
	
//		return $this->db->insert('news', $data);
	
	
	
	
	}
	
	
	
}