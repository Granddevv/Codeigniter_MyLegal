<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('jobs_model');
		$this->load->model('law_areas_model', 'la_model');
	}

	public function index($status=NULL) {
		$this->session->unset_userdata(array('selected_options', 'questions_answers', 'selected_options', 'selected_category', 'selected_sub_category'));
		$this->load->template('job/index');
	}

	public function create($area_id=NULL) {
		if($area_id) $this->session->set_userdata('selected_area', $area_id);

		$this->form_validation->set_rules('title', 'Job Title', 'required');
		$this->form_validation->set_rules('about', 'Details', 'required');
		$this->form_validation->set_rules('expiry', 'Expiry Date', 'required|min_length[8]');
		$areas_selected = $this->jobs_model->get_area_by_selected_options($this->session->selected_options);
		if($this->input->post())
		{
			if($this->form_validation->run()==true)
			{
				$insert_data['title'] = $this->input->post('title', true);
				$insert_data['about'] = $this->input->post('about', true);
				$insert_data['pro_bono'] = $this->input->post('pro_bono', true);
				$insert_data['budget'] = $this->input->post('budget', true);
				$date=$insert_data['expiry'] = Date("Y-m-d", strtotime($this->input->post('expiry', true)));
				$insert_data['language'] = $this->input->post('language', true);
				$insert_data['ethnicity'] = $this->input->post('ethnicity', true);
				$insert_data['gender'] = $this->input->post('gender', true);
				$insert_data['status_id'] = $this->jobs_model->get_status_id();
				$insert_data['user_id'] = $this->session->user_id;
				// $areas = $this->input->post('areas', true);

				$areas_selected = $this->jobs_model->get_area_by_selected_options($this->session->selected_options);

				if($job_id = $this->jobs_model->insert_job($insert_data))
				{
					// record areas_selected
					if($areas_selected)
					{
						foreach($areas_selected as $area)
						{
							$insert_areas_data[] = array('job_id'=>$job_id, 'area_id'=>$area);
						}
						$this->jobs_model->insert_areas($insert_areas_data);
					}

					//record answers of the questions
					$questions_answered = $this->session->questions_answers;
					if($questions_answered)
					{
						foreach ($questions_answered as $answers) {
						// print_r($answers); exit;
							$i_data[] = array('job_id'=>$job_id, 'area_question_id'=>$answers['question_id'], 'answer'=>$answers['answer']);
						// $i_data[]['job_id'] = $job_id;
						// $i_data[]['area_question_id'] = $answers['question_id'];
						// $i_data[]['answer'] = $answers['answer'];
						}
					// print_r($i_data); exit;
						$this->jobs_model->insert_job_answers($i_data);
					}

					$data['response'] = TRUE;
				}
				else $data['response'] = FALSE;

			}else{
				$data['response'] = validation_errors();
			}

		}
		// $data['areas'] = $this->jobs_model->get_areas();
		if(!$this->session->selected_category && !$this->session->selected_options) redirect('jobs/find');
		$data['selected_category'] = $this->la_model->get_category($this->session->selected_category);
		$data['selected_sub_category'] = $this->la_model->get_category($this->session->selected_sub_category);
		$data['selected_area'] = $this->la_model->get_area($this->session->selected_area);
		$this->load->template('job/create', $data);

	}

	public function my_jobs($filter='all')
	{
		if($this->session->userdata('user_role')!=2 && $filter=='all')  $filter = 'requested';
		$this->load->library('pagination');

		$config['base_url'] = site_url('jobs/my_jobs/'.$filter);

		// $user_id = 1;
		$data = array();
		if($filter=='active')
		{
			$status_id = $this->jobs_model->get_status_id('in-progress'); //4

		}
		else if($filter=='pending')
		{
			$status_id = $this->jobs_model->get_status_id('pending-approval'); //3
			
		}
		else if($filter=='completed')
		{
			$status_id = $this->jobs_model->get_status_id('complete'); //5
		}
		else if($filter=='draft')
		{
			$status_id = $this->jobs_model->get_status_id('draft'); //1
		}
		else if($filter=='requested')
		{
			$status_id = $this->jobs_model->get_status_id('job-requested'); //2
		}
		else
		{
			$status_id = NULL;
		}
		$data['jobs'] = $this->jobs_model->fetch_user_jobs_by_status($this->session->user_id, $status_id);
		$config['total_rows'] = count($data['jobs']);
		$config['per_page'] = 4;
		$config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$this->pagination->initialize($config);
		// echo "<pre>";
		// print_r($data['jobs']); exit;
		$this->load->template('job/my_jobs', $data);
	}

	public function view($job_id)
	{
		$data['job'] = $this->jobs_model->get_job($job_id);
		$data['areas'] = $this->jobs_model->get_areas($job_id);
		$data['area_cat'] = $this->jobs_model->get_area_cat($data['areas'][0]->category_id);
		$this->load->model('lawyer_model','la');
		$lawyer_id = $this->la->get_lawyer_id($this->session->userdata('user_id'));
		if(count($lawyer_id)>0) 
		{
			$lawyer_id = $lawyer_id[0]->id;
			$data['my_bid'] = $this->jobs_model->get_bid($job_id, $lawyer_id);
		}
		$this->load->template('job/view', $data);
	}

	public function place_bid($job_id)
	{
		if($this->session->userdata('user_id') && $this->session->userdata('user_role')!=2){
			$data['job'] = $this->jobs_model->get_job($job_id);
			if($this->input->post())
			{
			// $inser_data['status_id'] = $this->input->post('status_id', true);
				$this->load->model('lawyer_model', 'la');
				$lawyer_id = $this->la->get_lawyer_id($this->session->userdata('user_id'));
				if(count($lawyer_id)>0) $lawyer_id = $lawyer_id[0]->id;

				$inser_data['price'] = $this->input->post('price', true);
				$inser_data['pro_bono'] = $this->input->post('pro_bono', true);
				$inser_data['proposal'] = $this->input->post('proposal', true);
				$inser_data['lawyer_id'] = $lawyer_id;
				$inser_data['job_id'] = $job_id;
				$inser_data['status_id'] = ($data['job'][0]->status_id);

				$check = $this->jobs_model->place_bid($inser_data);
			if($check==-1){ //already placed
				$this->session->flashdata('message', '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> You have alread placed a bid on this job!</div>');
			}
			else if($check) //success
			{
				$this->session->flashdata('message', '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> You have alread placed a bid on this job!</div>');
			}
			else {
				$this->session->flashdata('message', '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> Your bid could not be placed, please try again later!</div>');
			}
			redirect(site_url('jobs/view/'.$job_id));
		}



		// $data['areas'] = $this->jobs_model->get_areas($job_id);
		// $data['area_cat'] = $this->jobs_model->get_area_cat($data['areas'][0]->category_id);
		$this->load->template('job/bid', $data);
	}
	else echo "You are not authorized to bid!";

}

