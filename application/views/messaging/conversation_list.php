<style>
	.shadow_hover:hover {
		background: #F8F8F8;
	}
	.shadow_selected {
		background: #F8F8F8;
	}
</style>
<div class="col-md-12">
	<a class="btn btn-opp btn-small" href="<?php echo base_url('messaging/start_conversation_with'); ?>"><i class='fa fa-phone'>&nbsp;</i>Initiate Conversation</a><br /> <small>(Note: This is only use for testing and will be removed once it goes live);</small>
</div>

<script src="<?php echo base_url().'assets/js/detect_mobile.js'; ?>"></script>
<script src="https://meet.jit.si/external_api.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/conversation.js"></script>

<form id="message_form">
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
						<?php echo "<strong>".$to_name."</strong><br/> (".$conversation->job_title.")"; ?>
						<span class="badge conv_badge_<?php echo $conversation->conversation_id ?>" style="background-color: #DC3545"><?php if($msg_count > 0) { echo $msg_count." unread msg"; } ?></span>
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
						<button class="btn btn-primary pull-right" id="open_modal"><i class='fa fa-phone'>&nbsp;</i>Start Call</button>
					<?php } ?>
				</h3>
			</div>
			<br />

			<div class="show_message" style="overflow-y:scroll; height:300px;border: 2px solid #CCCCCC;border-radius: 4px;">
				<div class="col-xs-12 text-center">
					<h4>Click on a conversation to start.</h4>
				</div>
			</div>
			<textarea class="form-control" id="message" name="message" rows="3" placeholder="Type your message here..." disabled></textarea>
		</div>
		
	</div>
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