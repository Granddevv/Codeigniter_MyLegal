<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Modify_areas extends CI_Migration {

        public function up()
        {

               $this->create_area_categories_table();
               $this->add_columns();
               $this->feed_data_for_categories();
        }

        protected function create_area_categories_table()
        {
                 $fields = array(
                        'name' => array(
                                'type'=>'varchar',
                                'constraint'=>100,
                                ),
                        'slug' => array(
                                'type'=>'varchar',
                                'constraint'=>100,
                                'null'=>true,
                                ),
                        'parent_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'null' => true,
                                ),
                        'user_label' => array(
                                'type' => 'varchar',
                                'constraint' => 150,
                                'null' => true,
                                ),
                        'lawyer_label' => array(
                                'type' => 'varchar',
                                'constraint' => 150,
                                'null' => true,
                                ),
                        );
                $this->dbforge->add_field($fields);
                $this->dbforge->add_field('id');
                $this->dbforge->create_table('area_categories');
        }

        protected function add_columns()
        {
                 $fields = array(                    
                        'user_label' => array(
                                'type' => 'varchar',
                                'constraint' => 150,
                                'null' => true,
                                ),
                        'lawyer_label' => array(
                                'type' => 'varchar',
                                'constraint' => 150,
                                'null' => true,
                                ),
                        'category_id' => array(
                                'type'=>'INT',
                                'constraint'=>11,
                                ),
                        );
                $this->dbforge->add_column('area', $fields);
                // now add the foreign key
                $this->db->query('ALTER TABLE `area` ADD FOREIGN KEY (category_id) REFERENCES area_categories(id) ON UPDATE NO ACTION ON DELETE NO ACTION');

                // $this->db->truncate('area');
        }

        protected function feed_data_for_categories()
        {
                 $data=array(
                        array('name'=>'ACC', 'slug'=>'acc'),
                        array('name'=>'Banking and Finance', 'slug'=>'banking-and-finance'),
                        array('name'=>'Business (Corporate and Commercial)', 'slug'=>'business-corporate-and-commercial'),
                        array('name'=>'Charities and Incorporated Societies', 'slug'=>'charities-and-incorporated-societies'),
                        array('name'=>'Construction', 'slug'=>'construction'),
                        array('name'=>'Consumer Law', 'slug'=>'consumer-aw'),
                        array('name'=>'Contract', 'slug'=>'contract'),
                        array('name'=>'Criminal (inc Land Transport Act/Traffic matters)', 'slug'=>'criminal-inc-land-transport-act-traffic-matters)'),
                        array('name'=>'Education', 'slug'=>'education'),
                        array('name'=>'Employment', 'slug'=>'employment'),
                        array('name'=>'Environmental, Planning and Resource Management', 'slug'=>'environmental-planning-and-resource-management'),
                        array('name'=>'Family', 'slug'=>'family'),
                        array('name'=>'Human Rights', 'slug'=>'human-rights'),
                        array('name'=>'Housing', 'slug'=>'housing'),
                        array('name'=>'Immigration', 'slug'=>'immigration'),
                        array('name'=>'Insurance and Superannuation', 'slug'=>'insurance-and-superannuation'),
                        array('name'=>'Intellectual Property and Patents', 'slug'=>'intellectual-property-and-patents'),
                        array('name'=>'International', 'slug'=>'international'),
                        array('name'=>'Maori and Treaty of Waitangi', 'slug'=>'maori-and-treaty-of-waitangi'),
                        array('name'=>'Media and Entertainment', 'slug'=>'media-and-entertainment'),
                        array('name'=>'Mediation and Alternative Dispute Resolution', 'slug'=>'mediation-and-alternative-dispute-resolution'),
                        array('name'=>'Medical or Health', 'slug'=>'medical-or-health'),
                        array('name'=>'Privacy and Information', 'slug'=>'privacy-and-information'),
                        array('name'=>'Property', 'slug'=>'property'),
                        array('name'=>'Public (Government, Local Council and Regulatory)', 'slug'=>'public-government-local-council-and-regulatory'),
                        array('name'=>'Sports', 'slug'=>'sports'),
                        array('name'=>'Tax', 'slug'=>'tax'),
                        array('name'=>'Technology', 'slug'=>'technology'),
                        array('name'=>'Tort (private claims for damages)', 'slug'=>'tort-private-claims-for-damages'),
                        array('name'=>'Wills, Trusts and Estates', 'slug'=>'wills-trusts-and-estates')
                        );

                $this->db->insert_batch('area_categories',$data);
        }

        public function down()
        {

        }
}