<section id="lawyer_signup_section">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1 class="title-header light_font">Practice Management</h1>
			<h2 class="second-title-header ">Manage your lawyers here</h2>
		</div>
	</div>
</section>
<div class="row text-right">
	<div class="col-md-12">
		<a class="btn btn-opp btn-small" href="<?php echo base_url(); ?>practice_management/billing">Go to Billing</a>
	</div>
</div>
<div class="container">
	<section id="section_signup_tabs">
		<div id="tabs_container">
		    <ul class="nav nav-tabs">
		        <li class="nav two-tabs active"><a href="#pending_lawyers" data-toggle="tab">Pending Lawyers</a></li>
		        <li class="nav two-tabs"><a href="#approved_lawyers" data-toggle="tab">Approved Lawyers</a></li>
		    </ul>
		</div>

    	<!-- Tab panes -->
	    <div class="tab-content">
	        <div class="tab-pane fade in active" id="pending_lawyers">
	    		<div>
	    			<h1>&nbsp;</h1>
	    		</div>
	    		<div class="col-md-12">
	    			<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
	    			<input type="hidden" name="p_id" id="p_id" value="<?php echo $p_id; ?>" />
		        	<table class="table table-bordered table-striped table-hover text-center">
						<thead>
							<td>Lawyer Name</td>
							<td>Action</td>
						</thead>
						<tbody class="pl_list">
							<?php 
							if(!empty($pending_lawyers)) {
								echo $pending_lawyers;
							} ?>
						</tbody>
					</table>
				</div>
	        </div>
	        <div class="tab-pane fade in" id="approved_lawyers">
	    		<div>
	    			<h1>&nbsp;</h1>
	    		</div>
	    		<div class="col-md-12">
		        	<table class="table table-bordered table-striped table-hover text-center">
						<thead>
							<td>Lawyer Name</td>
							<td>Action</td>
						</thead>
						<tbody class="al_list">
							<?php 
							if(!empty($approved_lawyers)) {
								echo $approved_lawyers;
							} ?>
						</tbody>
					</table>
				</div>
	        </div>
	    </div>
	</section>
</div>

<script>
	$(document).ready(function() {
		$(document).on("click", ".approve_lawyer", function(){
			if(confirm("Are you sure you want to approve this lawyer?")) {
				$.ajax({
					url: $("#base_url").val()+"practice_management/approve",
					data: "id="+$(this).attr("rel")+"&p_id="+$("#p_id").val(),
					dataType: "json",
					type: "post",
					success: function(response) {
						if(response.status) {
							$(".pl_list").html("");
							$(".al_list").html("");
							$(".pl_list").html(response.pendingList);
							$(".al_list").html(response.approveList);
							alert(response.msg);
						} else {
							alert(response.msg);
						}
					}
				});
			}
		});

		$(document).on("click", ".decline_lawyer", function(){
			if(confirm("Are you sure you want to decline this lawyer?")) {
				$.ajax({
					url: $("#base_url").val()+"practice_management/decline",
					data: "id="+$(this).attr("rel")+"&p_id="+$("#p_id").val(),
					dataType: "json",
					type: "post",
					success: function(response) {
						if(response.status) {
							$(".pl_list").html("");
							$(".al_list").html("");
							$(".pl_list").html(response.pendingList);
							$(".al_list").html(response.approveList);
							alert(response.msg);
						} else {
							alert(response.msg);
						}
					}
				});
			}
		});

		$(document).on("click", ".remove_lawyer", function(){
			if(confirm("Are you sure you want to remove this lawyer?")) {
				$.ajax({
					url: $("#base_url").val()+"practice_management/remove_lawyer",
					data: "id="+$(this).attr("rel")+"&p_id="+$("#p_id").val(),
					dataType: "json",
					type: "post",
					success: function(response) {
						if(response.status) {
							$(".pl_list").html("");
							$(".al_list").html("");
							$(".pl_list").html(response.pendingList);
							$(".al_list").html(response.approveList);
							alert(response.msg);
						} else {
							alert(response.msg);
						}
					}
				});
			}
		});
	});
</script>