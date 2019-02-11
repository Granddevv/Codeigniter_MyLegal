<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_title_in_job extends CI_Migration {

        public function up()
        {
                $fields = array(
                        'title' => array(
                                'type' => 'varchar',
                                'constraint' => 255,
                                'null' => false
                                ),
                        );
                $this->dbforge->add_column('jobs', $fields);

        }
}