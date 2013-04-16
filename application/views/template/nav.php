<ul class="nav" >
	<li class="<?php echo isActive($pageName,"workspace")?>"><a href="<?php echo site_url("workspace");?>">Workspace</a></li>
	<?php if($this->session->userdata('is_admin')): ?>
	<li class="<?php echo isActive($pageName,"settings")?>"><a href="<?php echo site_url("settings");?>">Settings</a></li>
	<?php endif; ?>
</ul>