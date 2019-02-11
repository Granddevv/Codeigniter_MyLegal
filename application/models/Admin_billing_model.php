<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_billing_model extends CRUD_Model {

	protected $_table = 'billing';
	protected $_primary_key = 'id';
	// protected $_timestamps = FALSE;
	// protected $_created_on_field = 't_created_on';
	// protected $_updated_on_field = 't_updated_on';
	// protected $_timestamps_format = 'Y-m-d H:i:s';

	public function __construct() {
		parent::__construct();
	}

	public function save_billing($data) {
		return $this->insert($data);
	}

	public function get_billing($where = FALSE) {
		if(!$where) {
			return $this->get();
		} else {
			return $this->get($where);
		}
	}

	public function get_billing_list($where = FALSE) {
		if($where) {
			$this->db->where($where);
		}
		$this->db->select("billing.*, billing_types.name AS billing_type_name, practices.name AS practice_name");
		$this->db->join("billing_types", "billing.billing_type_id = billing_types.id", "left");
		$this->db->join("practices", "billing.practice_id = practices.id", "left");
		$qry = $this->db->get("billing");

		if($qry->num_rows() > 0) {
			return $qry->result();
		} else {
			return array();
		}
	}

	public function check_billing($where) {
		return $this->count($where);
	}

	public function cron_logs($data) {
		$this->_table = "cron_logs";
		$result = $this->insert($data);
		$this->_table = "billing";

		return $result;
	}
}