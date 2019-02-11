<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_template_tables extends CI_Migration {

        public function up()
        {
            $fields = array(
                    'template_name' => array(
                        'type'=>'varchar',
                        'constraint'=>225,
                    ),
                    'subject' => array(
                        'type'=>'varchar',
                        'constraint'=>225,
                    ),
                    'content' => array(
                        'type'=>'TEXT'
                    ),
                    'mandrill_template' => array(
                        'type'=>'varchar',
                        'constraint'=>225,
                    ),
                    'created_by' => array(
                        'type' => 'int'
                    ),
                    'date_created' => array(
                        'type' => 'datetime'
                    )
            );

            $this->dbforge->add_field('id');
            $this->dbforge->add_field($fields);
            $this->dbforge->create_table('email_template');

            $fields = array(
                    'logs' => array(
                        'type'=>'TEXT'
                    ),
                    'email_msg' => array(
                        'type' => 'TEXT'
                    ),
                    'template_id' => array(
                        'type'=>'int'
                    ),
                    'status' => array(
                        'type'=>'VARCHAR',
                        'constraint'=>225,
                    ),
                    'to' => array(
                        'type'=>'TEXT'
                    ),
                    'subject' => array(
                        'type'=>'TEXT'
                    ),
                    'sent_by' => array(
                        'type' => 'int'
                    ),
                    'date_created' => array(
                        'type' => 'datetime'
                    )
            );

            $this->dbforge->add_field('id');
            $this->dbforge->add_field($fields);
            $this->dbforge->create_table('email_logs');


            $this->db->query("insert  into `email_template`(`id`,`template_name`,`subject`,`content`,`mandrill_template`,`created_by`,`date_created`) values (1,'Lawyer Signup','Thank you for signing up','<p>Hi Mr. ||first_name|| ||last_name||,</p><p><br></p><p>Your email is ||email|| for ||practice_name||</p><p><br></p><p>Regards,<br>ABC Company<br></p>','global-template',0,'0000-00-00 00:00:00'),(2,'Client Signup','Thank you client','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod \ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim \nveniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea \ncommodo consequat. Duis aute irure dolor in reprehenderit in voluptate \nvelit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint \noccaecat cupidatat non proident, sunt in culpa qui officia deserunt \nmollit anim id est laborum<br></p>','global-template',0,'0000-00-00 00:00:00'),(3,'Forgot Password','Forgot Password','<p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod \ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim \nveniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea \ncommodo consequat. Duis aute irure dolor in reprehenderit in voluptate \nvelit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint \noccaecat cupidatat non proident, sunt in culpa qui officia deserunt \nmollit anim id est laborum<br></p><p><br></p>','global-template',0,'0000-00-00 00:00:00'),(4,'Reset Password','Reset Password','<p><br></p><p><br></p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod \ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim \nveniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea \ncommodo consequat. Duis aute irure dolor in reprehenderit in voluptate \nvelit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint \noccaecat cupidatat non proident, sunt in culpa qui officia deserunt \nmollit anim id est laborum<br></p><p><br></p><p><br></p><p><br></p>','global-template',0,'0000-00-00 00:00:00'),(5,'New Job Posted','New Job Posted','<p><br></p><p data-pm-context=\"[]\">New Job Posted - Client notification</p><p><br></p>','global-template',0,'0000-00-00 00:00:00'),(6,'New Job Posted - Relevant Lawyers Notification','New Job Posted - Relevant Lawyers Notification','<p><br></p><p data-pm-context=\"[]\">New Job Posted - Relevant Lawyers Notification</p><p><br></p>','global-template',0,'0000-00-00 00:00:00'),(7,'Bid Submitted - Client notification','Bid Submitted - Client notification','<p><br></p><p data-pm-context=\"[]\">Bid Submitted - Client notification</p><p><br></p>','global-template',0,'0000-00-00 00:00:00'),(8,'Bid Accepted / Job in progress - Client notification','Bid Accepted / Job in progress - Client notification','<p><br></p><p data-pm-context=\"[]\">Bid Accepted / Job in progress - Client notification</p><p><br></p>','global-template',0,'0000-00-00 00:00:00'),(9,'Bid Accepted / Job in progress - Lawyer notification','Bid Accepted / Job in progress - Lawyer notification','<p><br></p><p data-pm-context=\"[]\">Bid Accepted / Job in progress - Lawyer notification</p><p><br></p>','global-template',0,'0000-00-00 00:00:00'),(10,'Bid Unsuccessful - Unsuccessful Lawyers bids once another lawyers bid is approved','Bid Unsuccessful - Unsuccessful Lawyers bids once another lawyers bid is approved','<p><br></p><p data-pm-context=\"[]\">Bid Unsuccessful - Unsuccessful Lawyers bids once another lawyers bid is approved</p><p><br></p>','global-template',0,'0000-00-00 00:00:00'),(11,'New Message notification for client / lawyer only notified on first contact','New Message notification for client / lawyer only notified on first contact','<p><br></p><p data-pm-context=\"[]\">New Message notification for client / lawyer only notified on first contact</p><p><br></p>','global-template',0,'0000-00-00 00:00:00'),(12,'Notification of Lawyer requesting to Join Practice - sent Practice manager','Notification of Lawyer requesting to Join Practice - sent Practice manager','<p><br></p><p data-pm-context=\"[]\">Notification of Lawyer requesting to Join Practice - sent Practice manager</p><p><br></p>','global-template',0,'0000-00-00 00:00:00'),(13,'Notification of Lawyer accepted to Practice - Sent to requesting lawyer','Notification of Lawyer accepted to Practice - Sent to requesting lawyer','Congratulation ||first_name|| ||last_name|| You have been accepted to ||practice_name||<br>','global-template',0,'0000-00-00 00:00:00')");
        }
}