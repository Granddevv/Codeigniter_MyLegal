<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dropdown_model extends CRUD_Model {

	protected $_table = 'dropdown_language';
	protected $_lang_table = 'dropdown_language';
	protected $_eth_table = 'dropdown_ethnicity';
	protected $_gen_table = 'dropdown_gender';
	protected $_primary_key = 'id';

	public function __construct() {
		parent::__construct();
		$this->_table = $this->_lang_table;
	}

	// LANGUAGE MODEL
	public function get_language($id = NULL) {
		return $this->get($id);
	}

	public function save_language($id = FALSE, $data) {
		if($id) {
			return $this->update($id, $data);
		} else {
			return $this->insert($data);
		}
	}

	public function delete_language($id) {
		return $this->delete($id);
	}


	// ETHNICITY MODEL
	public function get_ethnicity($id = NULL) {
		$this->_table = $this->_eth_table;
		return $this->get($id);
	}

	public function save_ethnicity($id = FALSE, $data) {
		$this->_table = $this->_eth_table;
		if($id) {
			return $this->update($id, $data);
		} else {
			return $this->insert($data);
		}
	}

	public function delete_ethnicity($id) {
		$this->_table = $this->_eth_table;
		return $this->delete($id);
	}

	// GENDER MODEL
	public function get_gender($id = NULL) {
		$this->_table = $this->_gen_table;
		return $this->get($id);
	}

	public function save_gender($id = FALSE, $data) {
		$this->_table = $this->_gen_table;
		if($id) {
			return $this->update($id, $data);
		} else {
			return $this->insert($data);
		}
	}

	public function delete_gender($id) {
		$this->_table = $this->_gen_table;
		return $this->delete($id);
	}
}