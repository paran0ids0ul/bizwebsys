<script>

	var d = new Date();

	var month = d.getMonth() + 1;
	var day = d.getDate();

	var date = d.getFullYear() + '-' +
		(month < 10 ? '0' : '') + month + '-' +
		(day < 10 ? '0' : '') + day;

	$(document).ready(function () {

		$(".dispatch").on("click", function (event) {

			var target = $(event.target);
			event.preventDefault();
			var dispatch = confirm("Dispatch Order?");
			if (dispatch === true) {
				target.parent().text('Loading...');
				$.ajax({
					dataType: "json",
					url: "<?php echo site_url('sales/dispatch_now/')?>/" + target.parentsUntil('tr').parent().attr('id'),
					statusCode: {
						201: function () {
							target.parent().text(date);
						}
					}
				});
			}

		})


	});
</script>