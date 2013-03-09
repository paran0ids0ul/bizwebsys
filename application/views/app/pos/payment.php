<div class="container">
	<?php echo $header ?>
	<div class="row">
		<!-- Left Column -->
		<div class="span5">
			<?php echo $left_column ?>
		</div>
		
		<!-- Content -->
		<div class="span7">
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
									<b>£2801.00</b>
								</div>
							</div>
							<div class="row">
								<div class="span2 offset1">
									<b>Cash (Pound):</b>
								</div>
								<div class="span2">
									<input type="text" placeholder="0.00" class="span1"/>
								</div>
							</div>
							<div class="row">
								<div class="span2 offset1">
									<label>Paid:</label>
								</div>
								<div class="span2">
									<label>£0.00</label>
								</div>
							</div>
							<div class="row">
								<div class="span2 offset1">
									<label>Remaining:</label>
								</div>
								<div class="span2">
									<label>£2801.00</label>
								</div>
							</div>
							<div class="row">
								<div class="span2 offset1">
									<label>Change:</label>
								</div>
								<div class="span2">
									<label>£0.00</label>
								</div>
							</div>	
						</form>
					</div>
			</div>
			<!-- Control Buttons -->
			<div class="row">
				<div class="span2">
					<a class="btn btn-block" href="<?php echo site_url("pos")?>">Back</a>
				</div>
				<div class="span2">
					<a class="btn btn-block disabled">Validate</a>
				</div>
			</div>
		</div>
	</div>	
</div>