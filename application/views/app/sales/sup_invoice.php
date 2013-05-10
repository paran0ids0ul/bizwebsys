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
				<li><a href="<?php echo site_url("sales/sup_invoice") ?>">Supplier Invoice</a> <span
						class="divider">/</span></li>
				<li class="active">Internal Reference</li>
			</ul>
			<!-- Control Buttons -->
			<div class="row">
				<button class="btn btn-primary same-btn-width">Save</button>
				<a class="btn btn-link" href="<?php echo site_url("sales/sup_invoice") ?>">Discard</a>
			</div>
			<!-- Form Headbar -->
			<div class="row content myform-headbar">
				<a href="#payinvoicemodal" data-toggle="modal" class="btn btn-small">Pay</a>
			</div>
			<!-- Form Container -->
			<div class="row myform-container">
				<div class="span8 offset1 myform box-shadow">
					<div class="span6">
						<h4>Invoice </h4>
						<form>
							<div class="row">
								<div class="span3">
									<label>Supplier</label>
									<select name="supplier" id="supplier_list">
										<option>Please Choose :</option>
										<?php foreach ($suppliers as $supplier_id => $supplier_name) { ?>
											<option
												value="<?php echo $supplier_id ?>"><?php echo $supplier_name ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="span3">
									<div class="row">
										<label> Invoice Date :</label>
										<input type="text" id="datepicker" name="invoice_date"/>
									</div>
									<div class="row">
										<label>Due Date :</label>
										<input type="text" id="datepicker" name="due_date"/>
									</div>
								</div>
							</div>
					</div>
					</form>
					<!-- Order Lines Table -->
					<table class="table table-striped" id="purchases_table">
						<caption>Invoice</caption>
						<thead>
						<tr>
							<th>Product</th>
							<th>Descriptions</th>
							<th>Quantity</th>
							<th>Taxes</th>
							<th>Unit Price</th>
							<th>Untaxed Amount</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>
								<button type="btn btn-link" id="add_line"/>
								Add an item</button></td>
							<td></td>
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
							<div class="row">
								<div class="span2">
									Deduction:
								</div>
								<div class="span1">
									<input class="span1" id="deduction" type="text">
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
<div id="payinvoicemodal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="payinvoicelabel"
	 aria-hidden="true">
	<div class="modal-header">
		<h3 id="payinvoicelabel">Pay Invoice</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" id="payinvoice_form" method="post" action="">
			<div class="control-group">
				<label class="control-label" for="supplier">Supplier</label>

				<div class="controls">
					<select name="supplier" id="supplier_list">
						<option>Please Choose :</option>
						<?php foreach ($suppliers as $supplier_id => $supplier_name) { ?>
							<option
								value="<?php echo $supplier_id ?>"><?php echo $supplier_name ?></option>
						<?php } ?>
					</select>
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
					<select name="paymenttype" id="payment_type">
						<option value="">Please Choose :</option>
						<option value="Cash">Cash</option>
						<option value="Credit Card">Credit Card</option>
						<option value="Debit Card">Debit Card</option>
						<option value="Cheque">Cheque</option>
					</select>
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
		<a button class="btn btn-primary" form="payinvoiceform">Pay</a>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>