<div class="row">
	<div class="header">
		<h2>Conversation Lists</h2>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-hover text-center">
			<thead>
				<td>Conversation With</td>
				<td>Date</td>
			</thead>
			<tbody>
				<?php 
				if(!is_null($msg_list)) {
					foreach($msg_list as $msg) {
						$unread_count = $this->messaging->count_unread_message($msg->conversation_id, $loggedUser);
						if($msg->user_to == $loggedUser) {
							$user = $msg->user_from;
							$to_name = $msg->uf_name;
						} else {
							$user = $msg->user_to;
							$to_name = $msg->ut_name;
						} ?>
						<tr style="cursor:pointer;" onclick="window.location = '<?php echo base_url()."send_message/".$user."/".$msg->job_id."/".$msg->conversation_id; ?>'">
							<td><?php echo $to_name." (".$msg->title.")"; ?>
								<?php if($unread_count > 0) { ?>
									- <span class="badge" style="background-color: #DC3545"><?php echo $unread_count; ?> New Message/s</span>
								<?php } ?>
							</td>
							<td><?php echo date("M d Y", strtotime($msg->created)); ?></td>
						</tr>
				<?php 
					}
				} else { ?>
					<tr>
						<td colspan="3">No messages</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>