<?php


class Sales extends MY_Controller {
	public function index(){	
		$this->_render('app/sales/sales');
	}
	
	public function new_order(){
		$this->_render('app/sales/new_order');
	}
	
}