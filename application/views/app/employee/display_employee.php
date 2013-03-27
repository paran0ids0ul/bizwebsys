<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url("employee") ?>">Employee</a> <span class="divider">/</span></li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
			<div class="span1 ">
				<a href="<?php echo site_url("employee") ?>" class="">
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

		<!-- Form Container -->
		<div class="employee-container container">
			<div class="span9 offset1 myform">
			<form>
				<div class="row">
					<div class="upper-employee">
							<div class="span1">
								<a href="<?php echo site_url("add_employee_picture");?>" class="thumbnail">
									<img src=<?php echo base_url("resources/images/icons128/employees.png")?> alt="Employee">
								</a>
							</div>

							<div class="span2">
								<label>First name :</label> 
								<span class="input-xlarge uneditable-input" id="employee_fname"></span>
								<label>Surname :</label> 
								<span class="input-xlarge uneditable-input" id="employee_surname"></span>
								<label>User name :</label> 
								<span class="input-xlarge uneditable-input" id="employee_username"  type="text" placeholder="e.g John2" ></span>
								
							</div>
	
					</div>  <!-- close upper employee-->

							
					<div class="lower-employee span9 ">
						<div class="row">
						<div class="tabbable span9 ">
						  <div class="tab-content">
							
							<!--contact information-->
								<div class="span5">
									<h4>Contact Information</h4>		
									<label class="span2">Home phone</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_phone"></span>
									</div>
									
									<label class="span2">Mobile</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_mobile"></span>
									</div>
									
									<label class="span2">Address</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_homestr1"></span>
										<span class="input uneditable-input" id="employee_homestr2"></span>
									</div>
									
									<label class="span2">Country</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_homecountry"></span>
									</div>
									
									<label class="span2">Postal code</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_homepostal"></span>
									</div>
								</div>
								
								<!--Position-->
								<div class="span5">
									<h4>Position</h4>
										
									<label class="span2">Job title</label>
									<div class="span2 label-field" id="job_select">
										<span class="input uneditable-input" id="employee_job"></span>					
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