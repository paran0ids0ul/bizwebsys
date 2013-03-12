<?php
class Sales_model extends MY_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_orders()  //return 2D array: cust_name,invoice_date,internal_ref,sales_person,due_date,outstanding,total(plz don't change the names)
	{
	
	}
	

}