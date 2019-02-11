<style>
	.shadow_hover:hover {
		background: #F8F8F8;
	}
	.shadow_selected {
		background: #F8F8F8;
	}
</style>
<div class="col-md-12">
	<a class="btn btn-plain btn-small" href="<?php echo base_url('messaging/start_conversation_with'); ?>"><i class='fa fa-phone'>&nbsp;</i>Initiate Conversation With</a><br /> <small>(Note: This is only use for testing and will be removed once it goes live);</small>
</div>

<script src="<?php echo base_url().'assets/js/detect_mobile.js'; ?>"></script>
<script src="https://meet.jit.si/external_api.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/conversation.js"></script>

<form id="message_form">
	<!-- <div class="row">
		<div class="page-header">
			<h3>
				Having a conversation with <strong><?php echo $client_name; ?></strong> on job: <strong><?php echo $job_name; ?></strong>
			</h3>
			<button class="btn btn-primary pull-right" id="open_modal"><i class='fa fa-phone'>&nbsp;</i> Start Call</button><br />
			<a class="pull-right" href="#">Back to list</a>
		</div>
	</div> -->
	<div class="row">
		<div class="col-md-3" >
			<div class="page-header">
				<h3>
					Conversations
				</h3>
			</div>
			<br />

			<?php
			if(count($conversation_list) > 0) {
			 	foreach($conversation_list as $conversation) { 
					$unread_count = $this->messaging->count_unread_message($conversation->conversation_id, $loggedUser);
					$msg_count = $this->messaging->count_unread_message($conversation->conversation_id, $this->session->userdata("user_id"));
					if($conversation->user_to == $loggedUser) {
						$user = $conversation->user_from;
						$to_name = $conversation->uf_name;
					} else {
						$user = $conversation->user_to;
						$to_name = $conversation->ut_name;
					} ?>

					<div onclick="window.location='<?php echo base_url().'conversation/'.$user.'/'.$conversation->job_id.'/'.$conversation->conversation_id; ?>'" class="col-md-12 shadow_hover <?php echo ($conversation->conversation_id == $conversation_id) ? "shadow_selected" : ""; ?>" style="cursor:pointer;border-bottom: 2px solid #EEEEEE; padding: 10px;">
						<?php echo "<strong>".$to_name."</strong>"; ?>
						<span class="badge pull-right conv_badge_<?php echo $conversation->conversation_id ?>" style="background-color: #DC3545"><?php  if($msg_count > 0) { echo $msg_count." unread msg"; } ?></span>
						<?php echo "<br/> (".$conversation->job_title.")"; ?>
					</div>
			<?php 
				}
			} else { ?>
				<div class="col-md-12">
					No conversation yet
				</div>
			<?php } ?>
		</div>
		<div class="col-md-9" style="border-left: 2px solid #EEEEEE">
			<div class="page-header">
				<h3>
					Chatbox
					<?php if(!empty($messages)) { ?>
						<button class="btn btn-opp btn-small pull-right" id="open_modal"><i class='fa fa-phone'>&nbsp;</i>Start Call</button>
					<?php } ?>
					<!-- Having a conversation with <strong><?php echo $client_name; ?></strong> on job: <strong><?php echo $job_name; ?></strong> -->
				</h3>
			</div>
			<br />
			<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
			<input type="hidden" name="conversation_id" id="conversation_id" value="<?php echo $conversation_id; ?>" />
			<input type="hidden" name="job_id" id="job_id" value="<?php echo $job_id; ?>" />
			<input type="hidden" name="user_to" id="user_to" value="<?php echo $user_to; ?>" />

			<div class="show_message" style="overflow-y:scroll; height:300px;border: 2px solid #CCCCCC;border-radius: 4px;">
				<?php 
				if(!empty($messages)) {
					echo $messages;
				} else { ?>
					<div class="col-xs-12 text-center">
						<h4>You have no message</h4>
					</div>
				<?php } ?>
			</div>
			
				<textarea class="form-control" id="message" name="message" rows="3" placeholder="Type your message here..."></textarea>
			
			<div class="text-right">
				<br />(Ctrl+Enter) <label> or </label>
				<button type="submit" class="btn btn-small" id="send_message" style=""><i class='fa fa-send'>&nbsp;</i> Send</button>&nbsp; 
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

<div class="modal modal-xs fade" id="concall_modal">
  	<div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title">Start A Call</h5>
		    </div>
		    <div class="col-md-12">
		    	<small><i>Note: Kindly allow your browser to have access on microphone to use this feature.</i></small>
		    </div>
		    <div class="modal-body"><br />
		        <div id="putvideohere" style="border: 2px solid #41484E;"></div>
		    </div>
		    <div class="modal-footer">
		        <button type="button" id="drop_call" class="btn btn-small"> <i class="fa fa-time"></i> Close and End Call</button>
		    </div>
	    </div>
  	</div>
</div>

<script>
var api;
var user_jid;
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
		<?php if($is_mobile) { // condition reversed only for testing. ?>
			$("#mobi_concall_modal").modal("show");
		<?php } else { ?>
			call_status("<i>Started Call</i>");
			$("#concall_modal").modal("show");
			call_jitsi();
		<?php } ?>
	});

	$("#drop_call").click(function() {
		drop_call();
		$("#concall_modal").modal("hide");
	});

	$("#start_mobile_call").click(function() {
		window.location = "https://meet.jit.si/<?php echo $room_name; ?>";
		call_status("<i>Started Call</i>");
		$("#mobi_concall_modal").modal("hide");
	});

	setTimeout(check_new_msg, 1000);
});

// function user_join(object) {
// 	console.log(object);
// 	alert("hey");
// }

function user_left(object) {
	// if(object.jid == user_jid) {
	$("#concall_modal").modal("hide");
	api.dispose();
	alert("User has left the call");
	call_status("<i>Call Ended</i>");
	// } else {
	// 	alert("User have left the call");
	// }
}

function name_change() {
	if(object.displayName == "<?php echo $user_name; ?>") {
		user_jid = object.jid
		alert(user_jid);
	}
}

function close_call(object) {
	$("#concall_modal").modal("hide");
	api.dispose();
	alert("User has left the call");
	call_status("<i>Call Ended</i>");
}

function call_jitsi() {
	var domain = "meet.jit.si";
    var options = {
        roomName: "<?php echo $room_name; ?>",
        // width: 280,
        height: 250,
        parentNode: document.getElementById('putvideohere'),
        // configOverwrite: {},
        interfaceConfigOverwrite: {
            filmStripOnly: true
        }
    }
    api = new JitsiMeetExternalAPI(domain, options);
    api.addEventListener("participantLeft", user_left);
    api.addEventListener("readyToClose", close_call);

    api.executeCommand('displayName', '<?php echo $user_name; ?>');
}

function call_status(status) {
	$.ajax({
		url: $("#base_url").val()+"messaging/call_status",
		data: $("#message_form").serialize()+"&status="+status,
		type: "post",
		dataType: "json",
		success: function(response) {
			if(response.status) {
				$(".show_message").html("");
				$(".show_message").html(response.message);
				$('.show_message').scrollTop($('.show_message')[0].scrollHeight);
			} else {
				$(".show_message").html("");
				$(".show_message").html(response.message);
				$('.show_message').scrollTop($('.show_message')[0].scrollHeight);
			}
		}
	});
}

function drop_call() {
	api.executeCommand('hangup');
}
</script>