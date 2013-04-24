<ul class="nav pull-right">
	<li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-user icon-white"></i> <?php echo $this->session->userdata('username'); ?><b class="caret"></b></a>
            <ul class="dropdown-menu" id="swatch-menu">
              <li><a href="<?php echo site_url('home/sign_out')?>">Sign out</a></li>
			  <li><a href="<?php echo site_url('change_password')?>">Change password</a></li>
            </ul>
    </li>
</ul>		  