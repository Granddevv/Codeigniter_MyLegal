<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('user_model', 'user');
	}

	public function index()
	{   
		$this->data = array();
		
		$this->form_validation->set_rules('first_name', 'First name', 'required');
		$this->form_validation->set_rules('last_name', 'Last name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

		if (isset($_POST) && !empty($_POST)) {
			// update the password if it was posted
			if ($this->input->post('password')) {
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[20]');
			}
			
			if ($this->form_validation->run() === TRUE) {
				$data = array(
					'first_name'  => $this->input->post('first_name', true),
					'last_name'   => $this->input->post('last_name', true),
					'phone'       => $this->input->post('phone', true),
					'email'       => $this->input->post('email', true),
					'password'    => $this->input->post('password', true),
					'user_role_id'=> $this->input->post('userrole', true)
				);
				// update the password if it was posted
				if ($this->input->post('password')) {
					$data['password'] = hash('sha256', $this->input->post('password', true));
				}

				$u_id = $this->user->insert($data);

			   	if($u_id) {
			   		$this->send_email($this->config->item("client_registration"), $u_id);

			    	// was succesfull, refresh page
					$this->session->set_userdata(array(
						'userID'=> $u_id,
						'fName'=>  $data['first_name'],
						'lName'=>  $data['last_name']
						));

					$this->data['message'] = 'User successfully created.';
					if($data['user_role_id']=='2'){
						redirect('account/profile');
					}
					else if($data['user_role_id']=='3'){
						redirect('lawyer/registration');
					}
			    } else {
			    	// there was an issue inserting
				   	$this->data['message'] = 'Issue creating user.';
			    }

			}
		}
		
		$this->load->view('usersignup_view', $this->data);
	}

	public function social_signup() {
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
					$result = $this->user->insert($data);
					if($result>0) {
						$this->send_email($this->config->item("client_registration"), $result);
						$this->session->set_userdata(array(
							'first_name' => $data['first_name'],
							'last_name'  => $data['last_name'],
							'email'      => $data['email'],
							'user_id'    => $result,
							'user_role'  => $default_role,
						));
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('success'=>false));
					}
				}
				
				break;
			
			default:
				# code...
				break;
		}
	}

}
