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
			<li><a href="<?php echo site_url("sales/sup_invoice") ?>">Supplier Invoice</a> <span class="divider">/</span></li>
			<li class="active">Internal Reference</li>
		</ul>
		<!-- Control Buttons -->
		<div class="row">
			<button class="btn btn-primary same-btn-width">Save</button>
			<button class="btn btn-link">Discard</button>
		</div>
		<!-- Form Headbar -->
		<div class="row content myform-headbar">
			<a href="#payinvoicemodal" data-toggle="modal" class="btn btn-small">Pay</a>
		</div>
		<!-- Form Container -->
		<div class="row myform-container">
			<div class="span8 offset1 myform box-shadow">
				<div class="span6">
					<h4>Invoice <?php echo $pinvoice['PurchaseInvoiceID']?></h4>
					<form>
						<div class="row">
							<div class="span3 ">
								<div class="row">
									<div class="span2">
										Supplier :
									</div>
									<div class="span1">
										<?php echo $supplier[$pinvoice['ContactID']]?>
									</div>							
								</div>
								<div class="row">
									<div class="span2">
										Suppiler No. :
									</div>
									<div class="span1">
										<?php echo $pinvoice['ContactID']?>
									</div>
								</div>
							</div>
							<div class="span3">
								<div class="row">
									<div class="span2">
										Invoice Date :
									</div>
									<div class="span1">
										<?php echo $pinvoice['DateInvoiced']?>
									</div>							
								</div>
								<div class="row">
									<div class="span2">
										Due Date :
									</div>
									<div class="span1">
										<?php echo $pinvoice['DatePaymentDue']?>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!-- Order Lines Table -->
				<table class="table table-striped">
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
						<?php
						$totals = array();
						$taxes = array();
						$gtotal = array();
						foreach ($items as $item):
							$total = $item['NetPrice'] * $item['Quantity'];
							$tax = $item['VAT'] * $total;
							$gtotal = $total + $tax ;
							$totals[] = $total;
							$taxes[] = $tax;
							$gtotals[] = $gtotal;
							?>
							<tr>
							  <td><?php echo $item['Name']?></td>
							  <td><?php echo $item['Description']?></td>
							  <td><?php echo $item['Quantity']?></td>
							  <td><?php echo $tax ?></td>
							  <td><?php echo $item['Cost']?></td>
							  <td><?php echo $total ?></td>
							</tr>
							 <?php endforeach ?>
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
								<?php echo array_sum($totals); ?>
							</div>							
						</div>
						<div class="row">
							<div class="span2">
								Taxes:
							</div>
							<div class="span1">
								<?php echo array_sum($taxes); ?>
							</div>							
						</div>
						<hr>
						<div class="row">
							<div class="span2">
								<b>Total:</b>
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
</div>

<!-- Modal Pay Invoice-->
<div id="payinvoicemodal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="payinvoicelabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="payinvoicelabel">Pay Invoice</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="payinvoiceform">
	  <div class="control-group">
		<label class="control-label" for="customer">Customer</label>
			<div class="controls">
				<div class="input-prepend">
					<div class="btn-group">
						<button class="btn dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
						<li><a tabindex="-1" href="#">cust1</a></li>
						<li><a tabindex="-1" href="#">cust2</a></li>
						</ul>
					</div>
					<input class="span2" id="cust" type="text" list="customers">
					<datalist id="customers">
					<option value="acust">
					<option value="bcust">
					<option value="ccust">
					<option value="dcust">
					<option value="ecust">
					</datalist>
				</div>
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
				<div class="input-prepend">
					<div class="btn-group">
						<button class="btn dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
						<li><a tabindex="-1" href="#">Visa</a></li>
						<li><a tabindex="-1" href="#">MasterCard</a></li>
						</ul>
					</div>
					<input class="span2" id="cust" type="text" list="paymethod">
						<datalist id="paymethod">
						<option value="apay">
						<option value="bpay">
						<option value="cpay">
						<option value="dpay">
						<option value="epay">
						</datalist>
				</div>
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
    <a button class="btn btn-primary" form="payinvoiceform" >Pay</a>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>