<link rel="stylesheet" href="<?php echo base_url('assets/js/summernote/dist/summernote.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/summernote/dist/summernote.js'); ?>"></script>

<div class="row">
	<div class="col-md-12">
		<div class="header">
			<h2>Email Template <div class="pull-right"><a class="btn btn-primary" id="add_new_template">Add New Template</a> <a class="btn btn-success" href="<?php echo base_url('admin/list_mail_sent'); ?>">View Mails</a></div></h2>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-striped table-hover text-center">
			<thead>
				<td>Template Name</td>
				<td>Action</td>
			</thead>
			<tbody class="template_listing">
				<?php echo $template_list; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="template_add">
	<form id="template_form">
		<input type="hidden" name="templ_id" id="templ_id" />
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title">Add New Template</h5>
	                </div>
	                <div class="modal-body">
	                    <div class="form-group">
			                <label for="template_name">Template Name:</label>
			                <input type="text" name="template_name" id="template_name" class="form-control" />
			            </div>
			            <div class="form-group">
			                <label for="template_content">Mandrill Template:</label> <small>(Can be use to change header)</small>
			                <div class="mandrill_option form-group">
			                	<?php echo $mandrill_templates; ?>
			                </div>
			            </div>
			            <div class="form-group">
			                <label for="subject">Subject:</label>
			                <input type="text" name="subject" id="subject" class="form-control" />
			            </div>
			            <div class="form-group">
			                <label for="template_content">Template Content:</label>
			                <input type="text" name="template_content" id="template_content" class="form-control" />
			            </div>
			            <div class="form-group">
			                <label>Legend:</label>
			                <ul>
				                <li>||first_name|| - First name of receiver</li>
				                <li>||last_name|| - Last name of receiver</li>
				                <li>||email|| - Email of receiver</li>				                
				                <li>||practice_name|| - Practice name of receiver <i>(If user is a lawyer)</i></li>
				            </ul>
			            </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary" id="save_template"> <i class="fa fa-save"></i> Save</button>
	                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"> <i class="fa fa-time"></i> Cancel</button>
	                </div>
	        </div>
	    </div>
	</form>
</div>
<!-- <form id="template_form">
	<input type="text" id="summernote" class="summernote" name="summernote" />
	<input type="submit" value="Save" />
</form> -->
<div class="modal fade" id="alert_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="alert-modal-title">Notification</h5>
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

<div class="modal fade" id="view_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="view-modal-title">View Template</h5>
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
		$('#template_content').summernote({height: 200});

	    $(document).on("click", "#add_new_template", function() {
	    	$("#template_name, #templ_id, #subject").val("");
	    	$("#template_content").summernote('reset');
	    	$(".modal-title").html("");
	    	$(".modal-title").html("Add new Template");
	      	$("#template_add").modal("show");
	    });

	    $(document).on("click", "#save_template", function() {
	    	if($("#template_name").val() == "") {
	    		show_alert("<p style='color:RED'>Template Name is required</p>");
	    		return;
	    	}
	    	$.ajax({
	    		url: "<?php echo base_url('admin/save_template'); ?>",
	    		data: "templ_id="+$("#templ_id").val()+"&template_name="+$("#template_name").val()+"&subject="+$("#subject").val()+"&mandrill_template="+$("#mandrill_template option:selected").val()+"&template_content="+$("#template_content").summernote('code'),
	    		type: "post",
	    		dataType: "json",
	    		success: function(response) {
	    			if(response.status) {
	    				$(".template_listing").html("");
	    				$(".template_listing").html(response.listing);
	    				$("#template_add").modal("hide");
	    			}
	    			show_alert(response.message);
	    		}
	    	});
	    });

	    $(document).on("click", ".view_this", function() {
	    	var id = $(this).attr("rel");
	    	$(".view-modal-title").html("");
	    	$("#template_view").html("");
	    	$("#view_modal").modal("show");

	    	$.ajax({
	    		url: "<?php echo base_url('admin/get_template_info'); ?>",
	    		data: "id="+id,
	    		type: "post",
	    		dataType: "json",
	    		success: function(response) {
	    			if(response.status) {
	    				$(".view-modal-title").html("Viewing template: <b>"+response.templ_info.template_name+"</b>");
	    				$('#template_view').html(response.templ_info.content);
	    			} else {
	    				show_alert(response.message);
	    			}
	    		}
	    	});
	    });

	    $(document).on("click", ".update_this", function() {
	    	var id = $(this).attr("rel");
	    	$(".modal-title").html("");
	    	$(".modal-title").html("Update Template");
	    	$.ajax({
	    		url: "<?php echo base_url('admin/get_template_info'); ?>",
	    		data: "id="+id,
	    		type: "post",
	    		dataType: "json",
	    		success: function(response) {
	    			if(response.status) {
	    				$("#template_name, #templ_id, #subject").val("");
	    				$("#template_content").summernote('reset');
	    				$("#template_name").val(response.templ_info.template_name);
	    				$('#template_content').summernote('code', response.templ_info.content);
	    				$("#subject").val(response.templ_info.subject);
	    				// $("#template_content").val(response.templ_info.content);
	    				$("#templ_id").val(response.templ_info.id);
	    				$(".mandrill_option").html("");
	    				$(".mandrill_option").html(response.mandrill_template);
	    				$("#template_add").modal("show");
	    			} else {
	    				show_alert(response.message);
	    			}
	    		}
	    	});
	    });

	    $(document).on("click", ".del_this", function() {
	    	if(confirm("Are you sure you want to delete this template?")) {
		    	var id = $(this).attr("rel");
		    	$.ajax({
		    		url: "<?php echo base_url('admin/delete_template'); ?>",
		    		data: "id="+id,
		    		type: "post",
		    		dataType: "json",
		    		success: function(response) {
		    			if(response.status) {
		    				$(".template_listing").html("");
	    					$(".template_listing").html(response.listing);
		    			}

		    			show_alert(response.message);
		    		}
		    	});
		    }
	    });
	});

    // $('form').on('submit', function (e) {
    //     e.preventDefault();
    //     alert($('.summernote').summernote('code'));
    //     alert($('.summernote').val());
    // });

	function show_alert(msg) {
		$("#alert_modal").modal("show");
		$("#alert_message").html("");
		$("#alert_message").html(msg);
	}
</script>