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
					<th><input type="checkbox" id="sup_payment_all"></th>
					<th>Payment Date</th>
					<th>Internal Reference</th>
					<th>Supplier</th>
					<th>Total</th>
				</tr>
				</thead>

				<?php foreach ($purchaseinvoices as $purchaseinvoice): ?>
				<tr id="<?php echo $purchaseinvoice['PurchaseInvoiceID'] ?>">
					<td href="<?php echo site_url("sales/display_cust_order_by_id/") . $purchaseinvoice['PurchaseInvoiceID'] ?>/">
						<input type="checkbox" class="checkboxs"
							   id=<?php echo $purchaseinvoice['PurchaseInvoiceID'] ?>></td>
					<td><?php echo $purchaseinvoice['DatePaymentDue'] ?></td>
					<td><?php echo $purchaseinvoice['IntRef'] ?></td>
					<td><?php echo $contact_list[$purchaseinvoice['ContactID']]; ?></td>
<!--					<td>--><?php //echo $purchaseinvoice['Total'] ?><!--<td/>-->
				</tr>
				<?php endforeach ?>
			</table>
		</div>
    </div>
  </div>
</div>