<script>
	var raw_item_list = <?php echo $item_list ?>;
	var item_list;


	var order_lines = new Array();

	$(document).ready(function () {


		item_list = new Array();
		for (var i in raw_item_list) {
			item_list[raw_item_list[i].ItemID] = raw_item_list[i];
		}
		var purchases_order = new Array();

	});
</script>