public function cancel_bid($job_id, $bid_id)
{
	if($this->session->userdata('user_role')!=2)
	{
		if($this->jobs_model->cancel_bid($bid_id))
			redirect(site_url('jobs/view/'.$job_id));
	}
	else redirect(site_url('jobs/view/'.$job_id));
}

public function find($page=NULL, $id=NULL)
{
		if($page==NULL && $id ==NULL) //shows categories
		{
			$data['categories'] = $this->la_model->get_categories(true);
			$this->load->template('job/find_lawyer', $data);
		}
		else if($page=='category' && $id) //shows sub category
		{
			$this->session->set_userdata('selected_category', $id);
			$data['category'] = $this->la_model->get_category($id);
			$data['sub_categories'] = $this->la_model->get_sub_categories($id);
			$this->load->template('job/list_area_subcategories', $data);
		}
		else if($page=='select_options' && $id) // shows job areas
		{
			$this->session->set_userdata('selected_sub_category', $id);
			$category_data = $this->la_model->get_category($id);
			$data['category'] = $category_data;
			$data['parent_category'] = $this->la_model->get_category($category_data->parent_id);
			$data['options'] = $this->la_model->get_options_by_category($id);
			$this->load->template('job/select_options', $data);
		}
		else if($page=='select_next_options' && $id) // shows job areas
		{
			/*if(!$this->session->selected_options)
				$selected_options = array();
			else $selected_options = $this->session->selected_options;
			$d = array_push($selected_options, $id);
			$this->session->set_userdata('selected_options', $id);*/
			$_SESSION['selected_options'][] = $id;
			$data['page'] = $page;
			$data['current'] = $this->la_model->get_option($id);
			$data['category'] = $this->la_model->get_option($id);
			$data['options'] = $this->la_model->get_option_children($id);
			$this->load->template('job/select_options', $data);
		}
	}

	public function questions($step=NULL)
	{
		if($this->input->post())
		{
			$question_ids = $this->session->job_questions;
			if($step>0) $question_id = $question_ids[$step-1]; else $question_id = $question_ids[$step];

			$record = array('question_id' => $question_id, 'answer'=>$this->input->post('answer'));
			$_SESSION['questions_answers'][] = $record; 
		}
		if(!$step){
			$selected_options = $this->session->selected_options;
			$last_selected_option = $selected_options[count($selected_options)-1]; //get option id
			//fetch option areas attached
			//fetch area questions
			$question_ids =$this->la_model->get_questions_by_option($last_selected_option);
			$question_ids = array_column($question_ids, 'id');
			// print_r(array_column($question_ids, 'id')); exit;
			$this->session->set_userdata('job_questions', $question_ids);
			$data['question'] = $this->la_model->get_question($question_ids[0]);
		}
		else{
			$question_ids = $this->session->job_questions;
			// print_r($question_ids); exit;
			$data['question'] = $this->la_model->get_question($question_ids[$step]);
		}

		$this->load->template('job/job_questions', $data);
	}

}
