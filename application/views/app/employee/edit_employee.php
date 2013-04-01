<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li>Edit<span class="divider">/</span></li>
			<li class="active"><?php echo $uid ?></li>
		</ul>

		<?php echo validation_errors(); ?>
		<?php echo form_open_multipart("employee/edit_employee/$uid") ?>
		<!-- Control Buttons -->
		<div>
			<input type="submit" class="btn btn-primary span1" name="submit" value="Save" />
			<a href="<?php echo base_url("employee/display_employee_byID/$uid")?>"class="btn btn-link">
				Cancel
			</a>
		</div>

		<!-- Form Container -->
		<div class="employee-container container">
			<div class="span9 offset1 myform">
			<form>
				<div class="row">
					<div class="upper-employee">
							<div class="span1">
								<a href="#uploadImageModal" data-toggle="modal" class="thumbnail">
									<img src=<?php if ($jpeg != NULL) {
														$mime = 'image/jpeg';
														$base64   = base64_encode($jpeg); 
														print('"data:' . $mime . ';base64,' . $base64.'"');
													}
													else {
														echo base_url("resources/images/icons128/employees.png");
													}
									?> alt="<?php echo $uid?>">
								</a>
							</div>

							<!-- image upload modal -->
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

							<div class="span2">
								<label>First name :</label> 
								<input id="employee_fname" name="employee_fname" type="text" placeholder="e.g John" value="<?php echo $gn ?>" >
								<label>Surname :</label> 
								<input id="employee_sname" name="employee_sname"  type="text" placeholder="e.g White" value="<?php echo $sn ?>">
								<label>Common name :</label> 
								<input id="employee_cname" name="employee_cname"  type="text" placeholder="e.g John2" value="<?php echo $cn ?>">
								
							</div>

							<div class="span2 offset2">
								<label>Username :</label> 
								<input id="employee_uname" name="employee_uname" type="text" placeholder="e.g John" value="<?php echo $uid ?>">
								<label>Password : (Leave it blank if you do not wish to reset)</label> 
								<input type="password" id="employee_password" name="employee_password">
							</div>
	
					</div>  <!-- close upper employee-->

							
					<div class="lower-employee span9 ">
						<div class="row">
						<div class="tabbable span9 "> 
						  <div class="tab-content">
							<div class="tab-pane active" id="tab_publicinfo">
							
							<!--contact information-->
								<div class="span5">
									<h4>Contact Information</h4>									
									<label class="span2">Email</label>
									<div class="span2 label-field">
										<input readonly id="employee_email" name="employee_email"  type="text" placeholder="John@gmail.com" value="<?php echo $mail ?>">
									</div>
									
									<label class="span2">Home phone</label>
									<div class="span2 label-field">
										<input id="employee_homephone" name="employee_homephone" type="text" placeholder="+97789789789" value="<?php echo $homephone ?>">
									</div>
									
									<label class="span2">Mobile</label>
									<div class="span2 label-field">
										<input id="employee_mobile" name="employee_mobile" type="text" placeholder="00447789789789" value="<?php echo $mobile ?>">
									</div>
									
									<label class="span2">Postal Address</label>
									<div class="span2 label-field">
										<textarea name="employee_paddress" style="width:90" rows="5"><?php echo $paddress ?></textarea>
									</div>										
											
									<label class="span2">Postal Code</label>
									<div class="span2 label-field">
										<input id="employee_postcode" name="employee_postcode" type="text" placeholder="Postal code" value="<?php echo $postalCode ?>">
									</div>
									
									<label class="span2">Country</label>
									<div class="span2 label-field">
										<select name="employee_country" id="employee_country">
											<option value="">Country :</option>
											<?php foreach ($country_list as $country): ?>
												<option value="<?php echo $country ?>" <?php if ($l == $country) {echo 'selected';} ?>><?php echo $country ?></option>
											<?php endforeach ?>
										</select>
									</div>
									
								</div>
								
								<!--Position-->
								<div class="span5">
									<h4>Position</h4>	
									<label class="span2">Job title</label>
									<div class="span2 label-field" id="job_select">
										<select name="employee_title">
											<option>Please Choose :</option>
											<<?php foreach ($job_titles as $job): ?>
												<option value="<?php echo $job ?>" <?php if ($jobtitle == $job) {echo 'selected';} ?>><?php echo $job ?></option>
											<?php endforeach ?>
										</select>						
									</div>		
								</div>
							</div>
							
							
						</div>
			
							
							
							
						</div>	
						</div> <!-- close lower form row-->
						
						
					</div> <!-- close lower form -->
				</div> <!--close row-->
			</form> <!-- close form-->
							
		 </div> <!-- close myform-->
						
	  </div> <!-- close form container -->
						
						
					
			
	</div> <!-- close content -->
  </div> <!-- close row -->
</div> <!-- close container -->