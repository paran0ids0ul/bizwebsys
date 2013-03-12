<div class="container">
	<div class="row">
		<div class="span5 offset3 content settings-details">
			<form class="span5">
				<label class="span2 pull-left">Old Password : </label>
				<input class="span3" id="oldpass" type="password">     <!-- will be disable for admin account -->
				<label class="span2 pull-left">New Password : </label>
				<input class="span3" id="newpass" type="password"> 	
				<label class="span2 pull-left">Retype Password : </label> 
				<input class="span3" id="verifypass" type="password"> 
				<input class="btn btn-primary same-btn-width span1 offset1" type="submit" value="Save">
				<a href="<?php echo site_url("settings")?>">
					<button class="btn btn-primary same-btn-width span1 offset2">Cancel</button>
				</a>
			<form>
		</div>
	</div>
</div>