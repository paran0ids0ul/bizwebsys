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
		
				//load local js
		$this->data["custom_js"] ='								  
								    <script>
										$(\'#btn_signin\').click(function(){
											var email = $(\'#inputEmail\').val().trim();
											var password = $(\'#inputPassword\').val().trim();
											if(email=="")
											{
												$(\'#errors\').text("Email can not be empty!");
												return;
											}
											
											if(password=="")
											{
												$(\'#errors\').text("Password can not be empty!");
												return;
											}
											$(\'#errors\').text("");
											
											sign_in(email,password);
										});
										
										function sign_in(email,password)
										{
											$.ajax({
												url: \''. site_url('home/sign_in') .'\',
												type: \'POST\',
												data: {email:email,password:password},
												success: function(response) {
													if(response == "true")
														window.location.href = \''.site_url('home').'\';
													else
													{
														$(\'#errors\').text("Email or Password is wrong");
														$(\'#inputEmail\').val("");
														$(\'#inputPassword\').val("");

													}
												}
											});
										}
								    </script>';	
		$this->_render('home');
	}
	
	public function sign_in(){	
		if(!(isset($_POST["email"]) && isset($_POST["password"])))
			return;
		$email = $_POST["email"];
		$password = $_POST["password"];	
		
		$data = $this->home_model->authenticate($email,$password);
		if($data["result"])
		{
			$newdata = array(
                   'username'  => $data["username"],
                   'email'     => $data["email"]
               );
			$this->session->set_userdata($newdata);
			echo "true";
			
		}
		else
			echo "false";
	}	
	
	public function sign_out()
	{
		$this->session->sess_destroy();
		$this->index();
	}
	
}