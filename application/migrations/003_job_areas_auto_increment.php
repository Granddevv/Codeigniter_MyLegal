<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Job_areas_auto_increment extends CI_Migration {

        public function up()
        {
                $fields = array(
                        'id' => array(
                                'type'=>'INT',
                                'constraint'=>11,
                                'auto_increment' => TRUE
                                ),
                        );
                $this->dbforge->modify_column('job_areas', $fields);
        }

        public function down()
        {

        }
}