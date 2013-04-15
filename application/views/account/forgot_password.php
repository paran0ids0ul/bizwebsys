 <!-- Navbar -->
 <div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
     <div class="container">
       <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a>
       <a class="brand" href="<?php echo site_url('');?>">BizWebSys</a>
       <div class="nav-collapse collapse" id="main-menu">
        <ul class="nav" id="main-menu-left">
          <li><a href="">About</a></li>
          <li><a href="">Contact</a></li>
        </ul>
       </div>
	   <div id="test"></div>
     </div>
   </div>
 </div>
 
<div class="container content"> 
	<h4>Confirm your identity to reset password</h4>
	<form class="form-horizontal myform-container">
	  
	  <div class="control-group">
		<label class="control-label" for="inputUsername">Work Email</label>
		<div class="controls">
		  <input type="text" id="field_email" placeholder="Username@bizwebsys.tk">
		  <label  class="label label-warning" id="errors"></label>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <a class="btn btn-primary" id="btn_continue">Continue</a>
		</div>
	  </div>
	</form>
</div>	