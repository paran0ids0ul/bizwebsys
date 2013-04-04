<div class="container">
	<div class="row">
		<div class="span12 content">
			<!--breadcrumb -->
			<ul class="breadcrumb">
				<li><a href="<?php echo site_url("contacts") ?>">Contact</a> <span class="divider">/</span></li>
				<li class="active" id="reference" value="<?php echo $uid ?>"><?php echo $cn ?></li>
			</ul>
			
			<div class="row">
				<div class="span1 ">
					<a href="<?php echo site_url("contacts") ?>" class="">
						<button class="btn btn-primary same-btn-width">Back</button>
					</a>
				</div>
				<div class="span1">
					<a href="<?php echo site_url("contacts/edit_contact/$uid") ?>">
						<button class="btn btn-primary same-btn-width">Edit</button>
					</a>
				</div>	
				<div class="span1">
					<button class="btn btn-primary same-btn-width">Print</button>
				</div>
				<div class="span1">	
					<a href="<?php echo site_url("contacts") ?>" id ="delete_button">
						<button class="btn btn-primary same-btn-width">Delete</button>
					</a>
				</div>
			</div>
			
			
			<div class="contact-container container">
				<div class="span9 offset1 myform">
					<form>
						<div class="row">
							<div class="upper-contact">
								<div class="span1">
									
									<img src=<?php if ($jpeg != NULL) {
														$mime = 'image/jpeg';
														$base64   = base64_encode($jpeg); 
														print('"data:' . $mime . ';base64,' . $base64.'"');
													}
													else {
														echo base_url("resources/images/no_image.gif");
													}
									?> alt="Contact <?php echo $uid ?>">
									
								</div>
								<div class="span1 content">
									
									<label>First Name</label>									
								</div>
								<div class="span3 content">
									<span class="uneditable-input" name ="contact_fname" id="contact_fname"><?php echo $gn ?></span>
								</div>
								
								<div class="span1 content">
									<label>Surname</label>									
								</div>
								<div class="span3 content">
									<span class="uneditable-input" name ="contact_sname" id="contact_sname"><?php echo $sn ?></span>
								</div>
								<div class="span1 content">
									<label>Common Name</label>									
								</div>
								<div class="span6 content">
									<span class="uneditable-input" name ="contact_cname" id="contact_cname"><?php echo $cn ?></span>
								</div>
									
						
							</div>  <!-- close upper contact-->
							
							
							<div class="lower-employee span9 ">
								<div class="row">
									<div class="tabbable span9 "> 
						  				<ul class="nav nav-tabs">
											<li class="active"><a href="#tab_personalinfo" data-toggle="tab">Personal Information</a></li>
											<li><a href="#tab_postalinfo" data-toggle="tab">Postal Details</a></li>
						  				</ul>
						  				<div class="tab-content">
											<div class="tab-pane active" id="tab_personalinfo">
												<div class="span4">
													<div class="row">
														<label class="span1">Home Address :	
														</label>
														<div class="span2 label-field">
															<span class="input-xlarge uneditable-input" name ="contact_hstreet1" id="contact_street1"><?php echo $street1 ?></span>
															<span class="input-xlarge uneditable-input" name ="contact_hstreet2" id="contact_street2"><?php echo $street2 ?></span>
														</div>
													</div>
													<div class="row">
														<label class="span1">City/State :	
														</label>
														<div class="span2 label-field">
															<span class="input-xlarge uneditable-input" name ="contact_hstate" id="contact_hstate"><?php echo $st ?></span>	
														</div>
													</div>
													<div class="row">
														<label class="span1">Zip Code :	
														</label>
														<div class="span2 label-field">
															<span class="input-xlarge uneditable-input" name ="contact_hpostcode" id="contact_hpostcode"><?php echo $postalCode ?></span>
														</div>
													</div>
													<div class="row">
														<label class="span1">Country :	
														</label>
														<div class="span2 label-field">
															<span class="input-xlarge uneditable-input" name ="contact_hcountry" id="contact_hcountry"><?php echo $l ?></span>
														</div>
													</div>
												</div>
								
												<div class="span4">
													<label class="span1">Work	
													</label>
													<div class="span2 label-field">
														<span class="input-xlarge uneditable-input" name ="contact_work" id="contact_Work"><?php echo $tel ?></span>
													</div>
							
													<label class="span1">Mobile	
													</label>
													<div class="span2 label-field">
														<span class="input-xlarge uneditable-input" name ="contact_mobile" id="contact_moblie"><?php echo $mob ?></span>
													</div>									
										
										
													<label class="span1">Fax	
													</label>
													<div class="span2 label-field">
														<span class="input-xlarge uneditable-input" name ="contact_fax" id="contact_fax"><?php echo $facs ?></span>
													</div>
										
													<label class="span1">E-mail	
													</label>
													<div class="span2 label-field">
														<span class="input-xlarge uneditable-input" name ="contact_email" id="contact_email"><?php echo $mail ?></span>
													</div>							
										
													<label class="span1 is-business">Organization
													</label>
													<div class="span2 label-field is-business">											
														<span class="input-xlarge uneditable-input" name ="contact_org" id="contact_org"><?php echo $o ?></span>						
													</div>
												</div>		
											</div>
											<div class="tab-pane" id="tab_postalinfo">
												<div class="span5">
													<label class="span1">Postal Address</label>
													<textarea disabled class="span4" id="contact_paddress" style="width:90" rows="9" ><?php echo $postalAddress ?></textarea>
												</div>							
											</div>	
										</div>
									</div>
								</div>
							</div> <!-- close lower form row-->
						</div> <!--close row-->
					</form> <!-- close form-->
				</div> <!-- close myform-->
			</div> <!-- close form container -->
		</div> <!-- close content-->
	</div>
</div>