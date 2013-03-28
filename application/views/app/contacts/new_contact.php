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
									<input name="contact_fname" id="contact_fname" type="text" placeholder="John" >
								</div>
								
								<div class="span1 content">
									<label>Surname</label>									
								</div>
								<div class="span3 content">
									<input name="contact_sname" id="contact_sname" type="text" placeholder="Smith" >
								</div>
								<div class="span1 content">
									<label>Common Name</label>									
								</div>
								<div class="span6 content">
									<input name="contact_cname" id="contact_cname" type="text" placeholder="John Smith" >
								</div>
								
									
						
					</div>  <!-- close upper contact-->
							
							
					<div class="lower-contact span9">
						<div class="row">
							<div class="span4">	
								<label class="span1">Postal Address	
								</label>
								<div class="span2 label-field">
									<input name="contact_street1" id="contact_street1" type="text" placeholder="Street name 1" >
									<input name="contact_street2" id="contact_street2" type="text" placeholder="Street name 2" >
									<input class="span2" name="contact_state" id="contact_city" type="text" placeholder="City/State" >
									<input class="span1" name="contact_postcode" id="contact_zip" type="text" placeholder="Postal Code" >
									<input name="contact_country" id="contact_country" type="text" placeholder="Country" >
								</div>
								
															
							</div> <!-- close left lower form-->
						
						
						
							<div class="span5">
							
								<label class="span1">Work	
								</label>
								<div class="span3 label-field">
									<input name="contact_landline" id="contact_work" type="text" placeholder="S97789789789" >
								</div>
							
								<label class="span1">Mobile	
								</label>
								<div class="span3 label-field">
									<input name="contact_mobile" id="mobile" type="text" placeholder="S97789789789" >
								</div>							
								
								<label class="span1">Fax	
								</label>
								<div class="span3 label-field">
									<input name="contact_fax" id="contact_fax" type="text" placeholder="S97789789789" >
								</div>
										
								<label class="span1">E-mail	
								</label>
								<div class="span3 label-field">
									<input name="contact_e-mail" id="contact_email" type="text" placeholder="123@123.com" >
								</div>
								
								
								<label class="span1 is-business">Organization	
								</label>
								<div class="span3 label-field is-business">				
									<input name="contact_org" id="contact_org" type="text" placeholder="Organization" >
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