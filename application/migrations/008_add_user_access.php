<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_user_access extends CI_Migration {

        public function up()
        {
                $this->add_user_access_table();
                $this->add_module_list_table();
                $this->fill_module_data();
                $this->fill_access_data();
        }

        protected function add_user_access_table() {
                $fields = array(
                        'user_role_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                        ),
                        'module_access' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                       ),
                );

                $this->dbforge->add_field('id');
                $this->dbforge->add_field($fields);
                $this->dbforge->create_table('user_access');
        }

        protected function add_module_list_table() {
                $fields = array(
                        'class_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 225,
                        ),
                        'method_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 225,
                        ),
                        'module_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 225,
                        ),
                );

                $this->dbforge->add_field('id');
                $this->dbforge->add_field($fields);
                $this->dbforge->create_table('module_list');
        }

        protected function fill_module_data() {
                $data = array(
                        array("class_name" => "jobs", "method_name" => "index", "module_name" => "Job Listing"),
                        array("class_name" => "jobs", "method_name" => "create", "module_name" => "Job Create"),
                        array("class_name" => "mail", "method_name" => "index", "module_name" => "Mail Listing"),
                );

                $this->db->insert_batch("module_list", $data);
        }

        protected function fill_access_data() {
                $data = array(
                        array("user_role_id" => 2, "module_access" => 1),
                        array("user_role_id" => 2, "module_access" => 2),
                        array("user_role_id" => 3, "module_access" => 1),
                        array("user_role_id" => 3, "module_access" => 2),
                );

                $this->db->insert_batch("user_access", $data);
        }
}