<?php

class Reviews_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function save($data)
	{
		$this->db->insert('reviews',$data);
		return $this->db->insert_id();
	}
	
	public function countTotal($data){
		if(isset($data['name']) && $data['name']!=''){
			$this->db->like('name', $data['name']);
		}
		$this->db->select('*');
		$this->db->from('reviews');
		$query  =   $this->db->get();
		return $query->num_rows();
	}
	
	public function getAll($data,$start,$limit){
		$this->db->limit($limit, $start);
		$this->db->order_by('id','desc');
		if($data['name']!=''){
			$this->db->like('name', $data['name']);
		}
		$this->db->select('*');
		$query = $this->db->get('reviews');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	
	function getPreviousRow($id){
		$this->db->order_by('id','desc');
		$this->db->where("id<",$id);
		$this->db->select('*');
		$query = $this->db->get('reviews');
		if($query->num_rows())
		{
			return $query->row();
		}
		return '';
	}
	
	function getNextRow($id){
		$this->db->order_by('id','asc');
		$this->db->where("id>",$id);
		$this->db->select('*');
		$query = $this->db->get('reviews');
		if($query->num_rows())
		{
			return $query->row();
		}
		return '';
	}
	
	
	public function getAllnews(){
		$query  =   $this->db->get('reviews');
		
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	
	function getForHomePage($start,$limit){
		$this->db->limit($limit, $start);
		$this->db->order_by('id','desc');
		$this->db->select('*');
		$query = $this->db->get('reviews');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function getRow($id){
		$this->db->where("id",$id);
		$query  =   $this->db->get('reviews');
		
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}

	public function update($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('reviews',$data);
		return true;
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('reviews');
	}

	public function deletePictureAndRow($id){
		$row = $this->getRow($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture']);
		}
		$this->delete($id);
	}

	public function deleteSliderFile($id){
		$row = $this->getRow($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture']);
			$data = array("picture" => "");
			$this->db->where('id',$id);
			$this->db->update('reviews',$data);
		}
	}

	public function getAllReviews(){
		$this->db->select("*");
		$query = $this->db->get('reviews');
		if($query->num_rows() > 0){
			return $query->result();
		}
		return array();
	}

}
?>
