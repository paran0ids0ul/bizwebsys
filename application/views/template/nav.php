<ul class="nav" >
	<li class="<?php echo isActive($pageName,"home")?>"><a  href="<?php echo site_url("panel/view/home");?>">Home</a></li>
	<li class="<?php echo isActive($pageName,"workspace")?>"><a  href="<?php echo  site_url("panel/view/workspace");?>">Workspace</a></li>
	<li class="<?php echo isActive($pageName,"settings")?>"><a  href="<?php echo  site_url("panel/view/settings");?>">Settings</a></li>
</ul>