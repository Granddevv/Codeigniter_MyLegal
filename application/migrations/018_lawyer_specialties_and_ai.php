<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Lawyer_specialties_and_ai extends CI_Migration {

    public function up()
    {
        // $fields = array(
        //         'id' => array(
        //             'auto_increment' => true
        //         )
        // );

        // $this->dbforge->modify_column('lawyer_areas', $fields);

        // $this->db->query('ALTER TABLE `mla_db`.`lawyer_areas` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT');
        

        $fields = array(
                'specialties' => array(
                        'type' => 'TINYINT',
                        'constraints' => 1,
                        'default' => 0
                )
        );

        $this->dbforge->add_column('lawyer_areas', $fields);
    }
}