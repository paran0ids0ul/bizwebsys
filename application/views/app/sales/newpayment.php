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
		<li><a href="<?php echo site_url("sales/custpayment") ?>">Customer Payment</a> <span class="divider">/</span></li>
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
				<a class="btn btn-small" href="<?php echo site_url("sales/displaypayment")?>">Validate</a>
			</div>
			<button class="btn btn-small">Cancel</button>
		</div>
		<!-- Form Container -->
		<div class="row myform-container">
			<div class="span8 offset1 myform box-shadow">
				<div class="span6">
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
								Payment Amount
								<input type="text"/>
								Payment Method
								<div class="input-prepend">
								  <div class="btn-group">
									<button class="btn dropdown-toggle" data-toggle="dropdown">
									  <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a tabindex="-1" href="#">Visa</a></li>
										<li><a tabindex="-1" href="#">MasterCard</a></li>
									</ul>
								  </div>
								  <input class="span2" id="cust" type="text" list="paymethod">
								  <datalist id="paymethod">
									  <option value="apay">
									  <option value="bpay">
									  <option value="cpay">
									  <option value="dpay">
									  <option value="epay">
								  </datalist>
								</div>
							</div>
							<div class="span3">
								Date
								<input type="text" id="datepicker" />
								Payment Reference
								<input type="text"/>
							</div>
						</div>
					</form>
				</div>
				<!-- Order Lines Table -->
				<table class="table table-striped">
					<caption>Payment Information</caption>
					  <thead>
						<tr>
						  <th>Date</th>
						  <th>Due Date</th>
						  <th>Original Amount</th>
						  <th>Allocation</th>
						</tr>
					  </thead>
					    <tbody>
							<tr>
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
							</tr>
						  </tbody>
				</table>
				<!-- Total Display -->
				<div class="row">
					<div class="span3 offset5">
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
