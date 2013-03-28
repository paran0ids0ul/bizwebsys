<div class="container">
  <div class="row">
  	<div class="span12 content contact-main">

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
		
	
			
		<div class="container contact-layout">
			<div class="content span12">
			<div class="row">
			
			<?php foreach ($contacts as $k => $contact): ?>
				<?php if (!is_array($contact)) continue; ?>
				
				<?php if ($x % 4 == 1): ?>
					<ul class="thumbnails">
					
				<?php endif; ?>
				
				
				
					<li class="span3">					
					
						<a href="<?php echo site_url("contacts/display_contact")?>" class="thumbnail">
							<div class="row">
								<div class="span1">
									<img src=<?php 
													$cname = $contact['cn'][0];
													$sr = ldap_search($ldap->getLdapConnection(),"ou=contacts,dc=bizwebsys,dc=tk", "cn=$cname");
													if ($sr) {
														$ei=ldap_first_entry($ldap->getLdapConnection(), $sr);
														if ($ei) {
															$pic = ldap_get_values_len($ldap->getLdapConnection(), $ei, "jpegPhoto");
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
									<div class="text contact-name"><?php echo $contact['cn'][0]?></div>
									<div class="text contact-desc"><?php echo $contact["mobile"][0]?></div>
									<div class="text contact-email"><?php echo $contact["mail"][0]?></div>
								</div>
							</div>
						</a>
					</li>
			
				
				
				
				
				
				
				
				
				
				<?php if ($x % 4 == 1  || $x == ($contacts["count"]-1)): ?>
					</ul>
				<?php endif; ?>
				
				<?php $x = $x+1; ?>
			
			
			
			<?php endforeach ?>
			
			
			</div>
			</div>
		</div>
	</div>
  </div>
</div>