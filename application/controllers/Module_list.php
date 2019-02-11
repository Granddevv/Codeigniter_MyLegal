<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Module_list extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("admin_model");
	}

	public function manager() {
		$data['module_list'] = $this->admin_model->get_data_from_table("module_list");

		$this->load->template('admin/module_list', $data);
	}

	public function add($id = FALSE) {
		$data['status'] = "";
		$data['message'] = "";
		if($this->input->post()) {
			$insert = array(
				"class_name" => $this->input->post("class_name"),
				"method_name" => $this->input->post("method_name"),
				"module_name" => $this->input->post("module_name")
			);

			if($id) {
				$status = $this->admin_model->update_module($id, $insert);
			} else {
				$status = $this->admin_model->save_module($insert);
			}

			if($status) {
				$data['status'] = "Success";
				$data['message'] = "Successfully saved";
			} else {
				$data['status'] = "Error";
				$data['message'] = "Error saving";
			}
		}

		if($id) {
			$module_info = $this->admin_model->get_specific_module($id);
			$data['class_name'] = $module_info->class_name;
			$data['method_name'] = $module_info->method_name;
			$data['module_name'] = $module_info->module_name;
		} else {
			$data['class_name'] = "";
			$data['method_name'] = "";
			$data['module_name'] = "";
		}

		$this->load->template("admin/module_list_add", $data);
	}

	public function delete($id) {
		if($this->admin_model->delete_module($id)) {
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Module successfully deleted</div>');
		} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Error deleting module</div>');
		}

		redirect("module_list/manager");
	}





	public function access_control() {
		

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

}