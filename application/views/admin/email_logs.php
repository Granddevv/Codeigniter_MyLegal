<link rel="stylesheet" href="<?php echo base_url('assets/js/summernote/dist/summernote.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/summernote/dist/summernote.js'); ?>"></script>

<div class="row">
	<div class="col-md-12">
		<div class="header">
			<h2>List of email sent</h2>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-striped table-hover text-center">
			<thead>
				<td>ID</td>
				<td>Status</td>
				<td>Subject</td>
				<td>Email Receiver</td>
				<td>Action</td>
			</thead>
			<tbody class="template_listing">
				<?php echo $email_logs; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="view_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="view-modal-title">View Mail</h5>
            </div>
            <div class="modal-body">
                <div id="template_view"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"> <i class="fa fa-time"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function() {
	    $(document).on("click", ".view_this", function() {
	    	var id = $(this).attr("rel");
	    	$("#template_view").html("");
	    	$("#view_modal").modal("show");

	    	$.ajax({
	    		url: "<?php echo base_url('admin/view_email_message'); ?>",
	    		data: "id="+id,
	    		type: "post",
	    		dataType: "json",
	    		success: function(response) {
	    			if(response.status) {
	    				$('#template_view').html(response.template_msg);
	    			} else {
	    				show_alert(response.message);
	    			}
	    		}
	    	});
	    });
	});
</script>