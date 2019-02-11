<div class="row">
	<div class="col-md-12">
		<div class="header">
			<h2>Ethnicity Dropdown <a class="btn btn-primary pull-right" id="add_new_ethnicity">Add New Ethnicity</a></h2>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-striped table-hover text-center">
			<thead>
				<td>id</td>
				<td>Ethnicity</td>
				<td>Action</td>
			</thead>
			<tbody class="ethnicity_listing">
				<?php echo $ethnicity_list; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="ethnicity_add">
	<form id="ethnicity_form">
		<input type="hidden" name="eth_id" id="eth_id" />
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title">Add New Ethnicity</h5>
	                </div>
	                <div class="modal-body">
	                    <div class="form-group">
			                <label for="ethnicity">Ethnicity:</label>
			                <input type="text" name="ethnicity" id="ethnicity" class="form-control" />
			            </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary" id="save_ethnicity"> <i class="fa fa-save"></i> Save</button>
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
	    $(document).on("click", "#add_new_ethnicity", function() {
	    	$("#ethnicity").val("");
	    	$("#eth_id").val("");
	    	$(".modal-title").html("");
	    	$(".modal-title").html("Add new Ethnicity");
	      	$("#ethnicity_add").modal("show");
	    });

	    $(document).on("click", "#save_ethnicity", function() {
	    	$.ajax({
	    		url: "<?php echo base_url('dropdown_manager/save_ethnicity'); ?>",
	    		data: $("#ethnicity_form").serialize(),
	    		type: "post",
	    		dataType: "json",
	    		success: function(response) {
	    			if(response.status) {
	    				$(".ethnicity_listing").html("");
	    				$(".ethnicity_listing").html(response.listing);
	    				$("#ethnicity_add").modal("hide");
	    			}
	    			show_alert(response.message);
	    		}
	    	});
	    });

	    $(document).on("click", ".update_this", function() {
	    	var id = $(this).attr("rel");
	    	$(".modal-title").html("");
	    	$(".modal-title").html("Update Ethnicity");
	    	$.ajax({
	    		url: "<?php echo base_url('dropdown_manager/get_ethnicity_info'); ?>",
	    		data: "id="+id,
	    		type: "post",
	    		dataType: "json",
	    		success: function(response) {
	    			if(response.status) {
	    				$("#ethnicity").val("");
	    				$("#ethnicity").val(response.eth_info.ethnicity);
	    				$("#eth_id").val(response.eth_info.id);
	    				$("#ethnicity_add").modal("show");
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
		    		url: "<?php echo base_url('dropdown_manager/delete_ethnicity'); ?>",
		    		data: "id="+id,
		    		type: "post",
		    		dataType: "json",
		    		success: function(response) {
		    			if(response.status) {
		    				$(".ethnicity_listing").html("");
	    					$(".ethnicity_listing").html(response.listing);
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