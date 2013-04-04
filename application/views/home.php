 <!-- Navbar -->
 <div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
     <div class="container">
       <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a>
       <a class="brand" href="../">BizWebSys</a>
       <div class="nav-collapse collapse" id="main-menu">
        <ul class="nav" id="main-menu-left">
          <li><a href="">About</a></li>
          <li><a href="">Contact</a></li>
        </ul>
        <ul class="nav pull-right" id="main-menu-right">
          <li><a href="#signin_modal" data-toggle="modal">Sign in</a></li>
          <li><a href="#register_modal" data-toggle="modal">Register</a></li>
        </ul>
       </div>
     </div>
   </div>
 </div>


<!-- Modal Sign In-->
<div id="signin_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="signin_label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="signin_label">Sign In</h3>
  </div>
  <div class="modal-body">
	<form class="form-horizontal" id="signin_form">
	<div class="text-center"><label class="label label-warning" id="errors"></label></div>
	  <div class="control-group">
		<label class="control-label" for="inputUsername">Username</label>
		<div class="controls">
		  <input type="text" id="inputUsername" placeholder="Username">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="inputPassword">Password</label>
		<div class="controls">
		  <input type="password" id="inputPassword" placeholder="Password">
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <a href="">Forgot password</a>
		</div>
	  </div>	  
	  <div class="control-group">
		<div class="controls">
		  <label class="checkbox">
			<input type="checkbox"> Remember me
		  </label>
		</div>
	  </div>
	</form>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" id="btn_signin">Sign In</button>
  </div>
</div>
 
 
 
<!-- Modal Register-->
<div id="register_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="register_label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="register_label">Register your company</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="register_form">
	  <div class="control-group">
		<label class="control-label" for="inputCompName">Company Name</label>
		<div class="controls">
		  <input type="text" id="inputCompName" placeholder="Company Name">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="inputStreet">Street</label>
		<div class="controls">
		  <input type="text" id="inputStreet" placeholder="Street">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="inputCity">City</label>
		<div class="controls">
		  <input type="text" id="inputCity" placeholder="City">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="inputZipcode">Zipcode</label>
		<div class="controls">
		  <input type="text" id="inputZipcode" placeholder="Zipcode">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="inputPhone">Phone</label>
		<div class="controls">
		  <input type="text" id="inputPhone" placeholder="Phone">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="inputUserId">User ID</label>
		<div class="controls">
		  <input type="text" id="inputUserId" placeholder="User ID">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="inputPassword">Password</label>
		<div class="controls">
		  <input type="text" id="inputPassword" placeholder="Password">
		</div>
	  </div>	  
	  <div class="control-group">
		<div class="controls">
		  <label class="checkbox">
			<input type="checkbox"> I agree on 
			<a href="">terms and conditions</a>
		  </label>
		</div>
	  </div>
	</form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" form="register_form">Register</button>
  </div>
</div>
 
 
 
 
<div class="container">



