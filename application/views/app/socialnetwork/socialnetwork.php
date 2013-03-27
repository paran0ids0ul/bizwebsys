<div class="container">
	<div class="row">
		<div class="underlined span12">
			<h4 class="settings-header">Connecting to the Public</h4>
		</div>
	</div>
	<div class="span12"></br></div>
	<form>
		<div class="row">
			<img class="span4" src=<?php echo base_url("resources/images/connectingPeople.png")?> alt="Connecting People"> 
			<div class="span1 content">
				<label style="HEIGHT:30px">Status :</label>
			</div>
			<div class="span7 input-append">
				<input id="statusContext" type="text" style="width:90%"; placeholder="How is your day?" >
				<a id="button"  class="btn btn-primary">Post</button></a>
			</div>
			<div class="span8">
				<label class="checkbox" style="HEIGHT:30px"  value="Yes" >
					<input id="facebook" type="checkbox"> Post onto Facebook
				</label>
			</div>
			<div class="span8">
				<label class="checkbox" style="HEIGHT:30px"  value ="Yes">
					<input id="twitter"  type="checkbox"> Post onto Twitter
				</label>
			</div>
			<div class="span8">
				<label class="checkbox" style="HEIGHT:30px"  value ="Yes"> 
					<input id="googlePlus" type="checkbox"> Post onto Google+
				</label>
			</div>
			<div class="span8">
				<span class="input-xlarge uneditable-input" style="width:60%"; id="process"></span>				
			</div>
			
		</div>
	</form>
</div>
