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
					var facebook = true;
				}
				else
				{
					var facebook = false;
				}
				
				if ($("#twitter").prop("checked") == true) 
				{ 
					var twitter = true;
				}				
				else
				{
					var twitter = false
				}
				
				if ($("#googlePlus").prop("checked") == true) 
				{ 
					var googlePlus = true;
				}
				else
				{
					var googlePlus = false;
				}
				
				if (($("#facebook").prop("checked") == false) && ($("#twitter").prop("checked") == false) && ($("#googlePlus").prop("checked") == false)) 
				{
					alert("Nothing is done due to none of the checkbox is selected");
				}				
				
				$.ajax(
				{
					type : "POST",
					url: "http://localhost/socialnetwork/submit",
					data: 
					{
						facebook1 : facebook,
						twitter1 : twitter,
						googlePlus1 : googlePlus
					},
					success : function(results)
					{
						$("#process").html(results);
					},
					error: function(xhr, textStatus, error)
					{
						alert(xhr.statusText);
						alert(textStatus);
						alert(error);
					}
					
				});
			});			
		});
			</script>';	
		$this->_render('app/socialnetwork/socialnetwork');
	}
	
	public function facebook()
	{	
		echo 'facebook';
		
		return 0;
	}
	
	public function twitter()
	{	
		echo 'twitter';
		
		return 0;
	}
	
	public function googlePlus()
	{	
		echo 'google+';
		
		return 0;
	}
	
	public function submit()
	{
		$facebook = $_POST['facebook1'];
		$twitter = $_POST['twitter1'];
		$googlePlus = $_POST['googlePlus1'];
		
		$f = $facebook;
		$t = $twitter;
		$g = $googlePlus;
		
		$context2 = "The status has been posted on ";
		
		if ($f == "true")
		{
			$context2 = $context2."Facebook ";
			facebook();
		}
		
		if ($t == "true")
		{
			$context2 = $context2."Twitter ";
			twitter();
		}
		
		if ($g == "true")
		{
			$context2 = $context2."Google+ ";
			googlePlus();
		}
		
		echo $context2;	
	}
}