<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Lawyers_column_and_cron_logs extends CI_Migration {

        public function up()
        {
            $fields = array(
                    'declined' => array(
                            'type' => 'TINYINT',
                            'constraints' => 1,
                            'default' => 0
                    ),
                    'removed' => array(
                            'type' => 'TINYINT',
                            'constraints' => 1,
                            'default' => 0
                    )
            );

            $this->dbforge->add_column('lawyers', $fields);
            $this->cron_logs();
            $this->db->insert("user_roles", array("type" => "Practice Manager", "slug" => "practice_manager"));
        }

        protected function cron_logs() {
            $fields = array(
                'date_performed' => array(
                        'type' => 'DATETIME'
                ),
                'month_performed' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 125,
                ),
                'practices_billed' => array(
                        'type' => 'TEXT'
                ),
            );

            $this->dbforge->add_field('id');
            $this->dbforge->add_field($fields);
            $this->dbforge->create_table('cron_logs');
        }
}