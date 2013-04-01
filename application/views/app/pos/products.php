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
						  <?php foreach ($items as $item): ?>
						  <li>
							<a class="thumbnail" value="<?php echo $item['VATRate']?>" rel="<?php echo $item['DiscountRate']?>" id="<?php echo $item['ItemID']?>">
							  <span class="label label-info pull-right">£<?php echo $item['NetPrice']?></span>
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
						  <?php endforeach ?>
						</ul>
					</div>
				</div>
			</div>


