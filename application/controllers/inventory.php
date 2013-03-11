<?php


class Inventory extends MY_Controller {
	function __construct()
	{	

		parent::__construct();
	}

	//sales order
	public function index(){	
		$this->_render('app/inventory/inventory');
	}
	
	public function new_item(){
		$this->_render('app/inventory/new_item');
	}
	
	public function display_item(){
		$this->_render('app/inventory/display_item');
	}
	
}