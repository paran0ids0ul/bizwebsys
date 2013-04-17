<div class="container">
  <div class="row">
      <!-- Content -->
    <div class="span12 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li>Edit<span class="divider">/</span></li>
			<li class="active"><?php echo $name ?></li>
		</ul>
		<!-- Control Buttons -->
		<?php echo validation_errors(); ?>
		<?php echo form_open_multipart("inventory/edit_item/$itemID") ?>
			<div>
				
				<input type="submit" class="btn btn-primary span1" name="submit" value="Save" />
				<a href="<?php echo base_url("inventory/display_item_by_id/$itemID")?>"class="btn btn-link">
					Cancel
				</a>
			</div>

		<!-- Form Container -->
			<div class="contact-container container">
			  <div class="span9 offset1 myform">
				<div class="row">
					<div class="upper-contact">
							<div class="span1">
								<a href="#uploadImageModal" data-toggle="modal" class="thumbnail">
									<img id="imgThumbnail" src=<?php 
									if ($imgpath == null){
										echo base_url("resources/images/no_image.gif");
									} else {
										echo base_url("resources/images/inventory/$imgpath");
									}
									?> alt="Inventory">
								</a>
							</div>
							<div class="span2">
								<label>Item Name : 
								</label> 
								<input name="item_name" type="text" placeholder="e.g Milo 3 in 1" value="<?php echo set_value('item_name',$name); ?>">
								
							</div>
							<div class="span3 offset2">
								<label>Category	
								</label> 
								<select name="item_category" id="item_category">
									<option value="">Please Choose :</option>
									<?php foreach ($itemType as $type): ?>
											<option value="<?php echo $type ?>" <?php if ($selected_category != NULL) {
																							if ($selected_category == $type) {
																								echo 'selected';
																							}
																						} else {
																							if ($category == $type) {echo 'selected';} 
																						}

																				?>><?php echo $type ?></option>
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
										<?php foreach ($contacts as $contact): ?>
											<?php if (!is_array($contact)) continue; ?>
											<option value="<?php echo $contact['uid'][0] ?>" <?php if ($selected_supplier != NULL) {
																										if ($selected_supplier == $contact['uid'][0]) {
																											echo 'selected';
																										}
																									} else {
																										if ($contactID == $contact['uid'][0]) 
																											{echo 'selected';}
																									} 
																							?>><?php echo $contact['cn'][0] ?></option>
										<?php endforeach ?>
									</select>	
								</div>
								<label class="span1">Cost Price</label>
								<div class="span2 label-field">
									<input name="item_costprice" type="text" placeholder="20.00" value="<?php echo set_value('item_costprice',$cost); ?>">
								</div>
								<label class="span1">Net Price</label>
								<div class="span2 label-field">
									<input name="item_netprice" type="text" placeholder="20.00" value="<?php echo set_value('item_netprice',$net); ?>">
								</div>
								<label class="span1">VAT Rate</label>
								<div class="span2 label-field">				
									<input name="item_vatrate" type="text" placeholder="0.16" value="<?php echo set_value('item_vatrate',$vat); ?>">
								</div>
								<label class="span1">Discount Rate</label>
								<div class="span2 label-field">				
									<input name="item_disrate" type="text" placeholder="0.16" value="<?php echo set_value('item_disrate',$dis); ?>">
								</div>
								
								
							</div> <!-- close left lower form-->
						
						
						
							<div class="span4">
									<label class="span1">Stock</label>
									<div class="span2 label-field">				
										<input name="item_stock" type="text" placeholder="50" value="<?php echo set_value('item_stock',$stock); ?>">
									</div>
									<label class="span1">Stock ROP</label>
									<div class="span2 label-field">				
										<input name="item_rop" type="text" placeholder="50" value="<?php echo set_value('item_rop',$stockROP); ?>">
									</div>
									<label class="span1">GTIN</label>	
									
									<div class="span2 label-field">
										<input name="item_gtin" type="text" placeholder="0000000000000" value="<?php echo set_value('item_gtin',$GTIN); ?>">
									</div>
									<label class="span1">SKU</label>
									<div class="span2 label-field">
										<input name="item_sku" type="text" placeholder="S97789789789" value="<?php echo set_value('item_sku',$SKU); ?>">
									</div>
									
						
							</div> <!-- close right lower form -->
							
							<div class="span9">
								<label class="span1">Description</label>
								<div class="span7 label-field">				
									<textarea class="span6" name="item_description" rows="3"><?php echo set_value('item_description',$desc); ?></textarea>
								</div>
							</div>
							
						</div> <!-- close lower form row-->
						
						
						
					</div> <!-- close lower form -->
					
					
					
				</div> <!--close row-->
				
				<div id="uploadImageModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="uploadImagelabel" aria-hidden="true">
					<div class="modal-header">
						<h3 id="stockuplabel">Upload Image</h3>
					</div>
					<div class="modal-body">
						<label class="span2">Please select : </label>
						<input id="file" name="file" type="file" value="<?php echo set_value('file'); ?>" >     
	
					</div>
					<div class="modal-footer ">
						<button class="btn same-btn-width" data-dismiss="modal" aria-hidden="true" id="changeImg">Ok</button>
						<a data-dismiss="modal" aria-hidden="true" id="cancelUpload" >Cancel</button>
					</div>
				</div>
				
				
				
				
				
			</form> <!-- close form-->
							
		 </div> <!-- close myform-->
						
	  </div> <!-- close form container -->
						
						
					
			
	</div> <!-- close content -->
  </div> <!-- close row -->
</div> <!-- close container -->