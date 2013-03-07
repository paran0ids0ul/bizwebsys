<div class="container">
  <div class="row">
    <div class="span2">
		<?php echo $sidemenu ?>
    </div>
    
    
    <div class="span10 content">
		<div class="row">
			<h4 class="span3">sales orders</h4>
			<form class="form-search span4 pull-right">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-search"></i></span>
					<input class="span3" id="searchbox" type="text">
				</div>
				<button type="submit input-medium search-query" class="btn btn-primary">Search</button>
			</form>
		</div>	
      	<div class="row">
			<a href="<?php echo site_url("sales/new_order")?>" class="btn btn-primary span1">Create</a>
		</div>
		<div class="row content">
			<table class="table table-striped span10">
				<tr>
					<td><input type="checkbox"><td/>
					<td>Customer<td/>
					<td>Invoice Date<td/>
					<td>Internal Reference<td/>
					<td>Salesperson<td/>
					<td>Due Date<td/>
					<td>Outstanding<td/>
					<td>Total<td/>
				</tr>
			</table>
		</div>
    </div>
  </div>
</div>