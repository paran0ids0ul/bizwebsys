<ul class="nav" >
	<li class="<?php echo isActive($pageName,"home")?>"><a href="<?php echo site_url('');?>">Home</a></li>
	<li class="<?php echo isActive($pageName,"workspace")?>"><a href="<?php echo site_url("workspace");?>">Workspace</a></li>
	<li class="<?php echo isActive($pageName,"settings")?>"><a href="<?php echo site_url("settings");?>">Settings</a></li>
</ul>