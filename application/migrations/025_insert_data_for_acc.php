<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insert_data_for_acc extends CI_Migration {

    public function up()
    {
        $this->insert_lawyer_profile_categories();
        $this->insert_sub_categories_frontend_acc();
        $this->insert_areas_acc();

        //inserting sports options
        $data = array(
            array(
                'name'=>'I was injured at work ',
                'areas'=>array($this->create_slug('ACC General')),
                ),
            array(
                'name'=>'I was injured at home',
                'areas'=>array($this->create_slug('ACC General')),
                ),
            array(
                'name'=>'ACC has previously covered me and I want this cover to continue',
                'areas'=>array($this->create_slug('ACC General')),
                ),
            );
        $this->insert_options_by_scategory($this->create_slug('I want to know if I am going to be covered by ACC'), $data);

        $data = array(
            array(
                'name'=>'I have already tried to claim through ACC',
                'areas'=>array($this->create_slug('ACC General')),
                ),
            array(
                'name'=>'I haven’t tried to claim through ACC yet',
                'areas'=>array(),
                ),
            );
        $this->insert_options_by_scategory($this->create_slug('I need assistance lodging a claim with ACC'), $data);

         $data = array(
            array(
                'name'=>'My accident or injury was in the last 12 months',
                'areas'=>array($this->create_slug('ACC General')),
                ),
            array(
                'name'=>'My accident or injury was not in the last 12 months',
                'areas'=>array($this->create_slug('ACC General')),
                ),
            );
        $this->insert_options_by_option_slug($this->create_slug('I haven’t tried to claim through ACC yet'), $data);


        $data = array(
            array(
                'name'=>'ACC have already reviewed my claim',
                'areas'=>array($this->create_slug('ACC Appeals')),
                ),
            array(
                'name'=>'I have already attended a mediation',
                'areas'=>array($this->create_slug('ACC Appeals')),
                ),
            array(
                'name'=>'I have not yet taken any steps to challenge ACC’s decision or resolve my issue with ACC',
                'areas'=>array($this->create_slug('ACC Appeals')),
                ),
            );
        $this->insert_options_by_scategory($this->create_slug('I want to challenge a decision made by ACC'), $data);
    }
    
    protected function insert_lawyer_profile_categories() {
        $data = array(
            array("name" => "ACC", "slug" => "acc", "is_main"=> 1),
            );

        $this->db->insert_batch("lawyer_profile_categories", $data);
    }

    protected function insert_sub_categories_frontend_acc() {
        $this->db->select('id')->from('categories_of_law')->where('slug','acc');
        $q = $this->db->get();
        $r = $q->row();
        // print_r($r); 
        if(count($r)>0)
        {
            $data = array(
                array("name" => "I want to know if I am going to be covered by ACC", "slug" => $this->create_slug('I want to know if I am going to be covered by ACC'), "parent_id"=> $r->id),
                array("name" => "I need assistance lodging a claim with ACC", "slug" => $this->create_slug('I need assistance lodging a claim with ACC'), "parent_id"=> $r->id),
                array("name" => "I want to challenge a decision made by ACC  ", "slug" => $this->create_slug('I want to challenge a decision made by ACC  '), "parent_id"=> $r->id),
                );
            $this->db->insert_batch("categories_of_law", $data);
        }
        else echo 'no category of law (frontend) found named acc';
        
    }


    protected function insert_areas_acc() {
        $this->db->select('id')->from('lawyer_profile_categories')->where('slug','acc');
        $q = $this->db->get();
        $r = $q->row();
        // print_r($r); 
        if(count($r)>0)
        {
            $data = array(
                array("name" => "General", "slug" => $this->create_slug('ACC General'), 'category_id'=> $r->id),
                array("name" => "Appeals", "slug" => $this->create_slug('ACC Appeals'), 'category_id'=> $r->id),
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