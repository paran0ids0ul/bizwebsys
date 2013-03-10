<div class="container">
  <div class="row">
	<!-- Side Menu -->
    <div class="span2">
		<?php echo $sidemenu ?>
    </div>
    
    <!-- Content -->
    <div class="span10 content">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url("sales") ?>">Sale Orders</a> <span class="divider">/</span></li>
			<li class="active">New</li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
			<button class="btn btn-primary span1">Save</button>
			<button class="btn btn-link">Discard</button>
		</div>
		<!-- Form Headbar -->
		<div class="row content myform-headbar">
			<div class="span2">
				<a class="btn btn-small" href="<?php echo site_url("sales/displayorder")?>">Confirm Sale</a>
			</div>
			<button class="btn btn-small">Cancel</button>
		</div>
		<!-- Form Container -->
		<div class="row myform-container">
			<div class="span8 offset1 myform box-shadow">
				<div class="span6">
					<h4>Quotation</h4>
					<form>
						<div class="row">
							<div class="span3">
								Customer
								<div class="input-prepend">
								  <div class="btn-group">
									<button class="btn dropdown-toggle" data-toggle="dropdown">
									  <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a tabindex="-1" href="#">cust1</a></li>
										<li><a tabindex="-1" href="#">cust2</a></li>
									</ul>
								  </div>
								  <input class="span2" id="cust" type="text" list="customers">
								  <datalist id="customers">
									  <option value="acust">
									  <option value="bcust">
									  <option value="ccust">
									  <option value="dcust">
									  <option value="ecust">
								  </datalist>
								</div>
							</div>
							<div class="span3">
								Date
								<input type="text" id="datepicker" />
							</div>
						</div>
					</form>
				</div>
				<!-- Order Lines Table -->
				<table class="table table-striped">
					<caption>Order Lines</caption>
					  <thead>
						<tr>
						  <th>Product</th>
						  <th>Descriptions</th>
						  <th>Quantity</th>
						  <th>Taxes</th>
						  <th>Unit Price</th>
						  <th>Amount</th>
						</tr>
					  </thead>
					    <tbody>
							<tr>
							  <td>...</td>
							  <td>...</td>
							  <td>...</td>
							  <td>...</td>
							  <td>...</td>
							  <td>...</td>
							</tr>
							<tr>
							  <td>...</td>
							  <td>...</td>
							  <td>...</td>
							  <td>...</td>
							  <td>...</td>
							  <td>...</td>
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

