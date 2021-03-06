<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	//Page info
	protected $data = Array();
	protected $pageName = False;
	protected $template = "main";
	protected $hasNav = TRUE;
	//Page contents
	protected $javascript = array();
	protected $css = array();
	protected $fonts = array();
	//Page Meta
	protected $title = FALSE;
	protected $description = FALSE;
	protected $keywords = FALSE;
	protected $author = FALSE;

	function __construct()
	{

		parent::__construct();
		$this->data["uri_segment_1"] = $this->uri->segment(1);
		$this->data["uri_segment_2"] = $this->uri->segment(2);
		$this->title = $this->config->item('site_title');
		$this->description = $this->config->item('site_description');
		$this->keywords = $this->config->item('site_keywords');
		$this->author = $this->config->item('site_author');

		$this->pageName = strToLower(get_class($this));
		$this->data["custom_css"] = '';
		$this->data["custom_js"] = '';

		$this->load->library('session');
	}

	protected function _render($view)
	{

		$toTpl = $this->preRender($view);
		
		//render view
		if($this->_check_login())
			$this->load->view("template/skeleton", $toTpl);
		else
			header('Location:'.site_url(''));	
	}
	
	//home render doesn't require login
	protected function _home_render($view)
	{
		$toTpl = $this->preRender($view);
		
		//render view
		$this->load->view("template/skeleton", $toTpl);
	}

	private function preRender($view)
	{

		//static
		$toTpl["javascript"] = $this->javascript;
		$toTpl["css"] = $this->css;
		$toTpl["fonts"] = $this->fonts;

		//meta
		$toTpl["title"] = $this->title;
		$toTpl["description"] = $this->description;
		$toTpl["keywords"] = $this->keywords;
		$toTpl["author"] = $this->author;

		$toTpl['customHead'] = '';

		//data
		$toBody["content_body"] = $this->load->view($view, array_merge($this->data, $toTpl), true);

		//nav menu
		if ($this->hasNav) {
			$this->load->helper("nav");
			$toMenu["pageName"] = $this->pageName;
			$toUser["username"] = "Jing"; // TODO: Model method required: getUsername()
			$toHeader["nav"] = $this->load->view("template/nav", $toMenu, true);
			$toHeader["user"] = $this->load->view("template/user", $toUser, true);
		}
		$toHeader["basejs"] = $this->load->view("template/basejs", $this->data, true);

		$toBody["header"] = $this->load->view("template/header", $toHeader, true);
		$toBody["footer"] = $this->load->view("template/footer", '', true);
		
		$toTpl["body"] = $this->load->view("template/" . $this->template, $toBody, true);

		return $toTpl;
	}

	protected function _data_render($view, $toPage)
	{


		$toTpl = $this->preRender2($view, $toPage);


		//render view
		if($this->_check_login())
			$this->load->view("template/skeleton", $toTpl);
		else
			header('Location:'.site_url(''));	

	}

	private function preRender2($view, $toPage)
	{

		//static
		$toTpl["javascript"] = $this->javascript;
		$toTpl["css"] = $this->css;
		$toTpl["fonts"] = $this->fonts;

		//meta
		$toTpl["title"] = $this->title;
		$toTpl["description"] = $this->description;
		$toTpl["keywords"] = $this->keywords;
		$toTpl["author"] = $this->author;

		$toTpl['customHead'] = '';

		//data
		$toTpl = array_merge($this->data, $toTpl);
		$toBody["content_body"] = $this->load->view($view, ($toTpl + $toPage), true);

		//nav menu
		if ($this->hasNav) {
			$this->load->helper("nav");
			$toMenu["pageName"] = $this->pageName;
			$toUser["username"] = "Jing"; // TODO: Model method required: getUsername()
			$toHeader["nav"] = $this->load->view("template/nav", $toMenu, true);
			$toHeader["user"] = $this->load->view("template/user", $toUser, true);
		}
		$toHeader["basejs"] = $this->load->view("template/basejs", $this->data, true);

		$toBody["header"] = $this->load->view("template/header", $toHeader, true);
		$toBody["footer"] = $this->load->view("template/footer", '', true);

		$toTpl["body"] = $this->load->view("template/" . $this->template, $toBody, true);

		return $toTpl;
	}
	
	private function _check_login()
	{
		//Check if user is logged in, if not, redirect to home page
		$result = false;
		$username = $this->session->userdata('username');	 
		if($username != "") 
		{
			$result = true;
		}			
		
		return $result;
	}


}
