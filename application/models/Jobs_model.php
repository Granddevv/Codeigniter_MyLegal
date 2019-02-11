<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs_Model extends CRUD_Model {

	protected $_table = 'jobs';
	protected $_primary_key = 'id';
	// protected $_timestamps = FALSE;
	// protected $_created_on_field = 't_created_on';
	// protected $_updated_on_field = 't_updated_on';
	// protected $_timestamps_format = 'Y-m-d H:i:s';

	public function __construct() {
		parent::__construct();
		
	}

	public function get_job($job_id)
	{
		return $this->get(['id'=>$job_id]);
	}

	public function get_areas($id=NULL)
	{
		if($id) $this->db->where($this->_primary_key, $id);
		$this->db->order_by($this->_primary_key, 'desc');
		$res = $this->db->get('area');
		return $res->result();
	}

	public function get_areas_by_category($category_id)
	{
		$this->db->where('category_id', $category_id);
		$res = $this->db->get('area');
		return $res->result();
	}

	public function insert_job($data)
	{
		if($this->db->insert('jobs', $data))
			return $this->db->insert_id();
		else return false;
	}

	public function insert_areas($data)
	{
		$this->db->insert_batch('job_areas', $data);
	}

	public function insert_job_answers($data)
	{
		$this->db->insert_batch('job_question_answers', $data);
	}

	public function get_status_id($status = 'job-requested')
	{
		$this->db->select('id')->from('job_status')->where('slug', $status);
		$res = $this->db->get();
		$row = $res->row();
		if(count($row)>0){
			return $row->id;
		}
		else return NULL;

	}

	public function get_area_by_selected_options($selected_options)
	{
		$selected_ares = array();
		foreach ($selected_options as $option) {
			
			$this->db->select('area_id')->from('area_option_associations')->where('option_id', $option);
			$res = $this->db->get();
			$res = $res->result();

			foreach ($res as $r) {
				$selected_ares[] = $r->area_id;
			}

		}

		// print_r($areas);
		return $selected_ares;

	}

	public function fetch_user_jobs_by_status($user_id, $status_id=NULL)
	{
		$areas = array();
		if($this->session->userdata('user_role')!=2)
			{ // if user is not client i.e. lawyer
				if($status_id==2) { //job requested 
				// 1.1 get lawyer id from lawyers
					$this->load->model('lawyer_model', 'la');
					$lawyer_id = $this->la->get_lawyer_id($user_id);
					if($lawyer_id)
						$lawyer_id = $lawyer_id[0]->id;
					else redirect('lawyer/registration');

				// 1.2 get area_id  from lawyer_areas
					$this->db->where(['lawyer_id'=>$lawyer_id]);
					$area_q = $this->db->get('lawyer_areas');
					$area_ids = $area_q->result();		

					$area_ids = array_column($area_ids, 'area_id');
				

				// 2.1 get job_ids from job_areas by area_id
					foreach ($area_ids as $area) {
						$this->db->select('*')->from('job_areas ja')->join('jobs j','ja.job_id = j.id');
						$this->db->where(['ja.area_id'=>$area, 'status_id'=>$status_id]);
						$area_q = $this->db->get();
						$res = $area_q->result();		
						if(count($res)>0) $areas[] = $res;
					}
				// 2.2 get all jobs by ids
					$jobs = call_user_func_array('array_merge', $areas);
					return $jobs;
					// echo $status_id;exit;
				// echo $status_id; exit;

				}
				else{
					$this->db->where(['user_id'=>$user_id, 'status_id'=>$status_id]);
					$jobs = $this->db->get($this->_table);
					return $jobs->result();
				}
			}
			else{ // if user is a client
				if($status_id)
				{
					$this->db->where(['user_id'=>$user_id, 'status_id'=>$status_id]);
					$jobs = $this->db->get($this->_table);
					return $jobs->result();
				}
				else{
					$this->db->where(['user_id'=>$user_id]);
					$jobs = $this->db->get($this->_table);
					return $jobs->result();
				}
			}
		}

		public function get_completed_jobs() {
			$this->db->where("status_id", 5);
			$completed_jobs = $this->db->get($this->_table);
			return $completed_jobs->result();
		}

		public function get_area_cat($area_id)
		{
			$this->_table = 'lawyer_profile_categories';
			$res = $this->get(['id'=>$area_id]);
			if(count($res)>0) return $res[0];
		}

		public function get_bid($job_id, $lawyer_id)
		{
			$this->_table = 'job_bids';
			return $this->get(['job_id'=>$job_id, 'lawyer_id'=>$lawyer_id]);
		}

		public function place_bid($data)
		{
			$bid = $this->get_bid($data['job_id'], $data['lawyer_id']);
			if(count($bid)>0)
			{
				//if bid is already placed
				return -1;
			}
			else
			{
				if($this->db->insert('job_bids', $data))
					return $this->db->insert_id();
				else return false;
			}
		}

		public function cancel_bid($bid_id)
		{
			$this->db->where('id', $bid_id);
			if($this->db->delete('job_bids'))return true; 
			else return false;
		}


	}