<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Db_changes_for_questions_module_update extends CI_Migration {

	public function up()
	{
		$this->rename_tables();
		$this->replace_keys();
		$this->create_table_lawyer_profile_categories();
	}

	protected function rename_tables()
	{
		$this->dbforge->rename_table('area_questions', 'job_questions');
		$this->dbforge->rename_table('job_area_answers', 'job_question_answers');
		$this->dbforge->rename_table('area_categories', 'categories_of_law');
	}

	protected function replace_keys()
	{
		/////job_questions
 		//remove area_id foreign key replace with area_option(option_id) foreign key
		$this->db->query('ALTER TABLE `job_questions` DROP FOREIGN KEY `fk_questions_area_id`');
		//remove area_id replace with option_id
		$this->dbforge->drop_column('job_questions', 'area_id');
		//add option_id
		$this->dbforge->add_column('job_questions', ['option_id' => ['type' => 'INT', 'constraint' => 11]]);
		//add the f-key for option_id
		$this->db->query('ALTER TABLE `job_questions` ADD FOREIGN KEY (option_id) REFERENCES area_options(id) ON UPDATE NO ACTION ON DELETE NO ACTION');
	}

	protected function create_table_lawyer_profile_categories()
	{
		// create lawyer_profile_categories

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
			'is_main' => array(
				'type' => 'bool',
				'null' => true,
				)
			);
		$this->dbforge->add_field('id');
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('lawyer_profile_categories');

		//drop area category_id foreign key
		$this->db->query('ALTER TABLE `area` DROP FOREIGN KEY `area_ibfk_1`');

		// add f-key to areas
		$this->db->query('ALTER TABLE `area` ADD FOREIGN KEY (category_id) REFERENCES lawyer_profile_categories(id) ON UPDATE NO ACTION ON DELETE NO ACTION');

	}


}