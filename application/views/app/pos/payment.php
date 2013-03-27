			<div class="row product-container" id="form_container">
				<h3 class="text-center">Payment</h3>
					<!-- Form -->
					<div class="span5 offset1 myform box-shadow">
						<form>
							<div class="row">
								<div class="span2 offset1">
									<b>Total:</b>
								</div>
								<div class="span2">
									<b>£<?php echo $total ?></b>
								</div>
							</div>
							<div class="row">
								<div class="span2 offset1">
									<b>Cash (Pound):</b>
								</div>
								<div class="span2">
									<input id="input_cash" type="text" placeholder="0.0" class="span1"/>
								</div>
							</div>
							<div class="row">
								<div class="span2 offset1">
									<label>Paid:</label>
								</div>
								<div class="span2">
									<label id="paid">£0.0</label>
								</div>
							</div>
							<div class="row">
								<div class="span2 offset1">
									<label>Remaining:</label>
								</div>
								<div class="span2">
									<label id="remain">£<?php echo $total ?></label>
								</div>
							</div>
							<div class="row">
								<div class="span2 offset1">
									<label>Change:</label>
								</div>
								<div class="span2">
									<label id="change">£0.0</label>
								</div>
							</div>	
						</form>
					</div>
			</div>
			<!-- Control Buttons -->
			<div class="row">
				<div class="span2">
					<button id="btn_back" class="btn btn-block">Back</button>
				</div>
				<div class="span2">
					<a id="btn_validate" class="btn btn-block" href="<?php echo site_url("pos/receipt")?>">Validate</a>
				</div>
			</div>
	