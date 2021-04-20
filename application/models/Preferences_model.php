<?php

class Preferences_model extends CI_Model
{

  	function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->preferences='preferences_backup';
    }
	
	function update($key,$value){
		if($this->check($key)){
			$arr = array('value' => $value);
			$this->db->where('name',$key);
			return $this->db->update('preferences', $arr); 
		}else{
			$arr = array("name"=>$key,'value' => $value);
			return $this->db->insert('preferences', $arr);
		}
	}
	public function getAllServicesbyid($id){
		$this->db->select("*");
		$this->db->where('category_id',$id);
		$q = $this->db->get('gifts');
		if($q->num_rows() >0){
			return $q->result();
		}
		return array();
	}
	public function getAllServices(){
		$this->db->select('*');
		$this->db->order_by('sort_order');
		$this->db->from('media ');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}
		return array();
	}
	function getValue($key){
 		$query  =   $this->db->query("SELECT * FROM preferences where name='".$key."'");
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0]['value'];
		}
		return '';
	}
	
	function check($key){
 		$query  =   $this->db->query("SELECT * FROM preferences where name='".$key."'");
		if($query->num_rows())
		{
			return true;
		}
		return false;
	}
	public function getProducts(){
		$this->db->select('*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		//$this->db->like('category_id',$name);
		$this->db->from('merchandise');
		//$this->db->limit(6,0);
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getPages(){
		$this->db->select('*');
		
		$this->db->like('type','footer');
		$this->db->from('pages_backup');
		//$this->db->limit(6,0);
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	
}
?>
