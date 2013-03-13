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
			<li><a href="<?php echo site_url("sales") ?>">Sale Orders</a> <span class="divider">/</span></li>
			<li class="active"><?php echo $orderid?></li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
				<button class="btn btn-primary same-btn-width">Create</button>
				<button class="btn btn-primary same-btn-width">Edit</button>
				<button class="btn btn-primary same-btn-width">Print</button>
				<button class="btn btn-primary same-btn-width">Delete</button>
		</div>
		<!-- Form Headbar -->
		<div class="row content myform-headbar">
				<a class="btn btn-small" href="<?php echo site_url("sales/super_invoice") ?>">Create Invoice</a>
			<button class="btn btn-small">Send by email</button>
		</div>
		<!-- Form Container -->
		<div class="row myform-container">
			<div class="span8 offset1 myform box-shadow">
				<div class="span6">
					<h4>Sales Order <?php echo $orderid?></h4>
					<form>
						<div class="row">
							<div class="span3">
								Customer : <?php echo $customer?>
							</div>
							<div class="span3">
								Date : <?php echo $date?>
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
</div>
