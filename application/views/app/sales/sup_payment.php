<div class="container">
  <div class="row">
    <div class="span2">
		<?php echo $sidemenu ?>
    </div>
    
    
    <div class="span10 content">
		<div class="row">
			<h4 class="span3">Supplier Payments</h4>
			<form class="form-search span4 pull-right">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-search"></i></span>
					<input class="span3" id="searchbox" type="text">
				</div>
				<button type="submit input-medium search-query" class="btn btn-primary">Search</button>
			</form>
		</div>	
      	<div class="row">
			<a href="<?php echo site_url("sales/sup_new_payment")?>" class="btn btn-primary span1">Create</a>
		</div>
		<div class="row content">
			<table class="table table-striped span10">
				<thead>
				<tr>
					<td><input type="checkbox" id="sup_payment_all"><td/>
					<td>Payment Date<td/>
					<td>Internal Reference<td/>
					<td>Supplier<td/>
					<td>Total<td/>
				</tr>
				</thead>

				<?php foreach ($purchase_invoices as $purchase_invoice): ?>
				<tr id="<?php echo $purchase_invoice['PurchaseInvoiceID'] ?>">
					<td href="<?php echo site_url("sales/display_cust_order_by_id/") . $purchase_invoice['PurchaseInvoiceID'] ?>/">
						<input type="checkbox" class="checkboxs"
							   id=<?php echo $salesorder['PurchaseInvoiceID'] ?>><td/>
					<td><?php echo $purchase_invoice['DatePaymentDue'] ?><td/>
					<td><?php echo $purchase_invoice['IntRef'] ?><td/>
					<td><?php echo $contact_list[$purchase_invoice['ContactID']]; ?><td/>
					<td><?php echo $purchase_invoice['Total'] ?><td/>
				</tr>
				<?php endforeach ?>
			</table>
		</div>
    </div>
  </div>
</div>