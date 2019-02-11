<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insert_access_data_for_area_categories extends CI_Migration {

        public function up()
        {

                //create module for jobs/find
               $data=array(
                array('class_name'=>'jobs', 'method_name'=>'find', 'module_name'=>'Find Lawyers'),
                );

               $this->db->insert_batch('module_list',$data);


               $this->db->where(array('class_name'=>'jobs', 'method_name'=>'find'));
               $query = $this->db->get('module_list');
               $module_access=$query->row();

               // give user access to jobs/find
               $data=array(
                array('user_role_id'=>2, 'module_access'=>$module_access->id),
                );

               $this->db->insert_batch('user_access',$data);


       }

       public function down()
       {

       }
}