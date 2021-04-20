<?php

class Location_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->pages = 'location';
    	$this->pages_description = 'location_description';
    }
	
	public function save($data)
	{
		$this->db->insert($this->pages,$data);
		return $this->db->insert_id();
	}

	public function save_location($data)
	{
		$this->db->insert_batch($this->pages_description,$data);
		return true;
	}

	public function updateUserPackages($package_id,$amount){

		$arr = array(
					'package_amount' => $amount
				);
		$this->db->where('package_id',$package_id);
 		return $this->db->update('pages', $arr); 
    }

	public function getAllLocation(){
		$this->db->select('m.*,md.*');
		$this->db->join($this->pages_description.' md','md.location_id = m.id');
		$this->db->where('md.language_id',1);
		$this->db->from($this->pages.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function getPagesByType($type,$both=null){
		$this->db->where('type',$type);
		if($both!=''){
			$this->db->or_where('type',$both);
		}
		$query = $this->db->get('pages');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();

	}

	public function getParentPages(){
		$this->db->where('parent_id','0');
		$query = $this->db->get('pages');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function get_location_by_id($id){
		$this->db->select('p.*,pd.*');
		$this->db->join($this->pages_description.' pd','pd.location_id = p.id');
		$this->db->where('p.id', $id);
		$this->db->from($this->pages.' p');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return array();
	}

	public function getRow($id){
		$sSQL   =   $this->db->where("id",$id);
		$query  =   $this->db->get('pages');
		$this->db->last_query();	
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}

	public function getRowBySeoUrl($seourl){
		$sSQL   =   $this->db->where("seo_url",$seourl);
		$query  =   $this->db->get('pages');
		
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array("title"=>"","body"=>"");
	}

	
	
	public function update($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('pages',$data);
		return true;
	}
     public function update_description($data,$id){
		$this->db->where('id',$id);
		$this->db->update_batch($this->pages_description,$data,'language_id');
		return true;
	}

	
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('location');
	}

	public function deleteDetail($id)
	{
		$this->db->where('location_id', $id);
		$this->db->delete('location_description');
	}	

	
}
?>
