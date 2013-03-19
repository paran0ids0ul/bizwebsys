<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url("employee") ?>">Employee</a> <span class="divider">/</span></li>
			<li class="active">New</li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
			<a  class="btn btn-primary span1">Save</a>
			<a href="<?php echo site_url("employee")?>">
			<button class="btn btn-link">Discard</button>
			</a>
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
								<input id="employee_fname" type="text" placeholder="e.g John" >
								<label>Surname :</label> 
								<input id="employee_surname" type="text" placeholder="e.g White" >
								<label>Tag :</label> 
								<input id="employee_tag" type="text" placeholder="e.g Part Time" >
								
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
							<div class="tab-pane active" id="tab_publicinfo">
							
							<!--contact information-->
								<div class="span5">
									<h4>Contact Information</h4>
									<label class="span2">Working address</label>
									<div class="span2 label-field" id="title_select">
										<select name="workadd_list">
											<option>Please Choose :</option>
											<option>University College London, Gower Street, London</option>
										</select>
									</div>
									
									<label class="span2">Work email</label>
									<div class="span2 label-field">				
										<input id="work_email" type="text" placeholder="ee@ucl.ac.uk" >
									</div>
									
									<label class="span2">Work phone</label>
									<div class="span2 label-field">
										<input id="work_phone" type="text" placeholder="+97789789789" >
									</div>
									
									<label class="span2">Work mobile</label>
									<div class="span2 label-field">
										<input id="work_mobile" type="text" placeholder="00447789789789" >
									</div>
								</div>
								
								<!--Position-->
								<div class="span5">
									<h4>Position</h4>
									<label class="span2">Department</label>
									<div class="span2 label-field" id="department_select">
										<select name="department_list">
											<option>Please Choose :</option>
											<option>Human Resources </option>
										</select>						
									</div>
										
									<label class="span2">Job</label>
									<div class="span2 label-field" id="job_select">
										<select name="job_list">
											<option>Please Choose :</option>
											<option></option>
										</select>						
									</div>
																
									<label class="span2">Manager</label>
									<div class="span2 label-field" id="manage_select">
										<select name="manager_list">
											<option>Please Choose :</option>
											<option></option>
										</select>						
									</div>		
								</div>
							</div>
							<div class="tab-pane" id="tab_personalinfo">
							<div class="span5">
								<label class="span2">Gender</label>
									<div class="span2 label-field" id="gender_select">
										<select name="gender_list">
											<option>Please Choose :</option>
											<option>Male</option>
											<option>Female</option>
										</select>						
									</div>
							
								<label class="span2">Date of Birth</label>
									<div class="span2 label-field">
										<input type="text" id="datepicker" >
									</div>
							
								<label class="span2">Nationality</label>
									<div class="span2 label-field" id="nationality_select">
										<select name="manager_list">
											<option>Please Choose :</option>
											<option></option>
										</select>						
									</div>
							
								<label class="span2">Passport Number</label>
									<div class="span2 label-field">
										<input id="passport_no" type="text" placeholder="S97789789789" >
									</div>
								
								<label class="span2">Bank account</label>
									<div class="span2 label-field">
										<input id="bankaccount" type="text" placeholder="2674948520582947" >
									</div>
									
								<label class="span2">Home Address</label>
								<div class="span2 label-field">
									<input id="homeaddress_street1" type="text" placeholder="Street name 1" >
									<input id="homeaddress_street2" type="text" placeholder="Street name 2" >
									<input id="homeaddress_city" type="text" placeholder="City" >
									<input id="homeaddress_postal" type="text" placeholder="Postal code" >
									<input id="homeaddress_country" type="text" placeholder="Country" >
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