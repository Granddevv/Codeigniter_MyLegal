<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("admin_model");
		$this->load->model('questions_model', 'questions');
		$this->load->model('law_areas_model', 'la_model');
		$this->load->model('jobs_model', 'jobs');
	}

	public function index() {
		$this->load->template('admin/index');
	}

	public function access_control() {
		$data['role_list'] = $this->admin_model->get_data_from_table("user_roles");

		$this->load->template('admin/role_list', $data);
	}

	public function update_role($id = FALSE) {
		if(!is_numeric($id)) show_404();

		$data['messages'] = "";
		$data['role_access'] = array();

		if($this->input->post()) {
			$batch_insert = array();
			foreach($this->input->post("role_module_access", true) as $new_access) {
				$batch_insert[] = array("user_role_id" => $id, "module_access" => $new_access);
			}

			if($this->admin_model->clear_insert_access($id, $batch_insert)) {
				$data['messages'] = "Role successfully updated";
			} else {
				$data['messages'] = "Error updating role";
			}
		}

		$data['module_list'] = $this->admin_model->get_data_from_table("module_list");
		$data['role'] = $this->admin_model->get_data_from_table("user_roles", $id);
		$user_access = $this->admin_model->get_data_from_table("user_access", array("user_role_id" => $id));

		foreach($user_access as $access) {
			$data['role_access'][] = $access->module_access;
		}

		$this->load->template('admin/user_role_update', $data);
	}

	public function fee_settings() {
		$this->load->model('admin_settings_model');
		$data = array();
		$data['messages'] = "";

		if($this->input->post()) {
			$params = array(
				"monthly_fee" => $this->input->post("monthly_fee", TRUE),
				"percentage_fee" => $this->input->post("percentage_fee", TRUE),
				"signup_fee" => $this->input->post("signup_fee", TRUE),
			);

			if($this->admin_settings_model->save_fee_settings($params)) {
				$data['messages'] = "Fees successfully save";
			} else {
				$data['messages'] = "Error updating fees";
			}
		}

		$fee_settings = $this->admin_settings_model->fee_settings();
		$data['fee_settings'] = (count($fee_settings) > 0) ? $fee_settings[0] : array();

		$this->load->template('admin/fee_settings', $data);		
	}

	public function billing_settings() {
		$this->load->model("Admin_billing_model", "billing");
		$data['billing_list'] = $this->billing->get_billing_list();
		
		$this->load->template("admin/billing_settings", $data);
	}

	public function questions() {
		// $data['areas'] = $this->la_model->get_options_tree();

		// $data['qa'] = $this->questions->get(array('option_id' => 1));
		$data = array();

		$this->load->template('admin/questions', $data);
	}

	public function area($id)
	{
		$this->add_questions($id);
	}
	public function add_questions($id) {
		$this->load->model('jobs_model');

		$data['areas'] = $this->la_model->get_options();
		$data['selected_area'] = $this->la_model->get_option($id, 'array');
		$data['questions'] = $this->questions->get(array('option_id' => $id));

		if (isset($_POST) && !empty($_POST)) {
			$this->form_validation->set_rules('questions[]', 'A few questions', 'required');

			if ($this->form_validation->run() === TRUE) {
				$questions = $this->input->post('questions');
				foreach ($questions as $k => &$q) {
					if(empty($q['text'])) {
						unset($questions[$k]);
						reset($questions);
						continue;
					}

					$q['option_id'] = $id;
					$choices = array();
					if(!empty($q['choices'])) {
						foreach ($q['choices'] as $k) {
							if(!empty($k['value'])) {
								$choices[] = $k;
							}
						}
					}
					$q['choices'] = json_encode($choices);
				}

				// Delete previous questions, so we don't double up
				// $this->questions->delete(array('option_id' => $id));

				$this->questions->insert_batch($questions);
				redirect('admin/add_questions/'.$id);
			}

		}

		$this->load->template('admin/area', $data);
	}

	public function question_edit($id)
	{
		$this->load->model('jobs_model');

		$data['areas'] = $this->jobs_model->get_areas();
		$data['questions'] = $this->questions->get_question($id);

		if (isset($_POST) && !empty($_POST)) {
			$this->form_validation->set_rules('questions[]', 'A few questions', 'required');

			if ($this->form_validation->run() === TRUE) {
				$questions = $this->input->post('questions');
				// print_r($questions); exit;
				foreach ($questions as $k => &$q) {
					if(empty($q['text'])) {
						unset($questions[$k]);
						reset($questions);
						continue;
					}

					$q['option_id'] = $id;
					$choices = array();
					if(!empty($q['choices'])) {
						foreach ($q['choices'] as $k) {
							if(!empty($k['value'])) {
								$choices[] = $k;
							}
						}
					}
				}

				$q['choices'] = json_encode($choices);

				// Delete previous questions, so we don't double up
				// $this->questions->delete(array('option_id' => $id));

				$this->questions->update_batch($questions[0], $id);
				redirect('admin/add_questions/'.$id);
			}

		}

		$this->load->template('admin/questions_edit', $data);
	}

	public function question_delete($id, $option_id)
	{
		if($this->questions->delete($id))
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Question has been deleted</div>');
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> Unable to delete question.</div>');
		}
		redirect(site_url('admin/add_questions/'.$option_id));

	}

	public function questions_view($id)
	{
		$this->question_edit($id);
	}

	// public function get_options_tree(){
	// 	echo $this->la_model->print_options_tree();
	// }

	public function list_mail_sent() {
		$this->load->model("template_model");
		$email_logs = $this->template_model->get_email_logs();
		$data['email_logs'] = $this->_get_email_table($email_logs);

		$this->load->template('admin/email_logs', $data);
	}

	public function view_email_message() {
		$this->load->model("template_model");
		$data = array("status" => FALSE, "message" => "Error retrieving template");

		$id = $this->input->post("id");
		$templ_msg = $this->template_model->get_template_msg($id);
		if($templ_msg) {
			$data['status'] = TRUE;
			$data['template_msg'] = $templ_msg;
		}

		echo json_encode($data);
	}

	private function _get_email_table($list) {
		$return = "";
		foreach($list as $data) {
			$return .= '<tr>
				<td>'.$data->id.'</td>
				<td>'.$data->status.'</td>
				<td>'.$data->subject.'</td>
				<td>'.$data->to.'</td>
				<td>
					<button class="btn btn-primary view_this" rel="'.$data->id.'">View</button>
				</td>
			</tr>';
		}
		return $return;
	}

	public function email_template() {
		$this->load->model("template_model");
		// $this->load->library("mandrill_lib");

		$templates = $this->template_model->get_template();
		$data['mandrill_templates'] = $this->_get_mandrill_dropdown($this->mandrill_lib->get_mandril_templates());
		$data['template_list'] = $this->_get_table($templates);

		$this->load->template('admin/email_template', $data);
	}

	private function _get_mandrill_dropdown($mandrill_templates, $selected = FALSE) {
		if($mandrill_templates) {
			$return = "<select class='form-control' name='mandrill_template' id='mandrill_template'>";
			foreach($mandrill_templates as $t) {
				$return .= '<option value="'.$t['slug'].'" '.($selected && $selected === $t['slug'] ? "selected" : "").'>'.$t['name'].'</option>';
			}
			$return .= "</select>";
		} else {
			$return .= "<label>Mandrill templates can not be retrieved.</label>";
		}

		return $return;
	}

	public function save_template() {
		$this->load->model("template_model");
		$status_return = array("status" => FALSE, "message" => "Error saving template");

		if($this->input->post()) {
			$id = ($this->input->post("templ_id")) ? $this->input->post("templ_id") : FALSE;

			$insert = array(
				"template_name" => $this->input->post("template_name"),
				"content" => $this->input->post("template_content"),
				"mandrill_template" => $this->input->post("mandrill_template"),
				"subject" => $this->input->post("subject"),
			);

			$status = $this->template_model->save_template($id, $insert);

			if($status) {
				$status_return['status'] = TRUE;
				$status_return['message'] = "Successfully saved";
			}
		}

		$status_return['listing'] = $this->_get_table($this->template_model->get_template());

		echo json_encode($status_return);
	}

	public function delete_template() {
		$this->load->model("template_model");
		$status_return = array("status" => FALSE, "message" => "Error deleting template");
		$status_return['mandrill_templates'] = $this->_get_mandrill_dropdown($this->mandrill_lib->get_mandril_templates());

		$id = $this->input->post("id");

		if($this->template_model->delete_template($id)) {
			$status_return = array("status" => TRUE, "message" => "Template deleted successfully");
			$status_return['listing'] = $this->_get_table($this->template_model->get_template());
		}

		echo json_encode($status_return);
	}

	public function get_template_info() {
		// $this->load->library("mandrill_lib");
		$this->load->model("template_model");
		$data = array("status" => FALSE, "message" => "Error retrieving template");

		$id = $this->input->post("id");
		$templ_info = $this->template_model->get_template($id);
		if($templ_info) {
			$data['status'] = TRUE;
			$data['templ_info'] = $templ_info;
			$data['mandrill_template'] = $this->_get_mandrill_dropdown($this->mandrill_lib->get_mandril_templates(), $templ_info->mandrill_template);
		}

		echo json_encode($data);
	}

	private function _get_table($list) {
		$return = "";
		foreach($list as $data) {
			$return .= '<tr>
				<td>'.$data->template_name.'</td>
				<td>
					<button class="btn btn-primary view_this" rel="'.$data->id.'">View</button>
					<button class="btn btn-warning update_this" rel="'.$data->id.'">Edit</button>
					<button class="btn btn-default del_this" rel="'.$data->id.'">Delete</button>
				</td>
			</tr>';
		}
		return $return;
	}

}