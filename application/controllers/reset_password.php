<?php


class Reset_password extends MY_Controller {
	function __construct()
	{	
		parent::__construct();
		$this->load->model('home_model');
	}
	
	public function view($guid){	
		$session_guid = $this->session->userdata('guid');
		if($session_guid!=$guid)
		{
			echo "Link has expired or is invalid.";
			return;
		}
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
												url: \''. site_url('reset_password/reset_pwd') .'\',
												type: \'POST\',
												data: {password:password},
												success: function(response) {
													if(response == "true")
														alert(response);
												}
											});
										}
									});
									
									</script>';
		$this->title="Reset password";							
		$this->template="main_no_header";
		$this->_home_render('account/reset_password');
	}
	
	public function reset_pwd()
	{
		if(!isset($_POST["password"]))
			return;
			
		$uid = $this->session->userdata('uid');
		$password = $_POST["password"];
		if($this->home_model->reset_password($uid,$password))
			echo "true";
		else
			echo "false";
	}
	

}