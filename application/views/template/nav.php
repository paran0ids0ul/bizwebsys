<ul class="nav" >
	<li class=" active"><a class="<?php echo isActive($pageName,"home")?>" href="<?php echo site_url("panel/view/home_panel");?>">Home</a></li>
	<li><a class="<?php echo isActive($pageName,"about")?>" href="<?php echo  site_url("panel/view/workspace_panel");?>">Workspace</a></li>
	<li><a class="<?php echo isActive($pageName,"about")?>" href="<?php echo  site_url("panel/view/settings_panel");?>">Settings</a></li>
</ul>