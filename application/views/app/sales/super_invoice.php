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
				<li><a href="<?php echo site_url("sales") ?>">Customer Invoice</a> <span class="divider">/</span></li>
                <li class="active" id="reference" ><?php echo $orderid?></li><span class="divider"> </span></li>
			</ul>
			<!-- Control Buttons -->
			<div class="row">
				<a class="btn btn-primary same-btn-width" href="<?php echo site_url("sales/edit_invoice") ?>">Edit</a>
				<button class="btn btn-primary same-btn-width">Print</button>
				<button class="btn btn-primary same-btn-width">Delete</button>
			</div>
			<!-- Form Headbar -->
			<div class="row content myform-headbar">
				<a class="btn btn-small" href="#payinvoicemodal" data-toggle="modal">Register Payment</a>
				<button class="btn btn-small">Send by email</button>
			</div>
			<!-- Form Container -->
			<div class="row myform-container">
				<div class="span8 offset1 myform box-shadow">
					<div class="span6">
						<h4>Invoice <?php echo $salesorder['salesorderID']?></h4>
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
					<caption>Invoice Lines</caption>
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
							<?php foreach ($salesorders as $salesorder): ?>
								<td id="<?php echo $salesorder['SalesOrderID']?>" href="<?php echo site_url("sales/display_order_by_id/") . $salesorder['SalesOrderID'] ?>/"><td/>
								<td><?php echo $contactCN ?><td/>
								<td><?php echo $salesorder['DateInvoiced'] ?><td/>
								<td><?php echo $salesorder['Ref'] ?><td/>
								<td><?php echo $employeeCN ?><td/>
								<td><?php echo $salesorder['DatePaymentDue'] ?><td/>
								<td><?php echo $salesorder['Total'] ?><td/>
								<td><td/>
						</tr>
				<?php endforeach ?>
						  </tbody>
					</table>
					<div class="row">
					<div class="span5 ">
						<div class="row">
							<div class="span3">
								Days until Payment Due: 
							</div>
							<div class="span1">
								<?php echo $paymentterm?>
							</div>							
						</div>
						<div class="row">
							<div class="span3">
								Additional Information:
							</div>
							<div class="span1">
								<?php echo $additioninfo?>
							</div>
						</div>
					</div>
					<div class="span3 ">
						<div class="row">
							<div class="span2">
								Subtotal:
							</div>
							<div class="span1">
								0.00
							</div>							
						</div>
						<div class="row">
							<div class="span2">
								Tax:
							</div>
							<div class="span1">
								0.00
							</div>							
						</div>
						<div class="row">
							<div class="span2">
								Deduction:
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

<!-- Modal Pay Invoice-->
<div id="payinvoicemodal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="payinvoicelabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="payinvoicelabel">Pay Invoice</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="payinvoiceform">
	  <div class="control-group">
		<label class="control-label" for="customer">Customer</label>
			<div class="controls">
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
	  </div>
	  <div class="control-group">
		<label class="control-label" for="payamount">Paid Amount</label>
		<div class="controls">
		  <input type="text" id="payamount" placeholder="00.00">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="paymethod">Payment Method</label>
			<div class="controls">
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
	  </div>
	  <div class="control-group">
		<label class="control-label" for="date">Date</label>
		<div class="controls">
		 <input type="text" id="datepicker"/>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="payreference">Payment Reference</label>
		<div class="controls">
		  <input type="text" id="payreference" placeholder="Payment Reference">
		</div>
	  </div>

	</form>
  </div>
  <div class="modal-footer ">
    <a button class="btn btn-primary" form="payinvoiceform" href="<?php echo site_url("sales/payed_super_invoice") ?>">Pay</a>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>