<div class="container">
  <div class="row">
	<!-- Side Menu -->
    <div class="span2">
		<?php echo $sidemenu ?>
    </div>

    
    <!-- Content -->
    <div class="span10 content">
		<div class="row">
			<h4 class="span3">Customer Invoices</h4>
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
			<form name="form1"  action="" id="cust_invoice_form">
			<table class="table table-striped span10">
				<tr>
					<td><input type="checkbox" name="checkboxall" id="cust_invoice_all"><td/>
					<td>Customer<td/>
					<td>Invoice Date<td/>
					<td>Internal Reference<td/>
					<td>Salesperson<td/>
					<td>Total<td/>
					<td>Status<td/>
				</tr>
				
				<?php foreach ($salesorders as $salesorder): ?>
					<td id="<?php echo $salesorder['SalesOrderID']?>" href="<?php echo site_url("sales/display_order_byID/")?>/"><input type="checkbox" class="checkboxs" id=<?php echo $salesorder['SalesOrderID'] ?>><td/>
					<td><?php echo $salesorder['CantactID'] ?><td/>
					<td><?php echo $salesorder['DateInvoiced'] ?><td/>
					<td><?php echo $salesorder['Ref'] ?><td/>
					<td><?php echo $salesorder['EmployeeID'] ?><td/>
					<td><?php echo $salesorder['DatePaymentDue'] ?><td/>
					<td><?php echo $salesorder['total'] ?><td/>
					<td><td/>
				</tr>
				<?php endforeach ?>
					<td><input type="checkbox" class="checkboxs"><td/>
					<td><td/>
					<td><td/>
					<td><td/>
					<td><td/>
					<td><td/>
					<td><td/>
					<td><td/>
			</table>
			</form>
		</div>
		
		
	</div>
  </div>
</div>