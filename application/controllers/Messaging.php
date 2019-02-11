<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Messaging extends MY_Controller {
	private $loggedUser = "";

	public function __construct() {
		parent::__construct();

		$this->load->library("encryption");
		$this->encryption->initialize(array('driver' => 'openssl'));

		$this->load->model("messaging_model", "messaging");
		$this->load->model("User_model", "user");
		$this->loggedUser = $this->session->userdata("user_id");
	}

	public function index() {
		$this->db->insert("jobs", array("status_id" => 1, "pro_bono" => 1, "budget" => 29, "title" => "Sample Job"));
		$data['loggedUser'] = $this->loggedUser;
		$data['msg_list'] = $this->messaging->get_conversations($this->loggedUser);
		$this->load->template("messaging/list", $data);
	}

	public function initiate_conversation($user_to, $job_id) {
		$user_from = $this->loggedUser;

		$get_conversation_id = $this->messaging->get_convo_base_on_job($job_id, $user_to, $user_from);
		if(!$get_conversation_id) {
			$job_info = $this->messaging->get_job_info($job_id);

			$conversation_id = $this->messaging->save_conversation($job_id.$user_to.$user_from);
			$this->messaging->save_message($this->encryption->encrypt("Started a conversation"), $conversation_id, $job_id, $user_to, $this->loggedUser);
		} else {
			$conversation_id = $get_conversation_id;
		}

		redirect("conversation/".$user_to."/".$job_id."/".$conversation_id);
	}

	public function conversation($user_to = FALSE, $job_id = FALSE, $conversation_id = FALSE) {
		// Do a second layer of checking when user is not part of the job
		// Must also check if login user is lawyer or client, and add the necessary validation.
		if(!$this->messaging->has_conversation_access($conversation_id, $job_id, $this->loggedUser)) {
			echo "<h2>You don't have access to this message</h2>";
			exit();
		}

		if($user_to == $this->loggedUser) {
			echo "<h2>System does not allow you to chat with yourself, kindly choose a different user</h2>";
			exit();
		}

		$user_to_info = $this->user->get_user_info($user_to);
		$job_info = $this->messaging->get_job_info($job_id);
		$conversation_info = $this->messaging->get_conversation_info($job_id);
		$logged_user_info = $this->user->get_user_info($this->loggedUser);

		if(!$job_info) {
			echo "<h2>Job you are trying to discuss does not exist</h2>";
			exit();
		}

		if(!$user_to_info) {
			echo "<h2>User you are trying to contact does not exist</h2>";
			exit();
		}

		if($this->messaging->count_unread_message($conversation_id, $this->loggedUser)) {
			$this->messaging->tag_message_as_read($conversation_id, $this->loggedUser);
		}

		$data['is_mobile'] = $this->isMobile();
		$data['room_name'] = $conversation_info->room_name; // this should be change and save on database, use only for testing
		$data['user_to'] = $user_to;
		$data['job_id'] = $job_id;
		$data['loggedUser'] = $this->loggedUser;
		$data['user_name'] = $logged_user_info->first_name;
		$data['messages'] = $this->_clean_message($this->messaging->get_messages($conversation_id));
		$data['conversation_id'] = $conversation_id;
		$data['client_name'] = $user_to_info->first_name." ".$user_to_info->last_name;
		$data['job_name'] = (isset($job_info->title)) ? $job_info->title : "N/a";
		$data['conversation_list'] = $this->messaging->get_conversations($this->loggedUser);

		$this->load->template("messaging/chat", $data);
	}

	public function call_status() {
		$conversation_id = $this->input->post("conversation_id");
		$job_id = $this->input->post("job_id");
		$user_to = $this->input->post("user_to");
		$status = $this->encryption->encrypt($this->input->post("status"));

		$this->messaging->save_message($status, $conversation_id, $job_id, $user_to, $this->loggedUser);
	}

	public function conversations() {
		// $user_to_info = $this->user->get_user_info($user_to);
		// $job_info = $this->messaging->get_job_info($job_id);
		// $conversation_info = $this->messaging->get_conversation_info($job_id);

		// if(!$job_info) {
		// 	echo "<h2>Job you are trying to discuss does not exist</h2>";
		// 	exit();
		// }

		// if(!$user_to_info) {
		// 	echo "<h2>User you are trying to contact does not exist</h2>";
		// 	exit();
		// }

		// if($this->messaging->count_unread_message($conversation_id, $this->loggedUser)) {
		// 	$this->messaging->tag_message_as_read($conversation_id, $this->loggedUser);
		// }

		$data['is_mobile'] = $this->isMobile();
		// $data['room_name'] = $conversation_info->room_name; // this should be change and save on database, use only for testing
		// $data['user_to'] = $user_to;
		// $data['job_id'] = $job_id;
		$data['loggedUser'] = $this->loggedUser;
		// $data['messages'] = $this->_clean_message($this->messaging->get_messages($conversation_id));
		$data['conversation_id'] = 0;
		// $data['client_name'] = $user_to_info->first_name." ".$user_to_info->last_name;
		// $data['job_name'] = (isset($job_info->title)) ? $job_info->title : "N/a";
		$data['conversation_list'] = $this->messaging->get_conversations($this->loggedUser);

		$this->load->template("messaging/conversation_list", $data);
	}

	public function start_conversation_with() {
		if($this->input->post()) {
			redirect("initiate_conversation/".$this->input->post("user")."/".$this->input->post("job"));
		}
		$data['user_list'] = $this->user->get_user_info(NULL);
		$data['job_list'] = $this->db->get("jobs")->result();

		$this->load->template("messaging/start_conversation_with", $data);
	}

	public function get_new_badge_message() {
		$listing = array();
		$count = $this->messaging->count_unread_messages(FALSE, $this->input->post("id"));

		foreach($count as $c) {
			if(!isset($listing[$c->conversation_id])) {
				$listing[$c->conversation_id] = 1;
			} else {
				$listing[$c->conversation_id] += 1;
			}
		}

		echo json_encode(array("count" => count($count), "listing" => $listing));
	}




	// public function send_message($user_to, $job_id, $conversation_id = FALSE) {
	// 	// Do a second layer of checking when user is not part of the job
	// 	// Must also check if login user is lawyer or client, and add the necessary validation.
	// 	if($conversation_id && !$this->messaging->has_conversation_access($conversation_id, $job_id, $this->loggedUser)) {
	// 		echo "<h2>You don't have access to this message</h2>";
	// 		exit();
	// 	}

	// 	if($this->messaging->count_unread_message($conversation_id, $this->loggedUser)) {
	// 		$this->messaging->tag_message_as_read($conversation_id, $this->loggedUser);
	// 	}

	// 	$user_to_info = $this->user->get_user_info($user_to);
	// 	$job_info = $this->messaging->get_job_info($job_id);

	// 	if($user_to == $this->loggedUser) {
	// 		echo "<h2>System does not allow you to chat with yourself, kindly choose a different user</h2>";
	// 		exit();
	// 	}

	// 	if(!$job_info) {
	// 		echo "<h2>Job you are trying to access does not exist</h2>";
	// 		exit();
	// 	}

	// 	if(!$user_to_info) {
	// 		echo "<h2>User you are trying to contact does not exist</h2>";
	// 		exit();
	// 	}

	// 	$data['is_mobile'] = $this->isMobile();
	// 	$data['room_name'] = "test_".$job_id; // this should be change and save on database, use only for testing

	// 	$data['user_to'] = $user_to;
	// 	$data['job_id'] = $job_id;
	// 	$data['messages'] = (!$conversation_id) ? "" : $this->_clean_message($this->messaging->get_messages($conversation_id));
	// 	$data['conversation_id'] = ($conversation_id) ? $conversation_id : "";
	// 	$data['client_name'] = $user_to_info->first_name." ".$user_to_info->last_name;
	// 	$data['job_name'] = (isset($job_info->title)) ? $job_info->title : "";

	// 	$this->load->template("messaging/initial_message", $data);
	// }

	public function save_message() {
		$return = array("status" => 0, "msg" => "Error sending message");

		if($this->input->post()) {
			$msg = $this->encryption->encrypt(nl2br($this->input->post("msg")));
			$user_to = $this->input->post("user_to");
			$conversation_id = (empty($this->input->post("conversation_id"))) ? 0 : $this->input->post("conversation_id");
			$job_id = (empty($this->input->post("job_id"))) ? 0 : $this->input->post("job_id");

			$convo_result = $this->start_conversation($conversation_id, $job_id, $user_to);
			if(!$convo_result['status']) {
				$return['msg'] = $convo_result['msg'];
			} else {
				$conversation_id = $convo_result['conversation_id'];

				if($this->messaging->save_message($msg, $conversation_id, $job_id, $user_to, $this->loggedUser)) {
					$messages = $this->messaging->get_messages($conversation_id);
					$return = array("status" => 1, "conversation_id" => $conversation_id, "message" => $this->_clean_message($messages));
				}
			}
		}

		echo json_encode($return);
	}

	private function _clean_message($messages) {
		$msg_panel = "";
		$prev_sender = "";
		foreach($messages as $msg) {
			if($msg->user_from == $this->loggedUser) {
				$sender = "<span style='color:GREEN;'>".$msg->first_name." ".$msg->last_name."</span>";
			} else {
				$sender = $msg->first_name." ".$msg->last_name;
			}

			$msg_panel .= $this->load->view("messaging/msg_panel", array("sender" => $sender, "date" => date("M d Y", strtotime($msg->created)), "message" => $this->encryption->decrypt($msg->message), "continuous" => ($prev_sender == $sender)), TRUE);
			$prev_sender = $sender;
		}

		return $msg_panel;
	}

	private function start_conversation($conversation_id = 0, $job_id, $user_to) {
		$returnArr = array("status" => FALSE, "msg" => "Unknown issue");
		if($conversation_id == 0) {
			$conv_id_exist = $this->messaging->get_convo_base_on_job($job_id, $user_to, $this->loggedUser);
			if($conv_id_exist) {
				$conversation_id = $conv_id_exist;
			} else {
				$conversation_id = $this->messaging->save_conversation();
			}

			return array("status" => TRUE, "conversation_id" => $conversation_id);
		} else {
			if($this->messaging->has_conversation_access($conversation_id, $job_id, $this->loggedUser)) {
				return array("status" => TRUE, "conversation_id" => $conversation_id);
			} else {
				$returnArr['msg'] = "You are not allowed to have this conversation";
				return $returnArr;
			}
		}
	}

	public function get_messages() {
		// if($this->messaging->count_unread_message($conversation_id, $this->loggedUser)) {
		// $this->messaging->tag_message_as_read($conversation_id, $this->loggedUser);
		// }

		$conversation_id = $this->input->post("conversation_id");
		$this->messaging->tag_message_as_read($conversation_id, $this->loggedUser);
		$messages = $this->messaging->get_messages($conversation_id);
		echo json_encode(array("status" => 1, "message" => $this->_clean_message($messages)));

	}

	// public function message_read() {
	// 	if($this->input->post()) {

	// 		echo json_encode();
	// 	}
	// }
}