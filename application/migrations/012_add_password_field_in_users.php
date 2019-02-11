<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_password_field_in_users extends CI_Migration {

        public function up()
        {
                $fields = array(
                        'password' => array(
                                'type' => 'varchar',
                                'constraint' => 150,
                                ),
                        );
                $this->dbforge->add_column('users', $fields);

        }
}