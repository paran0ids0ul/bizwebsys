<?php


class Forgot_password extends MY_Controller {
	function __construct()
	{	
		parent::__construct();
		$this->load->model('home_model');
	}
	
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
		$this->data["custom_js"] ='
									<script>
									$(\'#btn_continue\').click(function(){
										var email = $(\'#field_email\').val().trim();
										var n=email.indexOf("@bizwebsys.tk");
										if(n==-1)
										{
											$(\'#errors\').text("Invalid work email!");
											return;
										}	
										else
										{
											$(\'#errors\').text("");
											$.ajax({
												url: \''. site_url('forgot_password/email') .'\',
												type: \'POST\',
												data: {email:email},
												success: function(response) {
													if(response == "true")
														window.location.href = \''.site_url('resetpwd_email_sent').'\';
													else
														//$(\'#errors\').text("Invalid work email!");
														$(\'#errors\').html(response);
												}
											});
										}
									});
									
									</script>';
		$this->title="Forgot password";							
		$this->template="main_no_header";
		$this->_render('account/forgot_password');
	}
	
	public function email(){
	if(!isset($_POST["email"]))
		return;
		$email = $_POST["email"];	
		if($this->home_model->check_email($email))
		{
			//$to = $email;
			$to = "litianw@hotmail.com";     //for testing
			$subject = "BizWebSys Reset Password";
			$message = "Click on the link to reset password:".site_url('home/reset_password');
			$from = "jing.li.11@ucl.ac.uk";
			$headers = "From:" . $from;
			mail($to,$subject,$message,$headers);

			echo "true";
			
		}	
		else
			echo "false";
	
	
	}
}