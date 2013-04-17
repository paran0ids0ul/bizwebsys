<div class="container">
	<div class="row">
		<div class="span12 content">
			<?php echo validation_errors(); ?>
			<?php echo form_open_multipart('settings/edit_company') ?>
			<div class="underlined span12">
				<h4 class="settings-header">Company Info</h4>
			</div>
			<div class="span10 offset1 content">
				<div class="row">
					<div class="span2">
						<img class="span2" src=<?php if ($imgpath == null){
													echo base_url("resources/images/no_image.gif");
												} else {
													echo base_url("resources/images/company_logo/$imgpath");
												}
														?> alt="Business Logo"> 
						<a href="#uploadImageModal" data-toggle="modal" >
							<button class="btn btn-primary span2" id="change_logo">Change Logo</button>
						</a>
					</div>


					<div id="uploadImageModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="uploadImagelabel" aria-hidden="true">
						<div class="modal-header">
							<h3 id="imagelabel">Upload Image</h3>
						</div>
						<div class="modal-body">

							<label class="span2">Please select : </label>
							<input id="file" name="file" type="file" >    

						</div>
						<div class="modal-footer ">

							<button class="btn same-btn-width" data-dismiss="modal" aria-hidden="true">Ok</button>
							<a data-dismiss="modal" aria-hidden="true" id="cancelUpload" >Cancel</button>

						</div>
					</div>



					<div class="span7 offset1 settings-details">
						<label>Company Name :</label> 
						<input name="company_name" type="text" placeholder="e.g Unilever" value="<?php echo set_value('company_name',$name); ?>">
						
						<label>Address :</label>
						<div class="address">
							<input class="span7" name="company_street1" type="text" placeholder="Street name 1" value="<?php echo set_value('company_street1',$street1); ?>">
							<input class="span7" name="company_street2" type="text" placeholder="Street name 2" value="<?php echo set_value('company_street2',$street2); ?>">
							<input name="company_city" type="text" placeholder="City" value="<?php echo set_value('company_city',$city); ?>">
							<input name="company_state" type="text" placeholder="State" value="<?php echo set_value('company_state',$state); ?>">
							<input name="company_zip" type="text" placeholder="Zip" value="<?php echo set_value('company_zip',$zip); ?>">
							<select name="company_country" id="company_country">
								<option value="">Country :</option>
								<?php foreach ($country_list as $countryvalue): ?>
									<option value="<?php echo $countryvalue ?>" <?php if ($selected_country != NULL) {
																					if ($selected_country == $countryvalue) {
																						echo 'selected';
																					}
																				} else {
																					if ($country == $countryvalue) {
																						echo 'selected';
																					}
																				}

							 										?>><?php echo $countryvalue ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<label>Phone :</label>
						<input name="company_phone" type="text" placeholder="e.g 07565758758" value="<?php echo set_value('company_phone',$phone); ?>">
						<label>Vat Code :</label>
						<input name="company_vatcode" type="text" placeholder="e.g 12345" value="<?php echo set_value('company_vatcode',$vatcode); ?>">
						<div>
							<input type="submit" class="btn btn-primary span1" name="submit" value="Save" />
						</div>
						
					</div> <!-- close settings details -->
				</div> <!-- close row-->
			</div> <!-- close company content-->
			


					
		
		</div>
	</div>
</div>



