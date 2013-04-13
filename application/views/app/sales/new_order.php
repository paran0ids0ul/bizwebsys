<div class="container">
  <div class="row">
	<!-- Side Menu -->
    <div class="span2">
		<?php echo $sidemenu ?>
    </div>
    
    <!-- Content -->
    <div class="span10 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb row">
			<li><a href="<?php echo site_url("sales") ?>">Invoices</a> <span class="divider">/</span></li>
			<li class="active">New</li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
			<button class="btn btn-primary same-btn-width">Save</button>
			<button class="btn btn-link">Discard</button>
		</div>
		<!-- Form Headbar -->
		<div class="row content myform-headbar">
			<a class="btn btn-small" href="<?php echo site_url("sales/display_order")?>">Confirm Sale</a>
			<a class="btn btn-small" href="<?php echo site_url("sales")?>">Cancel</a>
		</div>
		<!-- Form Container -->
		<div class="row myform-container">
			<div class="span8 offset1 myform box-shadow">
				<div class="span6">
					<h4>Quotation</h4>
					<form>
						<div class="row">
							<div class="span3">
								<label>Customer</label>
									<select name="customer" id="customer_list">
										<option>Please Choose :</option>
										<?php foreach ($customers as $customer): ?>
												<option value="<?php echo $customer['ContactID'] ?>"><?php echo $customer['lname'] ?></option>
										<?php endforeach ?>
									</select>	

							</div>
							<div class="span3">
								<label>Date</label>
								<input type="text" id="datepicker" name="item_date" />
							</div>
							
						</div>
					</form>
				</div>
				<!-- Order Lines Table -->
				<table class="table table-striped" id="table">
					<caption>Order Lines</caption>
					
					  <thead>
						<tr>
						  <th>Product</th>
						  <th>Quantity</th>
						  <th>Taxes</th>
						  <th>Unit Price</th>
						  <th>Amount</th>
						</tr>
					  </thead>
					    <tbody>
							<tr> 
							 <td><button type="btn btn-link" id="add"/>Add an item</button></td>
							 <td></td>
							 <td></td>
							 <td></td>
							 <td></td>
							</tr>
						  </tbody>
				</table>
				<!-- Total Display -->
				<div class="row">
					<div class="span3 offset5">
						<div class="row">
							<div class="span2">
								Untaxed Amount:
							</div>
							<div class="span1">
								0.00
							</div>							
						</div>
						<div class="row">
							<div class="span2">
								Taxes:
							</div>
							<div class="span1">
								0.00
							</div>							
						</div>
						<hr>
						<div class="row">
							<div class="span2">
								<b>Total:</b>
							</div>
							<div class="span1">
								<b>0.00</b>
							</div>							
						</div>						
					</div>
				</div>
			</div>
		</div>				
						
					
	</div>
    </div>
  </div>

