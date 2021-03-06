<?php

class SocialNetwork extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		// Loading TwitterOauth library. Delete this line if you choose autoload method.
		$this->load->library('twitteroauth');
		
	}
	
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
			
				var process_note = "The status has been posted on ";
				var status_note = $("#statusContext").val();
				
				if ($("#twitter").prop("checked") == true) 
				{ 
					var ajaxurl = "http://" + (document.location.hostname) + "/socialnetwork/twitter"; 
					var ajaxdata = status_note;
					$.ajax
					(
						{
							type: "POST",
							url: ajaxurl,
							data: {ajaxdata : ajaxdata},
							success: function(results)
							{
								alert("Sucessfully Posted on Twitter");
							},
							error: function(xhr, textStatus, error)
							{
								alert(xhr.statusText);
								alert(textStatus);
								alert(error);
								alert("AJAX ERROR");
							}
						}
					);
					
					process_note = process_note + "Twitter ";
				}
				
				if ($("#facebook").prop("checked") == true) 
				{ 
					getLogin();
					
					process_note = process_note + "Facebook ";
				}				
				
				if (status_note === "")
				{
					alert("The content cannot be empty");
				}
				
				
				if (($("#facebook").prop("checked") == false) && ($("#twitter").prop("checked") == false)) 
				{
					alert("Nothing is done due to none of the checkbox is selected");
				}				
				
				if ((($("#facebook").prop("checked") == true) || ($("#twitter").prop("checked") == true)) && (status_note != "")) 
				{
					$("#process").html(process_note);
					$("#status_output").html(status_note);
				}
				
				
				
			});			
		});
			</script>';	

		$this->_render('app/socialnetwork/socialnetwork');
	}
	
	public function twitter()
	{
		$connection = $this->twitteroauth->create('qsyeIajydJgHRfLI9T4A', '9V5rqgTbwUdCvnlBiyF9eMegaaPJJWT1X05URm6cuU', '1327423556-7yRfZmvInpYuSDbbroXl1upBnt1n7zjjtAdoyiF', 'T6Ke1oIKVjOzKzVjVHyjFdwjLCNgTCIDpmHfz8jsNuk');
	

		$content = $connection->get('account/verify_credentials');
			
		if(isset($content->error))
		{
			return false;
		};
			
		$status = $_POST["ajaxdata"];
			
		$data = array
		(
			'status' => $status,
		);
		
		$result = $connection->post('statuses/update', $data);
		
		
		
	}	
	
}
	
	