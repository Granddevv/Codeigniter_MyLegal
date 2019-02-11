<script src="<?php echo base_url().'assets/js/detect_mobile.js'; ?>"></script>
<script src="https://meet.jit.si/external_api.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/conversation.js"></script>

<form id="message_form">
	<div class="row">
		<div class="page-header">
			<h3>
				Having a conversation with <strong><?php echo $client_name; ?></strong> on job: <strong><?php echo $job_name; ?></strong>
				<button class="btn btn-primary pull-right" id="open_modal"><i class='fa fa-phone'>&nbsp;</i> Start Call</button>
			</h3>
			<!-- <a class="pull-right" href="#">Back to list</a> -->
		</div>
		<div class="col-xs-12">
			<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
			<input type="hidden" name="conversation_id" id="conversation_id" value="<?php echo $conversation_id; ?>" />
			<input type="hidden" name="job_id" id="job_id" value="<?php echo $job_id; ?>" />
			<input type="hidden" name="user_to" id="user_to" value="<?php echo $user_to; ?>" />

			<div class="show_message" style="overflow-y:scroll; height:300px;border: 2px solid #CCCCCC">
				<?php 
				if(!empty($messages)) {
					echo $messages;
				} else { ?>
					<div class="col-xs-12 text-center">
						<h4>You have no new message</h4>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
					<textarea class="form-control" id="message" name="message" rows="3" placeholder="Type your message here..."></textarea>
				</div>
				<div class="col-md-12 text-right">
					<br />(Ctrl+Enter) <label> or </label>
					 <button type="submit" class="btn btn-success" id="send_message" style=""><i class='fa fa-pencil'>&nbsp;</i> Send Message</button>
					
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="col-md-12"> -->
	<!-- </div> -->
</form>
<div class="modal fade" id="mobi_concall_modal">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title">How to Start A Call</h5>
		    </div>
		    <div class="modal-body">
		        <?php echo $this->load->view('messaging/mobile_jitsi', array('room_name' => $room_name), TRUE); ?>
		    </div>
		    <!-- <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"> <i class="fa fa-time"></i> Close and End Call</button>
		    </div> -->
	    </div>
  	</div>
</div>

<div class="modal fade" id="concall_modal">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title">Start A Call</h5>
		    </div>
		    <div class="modal-body">
		        <div id="putvideohere"></div>
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"> <i class="fa fa-time"></i> Close and End Call</button>
		    </div>
	    </div>
  	</div>
</div>

<script>
$(document).ready(function(){
	var conv = new Chat();
	$("#message_form").submit(function(e) {
		e.preventDefault();
		conv.send_msg();
	});

	$("#message").keydown(function(event) {
		if ((event.keyCode == 10 || event.keyCode == 13) && event.ctrlKey) {
			$("#message_form").submit();
		}
	});

	$("#open_modal").click(function() {
		<?php if(!$is_mobile) { // condition reversed only for testing. ?>
			$("#mobi_concall_modal").modal("show");
		<?php } else { ?>
			$("#concall_modal").modal("show");
			call_jitsi();
		<?php } ?>
	});

	setTimeout(check_new_msg, 1000);
});

function call_jitsi() {
	var domain = "meet.jit.si";
    var options = {
        roomName: "<?php echo $room_name; ?>",
        // width: 700,
        // height: 180,
        parentNode: document.getElementById('putvideohere'),
        // configOverwrite: {},
        interfaceConfigOverwrite: {
            filmStripOnly: true
        }
    }
    var api = new JitsiMeetExternalAPI(domain, options);
}
</script>