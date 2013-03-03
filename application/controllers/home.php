<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	public function index(){	
		
		/*
		 *set up title and keywords (if not the default in custom.php config file will be set) 
		 */
		$this->title = 'Biz WebSys';
		$this->keywords = 'UCL, COMP2014, COMP2013, CS';
		
		$this->_render('pages/system');
	}
	
}