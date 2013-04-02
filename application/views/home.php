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
	<div class="text-center"><?php echo validation_errors(); ?></div>
	<?php $attributes = array('class' => 'form-horizontal', 'id' => 'signin_form');
		   echo form_open('home/sign_in', $attributes); ?>
	  <div class="control-group">
		<label class="control-label" for="inputEmail">Email</label>
		<div class="controls">
		  <input type="text" id="inputEmail" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="inputPassword">Password</label>
		<div class="controls">
		  <input type="password" id="inputPassword" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>">
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
    <button class="btn btn-primary" type="submit" form="signin_form">Sign In</button>
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

<div id="myCarousel" class="carousel slide">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <!-- Carousel items -->
  <div class="carousel-inner">
    <div class="active item homeCarousel"><img src="resources/images/carousel_1.jpg" width="800" height="600" align="middle" alt="bizpic"></div>
    <div class="item homeCarousel"><img src="resources/images/carousel_2.jpg" width="800" height="600" align="middle" alt="bizpic"></div>
    <div class="item homeCarousel"><img src="resources/images/carousel_3.jpg" width="800" height="600" align="middle" alt="bizpic"></div>
  </div>
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>


