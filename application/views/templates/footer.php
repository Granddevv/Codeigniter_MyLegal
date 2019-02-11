	</div> <!-- Closing .container -->
	<?php if($this->session->userdata("user_id")) { ?>
		<script>
			setTimeout(check_new_badge_msg, 2000);
			function check_new_badge_msg() {
				$.ajax({
					url: "<?php echo base_url(); ?>messaging/get_new_badge_message",
					data: 'id=<?php echo $this->session->userdata("user_id"); ?>',
					type: "post",
					dataType: "json",
					success: function(response) {
						$(".has_new_message").html("");
						if(response.count == 0) {
							$(".has_new_message").html("");
						} else {
							ur_conv_list = response.listing;
							for(var i in ur_conv_list) {
								$(".conv_badge_"+i).html(ur_conv_list[i]+" unread msg");
							}

							$(".has_new_message").html(response.count);
						}
					},
					complete: function(resposne) {
						setTimeout(check_new_badge_msg, 1000);
					}
				});
			}
		</script>
	<?php } ?>
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
			});
		});
	</script>

</body>
</html>