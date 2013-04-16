<div class="container">
	<div class="row">
		<div class="span12 content">
			<div class="underlined span12">
				<h4 class="settings-header">Company Info</h4>
			</div>
			<div class="span10 offset1 content">
				<div class="row">
					<div class="span2">
						<img class="span2" src=<?php echo base_url("resources/images/icons128/inventory.png")?> alt="Business Logo"> <!-- to be updated to business logo-->
						<button class="btn btn-primary span2">Change Logo</button>
				
					</div>
					<div class="span7 offset1 settings-details">
						<label>Company Name :</label> 
						<input id="company_name" type="text" placeholder="e.g Unilever" >
						<label>Category :</label> 
						<select name="company_cate" id="company_category">
							<option>Please Choose :</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
						<label>Address :</label>
						<div class="address">
							<input class="span7" id="company_street1" type="text" placeholder="Street name 1" >
							<input class="span7" id="company_street2" type="text" placeholder="Street name 2" >
							<input id="company_city" type="text" placeholder="City" >
							<input id="company_state" type="text" placeholder="State" >
							<input id="company_zip" type="text" placeholder="Zip" >
							<input id="company_country" type="text" placeholder="Country" >
						</div>x						<label>Phone :</label>
						<input id="company_phone" type="text" placeholder="e.g 07565758758" >
						<label>Vat Code :</label>
						<input id="company_vatcode" type="text" placeholder="e.g 12345" >
						<div>
							<button class="btn btn-primary same-btn-width">Save</button>
						</div>
						
					</div> <!-- close settings details -->
				</div> <!-- close row-->
			</div> <!-- close company content-->
			
	<!--		<div class="underlined span12">
				<h4 class="settings-header">Admin Configuration</h4>
			</div>
			
			<div class="span10 offset2 settings-details">
				<a href="<?php echo site_url("change_password")?>" id="change_admin_pass" class="span10">
					<button class="btn btn-link">Change Admin password</button>
				</a>
				<a href="<?php echo site_url("change_password")?>" id="change_emp_preset_pass" class="span10">
					<button class="btn btn-link">Change Preset password for new employee</button>
				</a>
			</div> -->
		</div>
	</div>
</div>