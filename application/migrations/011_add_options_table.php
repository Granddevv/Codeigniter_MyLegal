<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_options_table extends CI_Migration {

  public function up()
  {
      $this->create_area_options_table();
      $this->add_foreign_key();
      $this->create_area_and_options_association_table();
  }

  protected function create_area_options_table()
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
        'category_id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'null' => true,
          ),
        'is_main' => array(
          'type' => 'bool',
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
      $this->dbforge->add_field('id');
      $this->dbforge->add_field($fields);
      $this->dbforge->create_table('area_options');
  }

  protected function add_foreign_key()
  {
    // now add the foreign key
      $this->db->query('ALTER TABLE `area_options` ADD FOREIGN KEY (category_id) REFERENCES area_categories(id) ON UPDATE NO ACTION ON DELETE NO ACTION');
  }

  protected function create_area_and_options_association_table()
  {
     $fields = array(
        'option_id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'null' => false,
          ),
        'area_id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'null' => false,
          ),
        );
      $this->dbforge->add_field('id');
      $this->dbforge->add_field($fields);
      $this->dbforge->create_table('area_option_associations');

      // now add the foreign keys
      $this->db->query('ALTER TABLE `area_option_associations` ADD FOREIGN KEY (option_id) REFERENCES area_options(id) ON UPDATE NO ACTION ON DELETE NO ACTION');

      $this->db->query('ALTER TABLE `area_option_associations` ADD FOREIGN KEY (area_id) REFERENCES area(id) ON UPDATE NO ACTION ON DELETE NO ACTION');
  }
  public function down()
  {

  }
}