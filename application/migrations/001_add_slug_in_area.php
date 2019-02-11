<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_slug_in_area extends CI_Migration {

        public function up()
        {
                $fields = array(
                        'slug' => array(
                                'type' => 'varchar',
                                'constraint' => 45,
                                ),
                        );
                $this->dbforge->add_column('area', $fields);
        }

        public function down()
        {

        }
}