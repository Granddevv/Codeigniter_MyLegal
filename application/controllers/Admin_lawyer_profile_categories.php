<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Lawyer_profile_categories extends MY_Controller {

	protected $_table = 'lawyer_profile_categories';

	public function __construct() {
		parent::__construct();

		$this->load->model('law_areas_model', 'la_model');
	}

	public function index()
	{
		$data = array();
		$data['categories'] = $this->la_model->get_lawyer_profile_categories();
		$this->load->template('admin/lawyer_profile_categories', $data);
	}

	public function create()
	{
		if($this->input->post() && $name = $this->input->post('name'))
		{
			$insert_data['name'] = $name;
			$insert_data['slug'] = $this->input->post('slug');
			// $insert_data['user_label'] = $this->input->post('user_label');
			// $insert_data['lawyer_label'] = $this->input->post('lawyer_label');

			if($this->input->post('category'))
			{
				$insert_data['parent_id'] = $this->input->post('category');
			}

			if($this->la_model->create($insert_data, $this->_table))
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Category Created Successfully!</div>');
			else $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> Something went wrong, please try again later!</div>');
			redirect(site_url('admin_lawyer_profile_categories'),'refresh');
		}
	}

	public function edit($id)
	{
		if($this->input->post() && $name = $this->input->post('name'))
		{
			$update_data['name'] = $name;
			$update_data['slug'] = $this->input->post('slug');
			// $update_data['user_label'] = $this->input->post('user_label');
			// $update_data['lawyer_label'] = $this->input->post('lawyer_label');

			if($this->input->post('category'))
			{
				$update_data['parent_id'] = $this->input->post('category');
			}

			if($this->la_model->update($update_data, ['id'=>$id], $this->_table))
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Category Updated Successfully!</div>');
			else $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> Something went wrong, please try again later!</div>');
			redirect(site_url('admin_lawyer_profile_categories'),'refresh');

		}
		$data['edit']=$this->la_model->get_category($id, 'lawyer');
		$data['categories'] = $this->la_model->get_lawyer_profile_categories();
		$this->load->template('admin/lawyer_profile_categories', $data);
	}

	public function delete($id)
	{
		if(is_numeric($id))
		{
			$check = $this->la_model->delete($id, $this->_table);
			if($check===true)
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Category Deteleted Successfully!</div>');
			else 
			{
				if($check==1)
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> Something went wrong, please try again later! </div>');
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> This category has sub categories! Please delete them first! </div>');
				}
			}
			redirect(site_url('admin_lawyer_profile_categories'),'refresh');
		}
	}
}
