<div class="container">
	<div class="row">
		<div class="span12 content">
			<!--breadcrumb -->
			<ul class="breadcrumb">
				<li><a href="<?php echo site_url("contacts") ?>">Contact</a> <span class="divider">/</span></li>
				<li class="active"><!--php code? --></li>
			</ul>
			
			<div class="row">
				<div class="span1 ">
					<a href="<?php echo site_url("contacts") ?>" class="">
						<button class="btn btn-primary same-btn-width">Back</button>
					</a>
				</div>
				<div class="span1">
					<button class="btn btn-primary same-btn-width">Edit</button>
				</div>	
				<div class="span1">
					<button class="btn btn-primary same-btn-width">Print</button>
				</div>
				<div class="span1">	
					<button class="btn btn-primary same-btn-width">Delete</button>
				</div>
			</div>
			
			
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
										<div class="row">
											<label class="span1">Street :	
											</label>
											<div class="span2 label-field">
												<span class="input-xlarge uneditable-input" id="contact_street1">php to retrive data</span>
												<span class="input-xlarge uneditable-input" id="contact_street2">php to retrive data</span>
											</div>
										</div>
										<div class="row">
											<label class="span1">City/State :	
											</label>
											<div class="span2 label-field">
												<span class="input-xlarge uneditable-input" id="contact_city">php to retrive data</span>	
											</div>
										</div>
										<div class="row">
											<label class="span1">Zip Code :	
											</label>
											<div class="span2 label-field">
												<span class="input-xlarge uneditable-input" id="contact_zip">php to retrive data</span>
											</div>
										</div>
										<div class="row">
											<label class="span1">Country :	
											</label>
											<div class="span2 label-field">
												<span class="input-xlarge uneditable-input" id="contact_country">php to retrive data</span>
											</div>
										</div>
										
									</div> <!-- close left lower form-->
						
						
						
									<div class="span5">
							
										<label class="span1">Mobile	
										</label>
										<div class="span3 label-field">
											<span class="input-xlarge uneditable-input" id="contact_moblie">php to retrive data</span>
										</div>
										
										<label class="span1">Telephone	
										</label>
										<div class="span3 label-field">
											<span class="input-xlarge uneditable-input" id="contact_phone">php to retrive data</span>
										</div>
										
										<label class="span1">Fax	
										</label>
										<div class="span3 label-field">
											<span class="input-xlarge uneditable-input" id="contact_fax">php to retrive data</span>
										</div>
										
										<label class="span1">E-mail	
										</label>
										<div class="span3 label-field">
											<span class="input-xlarge uneditable-input" id="contact_email">php to retrive data</span>
										</div>
								
										
										
										<label class="span1 is-business">Organization
										</label>
										<div class="span3 label-field is-business">											
											<span class="input-xlarge uneditable-input" id="contact_organization">php to retrive data</span>						
										</div>
										
										
										
												
									</div> <!-- close right lower form -->
								</div> <!-- close lower form row-->
							</div> <!-- close lower form -->
						</div> <!--close row-->
					</form> <!-- close form-->
				</div> <!-- close myform-->
			</div> <!-- close form container -->
		</div> <!-- close content-->
	</div>
</div>