<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends MY_Controller {
    private $month_today = "";
    private $monthly_billing_type = 1;
    private $job_billing_type = 2;

	public function __construct() {
		parent::__construct();
        
        $this->load->model("Admin_settings_model", "fees");
        $this->load->model("Admin_billing_model", "billing");
        $this->load->model('lawyer_model', 'lawyer');
        $this->load->model('jobs_model', 'jobs');
        $this->load->model('practice_management_model', 'practice_management');
        $this->month_today = date("n");
	}

	public function index() {
        $monthly_fee = $this->fees->fee_settings()[0]->monthly_fee;
        $date_today = date("Y-m-d H:i:s");
        $practices = $this->lawyer->get_all_data("practices");
        $practices_billed = array();

        $jobs = $this->jobs->get_completed_jobs();

        foreach($practices as $p) {
            if(!$this->billing->check_billing(array("practice_id" => $p->id, "billing_type_id" => $this->monthly_billing_type, "MONTH(billing_month)" => $this->month_today, "MONTH(billing_month) <>" => 0))) {
                $l_count = count($this->practice_management->get_part_of_practice($p->id, 1, TRUE));
                $monthly_billing = array(
                    "practice_id" => $p->id,
                    "billing_type_id" => $this->monthly_billing_type,
                    "amount" => ($monthly_fee*$l_count),
                    "billing_month" => $date_today
                );

                if($this->billing->save_billing($monthly_billing)) {
                    $practices_billed[] = $p->id;
                }
            }
        }

        $cron_data = array(
            "date_performed" => $this->fees->freshTimestamp(),
            "month_performed" => $this->month_today,
            "practices_billed" => implode(",", $practices_billed),
        );

        $this->billing->cron_logs($cron_data);

        echo "Success";
	}

}
