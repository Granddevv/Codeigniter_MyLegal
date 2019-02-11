<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lawyer extends MY_Controller {

	public function __construct() {
		parent::__construct();
        
        $this->load->model('lawyer_model', 'lawyer');
	}

	public function registration() {
        $this->load->model("Admin_settings_model", "fees");
        $this->load->model("Admin_billing_model", "billing");
        $this->load->model("User_model", "users");
        $this->load->model("dropdown_model", "dm");

        $viewData['name']               = $this->session->userdata('fName')." ".$this->session->userdata('lName');
        $viewData['practice']           = $this->lawyer->get_all_data('practices')?$this->lawyer->get_all_data('practices'):array();
        $viewData['fees']               = $this->fees->fee_settings();
        $viewData['language_dropdown']  = $this->dm->get_language();
        $viewData['gender_option']      = $this->dm->get_gender();
        $viewData['ethnicity_dropdown'] = $this->dm->get_ethnicity();
       
        // $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_email_check');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('alawyer', 'About lawyer', 'required');
        $this->form_validation->set_rules('experience', 'Experience', 'required');
        $this->form_validation->set_rules('language[]', 'Language', 'required');
        // $this->form_validation->set_rules('specialty', 'Specialities', 'required');
        $this->form_validation->set_rules('ethnicity[]', 'Ethnicity', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('mfee', 'Monthly_fee', 'required');
        $this->form_validation->set_rules('pcertificate', 'Certificates', 'required');

        if($this->input->post()) {
            $location = $this->input->post("address")." ".$this->input->post("address2")." ".$this->input->post("suburb")." ".$this->input->post("city")." ".$this->input->post("zip_code");
            if($this->form_validation->run() === TRUE) {
                $cPractice = $this->lawyer->find_practice($this->input->post('pname'));

                $data = array(
                    'first_name'   => $this->input->post('first_name', true),
                    'last_name'    => $this->input->post('last_name', true),
                    // 'phone'       => $this->input->post('phone', true),
                    'email'        => $this->input->post('email', true),
                    'password'     => hash('sha256', $this->input->post('password', true)),
                    'user_role_id' => (!$cPractice) ? 4 : 3,
                );
                // update the password if it was posted
                // if ($this->input->post('password')) {
                //     $data['password'] = hash('sha256', $this->input->post('password', true));
                // }

                $user_id = $this->users->insert($data);

                // if($this->input->post("manager") && $this->input->post("manager") == 1) {
                if(!$cPractice) {
                    $practiceData = array(
                        'name'          => $this->input->post('pname'),
                        'location'      => $location,
                        'about'         => $this->input->post('alawyer'),
                        'monthly_fee'   => $this->input->post('mfee'),
                    );
                    $practiceID = $this->lawyer->insert_practices($practiceData);
                    // $this->users->change_user_role($user_id, 4);
                } else {
                    // $practiceID = $this->input->post("joined_practice");
                    $practiceID = $cPractice[0]->id;

                    $manager_user_id = $this->lawyer->get_practice_manager($practiceID);
                    $this->send_email($this->config->item("request_join_practice"), $manager_user_id);
                }
                
                $lawyerData = array(
                    'name'         => $this->input->post('first_name', true)." ".$this->input->post('last_name', true),
                    'user_id'      => $user_id,
                    'practice_id'  => $practiceID,
                    'about'        => $this->input->post('alawyer'),
                    'experience'   => $this->input->post('experience'),
                    // 'languages'    => $this->input->post('language'),
                    'gender'       => $this->input->post('gender'),
                    // 'specialities' => $this->input->post('specialty'),
                    // 'ethnicity'    => $this->input->post('ethnicity'),
                    'location'     => $location,
                    'qualified'    => $this->input->post('qualify')?$this->input->post('qualify'):0,
                    'certificates' => $this->input->post('pcertificate'),
                    'approved'     => (!$cPractice) ? 1 : 0,
                    'manager'      => $this->input->post('user_type') == "2" ? 1 : 0,
                    'photo'        => $this->do_upload($_FILES),
                );
               
                $resultID = $this->lawyer->insert_lawyers($lawyerData);
                $viewData['lawyerData'] = $lawyerData;

                $billing = array(
                    "practice_id" => $practiceID,
                    "billing_type_id" => 3,
                    "amount" => $viewData['fees'][0]->signup_fee,
                    "billing_month" => $this->lawyer->freshTimestamp(),
                );

                $this->billing->save_billing($billing);

                if($resultID) {
                    $this->send_email($this->config->item("lawyer_registration"), $user_id);

                    $viewData['msg'] = "Lawyer successfully created.";
                    if($this->input->post("ethnicity") > 0) {
                        $this->lawyer->insert_ethnicities($resultID, $this->input->post("ethnicity"));
                    }

                    if($this->input->post("language") > 0) {
                        $this->lawyer->insert_languages($resultID, $this->input->post("language"));
                    }                    

                    redirect("login");
                } else{
                    $viewData['msg'] = "Error!";
                    $viewData['message'] = "Email already exists";
                }
            }
        }

        // $this->load->page2('lawyer_signup');
		$this->load->signup('lawyer/registration', $viewData);
	}

    public function email_check($email) {
        $emailExist = $this->lawyer->verify_email_exists($email);
        if($emailExist) {
            $this->form_validation->set_message('email_check', '{field} already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function do_upload($file) {

         $config['upload_path']   = './uploads/'; 
         $config['allowed_types'] = 'gif|jpg|png|bmp'; 
         $config['max_size']      = 100; 
         $config['max_width']     = 1024; 
         $config['max_height']    = 768;
         $config['file_name']     = $file['file']['name'];  
         $this->load->library('upload', $config);

         if(!file_exists($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
         }
		
         if ( ! $this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
         }
         else { 
            return $file['file']['name'];
         } 
    }

    public function json() {
        $retArray = array();
        $practices = $this->lawyer->get_practices();

        foreach($practices as $practice) {
            $retArray[] = array("name" => $practice->name, "email" => $practice->location);
        }

        // $retArray = array(array("name" => "test", "email" => "test") , array("name" => "test1", "email" => "test1"));

        echo json_encode($retArray);
    }
}
