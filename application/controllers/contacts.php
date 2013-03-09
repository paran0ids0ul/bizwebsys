<?php


class Contacts extends MY_Controller {
	function __construct()
	{	

		parent::__construct();
	
	}

	public function index(){	
		$this->_render('app/contacts/contacts');
	}
	
	public function new_contact(){
		$this->_render('app/contacts/new_contact');

	}
}
	
	/*
	public function display_order($order_id="SO0001",$customer="cust1",$date="7/03/2013"){
		//data
		$this->data["order_id"] = $order_id;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		
		$this->_render('app/sales/display_order');
	}
	
		public function display_invoice(){
		$this->_render('app/sales/display_invoice');
	}
	
	public function cust_invoice(){
		$this->_render('app/sales/cust_invoice');
	}

	public function cust_payment(){
		$this->_render('app/sales/cust_payment');
	}

	public function sup_invoice(){
		$this->_render('app/sales/sup_invoice');
	}

	public function sup_payment(){
		$this->_render('app/sales/sup_payment');
	}	*/
	
