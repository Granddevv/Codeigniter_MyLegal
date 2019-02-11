<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_access_for_bids extends CI_Migration {

    public function up()
    {

        $data = array(
            array(
                'class_name'=>'jobs',
                'method_name'=>'cancel_bid',
                'module_name'=>'Cancel Bid',
                ),
            );
        $this->db->insert_batch('module_list', $data);

        $this->db->select('id')->from('module_list')->where('method_name','cancel_bid');
        $q = $this->db->get(); $r = $q->row();

        $data = array(
            array(
                'user_role_id'=>4,
                'module_access'=>$r->id,
                ),
            array(
                'user_role_id'=>3,
                'module_access'=>$r->id,
                ),
            );
        $this->db->insert_batch('user_access', $data);


        $this->db->query('ALTER TABLE `job_bids` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT');
    }
}