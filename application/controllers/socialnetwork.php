<?php

class SocialNetwork extends MY_Controller 
{
	public function index()
	{			
	
		$this->data["custom_js"] ='			
		<script>
		$(document).ready(function()
		{
			window.fbAsyncInit = function() 
			{
				FB.init
				(
					{
						appId      : "444833315594772", // App ID
						channelUrl : "//localhost/channel.html", // Channel File
						status     : true, // check login status
						cookie     : true, // enable cookies to allow the server to access the session
						xfbml      : true  // parse XFBML
					}
				);
				alert("Finsih ini");
				
				
				

			// Additional init code here
			};
			
			function getLogin()
			{
				alert("getLogin"); 
				FB.getLoginStatus
				(
					function(response) 
					{
						alert("getLogin2");
						if (response.status === "connected") 
						{
							alert("connected");
							publish();
							
						} 
						else if (response.status === "not_authorized") 
						{
							alert("not_aut");
							fbLogin();
						}
						else 
						{
							alert("not");
							fbLogin();
						}	
					}
				);
			};
			
			function publish()
			{
				var params = {};
				params["message"] = $("#statusContext").val();

				alert("publish");
				FB.api
				(
					"/me/feed", "post", params, function (response) 
					{
						if (!response || response.error) 
						{
							alert("Error");	
						} 
						else 
						{
							alert("Sucess");
						}
					}
				);
			};

			function fbLogin()
			{
				alert("fbLogin");
				FB.login
				(
					function (response) 
					{
						if (response.authResponse) 
						{
							streamPublish();
						} 
						else 
						{
							// cancelled
						}
					}, { perms: "publish_stream" }
				);
				
			};
	
			// Load the SDK Asynchronously
			(
				function(d)
					{
						var js, id = "facebook-jssdk", ref = d.getElementsByTagName("script")[0];
						if (d.getElementById(id)) {return;}
						js = d.createElement("script"); js.id = id; js.async = true;
						js.src = "//connect.facebook.net/en_US/all.js";
						ref.parentNode.insertBefore(js, ref);
					}(document)
			);
				
			
			$("#button_post").click(function()
			{
			
				alert("adfsg");
				if ($("#facebook").prop("checked") == true) 
				{ 
					alert("facebook");
					getLogin();
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
				
				var status = $("#statusContext").val();
				
				if ($status = "")
				{
					alert("The content cannot be empty");
				}
				
				
			});			
		});
			</script>';	

		$this->_render('app/socialnetwork/socialnetwork');
	}
	}
	
	