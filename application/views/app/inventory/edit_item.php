<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li>Edit<span class="divider">/</span></li>
			<li class="active"><?php echo $itemID ?></li>
		</ul>
		<!-- Control Buttons -->
		<?php echo validation_errors(); ?>
		<?php echo form_open("inventory/edit_item/$itemID") ?>
			<div>
				
				<input type="submit" class="btn btn-primary span1" name="submit" value="Save" />
				<a onclick="history.back();" class="btn btn-link">
					Cancel
				</a>
			</div>

		<!-- Form Container -->
			<div class="contact-container container">
			  <div class="span9 offset1 myform">
				<div class="row">
					<div class="upper-contact">
							<div class="span1">
								<a href="<?php echo site_url("add_item_picture");?>" class="thumbnail">
									<img src=<?php echo base_url("resources/images/no_image.gif")?> alt="Inventory">
								</a>
							</div>
							<div class="span2">
								<label>Item Name : 
								</label> 
								<input name="item_name" type="text" placeholder="e.g Milo 3 in 1" value="<?php echo $name?>">
								
							</div>
							<div class="span3 offset2">
								<label>Category	
								</label> 
								<select name="item_category" id="item_category">
									<option value="null">Please Choose :</option>
									<?php foreach ($itemType as $type): ?>
											<option value="<?php echo $type ?>" <?php if ($category == $type) {echo 'selected';} ?>><?php echo $type ?></option>
										<?php endforeach ?>
								</select>		
							</div>		
						
					</div>  <!-- close upper contact-->
							
							
					<div class="lower-contact span9">
						<div class="row">
							<div class="span4">
								<label class="span1">Supplier	
								</label> 	
								<div class="span2 label-field">
									<select name="supplier" id="supplier_list">
										<option>Please Choose :</option>
										<?php foreach ($suppliers as $supplier): ?>
											<option value="<?php echo $supplier['ContactID'] ?>" <?php if ($contactID == $supplier['ContactID']) {echo 'selected';} ?>><?php echo $supplier['lname'] ?></option>
										<?php endforeach ?>
									</select>	
								</div>
								<label class="span1">Cost Price</label>
								<div class="span2 label-field">
									<input name="item_costprice" type="text" placeholder="20.00" value="<?php echo $cost?>" >
								</div>
								<label class="span1">Net Price</label>
								<div class="span2 label-field">
									<input name="item_netprice" type="text" placeholder="20.00" value="<?php echo $net ?>" >
								</div>
								<label class="span1">VAT Rate</label>
								<div class="span2 label-field">				
									<input name="item_vatrate" type="text" placeholder="0.16" value="<?php echo $vat ?>" >
								</div>
								
								
							</div> <!-- close left lower form-->
						
						
						
							<div class="span4">
									<label class="span1">Stock</label>
									<div class="span2 label-field">				
										<input name="item_stock" type="text" placeholder="50" value="<?php echo $stock?>" >
									</div>
									<label class="span1">Stock ROP</label>
									<div class="span2 label-field">				
										<input name="item_rop" type="text" placeholder="50" value="<?php echo $stockROP?>">
									</div>
									<label class="span1">GTIN</label>	
									
									<div class="span2 label-field">
										<input name="item_gtin" type="text" placeholder="0000000000000" value="<?php echo $GTIN?>">
									</div>
									<label class="span1">SKU</label>
									<div class="span2 label-field">
										<input name="item_sku" type="text" placeholder="S97789789789" value="<?php echo $SKU?>">
									</div>
									
						
							</div> <!-- close right lower form -->
							
							<div class="span9">
								<label class="span1">Description</label>
								<div class="span7 label-field">				
									<textarea class="span6" name="item_description" rows="3"><?php echo $desc ?></textarea>
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