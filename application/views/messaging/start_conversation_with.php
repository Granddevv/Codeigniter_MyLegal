<div class="row">
	<div class="header">
		<h2>Start Conversation with</h2>
	</div>
	<div class="col-md-12">
		<form method="post">
			<select name="user">
				<?php foreach($user_list as $user) { ?>
					<option value="<?php echo $user->id; ?>"><?php echo $user->first_name." ".$user->last_name; ?></option>
				<?php } ?>
			</select>
			<select name="job">
				<?php foreach($job_list as $job) { ?>
					<option value="<?php echo $job->id; ?>"><?php echo $job->title; ?></option>
				<?php } ?>
			</select>
			<input type="Submit" value="Start chat" />
		</form>
	</div>
</div>