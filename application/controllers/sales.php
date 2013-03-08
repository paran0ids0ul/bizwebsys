<?php


class Sales extends MY_Controller {
	function __construct()
	{	

		parent::__construct();
		//side menu
		$this->data["sidemenu"] = $this->load->view("app/sales/sidemenu",'',true);
	}

	public function index(){	
		$this->_render('app/sales/sales');
	}
	
	public function new_order(){
		$this->_render('app/sales/new_order');
	}
	
	public function display_order($order_id="SO0001",$customer="cust1",$date="7/03/2013"){

		
		//data
		$this->data["order_id"] = $order_id;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		
		$this->_render('app/sales/display_order');
	}
	
}