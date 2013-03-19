<div class="container">
	<div class="row">
		<div class="span12 content">
			<!--breadcrumb -->
			<ul class="breadcrumb">
				<li><a href="<?php echo site_url("inventory") ?>">Item</a> <span class="divider">/</span></li>
				<li class="active"><!--php code? --></li>
			</ul>
			
			<div class="row">
				<div class="span1 ">
					<a href="<?php echo site_url("inventory") ?>" class="">
						<button class="btn btn-primary same-btn-width">Back</button>
					</a>
				</div>
				<div class="span1">	
					<a href="#stockupmodal" data-toggle="modal">
						<button class="btn btn-primary same-btn-width">Stock up</button>
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
								<span class="input-xlarge uneditable-input" id="item_name"><?php echo $name ?></span>
								
							</div>
							<div class="span3 offset2">
								<label>Category	
								</label> 
								<span class="input-xlarge uneditable-input" id="item_category"><?php echo $category ?></span>		
							</div>		
						
					</div>  <!-- close upper contact-->
							
							
					<div class="lower-contact span9">
						<div class="row">
							<div class="span4">	
								
								
								
								
								
								<label class="span1">Supplier	
								</label> 	
								<div class="span2 label-field">
									<span class="input-xlarge uneditable-input" id="item_supplier"><?php echo $supplier ?></span>
								</div>
								<label class="span1">Cost Price</label>
								<div class="span2 label-field">
									<span class="input-xlarge uneditable-input" id="item_costprice"><?php echo $cost ?></span>
								</div>
								<label class="span1">Net Price</label>
								<div class="span2 label-field">
									<span class="input-xlarge uneditable-input" id="item_netprice"><?php echo $net ?></span>
								</div>
								<label class="span1">VAT Rate</label>
								<div class="span2 label-field">
									<span class="input-xlarge uneditable-input" id="item_vatrate"><?php echo $vat ?></span>
								</div>
								
								
							</div> <!-- close left lower form-->
						
						
						
							<div class="span4">
									
									
									
									<label class="span1">Stock</label>
									<div class="span2 label-field">				
										<span class="input-xlarge uneditable-input" id="item_stock"><?php echo $stock ?></span>
									</div>
									<label class="span1">Stock ROP</label>
									<div class="span2 label-field">				
										<span class="input-xlarge uneditable-input" id="item_rop"><?php echo $stockROP ?></span>
									</div>
									<label class="span1">GTIN</label>	
									<div class="span2 label-field">
										<span class="input-xlarge uneditable-input" id="item_gtin"><?php echo $GTIN ?></span>
									</div>
									<label class="span1">SKU</label>
									<div class="span2 label-field">
										<span class="input-xlarge uneditable-input" id="item_sku"><?php echo $SKU ?></span>
									</div>
									
									
						
							</div> <!-- close right lower form -->
							
							
							<div class="span9">
								<label class="span1">Description</label>
								<div class="span7 label-field">				
									<textarea disabled class="span6" id="item_description" rows="3"><?php echo $description ?></textarea>
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



<!-- Modal Stock up-->
<div id="stockupmodal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="stockuplabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="stockuplabel">Stock Up</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="stockupform">
		
			<label class="span2">Stock to add : </label>
			<input class="span2" id="oldpass" type="number">     
		
	</form>
  </div>
  <div class="modal-footer ">
    <a button class="btn btn-primary" form="stockupform" data-dismiss="modal" aria-hidden="true">Stock Up</a> <!--update stock count -->
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
  </div>
</div>