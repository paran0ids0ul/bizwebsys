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
		$this->_home_render('account/forgot_password');
	}
	
	public function email(){
	if(!isset($_POST["email"]))
		return;
		$email = $_POST["email"];	
		$this->load->library('phpmailer');
		$uid = $this->home_model->check_email($email);
		if($uid!=null)
		{	
			$guid = com_create_guid();
			$guid = substr($guid, 1, strlen($guid)-2);
			$newdata = array(
                  'guid'  => $guid,
                  'uid'     => $uid
               );
			$this->session->set_userdata($newdata);
			$to = $email;
			$subject = "BizWebSys Reset Password";
			$message = '
							<html>
							<head>
							  <title>BizWebSys Reset Password</title>
							</head>
							<body>
							  <p>Click on the link to reset password:<a href='.site_url('reset_password/view/'.$guid).'>'.site_url('home/reset_password').'</a></p>
							</body>
							</html>
							';
			$from = "admin@bizwebsys.tk"; 
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From:" . $from;
			mail($to,$subject,$message,$headers);
		
//	$mail             = new PHPMailer();

//	$body             =  "Hello, <b>my friend</b>! \n\n This message uses HTML entities!";
//	$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
//	$mail->IsSMTP(); // telling the class to use SMTP
//	$mail->Host       = "bizwebsys.tk"; // SMTP server
//	$mail->SMTPAuth   = true;                  // enable SMTP authentication
//	$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
//	$mail->Username   = "naomi.li@bizwebsys.tk"; // SMTP account username
//	$mail->Password   = "abc123";        // SMTP account password

//	$mail->SetFrom('naomi.li@bizwebsys.tk', 'Jing Li');

//	$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";

//	$mail->MsgHTML($body);

//	$address = "litianw@hotmail.com";
//	$mail->AddAddress($address, "John Doe");

//	if(!$mail->Send()) {
//	  echo "Mailer Error: " . $mail->ErrorInfo;
//	} else {
	//  echo "Message sent!";
	//}
		
			
			echo "true";
			
		}	
		else
			echo "false";
	
	
	}
}