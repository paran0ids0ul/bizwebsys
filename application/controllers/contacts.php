<?php


class Contacts extends MY_Controller {
	public function index(){	
		$this->_render('app/contacts/contacts');
	}
	
	public function new_contact(){
		$this->_render('app/contacts/new_contact');
 }
	
}