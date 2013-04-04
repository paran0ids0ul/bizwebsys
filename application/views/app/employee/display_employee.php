<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url("employee") ?>">Employee</a> <span class="divider">/</span></li>
			<li class="active" id="reference" value="<?php echo $uid ?>"><?php echo $uid ?></li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
			<div class="span1 ">
				<a href="<?php echo site_url("employee") ?>">
					<button class="btn btn-primary same-btn-width">Back</button>
				</a>
			</div>
			<div class="span1">
				<a href="<?php echo site_url("employee/edit_employee/$uid") ?>">
					<button class="btn btn-primary same-btn-width">Edit</button>
				</a>
			</div>	
			<div class="span1">
				<button class="btn btn-primary same-btn-width">Print</button>
			</div>
			<div class="span1">	
				<a href="<?php echo site_url("employee") ?>" id="delete_button">
					<button class="btn btn-primary same-btn-width">Delete</button>
				</a>
			</div>
		</div>

		<!-- Form Container -->
		<div class="employee-container container">
			<div class="span9 offset1 myform">
			<form>
				<div class="row">
					<div class="upper-employee">
							<div class="span1">
								<img src=<?php if ($jpeg != NULL) {
														$mime = 'image/jpeg';
														$base64   = base64_encode($jpeg); 
														print('"data:' . $mime . ';base64,' . $base64.'"');
													}
													else {
														echo base_url("resources/images/icons128/employees.png");
													}
								?> alt="<?php echo $uid ?>">
							</div>

							<div class="span2">
								<label>First name :</label> 
								<span class="input-xlarge uneditable-input" id="employee_fname" name="employee_fname"><?php echo $gn ?></span>
								<label>Surname :</label> 
								<span class="input-xlarge uneditable-input" id="employee_sname" name="employee_sname"><?php echo $sn ?></span>
								<label>Common name :</label> 
								<span class="input-xlarge uneditable-input" id="employee_cname" name="employee_cname"><?php echo $cn ?></span>	
							</div>
							
							<div class="span2 offset2">
								<label>Username :</label> 
								<span class="input-xlarge uneditable-input" id="employee_uname" name="employee_uname" ><?php echo $uid ?></span>
							</div>
	
					</div>  <!-- close upper employee-->

							
					<div class="lower-employee span9 ">
						<div class="row">
						<div class="tabbable span9 ">
						  <div class="tab-content">
							
							<!--contact information-->
								<div class="span5">
									<h4>Contact Information</h4>		
									<label class="span2">Email</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_email" name="employee_email"><?php echo $mail ?></span>
									</div>
									
									<label class="span2">Home phone</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_phone" name="employee_email"><?php echo $homephone ?></span>
									</div>
									
									<label class="span2">Mobile</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_mobile" name="employee_email"><?php echo $mobile ?></span>
									</div>
									
									<label class="span2">Postal Address</label>
									<div class="span2 label-field">
											<textarea readonly name="employee_paddress" style="width:90" rows="5"><?php echo $paddress ?></textarea>
									</div>
									
									<label class="span2">Postal code</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_postcode" name="employee_postcode"><?php echo $postalCode ?></span>
									</div>

									<label class="span2">Country</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_country" name="employee_postcode"><?php echo $l ?></span>
									</div>
									
									
								</div>
								
								<!--Position-->
								<div class="span5">
									<h4>Position</h4>
										
									<label class="span2">Job title</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_title" name="employee_title"><?php echo $jobtitle ?></span>					
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