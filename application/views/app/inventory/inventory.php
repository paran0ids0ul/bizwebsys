<div class="container">
	<div class"row">
		<div class="span12 content">
			<div class="row">
				<h4 class="span3">Inventory</h4>
				<form class="form-search span4 pull-right">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-search"></i></span>
						<input class="span3" id="searchbox" type="text">
					</div>
					<button type="submit input-medium search-query" class="btn btn-primary">Search</button>							</form>
			</div>	
			<div class="row">
				<a href="<?php echo site_url("inventory/new_item")?>" class="btn btn-primary span1">Create</a>
			</div>
			<div class="row content">
				<table class="table table-striped span12">
					<tr>
						<td><input type="checkbox"><td/>
						<td>Internal Reference<td/>
						<td>Name<td/>
						<td>Category<td/>
						<td>Quantity<td/>
						<td>Sale Price<td/>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>