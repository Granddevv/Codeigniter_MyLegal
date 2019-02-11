function Chat() {
	this.send_msg = send_msg_convo;
	this.check_new_msg = check_new_msg;
	this.is_msg_read = check_if_msg_read;
}

function send_msg_convo() {
	$.ajax({
		url: $("#base_url").val()+"messaging/save_message",
		data: "msg="+$("#message").val()+"&conversation_id="+$("#conversation_id").val()+"&job_id="+$("#job_id").val()+"&user_to="+$("#user_to").val(),
		type: "post",
		dataType: "json",
		success: function(response) {
			if(response.status) {
				$("#message").val("");
				$("#conversation_id").val(response.conversation_id);
				$(".show_message").html("");
				$(".show_message").html(response.message);
				$('.show_message').scrollTop($('.show_message')[0].scrollHeight);
			} else {
				alert(response.msg);
			}
		}
	});
}

function check_new_msg() {
	$.ajax({
		url: $("#base_url").val()+"messaging/get_messages",
		data: "conversation_id="+$("#conversation_id").val(),
		type: "post",
		dataType: "json",
		success: function(response) {
			if(response.status) {
				$(".show_message").html("");
				$(".show_message").html(response.message);
				$('.show_message').scrollTop($('.show_message')[0].scrollHeight);
			}
		},
		complete: function(resposne) {
			setTimeout(check_new_msg, 1000);
		}
	});
}

function check_if_msg_read() {

}