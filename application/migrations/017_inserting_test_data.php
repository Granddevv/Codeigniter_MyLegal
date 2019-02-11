<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Inserting_test_data extends CI_Migration {

    public function up()
    {
        $this->empty_areas();
        $this->insert_lawyer_profile_categories();
        $this->insert_sub_categories_frontend_sport();
        $this->insert_sub_categories_frontend_contract();

        $this->insert_areas_sports();
        $this->insert_areas_contract();

        //inserting sports options
        $data = array(
            array(
                'name'=>'I have a misconduct/disciplinary hearing and I would like representation',
                'areas'=>array($this->create_slug('Athlete misconduct/disciplinary hearings')),
                ),
            array(
                'name'=>'I need to negotiate or review a sponsorship deal/contract',
                'areas'=>array($this->create_slug('Event Contracts')),
                ),
            );
        $this->insert_options_by_scategory($this->create_slug('I am an athlete'), $data);

        $data = array(
            array(
                'name'=>'I want to protect the intellectual property of the event',
                'areas'=>array($this->create_slug('Intellectual Property')),
                ),
            array(
                'name'=>'I need to arrange contracts with sponsors, suppliers, volunteers or other stakeholders',
                'areas'=>array($this->create_slug('event contracts')),
                ),
            array(
                'name'=>'I need to ensure that I have considered all the legal health and safety requirements for my event ',
                'areas'=>array($this->create_slug('Health & Safety')),
                ),
            );
        $this->insert_options_by_scategory($this->create_slug('I want to organise a sporting event'), $data);


        $data = array(
            array(
                'name'=>'I need help drafting coach, player, volunteer or other contracts ',
                'areas'=>array($this->create_slug('coach/player/volunteer contracts')),
                ),
            array(
                'name'=>'I need to discipline or performance manage a player, volunteer, coach or other staff member/contractor',
                'areas'=>array($this->create_slug('Discipline & performance management')),
                ),
            array(
                'name'=>'I need assistance with governance structures for my sporting organisation',
                'areas'=>array($this->create_slug('Governance')),
                ),
            array(
                'name'=>'I need to draft rules for my sporting organisation',
                'areas'=>array($this->create_slug('drafting rules')),
                ),
            array(
                'name'=>'I want to merge or amalgamate my sports organisation with another one',
                'areas'=>array($this->create_slug('merging/amalgamating organisations')),
                ),
            );
        $this->insert_options_by_scategory($this->create_slug('I work in sports management'), $data);

        //inserting contract options
        $data = array(
            array(
                'name'=>'I need to draft a contract',
                'areas'=>array($this->create_slug('drafting contracts')),
                ),
            array(
                'name'=>'I need to resolve a contractual dispute',
                'areas'=>array(),
                'children'=>array(
                    array(
                        'name'=>'Someone has accused me of breaching a contract',
                        'areas'=>array($this->create_slug('breach of contract')),
                        ),
                    array(
                        'name'=>'Someone has breached a contract that I have with them',
                        'areas'=>array($this->create_slug('breach of contract')),
                        ),
                    )
                ),
            array(
                'name'=>'I need to get out of a contract',
                'areas'=>array($this->create_slug('terminating contracts')),
                ),
            array(
                'name'=>'I need to understand what my contractual obligations are',
                'areas'=>array($this->create_slug('interpreting contracts')),
                ),
            );
        $this->insert_options_by_scategory($this->create_slug('I am an individual'), $data);

       /* //insert child nodes
        $data = array(
            array(
                'name'=>'Someone has accused me of breaching a contract',
                'areas'=>array($this->create_slug('breach of contract')),
                ),
            array(
                'name'=>'Someone has breached a contract that I have with them',
                'areas'=>array($this->create_slug('breach of contract')),
                ),
            );
        $this->insert_options_by_option_slug($this->create_slug('I need to resolve a contractual dispute'), $data);
*/

        $this->insert_options_by_scategory($this->create_slug('I am a small or medium-sized business/company'), $data);
        $this->insert_options_by_scategory($this->create_slug('I am a large business/company'), $data);

        $this->add_test_lawyer();
    }

    protected function empty_areas() {
            //1. remove problematic foreign keys            
        
    }

    protected function insert_lawyer_profile_categories() {
        $data = array(
            array("name" => "Contract", "slug" => "contract", "is_main"=> 1),
            array("name" => "Sports", "slug" => "sports", "is_main"=> 1),
            );

        $this->db->insert_batch("lawyer_profile_categories", $data);
    }

    protected function insert_sub_categories_frontend_sport() {
        $this->db->select('id')->from('categories_of_law')->where('slug','sports');
        $q = $this->db->get();
        $r = $q->row();
        // print_r($r); 
        if(count($r)>0)
        {
            $data = array(
                array("name" => "I am an athlete", "slug" => $this->create_slug('I am an athlete'), "parent_id"=> $r->id),
                array("name" => "I want to organise a sporting event", "slug" => $this->create_slug('I want to organise a sporting event'), "parent_id"=> $r->id),
                array("name" => "I work in sports management", "slug" => $this->create_slug('I work in sports management'), "parent_id"=> $r->id),
                );
            $this->db->insert_batch("categories_of_law", $data);
        }
        else echo 'no category of law (frontend) found named sports';
        
    }

    protected function insert_sub_categories_frontend_contract() {
        $this->db->select('id')->from('categories_of_law')->where('slug','contract');
        $q = $this->db->get();
        $r = $q->row();
        // print_r($r); 
        if(count($r)>0)
        {
            $data = array(
                array("name" => "I am an individual", "slug" => $this->create_slug('I am an individual'), "parent_id"=> $r->id),
                array("name" => "I am a small or medium-sized business/company", "slug" => $this->create_slug('I am a small or medium-sized business/company'), "parent_id"=> $r->id),
                array("name" => "I am a large business/company", "slug" => $this->create_slug('I am a large business/company'), "parent_id"=> $r->id),
                );
            $this->db->insert_batch("categories_of_law", $data);
        }
        else echo 'no category of law (frontend) found named sports';
        
    }

    protected function insert_areas_sports() {
        $this->db->select('id')->from('lawyer_profile_categories')->where('slug','sports');
        $q = $this->db->get();
        $r = $q->row();
        // print_r($r); 
        if(count($r)>0)
        {
            $data = array(
                array("name" => "Discipline & Performance management", "slug" => $this->create_slug('Discipline & Performance management'), 'category_id'=> $r->id),
                array("name" => "Athlete misconduct/disciplinary hearings", "slug" => $this->create_slug('Athlete misconduct/disciplinary hearings'), 'category_id'=> $r->id),
                array("name" => "Event Contracts", "slug" => $this->create_slug('Event Contracts'), 'category_id'=> $r->id),
                array("name" => "Intellectual Property", "slug" => $this->create_slug('Intellectual Property'), 'category_id'=> $r->id),
                array("name" => "Health & Safety", "slug" => $this->create_slug('Health & Safety'), 'category_id'=> $r->id),
                array("name" => "Governance", "slug" => $this->create_slug('Governance'), 'category_id'=> $r->id),
                array("name" => "Sponsorship deals & contracts", "slug" => $this->create_slug('Sponsorship deals & contracts'), 'category_id'=> $r->id),
                array("name" => "Coach/player/volunteer contracts", "slug" => $this->create_slug('Coach/player/volunteer contracts'), 'category_id'=> $r->id),
                array("name" => "Drafting Rules", "slug" => $this->create_slug('Drafting Rules'), 'category_id'=> $r->id),
                array("name" => "Merging/Amalgamating Organisations", "slug" => $this->create_slug('Merging/Amalgamating Organisations'), 'category_id'=> $r->id),
                );
            $this->db->insert_batch("area", $data);
        }
        else echo 'no categories_of_law found named sports';
        
    }

    protected function insert_areas_contract() {
        $this->db->select('id')->from('lawyer_profile_categories')->where('slug','contract');
        $q = $this->db->get();
        $r = $q->row();
        // print_r($r); 
        if(count($r)>0)
        {
            $data = array(
                array("name" => "Drafting contracts", "slug" => $this->create_slug('drafting contracts'), 'category_id'=> $r->id),
                array("name" => "Breach of contract", "slug" => $this->create_slug('breach of contract'), 'category_id'=> $r->id),
                array("name" => "Terminating contracts", "slug" => $this->create_slug('terminating contracts'), 'category_id'=> $r->id),
                array("name" => "Interpreting contracts", "slug" => $this->create_slug('interpreting contracts'), 'category_id'=> $r->id),
                );
            $this->db->insert_batch("area", $data);
        }
        else echo 'no categories_of_law found named sports';
        
    }
    
    protected function insert_options_by_scategory($category, $data)
    {
      $this->db->select('id')->from('categories_of_law')->where('slug', $category);
      $q = $this->db->get();
      $r = $q->row();

      if(count($r)>0)
      {
        $this->insert_options($data, $r->id);
    }
    else echo 'no categories_of_law named '.$category;
} 

protected function insert_options_by_option_slug($slug, $data)
{
  $this->db->select('id')->from('area_options')->where('slug', $slug);
  $q = $this->db->get();
  $r = $q->row();

  if(count($r)>0)
  {
    $this->insert_child_option($data, $r->id);
}
else echo 'no categories_of_law named '.$category;
} 

protected function insert_options($data, $id)
{
    foreach ($data as $option) {
            ////insert option
        $insert_data = array('name'=>$option['name'], 'slug'=>$this->create_slug($option['name']), 'is_main'=>1, 'category_id'=>$id);
        $this->db->insert('area_options', $insert_data);
        $iid = $this->db->insert_id();

            //insert area_option_associations
        foreach ($option['areas'] as $area) {
            $area_id = $this->get_area_id_by_slug($area);
            // echo '<br>'.$area.'('.$area_id.')<br>';
            $insert_data = array('area_id'=>$area_id, 'option_id'=>$iid);
            $this->db->insert('area_option_associations', $insert_data);
        }

        if(isset($option['children']))
        {
            $this->insert_child_option($option['children'], $iid);
        }

    }
}

protected function insert_child_option($data, $id)
{
    foreach ($data as $option) {
            ////insert option
        $insert_data = array('name'=>$option['name'], 'slug'=>$this->create_slug($option['name']), 'parent_id'=>$id);
        $this->db->insert('area_options', $insert_data);
        $iid = $this->db->insert_id();

            //insert area_option_associations
        foreach ($option['areas'] as $area) {
            $area_id = $this->get_area_id_by_slug($area);
            // echo '<br>'.$area.'('.$area_id.')<br>';
            $insert_data = array('area_id'=>$area_id, 'option_id'=>$iid);
            $this->db->insert('area_option_associations', $insert_data);
        }

    }
}

protected function add_test_lawyer()
        {
                $data = array(
                        'first_name'=>'Test',
                        'last_name'=>'Lawyer',
                        'email'=>'lawyer@test.com',
                        'phone'=>'123456789',
                        'user_role_id'=>3,
                        'password'=>hash('sha256', 'lawyer1234'),
                        );
                $this->db->insert('users', $data);
        }


protected function create_slug($text)
{
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);
  if (empty($text))
    return 'n-a';

return $text;
}

protected function get_area_id_by_slug($area_slug)
{
    $this->db->select('id')->from('area')->where('slug', $area_slug);
    $q = $this->db->get();
    $r = $q->row();
    // echo $r->id;
    return $r->id;
}

}