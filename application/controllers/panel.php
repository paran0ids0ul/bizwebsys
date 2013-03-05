<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Horace
 * Date: 2/21/13
 * Time: 10:07 PM
 * To change this template use File | Settings | File Templates.
 */

class Panel extends MY_Controller {

	
	public function index(){	
		
		/*
		 *set up title and keywords (if not the default in custom.php config file will be set) 
		 */
		$this->title = 'Biz ';
		$this->keywords = 'UCL, COMP2014, COMP2013, CS';
		
		$this->_render('panel/home_panel');
	}
	
		public function view($page='home_panel'){	
		$this->_render('panel/'.$page);
	}
}