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
								<span class="input-xlarge uneditable-input" id="item_name">php to retrive data</span>
								<label>Category	
								</label> 
								<span class="input-xlarge uneditable-input" id="item_category">php to retrive data</span>
							</div>
							<div class="span3 offset2">
								<div class="row">	
									</br>	
									<label class="checkbox" id"sold_instore">
										<input type="checkbox"> Can be sold in-store <!-- php to determine checkbox status -->
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
									<span class="input-xlarge uneditable-input" id="item_saleprice">php to retrive data</span>
								</div>
								<label class="span1">Quantity</label>
								<div class="span2 label-field">				
									<span class="input-xlarge uneditable-input" id="item_quantity">php to retrive data</span>
								</div>
								
							</div> <!-- close left lower form-->
						
						
						
							<div class="span4">
									<label class="span1">EAN13</label>	
									
									<div class="span2 label-field">
										<span class="input-xlarge uneditable-input" id="item_barcode">php to retrive data</span>
									</div>
									<label class="span1">Internal Reference</label>
									<div class="span2 label-field">
										<span class="input-xlarge uneditable-input" id="item_intref">php to retrive data</span>
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