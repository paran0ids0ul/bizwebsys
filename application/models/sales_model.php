<?php
class Sales_model extends MY_Model {

	public function __construct()
	{
		$this->load->database();
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
		//	'Name' => $this->input->post('item_name'),
		//	'ItemType' => $this->input->post('item_category'),
			'ContactID' => $this->input->post('customer'),
			'Date' => $this->input->post('item_date'),
		//	'Description' => $this->input->post('item_description'),
			//'Stock' => $this->input->post('item_stock'),
			//'StockROP' => $this->input->post('item_rop'),
			//'Cost' => $this->input->post('item_costprice'),
			//'VATRate' => $this->input->post('item_vatrate'),
			//'GTIN' => $this->input->post('item_gtin'),
			//'NetPrice' => $this->input->post('item_netprice')
			
		);
	
		
		$this->db->insert('Sales', $data);

		$id = $this->db->insert_id();
		
		return $id;
	
	}
	
	public function get_orders()  //return 2D array: cust_name,invoice_date,internal_ref,sales_person,due_date,outstanding,total(plz don't change the names)
	{
	
	}
	

}