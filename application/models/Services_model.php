<?php

class Services_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function save($data)
	{
		$this->db->insert('services',$data);
		return $this->db->insert_id();
	}

	public function getRow($id){
		$this->db->where("id",$id);
		$query  =   $this->db->get('services');
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}	
		return array();
	}
	
	public function countTotal($data){
		if(isset($data['name']) && $data['name']!=''){
			$this->db->like('title', $data['name']);
		}
		$this->db->select('*');
		$this->db->from('services');
		$query  =   $this->db->get();
		return $query->num_rows();
	}
	
	public function getAll($data,$start,$limit){
		$this->db->limit($limit, $start);
		$this->db->order_by('id','desc');
		if($data['name']!=''){
			$this->db->like('title', $data['name']);
		}
		$this->db->select('*');
		$query = $this->db->get('services');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function update($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('services',$data);
		return true;
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('services');
	}

	public function getAllServices(){
		$this->db->select("*");
		$query = $this->db->get("services");
		if($query->num_rows() > 0){
			return $query->result();
		}
		return array();
	}

}
?>
	