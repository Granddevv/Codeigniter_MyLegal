<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Access_for_viewing_job extends CI_Migration {

    public function up()
    {

        $data = array(
            array(
                'class_name'=>'jobs',
                'method_name'=>'view',
                'module_name'=>'View Job',),
            array(
                'class_name'=>'jobs',
                'method_name'=>'place_bid',
                'module_name'=>'Place Bid on Jobs',),
            );
        $this->db->insert_batch('module_list', $data);

        $this->db->select('id')->from('module_list')->where('method_name','view');
        $q = $this->db->get(); $r = $q->row();

        $this->db->select('id')->from('module_list')->where('method_name','place_bid');
        $qq = $this->db->get(); $rr = $qq->row();

        $data = array(
            array(
                'user_role_id'=>4,
                'module_access'=>$r->id,
                ),
            array(
                'user_role_id'=>3,
                'module_access'=>$r->id,
                ),
            array(
                'user_role_id'=>2,
                'module_access'=>$r->id,
                ),
            array(
                'user_role_id'=>4,
                'module_access'=>$rr->id,
                ),
            array(
                'user_role_id'=>3,
                'module_access'=>$rr->id,
                ),
            );
        $this->db->insert_batch('user_access', $data);
    }
}