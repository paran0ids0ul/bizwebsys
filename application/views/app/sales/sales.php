<div class="container">
  <div class="row">
    <div class="span2">
		<?php echo $sidemenu ?>
    </div>
    
    
    <div class="span10 content">
		<div class="row">
			<h4 class="span3">Sales Orders</h4>
			<!-- Search Bar -->
			<form class="form-search span4 pull-right">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-search"></i></span>
					<input class="span3" id="searchbox" type="text">
				</div>
				<!-- Button Create -->
				<button type="submit input-medium search-query" class="btn btn-primary">Search</button>
			</form>
		</div>	
      	<div class="row">
			<a href="<?php echo site_url("sales/new_order")?>" class="btn btn-primary span1">Create</a>
		</div>
		<!-- Orders Table -->
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
				<?php foreach ($orders as $order): ?>
			<tr>
					<td><input type="checkbox"><td/>
					<td><?php echo $order['cust_name'] ?></td>
					<td><?php echo $order['invoice_date'] ?></td>
					<td><?php echo $order['internal_ref'] ?></td>
					<td><?php echo $order['sales_person'] ?></td>
					<td><?php echo $order['due_date'] ?></td>
					<td><?php echo $order['outstanding'] ?></td>
					<td><?php echo $order['total'] ?></td>
				</tr>					
				<?php endforeach ?>

			</table>
		</div>
    </div>
  </div>
</div>