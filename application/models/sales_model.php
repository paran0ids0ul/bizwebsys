<?php
class Sales_model extends MY_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_orders()  //return 2D array: CustomerName,InvoiceDate,InternalRef,SalesPerson,DueDate,Outstanding,Total
	{
	
	}
	

}