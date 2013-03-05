<ul class="nav" >
	<li class=" active"><a class="<?php echo isActive($pageName,"home")?>" href="<?php echo site_url("panel/view/home");?>">Home</a></li>
	<li><a class="<?php echo isActive($pageName,"about")?>" href="<?php echo  site_url("panel/view/workspace");?>">Workspace</a></li>
	<li><a class="<?php echo isActive($pageName,"about")?>" href="<?php echo  site_url("panel/view/settings");?>">Settings</a></li>
</ul>