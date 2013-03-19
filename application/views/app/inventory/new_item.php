<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url("inventory") ?>">Item</a> <span class="divider">/</span></li>
			<li class="active">New</li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
			<a href="<?php echo site_url("inventory/display_item")?>" id="save_item" class="btn btn-primary span1">Save</a>
			<a href="<?php echo site_url("inventory")?>">
			<button class="btn btn-link">Discard</button>
			</a>
		</div>

		<!-- Form Container -->
		<div class="contact-container container">
			<div class="span9 offset1 myform">
			<form id="new_item_form">
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
								
							</div>
							<div class="span3 offset2">
								<label>Category	
								</label> 
								<select name="item_cate" id="item_category">
									<option value="null">Please Choose :</option>
								</select>		
							</div>		
						
					</div>  <!-- close upper contact-->
							
							
					<div class="lower-contact span9">
						<div class="row">
							<div class="span4">
								<label class="span1">Supplier	
								</label> 	
								<div class="span2 label-field">
									<select name="supplier_list" id="supplier_list">
										<option>Please Choose :</option>
									</select>	
								</div>
								<label class="span1">Cost Price</label>
								<div class="span2 label-field">
									<input id="item_costprice" type="text" placeholder="20.00" >
								</div>
								<label class="span1">Net Price</label>
								<div class="span2 label-field">
									<input id="item_netprice" type="text" placeholder="20.00" >
								</div>
								<label class="span1">VAT Rate</label>
								<div class="span2 label-field">				
									<input id="item_vatrate" type="text" placeholder="50" >
								</div>
								
								
							</div> <!-- close left lower form-->
						
						
						
							<div class="span4">
									<label class="span1">Stock</label>
									<div class="span2 label-field">				
										<input id="item_stock" type="number" placeholder="50" >
									</div>
									<label class="span1">Stock ROP</label>
									<div class="span2 label-field">				
										<input id="item_rop" type="number" placeholder="50" >
									</div>
									<label class="span1">GTIN</label>	
									
									<div class="span2 label-field">
										<input id="item_gtin" type="text" placeholder="0000000000000" >
									</div>
									<label class="span1">SKU</label>
									<div class="span2 label-field">
										<input id="item_sku span3" type="text" placeholder="S97789789789" >
									</div>
									
						
							</div> <!-- close right lower form -->
							
							<div class="span9">
								<label class="span1">Description</label>
								<div class="span7 label-field">				
									<textarea class="span6" id="item_description" rows="3"></textarea>
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