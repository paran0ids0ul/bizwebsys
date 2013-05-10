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
				<li><a href="<?php echo site_url("sales/sup_payment") ?>">Supplier Payment</a> <span
						class="divider">/</span></li>
				<li class="active">New</li>
			</ul>
			<!-- Control Buttons -->
			<div class="row">
				<a class="btn btn-primary same-btn-width" href="<?php echo site_url("sales/sup_display_payment") ?>">Save</a>
				<button class="btn btn-link">Discard</button>
			</div>
			<!-- Form Container -->
			<div class="row myform-container">
				<div class="span8 offset1 myform box-shadow">
					<div class="span6">
						<form>
							<div class="row">
								<div class="span3">
									<label>Supplier</label>
									<select name="customer" id="customer_list">
										<option>Please Choose :</option>
										<?php foreach ($suppliers as $supplier_id => $supplier_name) { ?>
											<option
												value="<?php echo $supplier_id ?>"><?php echo $supplier_name ?></option>
										<?php } ?>
									</select>
									<label>Payment Amount</label>
									<input type="text" placeholder="00.00"/>
									<label>Payment Method</label>

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
								<div class="span3">
									<label>Date</label>
									<input type="text" id="datepicker"/>
									<label>Payment Reference</label>
									<input type="text" placeholder="003/10"/>
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
