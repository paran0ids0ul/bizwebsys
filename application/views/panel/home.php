<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
      <ul class="nav nav-list">
			<li class="nav-header">Bulletin Board</li>
			<li class="active sub-header"><a href="#">Whole Company</a></li>
			<li class="sub-header"><a href="#">phpCode in here</a></li>    <!-- dynamic to get groups-->
			<li class="sub-header"><a href="#">Add Group</a></li>
			<li class="nav-header">Email</li>
			<li class="sub-header"><a href="#">Inbox</a></li>
			<li	class="sub-header"><a href="#">Todo</a></li> 
			<li class="nav-header">Calendar</li>
			<li	class="sub-header"><a href="#">Work</a></li>  
		</ul>
    </div>
    <div class="span10">
    
      	<div class="row">
		<!-- Bulletin Board -->
			<p class="nav-header content-header inline">Bulletin Board:Whole Company</p>             <!--  TODO:dynamic get group name -->
			<a class="btn btn-primary inline" href="<?php echo site_url("group");?>">Info</a>
			<pre class = "pre-scrollable" id="bulletin-board">Sample text here...</pre>
		</div>	
		<div class="row">
			<h5>Post Notice</h5> 
			<textarea class="span9"></textarea>
		    <button class="btn btn-primary" type="button">Post</button>
		</div>
    </div>
  </div>
</div>