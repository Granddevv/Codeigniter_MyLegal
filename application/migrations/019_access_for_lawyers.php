<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Access_for_lawyers extends CI_Migration {

    public function up()
    {

        $data = array(
            'class_name'=>'jobs',
            'method_name'=>'my_jobs',
            'module_name'=>'My Jobs',
            );
        $this->db->insert('module_list', $data);

        $this->db->select('id')->from('module_list')->where('method_name','my_jobs');
        $q = $this->db->get(); $r = $q->row();
        $data = array(
            array(
                'user_role_id'=>4,
                'module_access'=>1,
                ),
             array(
                'user_role_id'=>3,
                'module_access'=>1,
                ),
            array(
                'user_role_id'=>4,
                'module_access'=>$r->id,
                ),
             array(
                'user_role_id'=>3,
                'module_access'=>$r->id,
                )
            );
        $this->db->insert_batch('user_access', $data);
    }
}