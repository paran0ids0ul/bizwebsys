<div class="container">
	<div class="row">
		<div class="span12 content">
			<div class="underlined span12">
				<h4 class="settings-header">Public Info</h4>
			</div>
			<div class="span10 offset1 content">
				<div class="row">
					<div class="span2">
						<img class="span2" src=<?php echo base_url("resources/images/icons128/inventory.png")?> alt="Display Picture"> <!-- to be updated to business logo-->
						<button class="btn btn-primary span2">Change Picture</button>
				
					</div>
					<div class="span7 offset1 settings-details">
						<label>Name :</label> 
						<input id="personal_name" type="text" placeholder="e.g John Constantine" >

						<label>Working Address :</label>
						<div class="address">
							<input class="span7" id="working_street1" type="text" placeholder="Street name 1" >
							<input class="span7" id="working_street2" type="text" placeholder="Street name 2" >
							<input id="working_city" type="text" placeholder="City" >
							<input id="working_state" type="text" placeholder="State" >
							<input id="working_zip" type="text" placeholder="Zip" >
							<input id="cworking_country" type="text" placeholder="Country" >
						</div>
						<label>Working Landline :</label>
						<input id="working_landline" type="text" placeholder="e.g 02565758758" >
						<label>Working Mobile :</label>
						<input id="working_mobile" type="text" placeholder="e.g 07565758758" >
						<div>
							<button class="btn btn-primary same-btn-width">Save</button>
						</div>
					</div> <!-- close settings details -->
				</div> <!-- close row-->
			</div> <!-- close public content-->
			
			
			<div class="underlined span12">
				<h4 class="settings-header">Private Info</h4>
			</div>
			<div class="span10 offset1 content">
				<div class="row">
					<div class="span7 offset1 settings-details">
						<label>I.D no. :</label> 
						<input id="personal_idno" type="text" placeholder="e.g 3940583049583" >
						<label>Passport no. :</label> 
						<input id="personal_passportno" type="text" placeholder="e.g A485093485" >
						<label>Nationality :</label> 
						<input id="personal_nationality" type="text" placeholder="e.g Brazilian" >
						<label>Gender :</label>
						<div id="gender_select">
							<select name="gender">
								<option>Please Choose :</option>
								<option>M</option>
								<option>F</option>
								</select>						
						</div>	
						<label>Bank Account :</label> 
						<input id="personal_bankacc" type="text" placeholder="e.g 20499302" >
						<label>Date of Birth :</label>
						<input id="datepicker" type="text" name="personal_dob"> 

						<label>Personal Address :</label>
						<div class="address">
							<input class="span7" id="personal_street1" type="text" placeholder="Street name 1" >
							<input class="span7" id="personal_street2" type="text" placeholder="Street name 2" >
							<input id="personal_city" type="text" placeholder="City" >
							<input id="personal_state" type="text" placeholder="State" >
							<input id="personal_zip" type="text" placeholder="Zip" >
							<input id="personal_country" type="text" placeholder="Country" >
						</div>
						<label>Personal Landline :</label>
						<input id="personal_landline" type="text" placeholder="e.g 02565758758" >
						<label>Personal Mobile :</label>
						<input id="personal_mobile" type="text" placeholder="e.g 07565758758" >
						<div>
							<button class="btn btn-primary same-btn-width">Save</button>
						</div>
					</div> <!-- close settings details 2-->
				</div> <!-- close row-->
			</div> <!-- close private content-->

		
		
			<div class="underlined span12">
				<h4 class="settings-header">Login Configuration</h4>
			</div>
			<div class="span10 offset2 settings-details">
				<a href="<?php echo site_url("change_password")?>" id="change_personal_pass" class="span10">
					<button class="btn btn-link">Change Log-in password</button>
				</a>
			</div>
		</div>
	</div>
</div>