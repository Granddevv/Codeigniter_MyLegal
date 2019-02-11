<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insert_test_users extends CI_Migration {

        public function up()
        {
                $this->add_test_user();
                $this->add_test_admin();
        }

        protected function add_test_user()
        {
                $data = array(
                        'first_name'=>'Test',
                        'last_name'=>'User',
                        'email'=>'test@test.com',
                        'phone'=>'123456789',
                        'user_role_id'=>2,
                        'password'=>hash('sha256', 'test1234'),
                        );
                $this->db->insert('users', $data);
        }

        protected function add_test_admin()
        {
                $data = array(
                        'first_name'=>'Test',
                        'last_name'=>'Admin',
                        'email'=>'admin@test.com',
                        'phone'=>'123456789',
                        'user_role_id'=>1,
                        'password'=>hash('sha256', 'admin1234'),
                        );
                $this->db->insert('users', $data);
        }
}