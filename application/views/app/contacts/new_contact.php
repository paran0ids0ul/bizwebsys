<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url("contacts") ?>">Contact</a> <span class="divider">/</span></li>
			<li class="active">New</li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
			<a href="<?php echo site_url("contacts/display_contact")?>" class="btn btn-primary span1">Save</a>
			<a href="<?php echo site_url("contacts")?>">
			<button class="btn btn-link">Discard</button>
			</a>
		</div>
		<!-- Form Container -->
		<div class="contact-container container">
			<div class="span9 offset1 myform">
			<form>
				<div class="row">
					<div class="upper-contact">
							<div class="span1">
								<a href="<?php echo site_url("add_contact_picture");?>" class="thumbnail">
									<img src=<?php echo base_url("resources/images/icons128/inventory.png")?> alt="Inventory">
								</a>
							</div>
							<div class="span1 content">
									
									<label>First Name</label>									
								</div>
								<div class="span3 content">
									<span class="input-xlarge uneditable-input" style="width:90%" id="contact_firstname">php to retrive data</span>
								</div>
								
								<div class="span1 content">
									<label>Surname</label>									
								</div>
								<div class="span3 content">
									<span class="input-xlarge uneditable-input" style="width:60%"id="contact_surname">php to retrive data</span>
								</div>
								<div class="span1 content">
									<label>Common Name</label>									
								</div>
								<div class="span6 content">
									<span class="input-xlarge uneditable-input" style="width:90%"id="contact_common_name">php to retrive data</span>
								</div>
								
									
						
					</div>  <!-- close upper contact-->
							
							
					<div class="lower-contact span9">
						<div class="row">
							<div class="span4">	
								<label class="span1">Address	
								</label>
								<div class="span2 label-field">
									<input id="contact_street1" type="text" placeholder="Street name 1" >
									<input id="contact_street2" type="text" placeholder="Street name 2" >
									<input class="span2" id="contact_city" type="text" placeholder="City/State" >
									<input class="span1" id="contact_zip" type="text" placeholder="Postal Code" >
									<input id="contact_country" type="text" placeholder="Country" >
								</div>
								
															
							</div> <!-- close left lower form-->
						
						
						
							<div class="span5">
							
								<label class="span1">Mobile	
								</label>
								<div class="span3 label-field">
									<input id="mobile" type="text" placeholder="S97789789789" >
								</div>
								
								<label class="span1">Telephone	
								</label>
								<div class="span3 label-field">
									<input id="contact_phone" type="text" placeholder="S97789789789" >
								</div>
								
								<label class="span1">Fax	
								</label>
								<div class="span3 label-field">
									<input id="contact_fax" type="text" placeholder="S97789789789" >
								</div>
										
								<label class="span1">E-mail	
								</label>
								<div class="span3 label-field">
									<input id="contact_email" type="text" placeholder="123@123.com" >
								</div>
								
								
								<label class="span1 is-business">Organization	
								</label>
								<div class="span3 label-field is-business">				
									<input id="contact_organization" type="text" placeholder="Organization" >
								</div>
								
								
								
							</div> <!-- close right lower form -->
							
							
							
							
						</div> <!-- close lower form row-->
						
						
					</div> <!-- close lower form -->
				</div> <!--close row-->
			</form> <!-- close form-->
							
		 </div> <!-- close myform-->
						
	  </div> <!-- close form container -->
						
						
					
			
	</div> <!-- close content -->
  </div> <!-- close row -->
</div> <!-- close container -->