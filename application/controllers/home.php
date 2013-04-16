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
											var username = $(\'#inputUsername\').val().trim();
											var password = $(\'#inputPassword\').val().trim();
											if(username=="")
											{
												$(\'#errors\').text("Username can not be empty!");
												return;
											}
											
											if(password=="")
											{
												$(\'#errors\').text("Password can not be empty!");
												return;
											}
											$(\'#errors\').text("");
											
											sign_in(username,password);
										});
										
										function sign_in(username,password)
										{
											$.ajax({
												url: \''. site_url('home/sign_in') .'\',
												type: \'POST\',
												data: {username:username,password:password},
												success: function(response) {
													if(response == "true")
														window.location.href = \''.site_url('workspace').'\';
													else
													{
														$(\'#errors\').text("Username or Password is wrong");
														$(\'#inputUsername\').val("");
														$(\'#inputPassword\').val("");
													}
												}
											});
										}
								    </script>';	
		$this->template="main_no_header";							
		$this->_home_render('home');
	}
	
	public function sign_in(){	
		if(!(isset($_POST["username"]) && isset($_POST["password"])))
			return;
		$username = $_POST["username"];
		$password = $_POST["password"];	
		
		$data = $this->home_model->authenticate($username,$password);
		if($data["result"])
		{
			$is_admin = $this->home_model->is_admin($username);
			$newdata = array(
                  'username'  => $data["username"],
                  'email'     => $data["email"],
				  'employee_id' => $data["employee_id"],
				  'is_admin' => $is_admin
               );
			$this->session->set_userdata($newdata);
			echo "true";
			
		}
		else
			echo "false";
	
	//Below is to bypass signIn, only for testing. remove this and uncomment above code for production
	
	//		$newdata = array(
     //             'username'  => "username",
      //             'email'     => "username@bizwebsys.tk",
	//			   'is_admin' => false
     //          );
	//		$this->session->set_userdata($newdata);
	//		echo "true";
	}	
	
	public function sign_out()
	{
		$this->session->sess_destroy();
		$this->index();
	}
	
}