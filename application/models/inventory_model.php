<?php
class Inventory_model extends MY_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	
	public function get_item_list()
	{
		
		$query = $this->db->get('Inventory');
		return $query->result_array();
		
	}
	
	public function get_contact_list()
	{
		
		$query = $this->db->get('Contact');
		return $query->result_array();
		
	}
	
	public function set_item() 
	{
		$this->load->helper('url');
	
		
	
		$data = array(
			'Name' => $this->input->post('item_name'),
			'ItemType' => $this->input->post('item_category'),
			'ContactID' => $this->input->post('supplier'),
			'SKU' => $this->input->post('item_sku'),
			'Description' => $this->input->post('item_description'),
			'Stock' => $this->input->post('item_stock'),
			'StockROP' => $this->input->post('item_rop'),
			'Cost' => $this->input->post('item_costprice'),
			'VATRate' => $this->input->post('item_vatrate'),
			'GTIN' => $this->input->post('item_gtin'),
			'NetPrice' => $this->input->post('item_netprice')
			
		);
	
		
		$this->db->insert('Inventory', $data);

		$id = $this->db->insert_id();
		
		return $id;
	
	}
	
	
	public function update_item($id) {
		
		$this->load->helper('url');
		
		$data = array(
			'Name' => $this->input->post('item_name'),
			'ItemType' => $this->input->post('item_category'),
			'ContactID' => $this->input->post('supplier'),
			'SKU' => $this->input->post('item_sku'),
			'Description' => $this->input->post('item_description'),
			'Stock' => $this->input->post('item_stock'),
			'StockROP' => $this->input->post('item_rop'),
			'Cost' => $this->input->post('item_costprice'),
			'VATRate' => $this->input->post('item_vatrate'),
			'GTIN' => $this->input->post('item_gtin'),
			'NetPrice' => $this->input->post('item_netprice')
			
		);
		
		
		$this->db->where('ItemID', $id);
		$this->db->update('Inventory', $data);
		
		
		
		
	}
	
	
	public function update_stock($id, $toAdd) {
		
		
		
		$this->db->where('ItemID', $id);
		$this->db->set('Stock', "Stock + $toAdd",FALSE);	
		$this->db->update('Inventory');
		
		
		$query = $this->db->query("SELECT Stock FROM Inventory WHERE ItemID = $id");
		
		
		$row = $query->row(); 

	    return $row->Stock;
		
	}
	
	
	public function get_item_byID($itemID) {
		
		$query = $this->db->get_where('Inventory', array('ItemID' => $itemID));
		return $query->row_array();
		
		
	}
	
	
	
}