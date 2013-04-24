<?php


class Change_password extends MY_Controller {
	function __construct()
	{	
		parent::__construct();
		$this->load->model('home_model');
	}
	
	public function index(){	
	//	$session_guid = $this->session->userdata('guid');
	/*	if($session_guid!=$guid)
		{
			echo "Link has expired or is invalid.";
			return;
		}
	*/	
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
									$(\'#field_pwd_old\').keyup(function(){
										$(\'#errors_pwd_old\').text("");
									});
									
									$(\'#field_pwd\').keyup(function(){
										$(\'#errors_pwd\').text("");
									});
									
									$(\'#field_confirm_pwd\').keyup(function(){
										$(\'#errors_confirm_pwd\').text("");
									});
									
									$(\'#btn_done\').click(function(){
										$(\'#errors\').val("");
										var password_old = $(\'#field_pwd_old\').val().trim();
										var password = $(\'#field_pwd\').val().trim();
										var ConfirmPassword = $(\'#field_confirm_pwd\').val().trim();
										
										if(password_old=="") 
										{
											$(\'#errors_pwd_old\').text("Old password cannot be empty!");
											return;
										}	
		                                else if(password=="") 
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
											$.ajax({
												url: \''. site_url('change_password/change_pwd') .'\',
												type: \'POST\',
												data: {password_old:password_old,password:password},
												success: function(response) {
													if(response == "fail")
													{
														$(\'#errors_pwd_old\').text("Invalid password");
													}
													else if(response == "true")
														window.location.href = \''.site_url('reset_pwd_successful').'\';
													else
													{
														$(\'#errors\').val("Failed to change password. Please try again later.");
													}
												
												}
											});
										}
									});
									
									</script>';
		$this->title="Change password";		
		$this->_render('account/change_password');
	}
	
	public function change_pwd()
	{
		if(!(isset($_POST["password"])&&isset($_POST["password_old"])))
			return;
			
		$uid = $this->session->userdata('username');
		$password_old =  $_POST["password_old"];
		$password = $_POST["password"];
		$result = $this->home_model->change_password($uid,$password,$password_old);
		echo $result;
	}
	

}