<div class="container">
  <div class="row">
  	<div class="span12 content">

	  	<div class="row">
			<h4 class="span3">Contacts</h4>
			<form class="form-search span4 pull-right">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-search"></i></span>
					<input class="span3" id="searchbox" type="text">
				</div>
				<button type="submit input-medium search-query" class="btn btn-primary">Search</button>
			</form>
		</div>	
		<div class="row">
			<a href="<?php echo site_url("contacts/new_contact")?>" class="btn btn-primary span1">Create</a>
			<div class="btn-group span1">
				<a class="btn dropdown-toggle btn-primary" data-toggle="dropdown" href="#">Filter<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="">Customer</a></li>
					<li><a href="">Partners</a></li>
    			</ul>
    		</div>
		</div>
		
	
			<!--generate contacts from database-->
		<div class="container contact-layout myform-container">
			<div class="content span12">
			<div class="row">
				<ul class="thumbnails">
					<li class="span3">					
						<a href="<?php echo site_url("inventory");?>" class="thumbnail">
							<div class="row">
								<div class="span1">
									<img src=<?php echo base_url("resources/images/icons128/inventory.png")?> alt="Inventory">
								</div>
								<div class="span1">
									<div class="text contact-name">Name</div>
									<div class="text contact-desc">Description</div>
									<div class="text contact-email">Email</div>
								</div>
							</div>
						</a>
					</li>
					<li class="span3">					
						<a href="<?php echo site_url("inventory");?>" class="thumbnail">
							<div class="row">
								<div class="span1">
									<img src=<?php echo base_url("resources/images/icons128/inventory.png")?> alt="Inventory">
								</div>
								<div class="span1">
									<div class="text contact-name">Name</div>
									<div class="text contact-desc">Description</div>
									<div class="text contact-email">Email</div>
								</div>
							</div>
						</a>
					</li>
					<li class="span3">					
						<a href="<?php echo site_url("inventory");?>" class="thumbnail">
							<div class="row">
								<div class="span1">
									<img src=<?php echo base_url("resources/images/icons128/inventory.png")?> alt="Inventory">
								</div>
								<div class="span1">
									<div class="text contact-name">Name</div>
									<div class="text contact-desc">Description</div>
									<div class="text contact-email">Email</div>
								</div>
							</div>
						</a>
					</li>
					<li class="span3">					
						<a href="<?php echo site_url("inventory");?>" class="thumbnail">
							<div class="row">
								<div class="span1">
									<img src=<?php echo base_url("resources/images/icons128/inventory.png")?> alt="Inventory">
								</div>
								<div class="span1">
									<div class="text contact-name">Name</div>
									<div class="text contact-desc">Description</div>
									<div class="text contact-email">Email</div>
								</div>
							</div>
						</a>
					</li>     
				</ul>
			</div>
			</div>
		</div>
	</div>
  </div>
</div>