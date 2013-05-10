<script>
	var raw_item_list = <?php echo $item_list ?>;
	var item_list;


	var order_lines = new Array();

	$(document).ready(function () {


		item_list = new Array();
		for (var i in raw_item_list) {
			item_list[raw_item_list[i].ItemID] = raw_item_list[i];
		}
		var sales_order = new Array();


//		var idate = document.getElementByName("item_date").value;
//		var paydue = document.getElementById("paydue").value;
//		var addtionalinfo = document.getElementById("addtionalinfo").value;
//		var deduction = document.getElementById("deduction").value;
//
//		var value = [idate, paydue, addtionalinfo, deduction ];

		function insert() {
			$DateDispatched.push(idate);

		}

		$("#add").click(function () {
			//add a new order
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


			var value = '<tr><td><select class="item_select"><option value="">Please Choose:</option>';


			for (var i in item_list) {
				value += '<option value="' + item_list[i].ItemID + '">' + item_list[i].Name + '</option>';
			}

			value += '</select></td>';

			value += '<td><input type="text" class="quantity"/></td>';

			value += '<td class="tax">0</td>';

			value += '<td class="unitprice">0</td>';

			value += '<td class="amount">0</td></tr>';

			// add a new row in the last
			$("#sales_table tr:last").before(value);

			//get select item
			$('.item_select').on("change", function (event) {

				update_order_line($(event.target).parentsUntil('tr').parent());

			});


			$('.quantity').on("keyup", function (event) {

				var item_id = $(event.target).parentsUntil('tr').parent().find('.item_select').first().val();
				var quantity = $(event.target).val();
				var row = $(event.target).parentsUntil('tr').parent();

				//when add item which was chosen in previous salesorder line
				if (false) {

					if (confirm(raw_item_list[item_id] + " already selected, amend quantity?")) {
						$(event.target).parentsUntil('table').find('tr').each(function (index, ele) {
							if (ele.find('.item_select').val() == item_id) {
								ele.find('.quantity').focus();
							}
						});
						row.remove();
					} else {
						$(event.target).val('');
					}

				} else {
					update_order_line($(event.target).parentsUntil('tr').parent());
					order_lines[item_id] = quantity;
				}


			});

		}

		//calculate unit price, unit tax, untaxed amount
		function update_order_line(row) {

			var item_id = row.find('.item_select').first().val();

			var quantity = row.find('.quantity').first().val();

			if (item_id !== 0) {

				var net_price = item_list[item_id].NetPrice;
				var VAT = item_list[item_id].VATRate;
				var discount_rate = item_list[item_id].DiscountRate;

				row.find('.tax').text((VAT * net_price * discount_rate).toFixed(2));
				row.find('.unitprice').text((net_price * discount_rate).toFixed(2));

				if ($.isNumeric(quantity) && quantity >= 0) {
					row.find('.amount').text((quantity * net_price * discount_rate).toFixed(2));
				}

			}

		}


	});
</script>