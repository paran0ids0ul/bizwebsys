<?php

class Workspace extends MY_Controller {


	
	public function index(){
	
		$param['customHead'] = '
		<style type="text/css">
		.thumbnail div {
			font-weight: bold;
			font-size: 120%;
			margin-top: 5%;
		}
		a.thumbnail:hover {
			text-decoration: none;
		}
		.thumbnail {
			
		}
		</style>';
		$this->paramRender('panel/workspace', $param);
	}
	
}