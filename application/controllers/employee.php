<?php


class Employee extends MY_Controller {
	public function index(){	
		$this->_render('app/employee/employee');
	}
	public function new_employee(){	
		$this->_render('app/employee/new_employee');
	}	
}