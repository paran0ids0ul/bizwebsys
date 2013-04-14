<?php


class Reset_password extends MY_Controller {
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
									$(\'#field_pwd\').keyup(function(){
										$(\'#errors_pwd\').text("");
									});
									
									$(\'#field_confirm_pwd\').keyup(function(){
										$(\'#errors_confirm_pwd\').text("");
									});
									
									$(\'#btn_done\').click(function(){
										var password = $(\'#field_pwd\').val().trim();
										var ConfirmPassword = $(\'#field_confirm_pwd\').val().trim();
										
		                                if(password=="") 
										{
											$(\'#errors_pwd\').text("Password cannot be empty!");
											return;
										}								
										else if(password.length<6) 
										{
											$(\'#errors_pwd\').text("Password must have at least 6 characters!");
											$(\'#field_pwd\').val("");
											$(\'#field_confirm_pwd\').val("");
											return;
										}
										else if(password!=ConfirmPassword)
										{
											$(\'#errors_confirm_pwd\').text("Passwords do not match!");
											$(\'#field_confirm_pwd\').val("");
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
		$this->title="Reset password";							
		$this->template="main_no_header";
		$this->_render('account/reset_password');
	}
	
	public function email(){
	if(!isset($_POST["email"]))
		return;
		$email = $_POST["email"];	
		if($this->home_model->check_email($email))
		{
			//$to = $email;
			$to = "naomi.li@bizwebsys.tk";     //for testing
			$subject = "BizWebSys Reset Password";
			$message = "Click on the link to reset password:".site_url('home/reset_password');
			$message = '
							<html>
							<head>
							  <title>BizWebSys Reset Password</title>
							</head>
							<body>
							  <p>Click on the link to reset password:<a href='.site_url('home/reset_password').'>'.site_url('home/reset_password').'</a></p>
							</body>
							</html>
							';
			$from = "admin@bizwebsys.tk";
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From:" . $from;
			mail($to,$subject,$message,$headers);
			
			echo "true";
			
		}	
		else
			echo "false";
	
	
	}
}