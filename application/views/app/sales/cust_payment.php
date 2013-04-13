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
			<table class="table table-striped span10">
				<tr>
					<td><input type="checkbox" id="cust_payment_all"><td/>
					<td>Payment Date<td/>
					<td>Internal Reference<td/>
					<td>Customer<td/>
					<td>Total<td/>
				</tr>
                <?php foreach ($purchaseinvoices as $purchaseinvoice): ?>
                <tr>
					<td id="<?php echo $purchaseinvoice['PurchaseInvoiceID']?>" href="<?php echo site_url("sales/display_cust_order_by_id/") . $purchaseinvoice['PurchaseInvoiceID'] ?>/"><input type="checkbox" class="checkboxs" id=<?php echo $purchaseinvoice['PurchaseInvoiceID'] ?>><td/>
					<td><?php echo[$purchaseinvoice['DatePaymentDue']] ?><td/>
					<td><?php echo $purchaseinvoice['IntRef'] ?><td/>
					<td><?php echo $contact_list[$purchaseinvoice['ContactID']]; ?><td/>
					<td><td/>
                </tr>
                <?php endforeach ?>
			</table>
		</div>
    </div>
  </div>
</div>