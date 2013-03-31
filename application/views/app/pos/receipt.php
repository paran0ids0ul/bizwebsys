			<div class="row product-container" id="form_container">
				<h3 class="text-center" >Receipt</h3>
					<!-- Form -->
					<div class="span5 offset1 myform box-shadow">
						<form id="receipt">
							<div class="row text-center">
								<label><?php echo $date?> <?php echo $time?> Order <?php echo $order_id?><label>
							</div>
							<div id="receiptItemList"></div>
							
							<hr/>	
							<div class="row">
								<div class="span2 offset1">
									<label>Subtotal:</label>
								</div>
								<div class="span2">
									<label>£<?php echo $subtotal?></label>
								</div>
							</div>
							<div class="row">
								<div class="span2 offset1">
									<label>Tax:</label>
								</div>
								<div class="span2">
									<label>£<?php echo $tax?></label>
								</div>
							</div>
							<hr/>
							<div class="row">
								<div class="span2 offset1">
									<b>Total:</b>
								</div>
								<div class="span2">
									<b>£<?php echo $total?></b>
								</div>
							</div>
							<div class="row">
								<div class="span2 offset1">
									<label>Cash:</label>
								</div>
								<div class="span2">
									<label>£<?php echo $cash?></label>
								</div>
							</div>	
							<div class="row">
								<div class="span2 offset1">
									<label>Change:</label>
								</div>
								<div class="span2">
									<label>£<?php echo $change?></label>
								</div>
							</div>	
						</form>
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
	