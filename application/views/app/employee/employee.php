<div class="container">
  <div class="row">
  	<div class="span12 content contact-main">

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
		
	
			
		<div class="container contact-layout">
			<div class="content span12">
			<div class="row">
				<!--generate employee from database-->
				
				<?php foreach ($employees as $k => $employee): ?>
					<?php if (!is_array($employee)) continue; ?>
				
					<?php if ($x % 4 == 0): ?>
						<ul class="thumbnails">
					<?php endif; ?>


					<li class="span3">			
						<a href="<?php echo site_url("contacts/display_contact")?>" class="thumbnail contact-thumbnail">
							<div class="row" style="min-height:80px;">
								<div class="span1">
									<img src=<?php 
												$cname = $employee['cn'][0];
												$sr = ldap_search($ldap->getLdapConnection(),"ou=people,dc=bizwebsys,dc=tk", "cn=$cname");
												if ($sr) {
													$ei=ldap_first_entry($ldap->getLdapConnection(), $sr);
													if ($ei) {
														$pic = @ldap_get_values_len($ldap->getLdapConnection(), $ei, "jpegPhoto");
														if ($pic) {
															$mime = 'image/jpeg';
															$base64   = base64_encode($pic[0]); 
															print('"data:' . $mime . ';base64,' . $base64.'"');
														}
														else {
															echo base_url("resources/images/no_image.gif");
														}
													
													}
												}
												
												?> alt="Inventory">
								</div>
								<div class="span1">
									<div class="text contact-name"><?php echo $employee['cn'][0]?></div>
									<div class="text"><?php if (array_key_exists("mobile",$employee)) {
																	echo $employee["mobile"][0];
																}
														?>
									</div>
									<div class="text"><?php if (array_key_exists("mail",$employee)) {
																	echo $employee["mail"][0];
																}
														?>
									</div>
								</div>
							</div>
						</a>
					</li>
						
					<?php $x = $x+1; ?>


					<?php if ($x % 4 == 0 || $x == ($employees["count"])): ?>
						</ul>
					<?php endif; ?>
				
						
			
			
			
				<?php endforeach ?>
				
				
				
				
						
				
			</div>
			</div>
		</div>
	</div>
  </div>
</div>