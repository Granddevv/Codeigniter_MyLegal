<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_job_status extends CI_Migration {

	public function up()
	{
		$this->update_structure();
		$this->feed_data();
	}

	protected function update_structure()
	{
		$fields = array(
			'status' => array(
				'name'=>'name',
				'type'=>'varchar',
				'constraint'=>45
				),
			/*'id' => array(
				'constraint'=>45,
				'auto_increment' => TRUE,
				),*/
			);
		$this->dbforge->modify_column('job_status', $fields);

		/// DROP THE FOREIGN KEY FROM JOB_BIDS 
		//becuase it doesn't let the job_status (id) to be changed
		$this->db->query('ALTER TABLE `job_bids` DROP FOREIGN KEY `fk_job_bids_status_id`');
		/// DROP THE FOREIGN KEY FROM JOBS 
		//becuase it doesn't let the job_status (id) to be changed
		$this->db->query('ALTER TABLE `jobs` DROP FOREIGN KEY `fk_job_status_id`');

		// NOW ADD THE AUTOINCREMENT TO id
		$this->db->query('ALTER TABLE `job_status` CHANGE `id` `id` INT( 11 ) NOT NULL AUTO_INCREMENT ');

		//NOW ADD THE FOREIGN KEY BACK for job_bids
		$this->db->query('ALTER TABLE `job_bids` ADD FOREIGN KEY (status_id) REFERENCES job_status(id) ON UPDATE NO ACTION ON DELETE NO ACTION');

		//NOW ADD THE FOREIGN KEY BACK for jobs
		$this->db->query('ALTER TABLE `jobs` ADD FOREIGN KEY (status_id) REFERENCES job_status(id) ON UPDATE NO ACTION ON DELETE NO ACTION');
	}

	protected function feed_data()
	{
		$data=array(
			array('name'=>'Save as draft', 'slug'=>'draft'),
			array('name'=>'Job Requested', 'slug'=>'job-requested'),
			array('name'=>'Pending Approval', 'slug'=>'pending-approval'),
			array('name'=>'In Progress', 'slug'=>'in-progress'),
			array('name'=>'Complete', 'slug'=>'complete')
			);

		$this->db->insert_batch('job_status',$data);
	}

	public function down()
	{

	}
}