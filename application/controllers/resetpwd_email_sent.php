<?php


class Resetpwd_email_sent extends MY_Controller {
	public function index(){	
		$this->data["custom_css"]='
		<style type="text/css">
			.content
			{
				margin-top:50px;
				margin-bottom:50px;
			}
		</style>	
		';
		$this->title = "Thank you";
		$this->_home_render('account/resetpwd_email_sent');
	}
	
}