<div class="row myform-container" id="left_column">
	<div class="span4">
		<!-- Shopping List -->
		<div class="row">	
			<div class="span4 myform">
				<ul class="item-list">
				</ul>
				<!-- Total Display -->
				<div class="row">
					<div class="span2 offset2">
						<hr/>
						<div class="row">
							<div class="span2 text-center">
								<b>Total: £</b><b id="total">0.0</b>
							</div>						
						</div>
						<div class="row">
							<div class="span2 text-center">
								<b>Taxes: £</b><b id="tax">0.0</b>
							</div>						
						</div>						
					</div>
				</div>	
			</div>	
		</div>	
		<!-- Keypad Buttons -->
		<div class="row keypad">
			<div class="span4">
				<div class="row">
					<div class="span1">
						<a class="btn btn-large" href="<?php echo site_url("pos/payment")?>">Cash</a>
					</div>
					<div class="span3">		
							<div class="row">
								<div class="span3">
									<button class="btn btn-large keypad-button">1</button>
									<button class="btn btn-large keypad-button">2</button>
									<button class="btn btn-large keypad-button">3</button>
									<button class="btn btn-large keypad-button-big btn-primary control" id="btn_qty">Qty</button>
								</div>
							</div>
							<div class="row">
								<div class="span3">
									<button class="btn btn-large keypad-button">4</button>
									<button class="btn btn-large keypad-button">5</button>
									<button class="btn btn-large keypad-button">6</button>
									<button class="btn btn-large keypad-button-big control" id="btn_disc">Disc</button>					
								</div>
							</div>
							<div class="row">
								<div class="span3">
									<button class="btn btn-large keypad-button">7</button>
									<button class="btn btn-large keypad-button">8</button>
									<button class="btn btn-large keypad-button">9</button>
									<button class="btn btn-large keypad-button-big control" id="btn_price">Price</button>									
								</div>
							</div>
							<div class="row">
								<div class="span3">
									<button class="btn btn-large keypad-button">+/-</button>
									<button class="btn btn-large keypad-button">0</button>
									<button class="btn btn-large keypad-button">.</button>
									<button class="btn btn-large keypad-button-big" id="btn_del">Del</button>									
								</div>
							</div>
					</div>
						
				</div>	
			</div>
		</div>
	</div>
</div>

