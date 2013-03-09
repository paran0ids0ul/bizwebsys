<?php


class Pos extends MY_Controller {
	function __construct()
	{	
		parent::__construct();
		
		//load left column
		$this->data["left_column"] = $this->load->view("app/pos/left_column",'',true);
		
		//load CSS
		$this->data["custom_css"] ='
									<style type="text/css">
									
									</style>';

	}
	
	public function index(){	
		$this->_render('app/pos/pos');
	}
	
}