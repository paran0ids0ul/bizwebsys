<script>

	var d = new Date();

	var month = d.getMonth() + 1;
	var day = d.getDate();

	var date = d.getFullYear() + '-' +
		(month < 10 ? '0' : '') + month + '-' +
		(day < 10 ? '0' : '') + day;

	$(document).ready(function () {

		// Button Dispatch
		$(".dispatch").on("click", function (event) {

			event.preventDefault();

			//once click change to text Loading....
			var parent = $(event.target).parent();
			parent.text('Loading...');

			//alert to confirm
			var dispatch = confirm("Dispatch Order?");
			if (dispatch === true) {

				//change the data in pispatch date in database
				$.ajax({
					dataType: "json",
					url: "<?php echo site_url('sales/dispatch_now/')?>/" + parent.parent().attr('id'),
					statusCode: {
						201: function () {
							parent.text(date);
						}
					}
				});
			}
		})
	});
</script>