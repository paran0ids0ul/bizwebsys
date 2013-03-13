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
				<li class="active"><?php echo $orderid?></li>
			</ul>
			<!-- Control Buttons -->
			<div class="row">
				<button class="btn btn-primary same-btn-width">Create</button>
				<button class="btn btn-primary same-btn-width">Edit</button>
				<button class="btn btn-primary same-btn-width">Print</button>
				<button class="btn btn-primary same-btn-width">Delete</button>
			</div>
			<!-- Form Headbar -->
			<div class="row content myform-headbar">
				<button class="btn btn-small">Send by email</button>
			</div>
			<!-- Form Container -->
			<div class="row myform-container">
				<div class="span8 offset1 myform box-shadow">
					<div class="span6">
						<h4>Invoice <?php echo $orderid?></h4>
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

