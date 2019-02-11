<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lawyer_Model extends CRUD_Model {

	protected $_table = 'lawyers';
	protected $_law_lang_table = 'lawyer_languages';
	protected $_law_eth_table = 'lawyer_ethnicities';
	protected $_primary_key = 'id';
	// protected $_timestamps = FALSE;
	// protected $_created_on_field = 't_created_on';
	// protected $_updated_on_field = 't_updated_on';
	// protected $_timestamps_format = 'Y-m-d H:i:s';

	public function __construct() {
		parent::__construct();
	}

	public function insert_lawyers($data) {
		if($this->db->insert('lawyers', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function insert_practices($data) {
		if($this->db->insert('practices', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function get_single_row($whereArray) {  
		$query = $this->db->get_where($this->_table, $whereArray);
		$result = $query->row();

		return $result;
	}

	public function get_all_data($table) {
		$query = $this->db->get($table);
		$result = $query->result();

		return $result;
	}

	public function get_lawyer_id($user_id) {
		return $this->get(array("user_id" => $user_id));
	}

	// check if lawyer
	public function is_lawyer($user_id) {
		return $this->count(array("user_id" => $user_id)); 
	}

	public function insert_ethnicities($id, $data) {
		foreach($data as $d) {
			$this->db->insert($this->_law_eth_table, array("ethnicity_id" => $d, "lawyer_id" => $id));
		}
	}

	public function insert_languages($id, $data) {
		foreach($data as $d) {
			$this->db->insert($this->_law_lang_table, array("language_id" => $d, "lawyer_id" => $id));
		}
	}

	public function insert_lawyer_interest($data) {
		if($this->db->insert('lawyer_interest_registration', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function find_practice($practice_name) {
		$result = $this->db->get_where("practices", array("name" => $practice_name));
		if($result->num_rows() > 0) {
			return $result->result();
		} else {
			return FALSE;
		}
	}

	public function get_practices() {
		return $this->db->get("practices")->result();
	}

	public function verify_email_exists($email) {
		return $this->db->get_where("users", array("email" => $email))->num_rows();
	}

	public function get_practice_manager($practice_id) {
		return $this->db->get_where("lawyers", array("manager" => 1, "practice_id" => $practice_id))->row()->user_id;
	}
}