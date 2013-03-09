<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url("contacts") ?>">Contact</a> <span class="divider">/</span></li>
			<li class="active">New</li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
			<button class="btn btn-primary span1">Save</button>
			<button class="btn btn-link">Discard</button>
		</div>

		<!-- Form Container -->
		<div class="contact-container container">
			<div class="span9 offset1 myform">
			<form>
				<div class="row">
					<div class="upper-contact">
							<div class="span1">
								<a href="<?php echo site_url("add_contact_picture");?>" class="thumbnail">
									<img src=<?php echo base_url("resources/images/icons128/inventory.png")?> alt="Inventory">
								</a>
							</div>
							<div class="span2">
								<label class"checkbox">Name : ( 
								<input type="checkbox" id"is_company"> Is a Company? )
								</label> 
								<input id="contact_name" type="text" placeholder="e.g John Wesley" >
								
							</div>
							<!-- this div is only unhidden if company tickbox is ticked-->
							<div class="span3 offset1" id="cate_select">
								<label>Business Category	
								</label> 
								<select name="business_list">
									<option>Please Choose :</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>						
							</div>		
						
					</div>  <!-- close upper contact-->
							
							
					<div class="lower-contact span9">
						<div class="row">
							<div class="span4">	
								<label class="span1">Address	
								</label>
								<div class="span2 label-field">
									<input id="contact_street1" type="text" placeholder="Street name 1" >
									<input id="contact_street2" type="text" placeholder="Street name 2" >
									<input class="span1" id="contact_city" type="text" placeholder="City" >
									<input class="span1" id="contact_state" type="text" placeholder="State" >
									<input class="span1" id="contact_zip" type="text" placeholder="Zip" >
									<input id="contact_country" type="text" placeholder="Country" >
								</div>
								<label class="span1">Website	
								</label>
								<div class="span2 label-field">				
									<input id="contact_website" type="text" placeholder="Website Address" >
								</div>
							
							</div> <!-- close left lower form-->
						
						
						
							<div class="span5">
							
								<label class="span1">Phone	
								</label>
								<div class="span3 label-field">
									<input id="contact_phone" type="text" placeholder="S97789789789" >
								</div>
										
								<label class="span1">E-mail	
								</label>
								<div class="span3 label-field">
									<input id="contact_email" type="text" placeholder="123@123.com" >
								</div>
								
								<label class="span1">Title
								</label>
								<div class="span3 label-field" id="title_select">
									<select name="title_list">
										<option>Please Choose :</option>
										<option>Mr.</option>
										<option>Ms.</option>
										<option>Mrs.</option>
									</select>						
								</div>		
							</div> <!-- close right lower form -->
							
							
							
							
						</div> <!-- close lower form row-->
						
						
					</div> <!-- close lower form -->
				</div> <!--close row-->
			</form> <!-- close form-->
							
		 </div> <!-- close myform-->
						
	  </div> <!-- close form container -->
						
						
					
			
	</div> <!-- close content -->
  </div> <!-- close row -->
</div> <!-- close container -->