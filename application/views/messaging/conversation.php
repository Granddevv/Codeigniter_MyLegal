<div class="row">
	<div class="header">
		<h2>Conversation Lists</h2>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-striped table-hover text-center">
			<thead>
				<td>Job Title</td>
				<td>Message</td>
				<td>Date</td>
			</thead>
			<tbody>
				<?php 
				if(!is_null($msg_list)) {
					foreach($msg_list as $msg) { ?>
						<tr>
							<td><?php echo $msg->job_title; ?></td>
							<td><?php echo $msg->message; ?></td>
							<td><?php echo $msg->created; ?></td>
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
<div class="row">
	<div class="header">
		<h2>Conversation with <?php // echo $client_name; ?> on <?php // echo $job_name; ?></h2>
		<!-- <a class="pull-right" href="#">Back to list</a> -->
	</div>
	<div class="col-xs-12">
		<div class="show_message" style="overflow-y:scroll; height:300px;">
			<?php foreach(range(0,0) as $convo) { ?>
				<div class="col-xs-12">
					<b>User Name</b>
					<p>This is a sample message</p>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12">
				<textarea class="form-control" rows="3" placeholder="Type your message here..."></textarea>
			</div>
			<div class="col-md-12 text-right">
				<br /> <button class="btn btn-success" style="" type="button">Send Message</button>
			</div>
		</div>
	</div>
	
</div>