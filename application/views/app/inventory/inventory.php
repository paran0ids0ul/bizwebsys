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
					<button type="submit input-medium search-query" class="btn btn-primary">Search</button>	
										
				</form>
			</div>	
			<div class="row">
				<a href="<?php echo site_url("inventory/new_item")?>" class="btn btn-primary span1 same-btn-width">Create</a>
				<button class="btn btn-primary span1 same-btn-width" id="print_button">Print</button>
				<button class="btn btn-primary span1 same-btn-width" id="delete_button">Delete</button>
				
			</div>
			<div class="row content">
				<table class="table table-striped span12">
					<tr>
						<th><input type="checkbox"></th>
						<th>SKU</th>
						<th>Name</th>
						<th>Category</th>
						<th>Stock</th>
						<th>Cost Price</th>
						<th>Net Price</th>
					</tr>
					<?php foreach ($items as $item): ?>
					<tr>
						<td><input class="checked_item" id=<?php echo $item['ItemID'] ?> type="checkbox"></td>
						<td><?php echo $item['SKU'] ?></td>
						<td><?php echo $item['Name'] ?></td>
						<td><?php echo $item['Description'] ?></td> <!-- to be changed to category, after field in database is added -->
						<td><?php echo $item['Stock'] ?></td>
						<td><?php echo $item['Cost'] ?></td>
						<td><?php echo $item['NetPrice'] ?></td>
					</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
</div>