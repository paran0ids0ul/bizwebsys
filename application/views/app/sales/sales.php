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
		<div class="row">
			<a href="<?php echo site_url("sales/display_invoice")?>" class="btn btn-primary span1">Create</a>
		</div>
		<div class="row content">
			<form name="form1"  action="" id="invoice_form">
			<table class="table table-striped span10">
			<thead>
				<tr  href="#">
					<td><input type="checkbox" name="checkboxall" id="cust_invoice_all"></td>
					<td>Customer</td>
					<td>Invoice Date</td>
					<td>Internal Reference</td>
					<td>Salesperson</td>
                    <td>Payment Deadline</td>
					<td>Total</td>
					<td>Paid</td>
                    <td>Dispatched</td>
				</tr>
			</thead>
				
				<?php foreach ($salesorders as $salesorder): ?>
				<tr>
					<td id="<?php echo $salesorder['SalesOrderID']?>" href="<?php echo site_url("sales/display_order_by_id/") . $salesorder['SalesOrderID'] ?>/"><input type="checkbox" class="checkboxs" id=<?php echo $salesorder['SalesOrderID'] ?>></td>
					<td><?php echo $contact_list[$salesorder['ContactID']]; ?></td>
					<td><?php echo $salesorder['DateInvoiced'] ?></td>
					<td><?php echo $salesorder['Ref'] ?></td>
					<td><?php echo $employee_list[$salesorder['EmployeeID']]; ?></td>
					<td><?php echo $salesorder['DatePaymentDue'] ?></td>
					<td><?php echo $salesorder['Total'] ?></td>
					<td><?php echo (empty($salesorder['DatePaid'])) ? 'Outstanding' : $salesorder['DatePaid'] ?></td>
                    <td><?php echo (empty($salesorder['DateDispatched'])) ? 'Outstanding' : $salesorder['DateDispatched'] ?></td>
				</tr>
				<?php endforeach ?>
				
			</table>
			</form>
		</div>
		
		
	</div>
  </div>
</div>