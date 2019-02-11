<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_lawyer_interest_table extends CI_Migration {

        public function up()
        {
            $fields = array(
                'name' => array(
                        'type' => 'text',
                        'constraint'=>100,
                        'null'=>false
                ),
                'email' => array(
                        'type' => 'text',
                        'constraint'=>150,
                        'null'=>false
                ),
                'mobile' =>array(
                        'type' => 'text',
                        'constraint'=>100,
                        'null'=>true
                ),
            );

            $this->dbforge->add_field('id');
            $this->dbforge->add_field($fields);
            $this->dbforge->create_table('lawyer_interest_registration');
        }

}