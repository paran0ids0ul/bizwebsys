			<div class="row product-container" id="form_container">
				<h3 class="text-center" >Receipt</h3>
					<!-- Form -->
					<div class="span5 offset1 myform box-shadow" id="receipt">
						<div class="row text-center">
							<label><?php echo $date?> <?php echo $time?> Order <?php echo $order_id?><label>
						</div>
						<div class="row">
							<div class="span4 offset1">
								<table class=".table" id="receiptItemList">
								</table>
								<hr/>	
								<table class=".table">
									<tr>
										<td class="span2">Subtotal:</td>
										<td class="span2">£<?php echo $subtotal?></td>
									</tr>
									<tr>
										<td class="span2">Tax:</td>
										<td class="span2">£<?php echo $tax?></td>
									</tr>
									<tr>
										<td class="span2"><b>Total:</b></td>
										<td class="span2"><b>£<?php echo $total?></b></td>
									</tr>
									<tr>
										<td class="span2">Cash:</td>
										<td class="span2">£<?php echo $cash?></td>
									</tr>
									<tr>
										<td class="span2">Change:</td>
										<td class="span2">£<?php echo $change?></td>
									</tr>
								</table>
							</div>
						</div>
						
					</div>
			</div>
			<!-- Control Buttons -->
			<div class="row">
				<div class="span2">
					<button class="btn btn-block" id="btn_print">Print</button>
				</div>
				<div class="span2">
					<button class="btn btn-block" id="btn_nextorder">Next Order</button>
				</div>
			</div>
	