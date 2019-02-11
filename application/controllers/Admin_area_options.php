<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_area_options extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('law_areas_model', 'la_model');
		$this->load->model('jobs_model');
	}

	public function index($category_id=NULL)
	{
		$data = array();
		if($category_id) 
		{
			$data['selected_category'] = $category_id;
			$data['categories'] = $this->la_model->get_sub_categories($category_id);
		}
		else{
			$data['categories'] = $this->la_model->get_categories(true);
		}
		$this->load->template('admin/law_areas/options/admin_area_options_main', $data);
	}

	public function show_options($category_id=NULL)
	{
		$data = array();
		if($category_id) $data['selected_category'] = $category_id;
		$data['categories'] = $this->la_model->get_category($category_id);
		$data['options'] = $this->la_model->get_options_by_category($category_id);
		$data['areas'] = $this->la_model->get_areas();
		$this->load->template('admin/law_areas/options/admin_area_options', $data);
	}

	public function create($option_id=NULL)
	{
		if($this->input->post() && $name = $this->input->post('name'))
		{
			$insert_data['name'] = $name;
			$insert_data['slug'] = $this->input->post('slug');
			$insert_data['user_label'] = $this->input->post('user_label');
			$insert_data['lawyer_label'] = $this->input->post('lawyer_label');
			$areas = $this->input->post('areas');
			// print_r($areas); exit;
			if($option_id) $insert_data['parent_id'] = $option_id;

			if($this->input->post('category'))
			{
				$insert_data['category_id'] = $this->input->post('category');
				$insert_data['is_main'] = true;
			}

			if($option_id = $this->la_model->create_area_option($insert_data))
			{
				if($areas && count($areas)>0)
					$this->la_model->insert_option_area_associations($areas, $option_id);

				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Option Created Successfully!</div>');
			}
			else $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> Something went wrong, please try again later!</div>');

			if($this->uri->segment(3)) 
				redirect(site_url('admin_area_options/create/'.$this->uri->segment(3)),'refresh');
			else {
				if($this->input->post('redirect_uri'))
				redirect(site_url($this->input->post('redirect_uri')));
				else redirect(site_url('admin_area_options'));
			}
		}

		if($option_id)
		{
			$data = array();
			$data['options'] = $this->la_model->get_main_options();
			$data['parent'] = $this->la_model->get_option($option_id);
			$data['parent_areas'] = $this->la_model->get_areas_by_option($option_id);
			$data['children'] = $this->la_model->get_option_children($option_id);
			$data['areas'] = $this->la_model->get_areas();
			$this->load->template('admin/law_areas/options/create_children', $data);
		}
		else redirect(site_url('admin_area_options'));
	}

	public function view($option_id)
	{
		// $data['parent'] = $this->la_model->get_option($option_id);
		// $data['children'] = $this->la_model->get_option_children($option_id);
		// $data['options'] = $this->la_model->get_main_options();
		// $this->load->template('admin/law_areas/options/view', $data);
		$this->create($option_id);
	}

	public function edit($id)
	{
		if($this->input->post() && $name = $this->input->post('name'))
		{
			$update_data['name'] = $name;
			$update_data['slug'] = $this->input->post('slug');
			$update_data['user_label'] = $this->input->post('user_label');
			$update_data['lawyer_label'] = $this->input->post('lawyer_label');
			$areas = $this->input->post('areas');
			// print_r($areas); exit;

			if($this->input->post('category'))
			{
				$update_data['category_id'] = $this->input->post('category');
			}

			if($this->la_model->update($update_data, ['id'=>$id], 'area_options'))
			{
				$this->la_model->delete_area_association($id);
				$this->la_model->insert_option_area_associations($areas, $id);

				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Option Updated Successfully!</div>');
			}
			else $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> Something went wrong, please try again later!</div>');
			redirect(site_url('admin_area_options/edit/'.$id),'refresh');

		}
		$data['edit']=$this->la_model->get_option($id);
		$data['edit_areas']=$this->la_model->get_areas_by_option($id);
		$data['selected_category'] = $id;
		$data['categories'] = $this->la_model->get_category($data['edit']->category_id);
		$data['options'] = $this->la_model->get_options_by_category($data['edit']->category_id);
		$data['areas'] = $this->la_model->get_areas();
		$this->load->template('admin/law_areas/options/admin_area_options', $data);
	}

	public function delete($option_id)
	{
		// redirect($this->input->get('redirect'));
		if(is_numeric($option_id))
		{
			$parent_id = $this->la_model->get_option_parent_id($option_id);

			$check = $this->la_model->delete_area_options($option_id);
			if($check===true)
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Option Deteleted Successfully!</div>');
			else 
			{
				if($check==1)
				{
					$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> Could not delete, this Area has sub-ares/chidren! Please delete them first! </div>');
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> Something went wrong, please try again later! </div>');
				}
			}
			if($this->input->get('redirect')) {redirect($this->input->get('redirect')); return;}
			if($parent_id)
				redirect(site_url('admin_area_options/view/'.$parent_id),'refresh');
			else redirect(site_url('admin_area_options'),'refresh');
		}
	}
}
