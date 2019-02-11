	</div>
	<!-- I put it here for the meantime, Need to be put on footer afterwards -->
	<script>
		$(document).ready(function() {
			$(".main-sidebar").mouseover(function() {
				$(this).addClass("main-sidebar-bigger");
				$(".hide_label, #backdrop").show();
			});

			$(".main-sidebar").mouseleave(function() {
				$(this).removeClass("main-sidebar-bigger");
				$(".hide_label, #backdrop").hide();
			})

			// $("#smaller_sidebar, #bigger_sidebar").mouseover(function() {
			// 	$("#bigger_sidebar, #backdrop").show();
			// 	$("#smaller_sidebar").hide();
			// });

			// $("#smaller_sidebar, #bigger_sidebar").mouseleave(function() {
			// 	$("#bigger_sidebar, #backdrop").hide();
			// 	$("#smaller_sidebar").show();
			// });
		});
	</script>

</body>
</html>