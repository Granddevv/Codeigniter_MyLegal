<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CRUD_Model {

	protected $_table = 'users';
	protected $_primary_key = 'id';
	// protected $_timestamps = FALSE;
	// protected $_created_on_field = 't_created_on';
	// protected $_updated_on_field = 't_updated_on';
	// protected $_timestamps_format = 'Y-m-d H:i:s';

	public function __construct() {
		parent::__construct();
		
	}

	public function login($email, $password) {
		$query = $this->get(array('email' => $email, 'password' => $this->_hash_password($password)));
		if(count($query) == 1) { // should only find one user
			$this->_set_session($query[0]);
			$this->set_message('Succesfully logged in.');
			return true;
		} else {
			$this->set_error('User not found.');
			return false;
		}
	}

	protected function _set_session($user) {
		$session_data = array(
		    'email'                => $user->email,
		    'user_id'              => $user->id, //everyone likes to overwrite id so we'll use user_id
		    'user_role' =>$user->user_role_id,
		);

		$this->session->set_userdata($session_data);

		return TRUE;
	}

	protected function _hash_password($password) {
		return hash('sha256', $password);
	}

	public function get_user_info($user_id) {
		return $this->get($user_id);
	}

	public function change_user_role($id, $new_role) {
		return $this->update($id, array("user_role_id" => $new_role));
	}

}