<?php


class Reset_pwd_successful extends MY_Controller {
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
												//$(\'#test\').html(response);
												}
											});
										}
								    </script>';	
		$this->title = "Reset Successful";
		$this->_home_render('account/reset_pwd_successful');
	}
	
}