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
									.myform-container
									{
										overflow:auto;
										padding-bottom:200px;
									}
									.keypad
									{
									      position: relative;
										  margin-top: -200px; /* negative value of footer height */
										  height: 200px;
										  clear:both;
										  padding-top:20px;
									}
									</style>';

	}
	
	public function index(){	
		$this->_render('app/pos/pos');
	}
	
}