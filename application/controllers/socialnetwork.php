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

			// Additional init code here
			};
			
			function getLogin()
			{
				FB.getLoginStatus
				(
					function(response) 
					{
						if (response.status === "connected") 
						{
							publish();
							
						} 
						else if (response.status === "not_authorized") 
						{
							fbLogin();
						}
						else 
						{
							fbLogin();
						}	
					}
				);
			};
			
			function publish()
			{
				var params = {};
				params["message"] = $("#statusContext").val();

				FB.api
				(
					"/me/feed", "post", params, function (response) 
					{
						if (!response || response.error) 
						{
							alert("Error - Facebook");	
						} 
						else 
						{
							alert("Sucessfully Posted on Facebook");
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
				alert("1");
				if ($("#twitter").prop("checked") == true) 
				{ 
					var ajaxurl = "http://" + (document.location.hostname) + "/socialnetwork/twitter"; 
					var ajaxdata = $("#statusContext").val();
					alert("2");
					$.ajax
					(
						{
							type: "POST",
							url: ajaxurl,
							data: ajaxdata,
							success: function(results)
							{
							
							},
							error: function(xhr, textStatus, error)
							{
								alert(xhr.statusText);
								alert(textStatus);
								alert(error);
							}
						}
					);
				}
				
				if ($("#facebook").prop("checked") == true) 
				{ 
					alert("facebook");
					getLogin();
				}
				
				if ($("#googlePlus").prop("checked") == true) 
				{ 
					var googlePlus = true;
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
	
	public function twitter()
	{
	
	}	
	
}
	
	