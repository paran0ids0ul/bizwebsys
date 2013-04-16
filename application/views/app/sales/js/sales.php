<script>

	var d = new Date();

	var month = d.getMonth() + 1;
	var day = d.getDate();

	var date = d.getFullYear() + '-' +
		(month < 10 ? '0' : '') + month + '-' +
		(day < 10 ? '0' : '') + day;

	$(document).ready(function () {

		$(".dispatch").on("click", function (event) {

			event.preventDefault();

			var parent = $(event.target).parent();
			parent.text('Loading...');

			var dispatch = confirm("Dispatch Order?");
			if (dispatch === true) {

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