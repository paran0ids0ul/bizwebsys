<?php

class Facebook extends MY_Controller 
{
	public function index()
	{	
		$this->_render('app/socialnetwork/facebook');	

		require_once("facebook.php");

		$config = array();
		$config['appId'] = '444833315594772';
		$config['secret'] = '7d68cfcbea4886ce11c0cd1581fb1db2';

		$facebook = new Facebook($config);
	  
		$token = $facebook->getAccessToken();
		$args = array
		(
			'access_token' => $token,
			'message' => 'Hello!',
			'privacy' => array('value' => 'SELF')
		);
		$post_id = $facebook->api("/USER_ID/feed", "post", $args);
	}
	
	
	
}