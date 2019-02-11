<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_dropdown_tables extends CI_Migration {

        public function up()
        {
            $this->dropdown_ethnicity();
            $this->dropdown_gender();
            $this->dropdown_language();
            $this->lawyer_ethnicities();
            $this->lawyer_languages();
        }

        protected function dropdown_ethnicity() {
            $fields = array(
                    'ethnicity' => array(
                        'type'=>'varchar',
                        'constraint'=>125,
                    ),
                    'date_created' => array(
                        'type' => 'datetime'
                    )
            );

            $this->dbforge->add_field('id');
            $this->dbforge->add_field($fields);
            $this->dbforge->create_table('dropdown_ethnicity');
        }

        protected function dropdown_gender() {
            $fields = array(
                    'gender' => array(
                        'type'=>'varchar',
                        'constraint'=>125,
                    ),
                    'date_created' => array(
                        'type' => 'datetime'
                    )
            );

            $this->dbforge->add_field('id');
            $this->dbforge->add_field($fields);
            $this->dbforge->create_table('dropdown_gender');
        }

        protected function dropdown_language() {
            $fields = array(
                    'language' => array(
                        'type'=>'varchar',
                        'constraint'=>125,
                    ),
                    'date_created' => array(
                        'type' => 'datetime'
                    )
            );

            $this->dbforge->add_field('id');
            $this->dbforge->add_field($fields);
            $this->dbforge->create_table('dropdown_language');
        }

        protected function lawyer_ethnicities() {
            $fields = array(
                    'lawyer_id' => array(
                        'type'=>'int'
                    ),
                    'ethnicity_id' => array(
                        'type' => 'int'
                    )
            );

            $this->dbforge->add_field('id');
            $this->dbforge->add_field($fields);
            $this->dbforge->create_table('lawyer_ethnicities');
        }

        protected function lawyer_languages() {
            $fields = array(
                    'lawyer_id' => array(
                        'type'=>'int'
                    ),
                    'language_id' => array(
                        'type' => 'int'
                    )
            );

            $this->dbforge->add_field('id');
            $this->dbforge->add_field($fields);
            $this->dbforge->create_table('lawyer_languages');
        }
}