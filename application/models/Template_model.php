<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template_model extends CRUD_Model {

	protected $_table = 'email_template';
	protected $_primary_key = 'id';
	// protected $_timestamps = FALSE;
	// protected $_created_on_field = 't_created_on';
	// protected $_updated_on_field = 't_updated_on';
	// protected $_timestamps_format = 'Y-m-d H:i:s';

	public function __construct() {
		parent::__construct();
	}

	public function get_template($id = NULL) {
		return $this->get($id);
	}

	public function save_template($id = FALSE, $data) {
		if($id) {
			return $this->update($id, $data);
		} else {
			return $this->insert($data);
		}
	}

	public function delete_template($id) {
		return $this->delete($id);
	}

	public function log_status($template_id, $to, $email_msg, $subject, $logs, $status) {
		return $this->db->insert("email_logs", array("email_msg" => $email_msg, "template_id" => $template_id, "to" => $to, "subject" => $subject, "status" => $status, "logs" => json_encode($logs), "date_created" => $this->freshTimestamp()));
	}

	public function get_template_user_info($user_id) {
		$this->db->select("users.*, practices.name as practice_name");
		$this->db->join("lawyers", "lawyers.user_id = users.id", "left");
		$this->db->join("practices", "practices.id = lawyers.practice_id", "left");
		$result = $this->db->get_where("users", array("users.id" => $user_id));
		if($result->num_rows() > 0) {
			return $result->row();
		} else {
			return FALSE;
		}
	}

	public function get_email_logs() {
		return $this->db->get("email_logs")->result();
	}

	public function get_template_msg($id) {
		return $this->db->get_where("email_logs", array("id" => $id))->row()->email_msg;
	}

}