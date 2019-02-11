<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_settings_model extends CRUD_Model {

	protected $_table = 'admin_settings';
	protected $_primary_key = 'id';
	// protected $_timestamps = FALSE;
	// protected $_created_on_field = 't_created_on';
	// protected $_updated_on_field = 't_updated_on';
	// protected $_timestamps_format = 'Y-m-d H:i:s';

	public function __construct() {
		parent::__construct();
	}

	public function fee_settings($where = array()) {
		if(count($where) > 0) {
			return $this->get($where);
		} else {
			return $this->get();
		}
	}

	public function save_fee_settings($params) {
		$result = $this->get();

		if(count($result) > 0) {
			return $this->update(array("id" => $result[0]->id), $params);
		} else {
			return $this->insert($params);
		}
	}
}