<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messaging_model extends CRUD_Model {

	protected $_table = 'job_messages';
	protected $_primary_key = 'id';

	public function __construct() {
		parent::__construct();
	}

	public function get_conversations($loggedUser) {
		$this->db->select("job_messages.*, job_messages_conversation.title, CONCAT(uf.first_name, ' ', uf.last_name) AS uf_name, CONCAT(ut.first_name, ' ', ut.last_name) AS ut_name, jobs.title AS job_title");
		$this->db->join("job_messages", "job_messages_conversation.id = job_messages.conversation_id", "left")->group_by("conversation_id");
		$this->db->join("jobs", "jobs.id = job_messages.job_id", "left")->group_by("conversation_id");
		$this->db->join("users uf", "job_messages.user_from = uf.id", "left");
		$this->db->join("users ut", "job_messages.user_to = ut.id", "left");
		$this->db->where(array("user_to" => $loggedUser));
		$this->db->or_where(array("user_from" => $loggedUser));
		return $this->db->get("job_messages_conversation")->result();
	}

	public function get_messages($conversation_id) {
		$this->db->join("users", "users.id = job_messages.user_from", "left");
		return $this->get(array("conversation_id" => $conversation_id));
	}

	public function count_unread_message($conversation_id = FALSE, $logged_user) {
		$where = array("conversation_id" => $conversation_id, "user_to" => $logged_user, "read" => NULL);
		if(!$conversation_id) {
			unset($where['conversation_id']);
		}

		return $this->count($where);
	}

	public function count_unread_messages($conversation_id = FALSE, $logged_user) {
		$where = array("user_to" => $logged_user, "read" => NULL);
		return $this->get($where);
	}

	public function tag_message_as_read($conversation_id, $logged_user) {
		return $this->update(array("conversation_id" => $conversation_id, "user_to" => $logged_user, "read" => NULL), array("read" => $this->freshTimestamp()));
	}

	// public function save_conversation($enc_msg, $user_to, $job_id) {
	// 	$insertData = array(
	// 		"user_to" => $user_to,
	// 		"user_from" => $userLogged,
	// 		"message" => $enc_msg, 
	// 		"job_id" => $job_id,
	// 	);

	// 	return $this->insert($insertData);
	// }

	public function get_job_info($job_id) {
		$qry = $this->db->get_where("jobs", array("id" => $job_id));
		if($qry->num_rows() > 0) {
			return $qry->row();
		} else {
			return FALSE;
		}
	}

	public function get_conversation_info($conversation_id) {
		$qry = $this->db->get_where("job_messages_conversation", array("id" => $conversation_id));
		if($qry->num_rows() > 0) {
			return $qry->row();
		} else {
			return FALSE;
		}
	}

	public function has_conversation_access($conversation_id, $job_id, $user_logged) {
		$result = $this->get(array("conversation_id" => $conversation_id, "job_id" => $job_id));
		if(count($result) > 0) {
			if(isset($result[0])) {
				$user_to_data = $result[0]->user_to;
				$user_from_data = $result[0]->user_from;
			} else {
				$user_to_data = $result->user_to;
				$user_from_data = $result->user_from;
			}

			if($user_to_data == $user_logged || $user_from_data == $user_logged) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function get_convo_base_on_job($job_id, $user_to, $user_from) {
		$result = $this->get(array("job_id" => $job_id, "user_to" => $user_to, "user_from" => $user_from));
		if(count($result) > 0) {
			if(isset($result[0])) {
				return $result[0]->conversation_id;
			} else {
				return $result->conversation_id;
			}
		} else {
			return FALSE;
		}
	}

	public function save_conversation($title) {
		$key = rand(10000, 99999).$title;
		$insert_data = array(
			"title" => $key,
			"room_name" => $key,
		);

		$this->_table = "job_messages_conversation";
		$conversation_id = $this->insert($insert_data);
		$this->_table = "job_messages";

		return $conversation_id;
	}

	public function save_message($msg, $conversation_id, $job_id, $user_to, $user_from) {
		$message_insert = array(
			"message" => $msg,
			"conversation_id" => $conversation_id,
			"job_id" => $job_id,
			"user_to" => $user_to,
			"user_from" => $user_from,
		);

		return $this->insert($message_insert);
	}
}