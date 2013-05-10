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
				<li class="active" id="reference"><?php echo $order['SalesOrderID']?></li>
				<span class="divider"> </span></li>
			</ul>
			<!-- Control Buttons -->
			<div class="row">
				<a class="btn btn-primary same-btn-width" href="<?php echo site_url("sales/new_invoice") ?>">Edit</a>
				<button class="btn btn-primary same-btn-width">Print</button>
				<button class="btn btn-primary same-btn-width">Delete</button>
			</div>
			<!-- Form Headbar -->
			<div class="row content myform-headbar">
				<?php if (empty($order['DatePaid'])) {
					?>
					<a class="btn btn-small" href="#payinvoicemodal" data-toggle="modal">Register Payment</a>
				<?php } ?>
			</div>
			<!-- Form Container -->
			<div class="row myform-container">
				<div class="span8 offset1 myform box-shadow">
					<div class="span6">
						<h4>Invoice <?php echo $order['SalesOrderID']?></h4>

						<form>
							<div class="row">
								<div class="span3">
									Customer :<?php echo $contact_list[$order['ContactID']]?>
								</div>
								<div class="span3">
									Invoiced Date : <?php echo $order['DateInvoiced']?>
								</div>
							</div>
							<div class="row">
								<div class="span6">
									Paid
									: <?php echo empty($order['DatePaid']) ? 'Pending' : $order['DatePaid'] . ' by ' . $order['PaymentMethod']; ?>
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
							<th>VAT</th>
							<th>Net Price</th>
							<th>Net Total</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$totals = array();
						$taxes = array();
						$gtotal = array();
						foreach ($items as $item):
							$total = $item['NetPrice'] * $item['Quantity'];
							$tax = $item['VAT'] * $total;
							$gtotal = $total + $tax - $order['Deduction'];
							$totals[] = $total;
							$taxes[] = $tax;
							$gtotals[] = $gtotal;
							?>
							<td><?php echo $item['Name']?>
							</td>
							<td><?php echo $item['Quantity']?>
							</td>
							<td><?php echo $tax ?>
							</td>
							<td><?php echo $item['NetPrice'] ?>
							</td>
							<td><?php echo $total ?>
							</td>
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
									<?php echo $order['DatePaymentDue']?>
								</div>
							</div>
							<div class="row">
								<div class="span3">
									Additional Information:
								</div>
								<div class="span1">
									<?php echo $order['Remarks']?>
								</div>
							</div>
						</div>
						<div class="span3 ">
							<div class="row">
								<div class="span2">
									Subtotal:
								</div>
								<div class="span1">
									<?php echo array_sum($totals); ?>
								</div>
							</div>
							<div class="row">
								<div class="span2">
									Tax:
								</div>
								<div class="span1">
									<?php echo array_sum($taxes); ?>
								</div>
							</div>
							<div class="row">
								<div class="span2">
									Deduction:
								</div>
								<div class="span1">
									-<?php echo $order['Deduction']?>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="span2">
									<b>Grand Total:</b>
								</div>
								<div class="span1">
									<b><?php echo array_sum($gtotals); ?></b>
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
		<form class="form-horizontal" id="payinvoiceform" method="post" action="">
			<div class="control-group">
				<label class="control-label" for="cust"> Customer :</label>

				<div class="controls">
					<input type="text" value="<?php echo $contact_list[$order['ContactID']] ?>"
						   disabled="true"/>
					<input type="hidden" name="orderid" value="<?php echo $order['SalesOrderID'] ?>"/>
				</div>
			</div>

			<div class="control-group">
				<div class="span3">
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
			</div>
			<div class="control-group">
				<label class="control-label" for="date">Date</label>

				<div class="controls">
					<input type="text" class="datepicker" name="date"/>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer ">
		<button class="btn btn-primary" form="payinvoiceform"
				href="<?php echo site_url("sales/view_invoice") ?>">Pay
		</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>