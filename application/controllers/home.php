<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct()
	{	
		parent::__construct();
		$this->load->model('home_model');
	}
	
	public function index(){	
		
		/*
		 *set up title and keywords (if not the default in custom.php config file will be set) 
		 */
		$this->title = 'home';
		$this->keywords = 'UCL, COMP2014, COMP2013, CS';
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');	
		
		$this->_render('home');
	}
	
	public function sign_in(){	
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		

		if ($this->form_validation->run() == FALSE)
		{
			$this->_render('home');
		}
		else
		{
			$this->_render('home');
		}
	}	
	
}