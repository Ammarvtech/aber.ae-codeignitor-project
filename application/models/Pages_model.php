<?php

class Pages_model extends CI_Model
{

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->pages = 'pages_backup';
    	$this->pages_description = 'pages_description';
    }
	
	public function save_page($data)
	{
		$this->db->insert($this->pages,$data);
		return true;
	}

	public function save_page_description($data)
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
    public function getRowBySlug($slug){
		$sSQL   =   $this->db->where("slug",$slug);
		$query  =   $this->db->get('pages');
		if($query->num_rows() > 0){
			$row = $query->result_array();
			return $row[0];
		}
		return array("title"=>"","body"=>"");
	}

	public function getAllPages(){

		$this->db->select('m.*');
		//$this->db->join($this->pages_description.' md','md.page_id = m.id');
		//$this->db->where('md.language_id',1);
		$this->db->from($this->pages.' m');
		$this->db->where('status','1');
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
		$query = $this->db->get('pages_backup');
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

	public function get_page_detail_by_id($id){
		$this->db->select('p.*');
		//$this->db->join($this->pages_description.' pd','pd.page_id = p.id');
		$this->db->where('p.id', $id);
		$this->db->from($this->pages.' p');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
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

	
	
	public function update_page($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('pages',$data);
		return true;
	}
     public function update_page_description($data,$id){
		$this->db->where('page_id',$id);
		$this->db->update_batch($this->pages_description,$data,'language_id');
		return true;
	}

	
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pages');
	}

	
}
?>
