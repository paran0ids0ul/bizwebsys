<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url("contacts") ?>">Item</a> <span class="divider">/</span></li>
			<li class="active">New</li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
			<a href="<?php echo site_url("inventory/display_item")?>" class="btn btn-primary span1">Save</a>
			<button class="btn btn-link">Discard</button>
		</div>

		<!-- Form Container -->
		<div class="contact-container container">
			<div class="span9 offset1 myform">
			<form>
				<div class="row">
					<div class="upper-contact">
							<div class="span1">
								<a href="<?php echo site_url("add_item_picture");?>" class="thumbnail">
									<img src=<?php echo base_url("resources/images/icons128/inventory.png")?> alt="Inventory">
								</a>
							</div>
							<div class="span2">
								<label>Item Name : 
								</label> 
								<input id="item_name" type="text" placeholder="e.g Milo 3 in 1" >
								<label>Category	
								</label> 
								<select name="item_cate" id="item_category">
									<option>Please Choose :</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
							</div>
							<div class="span3 offset2">
								<div class="row">	
									</br>	
									<label class="checkbox" id"sold_instore">
										<input type="checkbox"> Can be sold in-store
									</label>
									<label class="checkbox" id"sold_online">
										<input type="checkbox"> Can be sold online
									</label>							
								</div>			
							</div>		
						
					</div>  <!-- close upper contact-->
							
							
					<div class="lower-contact span9">
						<div class="row">
							<div class="span4">	
								<label class="span1">Sale Price</label>
								<div class="span2 label-field">
									<input id="item_saleprice" type="text" placeholder="20.00" >
								</div>
								<label class="span1">Quantity</label>
								<div class="span2 label-field">				
									<input id="item_quantity" type="number" placeholder="50" >
								</div>
								
							</div> <!-- close left lower form-->
						
						
						
							<div class="span4">
									<label class="span1">EAN13</label>	
									
									<div class="span2 label-field">
										<input id="item_barcode" type="text" placeholder="0000000000000" >
									</div>
									<label class="span1">Internal Reference</label>
									<div class="span2 label-field">
										<input id="item_intref span3" type="text" placeholder="S97789789789" >
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