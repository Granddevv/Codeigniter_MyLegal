<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_dummy_data extends CI_Migration {

        public function up()
        {
               $this->run_areas_migration();
               $this->run_user_roles_migration();
               $this->run_billing_types_migration();
        }

        protected function run_areas_migration()
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

                $this->db->insert_batch('area',$data);
        }

        protected function run_user_roles_migration()
        {
                 $data=array(
                        array('type'=>'admin', 'slug'=>'admin'),
                        array('type'=>'user', 'slug'=>'user'),
                        array('type'=>'lawyer', 'slug'=>'lawyer')
                        );

                $this->db->insert_batch('user_roles',$data);
        }

        protected function run_billing_types_migration()
        {
                $data=array(
                        array('name'=>'monthly lawyer fee', 'slug'=>'monthly-lawyer-fee'),
                        array('name'=>'job fee', 'slug'=>'job-fee'),
                        array('name'=>'initial sign up', 'slug'=>'initial-sign-up')
                        );

                $this->db->insert_batch('billing_types',$data);
        }

        public function down()
        {

        }
}