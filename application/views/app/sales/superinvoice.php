<div class="container">
	<div class="row">
		<!-- Side Menu -->
		<div class="span2">
			<?php echo $sidemenu ?>
		</div>
		
		<!-- Content -->
		<div class="span10 content">
			<!-- Breadcrumb -->
			<ul class="breadcrumb">
				<li><a href="<?php echo site_url("sales") ?>">Sale Orders</a> <span class="divider">/</span></li>
				<li class="active"><?php echo $orderid?></li>
			</ul>
			<!-- Control Buttons -->
			<div class="row">
				<div class="span1">
					<button class="btn btn-primary">Edit</button>
				</div>	
				<div class="span1">
					<button class="btn btn-primary">Create</button>
				</div>	
				<div class="span1">
					<button class="btn btn-primary">Print</button>
				</div>
				<div class="span1">	
					<button class="btn btn-primary">Delete</button>
				</div>	
			</div>
			<!-- Form Headbar -->
			<div class="row content myform-headbar">
				<div class="span2">
					<a class="btn btn-small" href="#payinvoicemodal" data-toggle="modal">Register Payment</a>
				</div>
				<button class="btn btn-small">Send by email</button>
			</div>
			<!-- Form Container -->
			<div class="row myform-container">
				<div class="span8 offset1 myform box-shadow">
					<div class="span6">
						<h4>Sales Order <?php echo $orderid?></h4>
						<form>
							<div class="row">
								<div class="span3">
									Customer : <?php echo $customer?>
								</div>
								<div class="span3">
									Date : <?php echo $date?>
								</div>
							</div>
						</form>
					</div>
					<!-- Order Lines Table -->
					<table class="table table-striped">
					<caption>Invoice Lines</caption>
					    <tbody>
							<tr>
							  <td>...</td>
							</tr>
						  </tbody>
					</table>
					<div class="row">
					<div class="span5 ">
						<div class="row">
							<div class="span3">
								Payment Terms: 
							</div>
							<div class="span1">
								<?php echo $paymentterm?>
							</div>							
						</div>
						<div class="row">
							<div class="span3">
								Additional Information:
							</div>
							<div class="span1">
								<?php echo $additioninfo?>
							</div>
						</div>
					</div>
					<div class="span3 ">
						<div class="row">
							<div class="span2">
								Subtotal:
							</div>
							<div class="span1">
								0.00
							</div>							
						</div>
						<div class="row">
							<div class="span2">
								Tax:
							</div>
							<div class="span1">
								0.00
							</div>							
						</div>
						<hr>
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

<!-- Modal Pay Invoice-->
<div id="payinvoicemodal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="payinvoicelabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="payinvoicelabel">Pay Invoice</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="payinvoiceform">
		<div class="span2">
		Customer
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
		Paid Amount 
		<input type="text" />
		Payment Method
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
		<div class="span3 offset1">
		Date
		<input type="text" id="datepicker" />
		Payment Reference
		<input type="text"  />
	 
		</div>
	</form>
  </div>
  <div class="modal-footer ">
    <a button class="btn btn-primary" form="payinvoiceform" href="<?php echo site_url("sales/payedsuperinvoice") ?>">Pay</a>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>