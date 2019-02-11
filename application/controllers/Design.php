<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('user_model', 'user');
	}

	public function index($value='')
	{
		$this->load->design_for_users('for_users');
	}

	public function lawyers(){
		$this->load->design('for_lawyers');
	}

	public function support(){
		$this->load->page('support', ['page_title'=>'Support', 'sub_heading'=>'Frequently Asked Questions']);
	}

	public function privacy_policy(){
		$this->load->page('privacy_policy', ['page_title'=>'Privacy Policy', 'sub_heading'=>'Your privacy is critically important to us:']);
	}

	public function contact(){

			$this->form_validation->set_rules('name', 'Name', 'required', array('required'=>'<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please enter your name!</div>'));
		$this->form_validation->set_rules('message', 'Message', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required'=>'<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please enter your email!</div>', 'valid_email'=>'<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Your email is invalid! Please enter a valid email.</div>'));
		if($this->input->post())
		{
			// print_r($this->input->post()); exit;
			if ($this->form_validation->run() === TRUE) {

				$message = "Name: ".$this->input->post('name', true)."<br>".
				"Contact: ".$this->input->post('contact', true)."<br>".
				"From Email: ".$this->input->post('email', true)."<br>".
				"Message: ".$this->input->post('message', true)."<br><br>Sent from mla.fweb.co.nz";
				$this->load->library('mandrill_lib');

				$subject = 'New Contact Request from Website - My Legal Advice';
				$from = $this->input->post('email', true);
				$from_name = 'My Legal Advice';
				$to = 'marc@fweb.co.nz';

				if($this->mandrill_lib->direct_email($message, $subject, $to, $from, $from_name))
					$this->session->set_flashdata('message', '<div class="alert alert-success"><h3 class="style">Your message has been sent!</h3> We will get back to you as soon as possible.</div>');
				else $this->session->set_flashdata('message', '<<div class="alert alert-danger"><h3 class="style">Your message could not be sent!<h3> Please try again later!</div>');
					redirect('design/contact');
			}

		}
		$this->load->page('contact', ['page_title'=>'Contact Us', 'sub_heading'=>'Frequently Asked Questions']);
	}

	public function lawyer_signup(){
		$this->load->page2('lawyer_signup');
	}

	public function lawyer_signin(){
		$this->signin();
	}

	public function signin()
	{
		$this->load->page2('lawyer_signin', ['page_title'=>'Sign In']);
	}

	public function lawyer_forget_password(){
		$this->load->page2('lawyer_forget_password');
	}

	public function dashboard(){
		$this->load->header_less('dashboard');
	}

	public function lawyer_register_your_interest(){

		$this->form_validation->set_rules('name', 'Name', 'required', array('required'=>'<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please enter your name!</div>'));
		// $this->form_validation->set_rules('mobile', 'Mobile', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required'=>'<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please enter your email!</div>', 'valid_email'=>'<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Your email is invalid! Please enter a valid email.</div>'));
		if($this->input->post())
		{
			// print_r($this->input->post()); exit;
			if ($this->form_validation->run() === TRUE) {

				$data['name'] = $this->input->post('name', true);
				$data['mobile'] = $this->input->post('mobile', true);
				$data['email'] = $this->input->post('email', true);
				$this->load->model('lawyer_model', 'la');
				if($this->la->insert_lawyer_interest($data))
					$this->session->set_flashdata('message', 'Your request has been recieved!<br> We will send you an alert when we go live.');
				else $this->session->set_flashdata('message', 'Your request could not be recorded!<br> Please try again later!');
					redirect('design/lawyer_register_your_interest');
			}

		}
		$this->load->page2('lawyer_register_your_interest', array('page_title'=>'Lawyer Register Your Interest'));
	}
}
