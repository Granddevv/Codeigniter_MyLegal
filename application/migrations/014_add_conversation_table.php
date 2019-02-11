<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_conversation_table extends CI_Migration {

        public function up()
        {
            $fields = array(
                    'title' => array(
                            'type' => 'TEXT'
                    )
            );

            $this->dbforge->add_field('id');
            $this->dbforge->add_field($fields);
            $this->dbforge->create_table('job_messages_conversation');
        }
}