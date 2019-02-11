<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_job_messages_conversation extends CI_Migration {

    public function up()
    {
        $fields = array(
                'room_name' => array(
                        'type' => 'TEXT'
                )
        );

        $this->dbforge->add_column('job_messages_conversation', $fields);
    }
}