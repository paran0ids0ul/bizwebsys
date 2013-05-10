<div class="container">
	<div class="row">
		<!-- Side Menu -->
		<div class="span2">
			<?php echo $sidemenu ?>
		</div>
		<!-- Content -->
		<div class="span10 content">
			<div class="row">
				<h4 class="span3">Invoices</h4>

				<form class="form-search span4 pull-right">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-search"></i></span>
						<input class="span3" id="searchbox" type="text">
					</div>
					<button type="submit input-medium search-query" class="btn btn-primary">Search</button>
				</form>
			</div>
			<!--Control Button-->
			<div class="row">
				<a href="<?php echo site_url("sales/new_invoice") ?>" class="btn btn-primary span1">Create</a>
			</div>
			<!--Sales Order Table-->
			<div class="row content">
				<form name="form1" action="" id="invoice_form">
					<table class="table table-striped span10">
						<thead>
						<tr href="#">
							<th><input type="checkbox" name="checkboxall" id="cust_invoice_all"></th>
							<th>Customer</th>
							<th>Invoice Date</th>
							<th>Internal Reference</th>
							<th>Salesperson</th>
							<th>Payment Deadline</th>
							<th>Total</th>
							<th>Paid</th>
							<th>Dispatched</th>
						</tr>
						</thead>
						<?php foreach ($salesorders as $salesorder): ?>
							<tr id="<?php echo $salesorder['SalesOrderID'] ?>">
								<td href="<?php echo site_url("sales/display_order_by_id/") . $salesorder['SalesOrderID'] ?>/">
									<input type="checkbox" class="checkboxs"
										   id=<?php echo $salesorder['SalesOrderID'] ?>></td>
								<td><?php echo (empty($salesorder['ContactID'])) ? '' : $contact_list[$salesorder['ContactID']] ?></td>
								<td><?php echo $salesorder['DateInvoiced'] ?></td>
								<td><?php echo $salesorder['Ref'] ?></td>
								<td><?php echo $employee_list[$salesorder['EmployeeID']]; ?></td>
								<td><?php echo $salesorder['DatePaymentDue'] ?></td>
								<td><?php echo $salesorder['Total'] ?></td>
								<td><?php echo (empty($salesorder['DatePaid'])) ? 'Outstanding' : $salesorder['DatePaid'] ?></td>
								<td><?php echo (empty($salesorder['DateDispatched'])) ? '<button class="dispatch">Dispatch</button>' : $salesorder['DateDispatched'] ?></td>
							</tr>
						<?php endforeach ?>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>