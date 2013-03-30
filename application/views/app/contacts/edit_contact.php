<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li>Edit<span class="divider">/</span></li>
			<li class="active"><!--<?php echo $itemID ?>--></li>
		</ul>
		<!-- Control Buttons -->
		<?php echo validation_errors(); ?>
		<?php echo form_open_multipart("inventory/edit_item/$itemID") ?>
			<div>
				
				<input type="submit" class="btn btn-primary span1" name="submit" value="Save" />
				<a href="<?php echo base_url("inventory/display_item_byID/$itemID")?>"class="btn btn-link">
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
									<img id="imgThumbnail" src=<?php 
									if ($imgpath == null){
										echo base_url("resources/images/no_image.gif");
									} else {
										echo base_url("resources/images/inventory/$imgpath");
									}
									?> alt="Inventory">
								</a>
							</div>
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
										<input name="contact_street1" id="contact_hstreet1" type="text" placeholder="Street name 1" >
										<input name="contact_street2" id="contact_hstreet2" type="text" placeholder="Street name 2" >
										<input class="span2" name="contact_state" id="contact_hcity" type="text" placeholder="City/State" >
										<input class="span1" name="contact_postcode" id="contact_hzip" type="text" placeholder="Postal Code" >
										<input name="contact_country" id="contact_hcountry" type="text" placeholder="Country" >
									</div>
								</div>
								
								<div class="span4">
									<label class="span1">Work</label>
									<div class="span2 label-field">
										<input name="contact_landline" id="contact_work" type="text" placeholder="S97789789789" >
									</div>
								
									<label class="span1">Mobile</label>
									<div class="span2 label-field">
										<input name="contact_mobile" id="mobile" type="text" placeholder="S97789789789" >
									</div>							
									
									<label class="span1">Fax</label>
									<div class="span2 label-field">
										<input name="contact_fax" id="contact_fax" type="text" placeholder="S97789789789" >
									</div>
											
									<label class="span1">E-mail</label>
									<div class="span2 label-field">
										<input name="contact_e-mail" id="contact_email" type="text" placeholder="123@123.com" >
									</div>
									
									
									<label class="span1 is-business">Organization</label>
									<div class="span2 label-field is-business">				
										<input name="contact_org" id="contact_org" type="text" placeholder="Organization" >
									</div>
								</div>		
							</div>
							<div class="tab-pane" id="tab_postalinfo">
							<div class="span5">
								<textarea class="span6" name="contact_paddress" style="width:60%" rows="9"><?php echo $desc ?></textarea>
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
						<input id="file" name="file" type="file">     
	
					</div>
					<div class="modal-footer ">
						<button class="btn same-btn-width" data-dismiss="modal" aria-hidden="true" id="changeImg">Ok</button>
						<a data-dismiss="modal" aria-hidden="true" id="cancelUpload" >Cancel</button>
					</div>
				</div>
				
				
				
				
				
			</form> <!-- close form-->
							
		 </div> <!-- close myform-->
						
	  </div> <!-- close form container -->
						
						
					
			
	</div> <!-- close content -->
  </div> <!-- close row -->
</div> <!-- close container -->