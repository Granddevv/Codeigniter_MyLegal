<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('user_model', 'user');
		$this->load->model("Lawyer_model");
	}

	public function profile() {
		$user = $this->user->get($this->session->userdata('user_id'));
		// validate form input
		$this->form_validation->set_rules('first_name', 'First name', 'required');
		$this->form_validation->set_rules('last_name', 'Last name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');

		if (isset($_POST) && !empty($_POST)) {
			// update the password if it was posted
			if ($this->input->post('password')) {
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[20]|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', 'Password confirmation', 'required');
			}

			if ($this->form_validation->run() === TRUE) {
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'phone'      => $this->input->post('phone'),
				);

				// update the password if it was posted
				if ($this->input->post('password')) {
					$data['password'] = hash('sha256', $this->input->post('password'));
				}

			// check to see if we are updating the user
			   if($this->user->update($user->id, $data)) {
			    	// was succesfull, refresh page
				    // $this->session->set_flashdata('message', 'Account has been updated.' );
					redirect('/account/profile', 'refresh');
			    } else {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    // $this->session->set_flashdata('message', 'Error updating account.' );
					redirect('/account/profile', 'refresh');
			    }

			}
		}

		$this->data['user'] = $user;
		$this->data['access_on_law_area'] = ($this->session->userdata("user_role") == 1) ? FALSE : $this->doesHaveAccess("account", "law_areas_update");

		$this->load->template('account/profile', $this->data);
	}

	public function law_areas_update() {
		$this->load->model("law_areas_model");
		$lawyer_info = $this->Lawyer_model->get_lawyer_id($this->session->userdata("user_id"));
		$law_areas = array();
		$data['status'] = "";
		$data['message'] = "";
		if(isset($lawyer_info[0])) $law_areas = $this->law_areas_model->get_lawyers_law_areas($lawyer_info[0]->id);
		$data['law_areas_data'] = $this->clean_la($law_areas);

        if($this->input->post()) {
        	$insert_data = $this->clean_data($this->input->post(), $lawyer_info[0]->id);

        	if($this->law_areas_model->save_lawyer_areas($insert_data, $lawyer_info[0]->id)) {
        		$law_areas = $this->law_areas_model->get_lawyers_law_areas($lawyer_info[0]->id);
				$data['law_areas_data'] = $this->clean_la($law_areas);

        		$data['status'] = "Success";
				$data['message'] = "Information succesfully saved!";
        	} else {
        		$data['status'] = "Error";
				$data['message'] = "Error saving information";
        	}
        }

        $data['lpc'] = $this->law_areas_model->get_lawyers_categories_and_area();

        $this->load->template("lawyer/category_listing", $data);
    }

    private function clean_data($params, $id) {
    	$return = array();
    	foreach($params as $index => $param) {
    		if($index == "area") {
    			foreach($param as $data => $s) {
					$return[$data] = array("lawyer_id" => $id, "area_id" => $data, "pro_bono" => 0, "specialties" => 0);
    			}
    		} else if($index == "pro_bono") {
    			foreach($param as $pdata => $ps) {
    				if(array_key_exists($pdata, $return)) {
    					$return[$pdata][$index] = 1;
    				}
    			}
    		} else if($index == "specialties") {
    			foreach($param as $pdata => $ps) {
    				if(array_key_exists($pdata, $return)) {
    					$return[$pdata][$index] = 1;
    				}
    			}
    		}

    	}

    	return $return;
    }

    private function clean_la($law_areas) {
    	$return = array("area" => array(), "pro_bono" => array(), "specialties" => array());
    	if(count($law_areas) == 0) return $return;

    	foreach($law_areas as $law_area) {
    		$return['area'][] = $law_area->area_id;
    		if($law_area->pro_bono == 1) {
    			$return['pro_bono'][] = $law_area->area_id;
    		}
    		if($law_area->specialties == 1) {
    			$return['specialties'][] = $law_area->area_id;
    		}
    	}
    	return $return;
    }
}
