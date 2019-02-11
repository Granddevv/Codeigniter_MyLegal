<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dropdown_manager extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("dropdown_model", "dm");
	}

	public function index() {
		$data['language_list'] = $this->_clean_table($this->dm->get_language());

		$this->load->template("admin/dropdown/language_list", $data);
	}

	public function save_language() {
		$status_return = array("status" => FALSE, "message" => "Error saving information");

		if($this->input->post()) {
			$id = ($this->input->post("lang_id")) ? $this->input->post("lang_id") : FALSE;

			$insert = array(
				"language" => $this->input->post("language"),
			);

			$status = $this->dm->save_language($id, $insert);

			if($status) {
				$status_return['status'] = TRUE;
				$status_return['message'] = "Successfully saved";
			}
		}

		$status_return['listing'] = $this->_clean_table($this->dm->get_language());

		echo json_encode($status_return);
	}

	public function delete_language() {
		$status_return = array("status" => FALSE, "message" => "Error deleting data");
		$id = $this->input->post("id");

		if($this->dm->delete_language($id)) {
			$status_return = array("status" => TRUE, "message" => "Data deleted successfully");
			$status_return['listing'] = $this->_clean_table($this->dm->get_language());
		}

		echo json_encode($status_return);
	}

	public function get_language_info() {
		$data = array("status" => FALSE, "message" => "Error retrieving data");

		$id = $this->input->post("id");
		$lang_info = $this->dm->get_language($id);
		if($lang_info) {
			$data['status'] = TRUE;
			$data['lang_info'] = $lang_info;
		}

		echo json_encode($data);
	}

	private function _clean_table($list, $type = "language") {
		$return = "";
		foreach($list as $data) {
			$return .= '<tr>
				<td>'.$data->id.'</td>
				<td>'.$data->{$type}.'</td>
				<td>
					<button class="btn btn-warning update_this" rel="'.$data->id.'">Edit</button>
					<button class="btn btn-default del_this" rel="'.$data->id.'">Delete</button>
				</td>
			</tr>';
		}
		return $return;
	}

	/**
	 * Ethnicity DROPDOWN
	 **/
	public function ethnicity() {
		$data['ethnicity_list'] = $this->_clean_table($this->dm->get_ethnicity(), "ethnicity");

		$this->load->template("admin/dropdown/ethnicity_list", $data);
	}

	public function save_ethnicity() {
		$status_return = array("status" => FALSE, "message" => "Error saving information");

		if($this->input->post()) {
			$id = ($this->input->post("eth_id")) ? $this->input->post("eth_id") : FALSE;

			$insert = array(
				"ethnicity" => $this->input->post("ethnicity"),
			);

			$status = $this->dm->save_ethnicity($id, $insert);

			if($status) {
				$status_return['status'] = TRUE;
				$status_return['message'] = "Successfully saved";
			}
		}

		$status_return['listing'] = $this->_clean_table($this->dm->get_ethnicity(), "ethnicity");

		echo json_encode($status_return);
	}

	public function delete_ethnicity() {
		$status_return = array("status" => FALSE, "message" => "Error deleting data");
		$id = $this->input->post("id");

		if($this->dm->delete_ethnicity($id)) {
			$status_return = array("status" => TRUE, "message" => "Data deleted successfully");
			$status_return['listing'] = $this->_clean_table($this->dm->get_ethnicity(), "ethnicity");
		}

		echo json_encode($status_return);
	}

	public function get_ethnicity_info() {
		$data = array("status" => FALSE, "message" => "Error retrieving data");

		$id = $this->input->post("id");
		$eth_info = $this->dm->get_ethnicity($id);
		if($eth_info) {
			$data['status'] = TRUE;
			$data['eth_info'] = $eth_info;
		}

		echo json_encode($data);
	}

	/**
	 * GENDER DROPDOWN
	 **/
	public function gender() {
		$data['gender_list'] = $this->_clean_table($this->dm->get_gender(), "gender");

		$this->load->template("admin/dropdown/gender_list", $data);
	}

	public function save_gender() {
		$status_return = array("status" => FALSE, "message" => "Error saving information");

		if($this->input->post()) {
			$id = ($this->input->post("gen_id")) ? $this->input->post("gen_id") : FALSE;

			$insert = array(
				"gender" => $this->input->post("gender"),
			);

			$status = $this->dm->save_gender($id, $insert);

			if($status) {
				$status_return['status'] = TRUE;
				$status_return['message'] = "Successfully saved";
			}
		}

		$status_return['listing'] = $this->_clean_table($this->dm->get_gender(), "gender");

		echo json_encode($status_return);
	}

	public function delete_gender() {
		$status_return = array("status" => FALSE, "message" => "Error deleting data");
		$id = $this->input->post("id");

		if($this->dm->delete_gender($id)) {
			$status_return = array("status" => TRUE, "message" => "Data deleted successfully");
			$status_return['listing'] = $this->_clean_table($this->dm->get_gender(), "gender");
		}

		echo json_encode($status_return);
	}

	public function get_gender_info() {
		$data = array("status" => FALSE, "message" => "Error retrieving data");

		$id = $this->input->post("id");
		$gen_info = $this->dm->get_gender($id);
		if($gen_info) {
			$data['status'] = TRUE;
			$data['gen_info'] = $gen_info;
		}

		echo json_encode($data);
	}

}