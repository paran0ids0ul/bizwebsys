<div class="product-container" id="product_container">
	<div class="row">
		<div class="span7">
			<!-- Search Bar -->
			<form class="form-search span4 content" id="search" action="">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-search"></i></span>
					<input class="span3" id="searchbox" type="text" placeholder="Search Product or Submit GTIN">
				</div>
				<button type="submit button" class="btn btn-primary" disabled="true">Add</button>
			</form>
			<p><span id="search-feedback">Loading please wait...</span></p>

		</div>

	</div>
	<div class="row">
		<div class="span7 ">
			<!-- Product Display Thumbnails -->
			<ul class="thumbnails" id="product-list">


				<?php foreach ($items as $item): ?>
				<?php if ($item['Stock'] != 0): ?>
					<li>
						<a class="thumbnail" value="<?php echo $item['VATRate']?>" rel="<?php echo $item['DiscountRate']?>" stock="<?php echo $item['Stock']?>" id="<?php echo $item['ItemID']?>">
							<span class="label label-info pull-right">£<?php echo $item['NetPrice']?></span>
							<?php if ($item['DiscountRate'] < 1): ?>
								<span class="label label-warning pull-right">£<?php echo $item['NetPrice'] * $item['DiscountRate'] ?></span>
							<?php endif; ?>
							<img src=<?php
								 if ($item['Imagepath'] == null){
									 echo base_url("resources/images/no_image.gif");
								 } else {
									 echo base_url("resources/images/inventory/".$item['Imagepath']);
								 }
								 ?> alt="">
							<label class="text-center"><?php echo $item['Name']?></label>
						</a>
					</li>
				<?php endif; ?>	
				<?php endforeach ?>



			</ul>
		</div>
	</div>
</div>


