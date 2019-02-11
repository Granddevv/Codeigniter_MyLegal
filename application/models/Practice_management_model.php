<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Practice_management_model extends CRUD_Model {

	protected $_table = 'lawyers';
	protected $_primary_key = 'id';

	public function __construct() {
		parent::__construct();
	}

	public function get_lawyer_information($user_id) {
		$lawyer_info = $this->get(array("user_id" => $user_id));
		return isset($lawyer_info[0]) ? $lawyer_info[0] : "";
	}

	public function get_part_of_practice($practice_id, $approved = 0, $include_manager = FALSE) {
		$where = array("practice_id" => $practice_id, "approved" => $approved, "declined" => 0, "removed" => 0);
		if(!$include_manager) {
			$where['manager'] = 0;
		}

		return $this->get($where);
	}

	public function view_lawyer_information($lawyer_id) {
		return $this->get($lawyer_id);
	}

	public function approve_pending_lawyer($lawyer_id) {
		return $this->update($lawyer_id, array("approved" => 1));
	}

	public function decline_pending_lawyer($lawyer_id) {
		return $this->update($lawyer_id, array("declined" => 1));
	}

	public function remove_lawyer($lawyer_id) {
		return $this->update($lawyer_id, array("removed" => 1));
	}
}