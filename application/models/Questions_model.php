<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questions_Model extends CRUD_Model {

	protected $_table = 'job_questions';
	protected $_primary_key = 'id';
	// protected $_timestamps = FALSE;
	// protected $_created_on_field = 't_created_on';
	// protected $_updated_on_field = 't_updated_on';
	// protected $_timestamps_format = 'Y-m-d H:i:s';

	public function __construct() {
		parent::__construct();
		
	}

	public function insert_batch($data) {
		$this->db->insert_batch($this->_table, $data);
	}

	public function update_batch($data, $question_id) {
		$this->db->where($this->_primary_key, $question_id);
		$this->db->update($this->_table, $data);
	}

	public function get($id = null) {

		$this->db->select($this->_table.'.*');
	    $this->db->select('area_options.name');

		$this->db->join('area_options', $this->_table.'.option_id = area_options.id', 'left');

		if (is_numeric($id)) {
			$this->db->where($this->_table.'.'.$this->_primary_key, $id);
		} elseif (is_array($id)) {
			foreach ($id as $key => $value) {
				$this->db->where($key, $value);
			}
		}

		$query = $this->db->get($this->_table);
		return (is_numeric($id)) ? $query->row() : $query->result();
	}

	public function get_question($id)
	{
		$q = $this->db->get_where($this->_table, [$this->_primary_key=>$id]);
		return $q->result();
	}

	public function question_delete($id)
	{
		$this->db->where($this->_primary_key, $id);
		if($this->db->delete($this->$this->_table)) return true; 
		else return false;
	}
}