<?php


class Employee extends MY_Controller {
	public function index(){	
		$this->_render('app/employee/employee');
	}
	public function new_employee(){	
		$this->_render('app/employee/new_employee');
	}

	public function display_employee(){	
		$this->_render('app/employee/display_employee');
	}
}