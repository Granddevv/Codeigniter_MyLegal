<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_conversation_id_in_messages extends CI_Migration {

        public function up()
        {
                $fields = array(
                        'conversation_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                ),
                        );
                $this->dbforge->add_column('job_messages', $fields);

        }

        public function down()
        {

        }
}