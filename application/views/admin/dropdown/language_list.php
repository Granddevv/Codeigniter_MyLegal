<div class="row">
	<div class="col-md-12">
		<div class="header">
			<h2>Language Dropdown <a class="btn btn-primary pull-right" id="add_new_language">Add New Language</a></h2>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-striped table-hover text-center">
			<thead>
				<td>id</td>
				<td>Language</td>
				<td>Action</td>
			</thead>
			<tbody class="language_listing">
				<?php echo $language_list; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="language_add">
	<form id="language_form">
		<input type="hidden" name="lang_id" id="lang_id" />
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title">Add New Language</h5>
	                </div>
	                <div class="modal-body">
	                    <div class="form-group">
			                <label for="language">Language:</label>
			                <input type="text" name="language" id="language" class="form-control" />
			            </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary" id="save_language"> <i class="fa fa-save"></i> Save</button>
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
	    $(document).on("click", "#add_new_language", function() {
	    	$("#language").val("");
	    	$("#lang_id").val("");
	    	$(".modal-title").html("");
	    	$(".modal-title").html("Add new Language");
	      	$("#language_add").modal("show");
	    });

	    $(document).on("click", "#save_language", function() {
	    	$.ajax({
	    		url: "<?php echo base_url('dropdown_manager/save_language'); ?>",
	    		data: $("#language_form").serialize(),
	    		type: "post",
	    		dataType: "json",
	    		success: function(response) {
	    			if(response.status) {
	    				$(".language_listing").html("");
	    				$(".language_listing").html(response.listing);
	    				$("#language_add").modal("hide");
	    			}
	    			show_alert(response.message);
	    		}
	    	});
	    });

	    $(document).on("click", ".update_this", function() {
	    	var id = $(this).attr("rel");
	    	$(".modal-title").html("");
	    	$(".modal-title").html("Update Language");
	    	$.ajax({
	    		url: "<?php echo base_url('dropdown_manager/get_language_info'); ?>",
	    		data: "id="+id,
	    		type: "post",
	    		dataType: "json",
	    		success: function(response) {
	    			if(response.status) {
	    				$("#language").val("");
	    				$("#language").val(response.lang_info.language);
	    				$("#lang_id").val(response.lang_info.id);
	    				$("#language_add").modal("show");
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
		    		url: "<?php echo base_url('dropdown_manager/delete_language'); ?>",
		    		data: "id="+id,
		    		type: "post",
		    		dataType: "json",
		    		success: function(response) {
		    			if(response.status) {
		    				$(".language_listing").html("");
	    					$(".language_listing").html(response.listing);
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