<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CRUD_Model {

	protected $_table = 'users';
	protected $_primary_key = 'id';

	public function __construct() {
		parent::__construct();
	}

	public function get_user_page_access($class = "", $method = "", $user_id = FALSE) {
		if(!$user_id && !empty($class) && !empty($method)) {
			if($this->session->userdata("user_id")) {
				$user_id = $this->session->userdata("user_id");
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}

		$role_id = $this->get($user_id)->user_role_id;
		if($role_id == 1) {
			return TRUE;
		}

		$where = array($this->_table.".id" => $user_id, "method_name" => $class, "class_name" => $method);

		$this->db->join("user_access", "users.user_role_id = user_access.user_role_id");
		$this->db->join("module_list", "user_access.module_access = module_list.id");

		return $this->get($where);
	}

	public function get_data_from_table($table = "", $id = null) {
		if(empty($table)) return FALSE;
		$this->_table = $table;
		$result = $this->get($id);
		$this->_table = "users";

		return $result;
	}

	public function clear_insert_access($role_id = FALSE, $batch_data = array()) {
		if(!$role_id || count($batch_data) == 0) return FALSE;

		$this->_table = "user_access";
		$this->delete(array("user_role_id" => $role_id));
		$this->_table = "users";

		return $this->db->insert_batch("user_access", $batch_data);
	}

	public function save_module($insert) {
		$this->_table = "module_list";
		$id = $this->insert($insert);
		$this->_table = "users";
		return $id;
	}

	public function delete_module($id) {
		$this->_table = "module_list";
		$status = $this->delete($id);
		$this->_table = "users";
		return $status;
	}

	public function get_specific_module($id) {
		$this->_table = "module_list";
		$module_info = $this->get($id);
		$this->_table = "users";

		return $module_info;
	}

	public function update_module($id, $data) {
		$this->_table = "module_list";
		$status = $this->update($id, $data);
		$this->_table = "users";

		return $status;
	}

}