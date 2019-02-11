<div class="row">
	<div class="col-md-12">
		<div class="header">
			<h2>Gender Dropdown <a class="btn btn-primary pull-right" id="add_new_gender">Add New Gender</a></h2>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-striped table-hover text-center">
			<thead>
				<td>id</td>
				<td>Gender</td>
				<td>Action</td>
			</thead>
			<tbody class="gender_listing">
				<?php echo $gender_list; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="gender_add">
	<form id="gender_form">
		<input type="hidden" name="gen_id" id="gen_id" />
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title">Add New Gender</h5>
	                </div>
	                <div class="modal-body">
	                    <div class="form-group">
			                <label for="gender">Gender:</label>
			                <input type="text" name="gender" id="gender" class="form-control" />
			            </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary" id="save_gender"> <i class="fa fa-save"></i> Save</button>
	                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"> <i class="fa fa-time"></i> Cancel</button>
	                </div>
	        </div>
	    </div>
	</form>
</div>

<div class="modal fade" id="alert_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notification</h5>
            </div>
            <div class="modal-body">
                <p id="alert_message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"> <i class="fa fa-time"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function() {
	    $(document).on("click", "#add_new_gender", function() {
	    	$("#gender").val("");
	    	$("#gen_id").val("");
	    	$(".modal-title").html("");
	    	$(".modal-title").html("Add new Gender");
	      	$("#gender_add").modal("show");
	    });

	    $(document).on("click", "#save_gender", function() {
	    	$.ajax({
	    		url: "<?php echo base_url('dropdown_manager/save_gender'); ?>",
	    		data: $("#gender_form").serialize(),
	    		type: "post",
	    		dataType: "json",
	    		success: function(response) {
	    			if(response.status) {
	    				$(".gender_listing").html("");
	    				$(".gender_listing").html(response.listing);
	    				$("#gender_add").modal("hide");
	    			}
	    			show_alert(response.message);
	    		}
	    	});
	    });

	    $(document).on("click", ".update_this", function() {
	    	var id = $(this).attr("rel");
	    	$(".modal-title").html("");
	    	$(".modal-title").html("Update Gender");
	    	$.ajax({
	    		url: "<?php echo base_url('dropdown_manager/get_gender_info'); ?>",
	    		data: "id="+id,
	    		type: "post",
	    		dataType: "json",
	    		success: function(response) {
	    			if(response.status) {
	    				$("#gender").val("");
	    				$("#gender").val(response.gen_info.gender);
	    				$("#gen_id").val(response.gen_info.id);
	    				$("#gender_add").modal("show");
	    			} else {
	    				show_alert(response.message);
	    			}
	    		}
	    	});
	    });

	    $(document).on("click", ".del_this", function() {
	    	if(confirm("Are you sure you want to delete this data?")) {
		    	var id = $(this).attr("rel");
		    	$.ajax({
		    		url: "<?php echo base_url('dropdown_manager/delete_gender'); ?>",
		    		data: "id="+id,
		    		type: "post",
		    		dataType: "json",
		    		success: function(response) {
		    			if(response.status) {
		    				$(".gender_listing").html("");
	    					$(".gender_listing").html(response.listing);
		    			}

		    			show_alert(response.message);
		    		}
		    	});
		    }
	    });
	});

	function show_alert(msg) {
		$("#alert_modal").modal("show");
		$("#alert_message").html("");
		$("#alert_message").html(msg);
	}
</script>