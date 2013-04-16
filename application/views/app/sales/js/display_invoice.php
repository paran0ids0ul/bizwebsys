<script>
	var raw_item_list = <?php echo $item_list ?>;
	var item_list = new Array();
	for (var item in raw_item_list) {
		item_list[item.ItemID] = item;
	}

	$(document).ready(function () {

		var sales_order = new Array();

		$("#add").click(function () {
			addRow();
		});

		function sales_order_line(item_id, quantity) {
			this.item_id = item_id;
			this.quantity = quantity;
		}

		function addRow() {


			var product_order = new sales_order_line(0, 0);
			var tax = 0;
			var unitprice = 0;
			var amount = 0;


			var value = '<tr><td><select class="item_select"><option value="0">Please Choose:</option>';


			for (var item in item_list) {
				value += '<option value="' + item.ItemID + '">' + item.Name + '</option>';
			}

			value += '</select></td>';

			value += '<td><input type="text" class="quantity"/></td>';

			value += '<td class="tax">0</td>';

			value += '<td class="unitprice">0</td>';

			value += '<td class="amount">0</td></tr>';


			$("#sales_table tr:last").before(value);

			$('.item_select').on("change", function (event) {

				update_order_line($(event.target).parentsUntil('tr').parent());

			});


			$('.quantity').on("keyup", function (event) {

				update_order_line($(event.target).parentsUntil('tr').parent());

			});

			//              salesrow.addRow();
		}


		function update_order_line(row) {

			var item_id = row.find('.item_select').first().val();
			var quantity = row.find('.quantity').first().val();

			if (item_id !== 0) {

				var net_price = item_list[item_id].NetPrice;
				var VAT = item_list[item_id].VATRate;
				var discount_rate = item_list[item_id].DiscountRate;

				row.find('.tax').text(VAT * net_price * discount_rate);
				row.find('.unitprice').text(net_price * discount_rate);

				if ($.isNumeric(quantity) && quantity >= 0) {
					row.find('.amount').text(quantity * net_price * discount_rate);
				}

			}

		}


	});
</script>