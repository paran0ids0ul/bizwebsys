<div class="container">
  <div class="row">
  	<div class="span12 content employee-main">

	  	<div class="row">
			<h4 class="span3">Employees</h4>
			<form class="form-search span4 pull-right">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-search"></i></span>
					<input class="span3" id="searchbox" type="text">
				</div>
				<button type="submit input-medium search-query" class="btn btn-primary">Search</button>

			</form>
		</div>	
		<div class="row">
			<a href="<?php echo site_url("employee/new_employee")?>" class="btn btn-primary span1">Create</a>
		</div>
		
	
			
		<div class="container employee-layout">
			<div class="content span12">
			<div class="row">
				<!--generate employee from database-->
				<ul class="thumbnails">
					<li class="span4">					
						<a href="<?php echo site_url("employee/display_employee")?>" class="thumbnail">
							<div class="row">
								<div class="span2">
									<img src=<?php echo base_url("resources/images/icons128/employees.png")?> alt="Inventory">
								</div>
								<div class="span1">
									<div class="text employee-name">Name</div>
									<div class="text employee-position">Position</div>
									<div class="text employee-email">Email</div>
								</div>
							</div>
						</a>
					</li>
					<li class="span4">					
						<a href="<?php echo site_url("employee/display_employee")?>" class="thumbnail">
							<div class="row">
								<div class="span2">
									<img src=<?php echo base_url("resources/images/icons128/employees.png")?> alt="Inventory">
								</div>
								<div class="span1">
									<div class="text employee-name">Name</div>
									<div class="text employee-position">Position</div>
									<div class="text employee-email">Email</div>
								</div>
							</div>
						</a>
					</li>
					<li class="span4">					
						<a href="<?php echo site_url("employee/display_employee")?>" class="thumbnail">
							<div class="row">
								<div class="span2">
									<img src=<?php echo base_url("resources/images/icons128/employees.png")?> alt="Inventory">
								</div>
								<div class="span1">
									<div class="text employee-name">Name</div>
									<div class="text employee-position">Position</div>
									<div class="text employee-email">Email</div>
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