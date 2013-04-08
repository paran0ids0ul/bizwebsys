<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li>Edit<span class="divider">/</span></li>
			<li class="active"><?php echo $cn ?></li>
		</ul>
		<!-- Control Buttons -->
		<?php echo validation_errors(); ?>
		<?php echo form_open_multipart("contacts/edit_contact/$uid") ?>
		<div>
			<input type="submit" class="btn btn-primary span1" name="submit" value="Save" />
			<a href="<?php echo base_url("contacts/display_contact_by_id/$uid")?>"class="btn btn-link">
				Cancel
			</a>
		</div>

		<!-- Form Container -->
			<div class="contact-container container">
			  <div class="span9 offset1 myform">
				<div class="row">
					<div class="upper-contact">
							<div class="span1">
								<a href="#uploadImageModal" data-toggle="modal" class="thumbnail">
									<img src=<?php if ($jpeg != NULL) {
														$mime = 'image/jpeg';
														$base64   = base64_encode($jpeg); 
														print('"data:' . $mime . ';base64,' . $base64.'"');
													}
													else {
														echo base_url("resources/images/no_image.gif");
													}
									?> alt="<?php echo $cn ?>">
								</a>
							</div>
							<div class="span1 content">
								<label>First Name</label>									
							</div>
							<div class="span3 content">
								<input name="contact_fname" id="contact_fname" type="text" placeholder="John" value="<?php echo set_value('contact_fname',$gn);?>" >
							</div>
								
							<div class="span1 content">
								<label>Surname</label>									
							</div>
							<div class="span3 content">
								<input name="contact_sname" id="contact_sname" type="text" placeholder="Smith" value="<?php echo set_value('contact_sname',$sn);?>" >
							</div>
							<div class="span1 content">
								<label>Common Name</label>									
							</div>
							<div class="span6 content">
								<input name="contact_cname" id="contact_cname" type="text" placeholder="John Smith" value="<?php echo set_value('contact_cname',$cn);?>">
							</div>		
						
					</div>  <!-- close upper contact-->
							
							
					<div class="lower-contact span9 ">
						<div class="row">
							<div class="tabbable span9 "> 
						  		<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_personalinfo" data-toggle="tab">Personal Information</a></li>
									<li><a href="#tab_postalinfo" data-toggle="tab">Postal Details</a></li>
		 						</ul>
						  		<div class="tab-content">
									<div class="tab-pane active" id="tab_personalinfo">
										<div class="span4">
											<label class="span1">Home Address</label>
											<div class="span2 label-field">
												<input name="contact_hstreet1" id="contact_hstreet1" type="text" placeholder="Street name 1" value="<?php echo set_value('contact_hstreet1',$street1);?>">
												<input name="contact_hstreet2" id="contact_hstreet2" type="text" placeholder="Street name 2" value="<?php echo set_value('contact_hstreet2',$street2);?>">
												<input class="span2" name="contact_hstate" id="contact_hstate" type="text" placeholder="City/State" value="<?php echo set_value('contact_hstate',$st);?>">
												<input class="span1" name="contact_hpostcode" id="contact_hpostcode" type="text" placeholder="Postal Code" value="<?php echo set_value('contact_hpostcode',$postalCode);?>">
												<select name="contact_hcountry" id="contact_hcountry">
													<option value="">Country :</option>
													<?php foreach ($country_list as $country): ?>
														<option value="<?php echo $country ?>" <?php if ($selected_country != NULL) {
																										if ($selected_country == $country) {
																											echo 'selected';
																										}
																									} else {
																										if ($l == $country) {
																											echo 'selected';
																										}
																									}

												 										?>><?php echo $country ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
								
										<div class="span4">
											<label class="span1">Work</label>
											<div class="span2 label-field">
												<input name="contact_work" id="contact_work" type="text" placeholder="S97789789789" value="<?php echo set_value('contact_work',$tel);?>">
											</div>
								
											<label class="span1">Mobile</label>
											<div class="span2 label-field">
												<input name="contact_mobile" id="contact_moblie" type="text" placeholder="S97789789789" value="<?php echo set_value('contact_mobile',$mob);?>">
											</div>							
									
											<label class="span1">Fax</label>
											<div class="span2 label-field">
												<input name="contact_fax" id="contact_fax" type="text" placeholder="S97789789789" value="<?php echo set_value('contact_fax',$facs);?>">
											</div>
												
											<label class="span1">E-mail</label>
											<div class="span2 label-field">
												<input name="contact_email" id="contact_email" type="text" placeholder="123@123.com" value="<?php echo set_value('contact_email',$mail);?>">
											</div>
									
									
											<label class="span1 is-business">Organization</label>
											<div class="span2 label-field is-business">				
												<input name="contact_org" id="contact_org" type="text" placeholder="Organization" value="<?php echo set_value('contact_org',$o);?>">
											</div>
										</div>		
									</div>
									<div class="tab-pane" id="tab_postalinfo">
										<div class="span5">
											<label class="span1">Postal Address</label>
											<textarea class="span4" name="contact_paddress" style="width:90" rows="9"><?php echo set_value('contact_paddress',$postalAddress);?></textarea>
										</div>
						  			</div>
								</div>
							</div>	
						</div> <!-- close lower form row-->
					</div> <!--close row-->
				
					<div id="uploadImageModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="uploadImagelabel" aria-hidden="true">
						<div class="modal-header">
							<h3 id="stockuplabel">Upload Image</h3>
						</div>
						<div class="modal-body">
							<label class="span2">Please select : </label>
							<input id="file" name="file" type="file" value="<?php echo set_value('file');?>">     
	
						</div>
						<div class="modal-footer ">
							<button class="btn same-btn-width" data-dismiss="modal" aria-hidden="true" id="changeImg">Ok</button>
							<a data-dismiss="modal" aria-hidden="true" id="cancelUpload" >Cancel</button>
						</div>
		
					</div>
				</div>	
			  </div>
		    </div>			
				
				
		</form> <!-- close form-->
	</div> <!-- close content -->
  </div> <!-- close row -->
</div> <!-- close container -->