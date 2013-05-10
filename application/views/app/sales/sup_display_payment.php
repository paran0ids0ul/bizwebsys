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
				<li><a href="<?php echo site_url("sales/sup_payment") ?>">Supplier Payment</a> <span
						class="divider">/</span></li>
				<li class="active"><?php echo $orderid?></li>
			</ul>
			<!-- Control Buttons -->
			<div class="row">
				<button class="btn btn-primary same-btn-width">Save</button>
				<button class="btn btn-link">Discard</button>
			</div>
			<!-- Form Container -->
			<div class="row myform-container">
				<div class="span8 offset1 myform box-shadow">
					<div class="span7">
						<h4><?php echo $orderid?></h4>

						<form>
							<div class="row">
								<div class="span3 ">
									<div class="row">
										<div class="span2">
											Supplier :
										</div>
										<div class="span1">
											<?php echo $supplier?>
										</div>
									</div>
									<div class="row">
										<div class="span2">
											Paid Amount :
										</div>
										<div class="span1">
											<?php echo $paidamount?>
										</div>
									</div>
									<div class="row">
										<div class="span2">
											Payment Method :
										</div>
										<div class="span1">
											<?php echo $paidmethod?>
										</div>
									</div>
								</div>
								<div class="span3 offset1">
									<div class="row">
										<div class="span2">
											Date :
										</div>
										<div class="span1">
											<?php echo $date?>
										</div>
									</div>
									<div class="row">
										<div class="span2">
											Payment Reference :
										</div>
										<div class="span1">
											<?php echo $paymentref?>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<!-- Order Lines Table -->
					<table class="table table-striped">
						<caption>Payment Information</caption>
						<thead>
						<tr>
							<th>Date</th>
							<th>Due Date</th>
							<th>Original Amount</th>
							<th>Allocation</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>...</td>
							<td>...</td>
							<td>...</td>
							<td>...</td>
						</tr>
						<tr>
							<td>...</td>
							<td>...</td>
							<td>...</td>
							<td>...</td>
						</tr>
						</tbody>
					</table>
					<!-- Total Display -->
					<div class="row">
						<div class="span3 offset6">
							<div class="row">
								<div class="span1">
									<b>00.00</b>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

