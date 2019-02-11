<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CRUD_Model extends CI_Model {

	protected $_table = NULL;
	protected $_primary_key = 'id';
	protected $_timestamps = FALSE;
	protected $_created_on_field = 't_created_on';
	protected $_updated_on_field = 't_updated_on';
	protected $_timestamps_format = 'Y-m-d H:i:s';
	protected $_messages = array();
	protected $_errors = array();

	public function __construct() {
		parent::__construct();
	}


	// options : int|array
	public function get($options = null) {
		if (is_numeric($options)) {
			$this->db->where($this->_primary_key, $options);
		} elseif (is_array($options)) {
			foreach ($options as $key => $value) {
				$this->db->where($key, $value);
			}
		}

		$query = $this->db->get($this->_table);
		return (is_numeric($options)) ? $query->row() : $query->result();
	}

	// data : array
	public function insert($data) {
		if ($this->_timestamps) {
			$data[$this->_created_on_field] = $this->freshTimestamp();
		}

		$this->db->insert($this->_table, $data);
		return $this->db->insert_id();
	}

	// id : int|array
	// data : array
	public function update($id, $data) {
		if ($this->_timestamps) {
			$data[$this->_updated_on_field] = $this->freshTimestamp();
		}

		if (is_numeric($id)) {
			$this->db->where($this->_primary_key, $id);
		} elseif (is_array($id)) {
			foreach ($id as $key => $value) {
				$this->db->where($key, $value);
			}
		}
	
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}

	// id : int
	// data : array
	public function checkDuplicate($id, $data) {
		foreach ($data as $key => $value) {
			$this->db->where($key, $value);
		}

		$this->db->where($this->_primary_key . ' !=', $id);

		$query = $this->db->get($this->_table);
		return ($query->num_rows() > 0) ? TRUE : FALSE;
	}
	
	// id : int
	// data : array
	public function insertUpdate($id, $data) {
		$count = $this->count($id);

		if ($count == 0) {
			return $this->insert($data);
		}
		
		return $this->update($data, $id);
	}

	// options : int|array
	public function count($options) {
		if (is_numeric($options)) {
			$this->db->where($this->_primary_key, $options);
		} elseif (is_array($options)) {
			foreach ($options as $key => $value) {
				$this->db->where($key, $value);
			}
		}
    
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	// id : int
	public function delete($id = false) {
		if (!$id) {
			die('You must supply parameter 1 for delete() method');
		}

		if (is_numeric($id)) {
			$this->db->where($this->_primary_key, $id);
		} elseif (is_array($id)) {
			foreach ($id as $key => $value) {
				$this->db->where($key, $value);
			}
		}

		$this->db->delete($this->_table);
		return $this->db->affected_rows();
	}

	public function freshTimestamp() {
		$timestamp = new DateTime();
		return $timestamp->format($this->_timestamps_format);
	}

	public function errors() {
		return $this->_errors;
	}

	public function messages() {
		return $this->_messages;
	}


	/**
	 * set_error
	 *
	 * Set an error message
	 *
	 * @return void
	 **/
	public function set_error($error) {
		$this->_errors[] = $error;

		return $error;
	}

	/**
	 * set_message
	 *
	 * Set a message
	 *
	 * @return void
	 **/
	public function set_message($message) {
		$this->_messages[] = $message;

		return $message;
	}
}

/* End of file  */
/* Location: ./application/models/ */