<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('user_model', 'user');
	}

	public function login() {
		// print_r($this->send_email(12, 4, "Test Subject"));
		// exit();
		// $this->load->library("mandrill_lib");
		// $html_msg = "
		// This is a test message from mandrill.<br /><br />
		// How've you been?";

		// $to = array(array('email' => 'benjie@test.com', 'name' => 'Jr', 'type' => 'to' ));

		// print_r($this->mandrill_lib->direct_email($html_msg, "Mandrill Message", $to));
		// exit();
		$this->data = array();
		$this->data['messages'] = array();

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		if($this->input->post()) {
			if($this->form_validation->run() == TRUE) {
				if($this->user->login($this->input->post('email', true), $this->input->post('password', true))) {
					redirect('jobs/index', 'refresh');
				} else {
					$this->data['messages'] = $this->user->errors();
				}
			} else {
				$this->data['messages'] = validation_errors();
			}
		}
		// var_dump($this->data);
		$this->load->signup('auth/login', $this->data);
		
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('/', 'refresh');
	}

	public function php_info() {
		phpinfo();
	}

	public function social_login() {
		$default_role = 2;
		$mode = $this->input->post('mode');

		switch ($mode) {
			case 'facebook':
				$data = array(
					'first_name'  => $this->input->post('fName', true),
					'last_name'   => $this->input->post('lName', true),
					'email'       => $this->input->post('email', true),
					'user_role_id'=> $default_role,
					'fb_token'    => $this->input->post('fb_token', true),
					'fb_id'       => $this->input->post('fb_id',true),
				);

				$user_result = $this->user->get(array("email" => $this->input->post('email', true)));
				if(count($user_result) > 0) {
					$this->session->set_userdata(array(
						'first_name' => $data['first_name'],
						'last_name'  => $data['last_name'],
						'email'      => $data['email'],
						'user_id'    => $user_result[0]->id,
						'user_role'  => $default_role,
					));
					echo json_encode(array('success'=>true));
				} else {
					echo json_encode(array('success'=>false, 'msg' => '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> You are not yet registered on the system. You can register using your facebook account by <a href="'.base_url().'">clicking here</a></div>'));
					// $this->session->set_flashdata('message', '<div class="alert alert-error alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> You are not yet registered on the system. Kindly register using your facebook account by <a href="'.base_url().'">clicking here</a></div>');
				}
				
				break;
			
			default:
				# code...
				break;
		}
	}

	public function lawyer_forget_password(){
		$this->load->signup('auth/lawyer_forget_password');
	}

	private function forgot_password_process($user_id) {
		$this->send_email($this->config->item("client_registration"), $user_id);
	}
}
