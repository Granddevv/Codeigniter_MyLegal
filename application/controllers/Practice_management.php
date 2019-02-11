<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Practice_management extends MY_Controller {
	private $user = "";

	public function __construct() {
		parent::__construct();

		$this->load->model("practice_management_model", "pm");
		$this->user = $this->session->userdata("user_id");
	}

	public function index() {
		$lawyer_information = $this->pm->get_lawyer_information($this->user);
		$practice_id = $lawyer_information->practice_id;

		if($lawyer_information->manager != 1) {
			echo "<h2>Project Manager only have access to this page.</h2>";
			exit();
		}

		$data['p_id'] = $practice_id;
		$data['pending_lawyers'] = $this->get_pending_list($practice_id);
		$data['approved_lawyers'] = $this->get_approved_list($practice_id);

		$this->load->template('pm/index', $data);
	}

	public function view($lawyer_id = FALSE, $sb = 0) {
		$data['show_buttons'] = $sb;
		$data['lawyer_information'] = $this->pm->view_lawyer_information($lawyer_id);

		$this->load->template("pm/view_lawyer", $data);
	}

	public function approve() {
		$retArray = array("status" => 0, "msg" => "Error approving lawyer");
		$lawyer_id = $this->input->post("id");
		if($this->pm->approve_pending_lawyer($lawyer_id)) {
			$lawyer_user_id = $this->pm->view_lawyer_information($lawyer_id)->user_id;
			$this->send_email($this->config->item("accepted_to_practice"), $lawyer_user_id);

			$retArray = array("status" => 1, "msg" => "Lawyer successfully approved", "pendingList" => $this->get_pending_list($this->input->post("p_id")), "approveList" => $this->get_approved_list($this->input->post("p_id")));
		}

		echo json_encode($retArray);
	}

	public function decline() {
		$retArray = array("status" => 1, "msg" => "Error Declining lawyer");
		$lawyer_id = $this->input->post("id");
		if($this->pm->decline_pending_lawyer($lawyer_id)) {
			$retArray = array("status" => 1, "msg" => "Lawyer declined", "pendingList" => $this->get_pending_list($this->input->post("p_id")), "approveList" => $this->get_approved_list($this->input->post("p_id"))); // , "" => );
		}

		echo json_encode($retArray);
	}

	private function get_pending_list($practice_id) {
		$return = "";
		$pending_lawyers = $this->pm->get_part_of_practice($practice_id);
		if($pending_lawyers) {
			foreach($pending_lawyers as $pl) {
				$return .= '<tr><td>'.$pl->name.'</td><td><button class="btn btn-small" onclick="window.location=\''.base_url("practice_management/view/").$pl->id.'/1\'"><i class="fa fa-search"></i> View</button> <button class="btn btn-opp approve_lawyer" rel="'.$pl->id.'"><i class="fa fa-thumbs-up"></i> Approve</button> <button class="btn btn-plain decline_lawyer" rel="'.$pl->id.'"><i class="fa fa-thumbs-down"></i> Decline</button></td></tr>';
			}
		} else {
			$return .= "<tr><td colspan='3'>No Pending Lawyers</td></tr>";
		}

		return $return;
	}

	private function get_approved_list($practice_id) {
		$return = "";
		$approved_lawyers = $this->pm->get_part_of_practice($practice_id, 1);
		if($approved_lawyers) {
			foreach($approved_lawyers as $al) {
				$return .= '<tr><td>'.$al->name.'</td><td><button class="btn btn-small" onclick="window.location=\''.base_url("practice_management/view/").$al->id.'\'"><i class="fa fa-search"></i> View</button> <button class="btn btn-plain btn-small remove_lawyer" rel="'.$al->id.'"><i class="fa fa-trash"></i> Remove</button></td></tr>';
			}
		} else {
			$return .= "<tr><td colspan='3'>No Lawyers</td></tr>";
		}

		return $return;
	}

	public function remove_lawyer() {
		$retArray = array("status" => 1, "msg" => "Error Declining lawyer");
		$lawyer_id = $this->input->post("id");
		if($this->pm->remove_lawyer($lawyer_id)) {
			$retArray = array("status" => 1, "msg" => "Lawyer removed", "pendingList" => $this->get_pending_list($this->input->post("p_id")), "approveList" => $this->get_approved_list($this->input->post("p_id"))); // , "" => );
		}

		echo json_encode($retArray);
	}

	public function billing() {
		$this->load->model("Admin_billing_model", "billing");
		$lawyer_information = $this->pm->get_lawyer_information($this->user);
		$practice_id = $lawyer_information->practice_id;

		$data['billing_list'] = $this->billing->get_billing_list(array("practice_id" => $practice_id));

		$this->load->template("pm/billing", $data);
	}

}