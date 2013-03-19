<div class="container">
	<?php echo $header ?>
	<div class="row">
		<!-- Left Column -->
		<div class="span5">
			<?php echo $left_column ?>
		</div>
		
		<!-- Content -->
		<div class="span7">
			<div class="row product-container" id="product_container">
				<div class="row">
					<div class="span7">
						<!-- Search Bar -->
						<form class="form-search span4 content">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-search"></i></span>
								<input class="span3" id="searchbox" type="text" placeholder="Search Product">
							</div>
							<button type="submit input-medium search-query" class="btn btn-primary">Search</button>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="span7 ">				
						<!-- Product Display Thumbnails -->
						<ul class="thumbnails">
						  <li>
							<a class="thumbnail" value="0.2" id="pdt1">
							  <span class="label label-info pull-right">£23</span>
							  <img src=<?php echo base_url("resources/images/icons128/sales_purchases.png")?> alt="">
							  <label class="text-center">Basket</label>
							</a>
						  </li>
						  <li>
							<a class="thumbnail" value="0.4" id="pdt2">
							  <span class="label label-info pull-right">£10</span>
							  <img src=<?php echo base_url("resources/images/icons128/sales_purchases.png")?> alt="">
							  <label class="text-center">Apple</label>
							</a>
						  </li>
						  <li>
							<a class="thumbnail" href="#">
							  <span class="label label-info pull-right">£23</span>
							  <img src=<?php echo base_url("resources/images/icons128/sales_purchases.png")?> alt="">
							  <label class="text-center">Basket</label>
							</a>
						  </li>						  
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>