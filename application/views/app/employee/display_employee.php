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
								<label>Name :</label> 
								<span class="input-xlarge uneditable-input" id="employee_name"></span>
								<label>Tag :</label> 
								<span class="input-xlarge uneditable-input" id="employee_tag"  type="text" placeholder="Part Time" ></span>
								
							</div>
	
					</div>  <!-- close upper employee-->

							
					<div class="lower-employee span9 ">
						<div class="row">
						<div class="tabbable span9 "> 
						  <ul class="nav nav-tabs">
							<li class="active"><a href="#tab_publicinfo" data-toggle="tab">Public Information</a></li>
							<li><a href="#tab_personalinfo" data-toggle="tab">Personal Information</a></li>
						  </ul>
						  <div class="tab-content">
						  <!--public info-->
							<div class="tab-pane active" id="tab_publicinfo">
							
							<!--contact information-->
								<div class="span5">
									<h4>Contact Information</h4>
									<label class="span2">Working address</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_workadd"></span>						
									</div>
									
									<label class="span2">Work email</label>
									<div class="span2 label-field">				
										<span class="input uneditable-input" id="employee_workemail"></span>
									</div>
									
									<label class="span2">Work phone</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_workphone"></span>
									</div>
									
									<label class="span2">Work mobile</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_workmobile"></span>
									</div>
								</div>
								
								<!--Position-->
								<div class="span5">
									<h4>Position</h4>
									<label class="span2">Department</label>
									<div class="span2 label-field" id="department_select">
										<span class="input uneditable-input" id="employee_department"></span>					
									</div>
										
									<label class="span2">Job</label>
									<div class="span2 label-field" id="job_select">
										<span class="input uneditable-input" id="employee_job"></span>					
									</div>
																
									<label class="span2">Manager</label>
									<div class="span2 label-field" id="manage_select">
										<span class="input uneditable-input" id="employee_manager"></span>					
									</div>		
								</div>
							</div>
							<!--personal info-->
							<div class="tab-pane" id="tab_personalinfo">
							<div class="span5">
								<label class="span2">Gender</label>
									<div class="span2 label-field" id="gender_select">
										<span class="input uneditable-input" id="employee_gender"></span>			
									</div>
							
								<label class="span2">Date of Birth</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_dob"></span>
									</div>
							
								<label class="span2">Nationality</label>
									<div class="span2 label-field" id="nationality_select">
										<span class="input uneditable-input" id="employee_nationality"></span>		
									</div>
							
								<label class="span2">Passport Number</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_passportno"></span>
									</div>
								
								<label class="span2">Bank account</label>
									<div class="span2 label-field">
										<span class="input uneditable-input" id="employee_bankacc"></span>
									</div>
									
								<label class="span2">Home Address</label>
								<div class="span2 label-field">
									<span class="input uneditable-input" id="employee_homestr1"></span>
									<span class="input uneditable-input" id="employee_homestr2"></span>
									<span class="input uneditable-input" id="employee_homecity"></span>
									<span class="input uneditable-input" id="employee_homepostal"></span>
									<span class="input uneditable-input" id="employee_homecountry"></span>
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