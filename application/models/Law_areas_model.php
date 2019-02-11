<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Law_Areas_Model extends CI_Model {

	protected $_table = 'categories_of_law';
	protected $_area_table = 'area';
	protected $_options_table = 'area_options';
	protected $_questions_table = 'job_questions';
	protected $_assoc_table = 'area_option_associations';
	protected $_lawyer_categories_table = 'lawyer_profile_categories';
	protected $_lawyer_areas = 'lawyer_areas';
	protected $_primary_key = 'id';
	// protected $_timestamps = FALSE;
	// protected $_created_on_field = 't_created_on';
	// protected $_updated_on_field = 't_updated_on';
	// protected $_timestamps_format = 'Y-m-d H:i:s';

	public function __construct() {
		parent::__construct();
		
	}

	public function get_categories($parent_only=false)
	{
		// $this->db->select("*")->from($this->_table);
		if($parent_only) $this->db->where('parent_id', NULL);
		$this->db->order_by($this->_primary_key, 'desc');
		$query=$this->db->get($this->_table);
		return $query->result();
	}

	public function get_categories_tree($parent_only=false)
	{
		// $this->db->select("*")->from($this->_table);
		if($parent_only) $this->db->where('parent_id', NULL);
		$this->db->order_by($this->_primary_key, 'desc');
		$query=$this->db->get($this->_table);
		return $this->get_tree($query->result_array());
	}

	public function get_lawyer_profile_categories($parent_only=false)
	{
		// $this->db->select("*")->from($this->_table);
		if($parent_only) $this->db->where('parent_id', NULL);
		$this->db->order_by($this->_primary_key, 'desc');
		$query=$this->db->get($this->_lawyer_categories_table);
		return $query->result();
	}

	public function get_lawyers_categories_and_area() {
		$this->db->select($this->_area_table.".*, ".$this->_lawyer_categories_table.".name as cname");
		$this->db->where("category_id <>", NULL);
		$this->db->join($this->_lawyer_categories_table, $this->_lawyer_categories_table.".id = ".$this->_area_table.".category_id", "left");
		$this->db->order_by("category_id");
		return $this->db->get($this->_area_table)->result();
	}

	public function save_lawyer_areas($data, $lawyer_id) {
		$this->db->delete($this->_lawyer_areas, array("lawyer_id" => $lawyer_id));
		return $this->db->insert_batch($this->_lawyer_areas, $data);
	}

	public function get_lawyers_law_areas($lawyer_id) {
		return $this->db->get_where($this->_lawyer_areas, array("lawyer_id" => $lawyer_id))->result();
	}

	public function get_sub_categories($category_id=false)
	{
		if($category_id) $this->db->where('parent_id', $category_id);
		else $this->db->where('parent_id != '.NULL);
		$this->db->order_by($this->_primary_key, 'desc');
		$query=$this->db->get($this->_table);
		return $query->result();
	}


	public function create($data, $table=false)
	{
		if(!$table) $this->_table;
		if($this->db->insert($table, $data))
			return $this->db->insert_id();
		else return false;
	}

	public function create_area($data)
	{
		if($this->db->insert($this->_area_table, $data))
			return $this->db->insert_id();
		else return false;
	}

	public function create_area_option($data)
	{
		if($this->db->insert($this->_options_table, $data))
			return $this->db->insert_id();
		else return false;
	}

	public function insert_option_area_associations($areas, $option_id)
	{
		foreach ($areas as $area) {
			$this->db->insert($this->_assoc_table, ['option_id'=>$option_id, 'area_id'=>$area]);
		}
	}

	public function update($data, $where, $table=NULL)
	{
		$this->db->where($where);
		if(!$table) $table = $this->_table;
		if($this->db->update($table, $data))
			return true;
		else return false;
	}

	public function update_area($data, $where)
	{
		$this->db->where($where);
		if($this->db->update($this->_area_table, $data))
			return true;
		else return false;
	}

	public function get_category($id, $type='law')
	{
		if($type=='lawyer')
		$query=$this->db->get_where($this->_lawyer_categories_table, [$this->_primary_key=>$id]);
	else $query=$this->db->get_where($this->_table, [$this->_primary_key=>$id]);

		return $query->row();
	}

	public function get_area($id)
	{
		$query=$this->db->get_where($this->_area_table, [$this->_primary_key=>$id]);
		return $query->row();
	}

	public function get_option($id, $type='obj')
	{
		$query=$this->db->get_where($this->_options_table, [$this->_primary_key=>$id]);
		if($type=='obj')
			return $query->row();
		else return $query->result();
	}

	public function delete($id, $table=NULL)
	{
		if(!$table) $table=$this->_table;
		// check if it has sub categories
		$this->db->select('*')->from($table)->where('parent_id', $id);
		$check = $this->db->count_all_results();

		// echo $check; exit;
		if($check==0)
		{
			$this->db->where($this->_primary_key, $id);
			if($this->db->delete($table)) 
				return true;
			else return false;
		}
		else
		{
			return $check;
		}
	}

	public function get_option_parent_id($id)
	{
		$this->db->select('*')->from($this->_options_table)->where('parent_id', $id);
		$q = $this->db->get();
		$check_children = $q->row();
		if(count($check_children)>0) return $check_children->get_option_parent_id;
		else return NULL;
	}

	public function delete_area_options($id)
	{

		// check if option has children
		$this->db->select('*')->from($this->_options_table)->where('parent_id', $id);
		$q = $this->db->get();
		$check_children = $q->result();

		if(count($check_children)>0)
		{
			return 1;
		}
		else{

			// check area associations
			$this->db->select('*')->from($this->_assoc_table)->where('option_id', $id);
			$q = $this->db->get();
			$check = $q->result();

			if(count($check)==0) // if no area associations, delete
			{
				$this->db->where($this->_primary_key, $id);
				if($this->db->delete($this->_options_table)) 
					return true;
				else return false;
			}
			else // area associations found
			{
				$this->delete_area_association($id);// remove area associations

				// remove options
				$this->db->where($this->_primary_key, $id);
				if($this->db->delete($this->_options_table)) 
					return true;
				else return false;
			}
		}

	}

	public function delete_area_association($option_id)
	{
		$this->db->where('option_id', $option_id);
		if($this->db->delete($this->_assoc_table)) 
			return true;
		else return false;
	}

	public function delete_area($id)
	{
		//check if area is being used in options
		$this->db->select('*')->from($this->_assoc_table)->where('area_id', $id);
		$q = $this->db->get();
		$check = $q->result();

		if(count($check)==0){
			//if its not being  used, delete
			$this->db->where($this->_primary_key, $id);
			if($this->db->delete($this->_area_table)) 
				return true;
			else return false;
		}
		else return 1;
	}

	public function get_areas($id=NULL)
	{
		$this->db->order_by($this->_primary_key, 'desc');
		$res = $this->db->get($this->_area_table);
		return $res->result();
	}

	public function get_areas_by_category($category_id)
	{
		$this->db->where('category_id', $category_id);
		$res = $this->db->get($this->_area_table);
		return $res->result();
	}

	public function get_areas_by_option($option_id)
	{
		// select * from area_option_associations s join area a on s.area_id=a.id where s.option_id=6
		$this->db->select('*')->from('area_option_associations s')->join('area a', 's.area_id=a.id')->where('s.option_id',$option_id);;
		$res = $this->db->get();
		return $res->result();
	}

	public function get_options($type='obj')
	{
		$this->db->order_by($this->_primary_key, 'desc');
		$res = $this->db->get($this->_options_table);
		if($type=='obj') return $res->result();
		else return $res->result_array();
	}

	public function get_main_options()
	{
		$this->db->where('is_main', 1);
		$this->db->order_by($this->_primary_key, 'desc');
		$res = $this->db->get($this->_options_table);
		return $res->result();
	}

	public function get_option_children($option_id)
	{
		$this->db->where('parent_id', $option_id);
		$res = $this->db->get($this->_options_table);
		return $res->result();
	}

	public function get_options_by_category($category_id)
	{
		$this->db->where('category_id', $category_id);
		$res = $this->db->get($this->_options_table);
		return $res->result();
	}

	public function get_questions_by_option($option_id)
	{
		// $q = $this->db->query('select q.id, q.text, q.type, q.choices, q.area_id from area_option_associations a join job_questions q on a.area_id = q.area_id where a.option_id = "'.$option_id.'"');
		$q = $this->db->query('select q.id from area_option_associations a join job_questions q on a.option_id = q.option_id where a.option_id = "'.$option_id.'"');
		return $q->result_array();
	}

	public function get_question($question_id)
	{
		$this->db->where($this->_primary_key, $question_id);
		$q = $this->db->get($this->_questions_table);
		return $q->result();
	}

	public function get_nested_options()
	{
		$this->db->where('parent_id is NULL');
		$this->db->order_by($this->_primary_key, 'desc');
		$res = $this->db->get($this->_options_table);
		$result= $res->result();
		$index = 0;
		foreach ($result as $res) { $index++;
			if($res->parent_id==NULL)
			{
				$this->db->where('parent_id', $res->id);
				$r = $this->db->get($this->_options_table);
				$result[$index-1]->children = $r->result();
			}
		}
		// echo "<pre>";
		// print_r($result); exit;
		return $result;
	}

	public function get_options_tree()
	{
		return $this->get_tree($this->get_options('abc'));
	}

	public function print_options_tree()
	{
		$tree= $this->get_tree($this->get_options('abc'));
		if(count($tree)>0)
		{
			// echo '<tr><td scope="row">';
			foreach ($tree as $tr) {
				echo $tr['name']." ".anchor('admin/add_questions/'.$tr['id'], '(Manage Questions)<br>');
				echo $this->has_chidren($tr, 1);
			}
			// echo '</tr></td>';
		}
		else echo "<div class='alert alert-warning'><strong>No Records Found!</strong> Please add some options from <a href='".site_url('admin_area_options')."'>Manage Options</a> page</div>";
	}

	function has_chidren($arr, $times)
	{
		// echo "<pre>";print_r($arr); exit;
		// $string = '';
		if(isset($arr['children'])){
			foreach ($arr['children'] as $sub) {
				// $string.='<br>';
				$times_dashes = '';
				for ($i=0; $i < $times; $i++) { 
						$times_dashes .= '-----';
				}
				echo $times_dashes." <em>".$sub['name']."</em> ".anchor('admin/add_questions/'.$sub['id'], '(Manage Questions)')."<br>";
				$this->has_chidren($sub, $times+1);
			}
			}
			// echo $string;
	}

	public function get_tree($array)
	{
		$tree = array('NULL' => array('children' => array()));
		foreach($array as $item){
			if(isset($tree[$item['id']])){
				$tree[$item['id']] = array_merge($tree[$item['id']],$item);
			} else {
				$tree[$item['id']] = $item;
			}

			$parentid = is_null($item['parent_id']) ? 'NULL' : $item['parent_id'];
			if(!isset($tree[$parentid])) $tree[$parentid] = array('children' => array());
			$tree[$parentid]['children'][] = &$tree[$item['id']];
		}
		$result= $tree['NULL']['children'];
		// echo "<pre>"; print_r($result);
		unset($tree);
		return $result;
	}

}