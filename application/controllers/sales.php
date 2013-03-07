<?php


class Sales extends MY_Controller {
	public function index(){	
		$this->_render('app/sales/sales');
	}
	
	public function new_order(){
		$this->_render('app/sales/new_order');
	}
	
	public function display_order($orderID="SO0001",$customer="cust1",$date="7/03/2013"){
		$this->data["orderID"] = $orderID;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		$this->_render('app/sales/display_order',$orderID);
	}
	
}