<div class="container">
  <div class="row">
    <div class="span2">
		<?php echo $sidemenu ?>
    </div>
    
    
    <div class="span10 content">
		<div class="row">
			<h4 class="span3">Customer Payments</h4>
			<form class="form-search span4 pull-right">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-search"></i></span>
					<input class="span3" id="searchbox" type="text">
				</div>
				<button type="submit input-medium search-query" class="btn btn-primary">Search</button>
			</form>
		</div>	
      	<div class="row">
			<a href="<?php echo site_url("sales/new_payment")?>" class="btn btn-primary span1">Create</a>
		</div>
		<div class="row content">
			<form name="form1" action="" id="cust_payment_form">
			<table class="table table-striped span10">
				<thead>
				<tr>
					<th><input type="checkbox" id="cust_payment_all"></th>
					<th>Payment Date</th>
					<th>Internal Reference</th>
					<th>Customer</th>
					<th>Total</th>
				</tr>
				</thead>
                <?php foreach ($salesorders as $salesorder): ?>
                <tr id="<?php echo $salesorder['SalesOrderID']?>">
					<td  href="<?php echo site_url("sales/display_order_by_id/") . $salesorder['SalesOrderID'] ?>/"><input type="checkbox" class="checkboxs" id=<?php echo $salesorder['SalesOrderID'] ?>></td>
					<td><?php echo $salesorder['DatePaymentDue'] ?></td>
					<td><?php echo $salesorder['Ref'] ?></td>
					<td><?php echo $contact_list[$salesorder['ContactID']]; ?></td>
					<td><?php echo $salesorder['Total'] ?></td>
                </tr>
                <?php endforeach ?>
			</table>
				</form>
		</div>
    </div>
  </div>
</div>