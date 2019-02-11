<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_user_id_in_jobs extends CI_Migration {

        public function up()
        {
                $fields = array(
                        'user_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                ),
                        );
                $this->dbforge->add_column('jobs', $fields);

        }

        public function down()
        {

        }
}