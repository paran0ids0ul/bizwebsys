<?php

class SocialNetwork extends MY_Controller 
{
	public function index()
	{	
		$this->data["custom_js"] ='			
		<script>
		$(document).ready(function()
		{
			$("#button").click(function()
			{
				if ($("#facebook").prop("checked") == true) 
				{ 
					alert("Facebook");
					window.location=("http:localhost/app/socialnetwork/facebook.php");
				}				
				
				if ($("#twitter").prop("checked") == true) 
				{ 
					alert("Twitter");
				}				
				
				if ($("#googlePlus").prop("checked") == true) 
				{ 
					alert("Google+");
				}
				
				if (($("#twitter").prop("checked") == false) && ($("#twitter").prop("checked") == false) && ($("#googlePlus").prop("checked") == false)) 
				{
					alert("Nothing is done due to none of the checkbox is selected");
				}
				
				return false;				
			});			
		});
			</script>';	
		$this->_render('app/socialnetwork/socialnetwork');
	}
	
	public function submit()
	{
		
	}
	
}