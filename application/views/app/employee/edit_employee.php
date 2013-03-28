<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li class="active">Edit/</li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
			<a  class="btn btn-primary span1">Save</a>
			<button class="btn btn-link">cancle</button>
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
								<label>Common name :</label> 
								<input id="employee_cn" type="text" placeholder="e.g John2" >
								
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
										<input id="work_email" type="text" placeholder="John@gmail.com" >
									</div>
									
									<label class="span2">Home phone</label>
									<div class="span2 label-field">
										<input id="work_phone" type="text" placeholder="+97789789789" >
									</div>
									
									<label class="span2">Mobile</label>
									<div class="span2 label-field">
										<input id="work_mobile" type="text" placeholder="00447789789789" >
									</div>
									
									<label class="span2">Address</label>
										<div class="span2 label-field">
											<input id="homeaddress_street1" type="text" placeholder="Street name 1" >
											<input id="homeaddress_street2" type="text" placeholder="Street name 2" >
										</div>
										
									<label class="span2">Country</label>
									<div class="span2 label-field">
										<input id="homeaddress_country" type="text" placeholder="Country" >
									</div>
										
									<label class="span2">Postal Code</label>
									<div class="span2 label-field">
										<input id="homeaddress_postal" type="text" placeholder="Postal code" >
									</div>
									
								</div>
								
								<!--Position-->
								<div class="span5">
									<h4>Position</h4>	
									<label class="span2">Job title</label>
									<div class="span2 label-field" id="job_select">
										<select name="job_list">
											<option>Please Choose :</option>
											<option></option>
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