<?php

class Product_model extends CI_Model
{

  	function __construct()
    {
        parent::__construct();
    	$this->merchandise = 'merchandise';
    	$this->merchand = 'catering_tems';
    	$this->merchandise_description = 'merchandise_description';
    }

    public function countProductsTotal($data){
		if(isset($data['name']) && $data['name']!=''){
			$this->db->like('m.product_name', $data['name']);
		}
		$this->db->select('m.*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		//$this->db->where('md.language_id',1);
		$this->db->from($this->merchandise.' m');
		$query  =   $this->db->get();
		return $query->num_rows();
	}
	 public function countItemsTotal($data){
		if(isset($data['name']) && $data['name']!=''){
			$this->db->like('product_name', $data['name']);
		}
		$this->db->select('*');
		//$this->db->where('md.language_id',1);
		$this->db->from('catering_tems');
		$query  =   $this->db->get();
		return $query->num_rows();
	}

    public function getAllProducts($data,$start,$limit){
		if($data['name']!=''){
			$this->db->like('m.product_name', $data['name']);
		}
		$this->db->limit($limit, $start);
		$this->db->order_by('id','desc');
		$this->db->select('m.*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		//$this->db->where('md.language_id',1);
		$this->db->from($this->merchandise.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	 public function getAllTems($data,$start,$limit){
		if($data['name']!=''){
			$this->db->like('product_name', $data['name']);
		}
		$this->db->limit($limit, $start);
		$this->db->order_by('id','desc');
		$this->db->select('*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		//$this->db->where('md.language_id',1);
		$this->db->from('catering_tems ');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function get_product_detail_by_id($id){
		$this->db->select('m.*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->where('m.id', $id);
		$this->db->from($this->merchandise.' m');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
		}
		return array();
	}
	public function get_items_detail_by_id($id){
		$this->db->select('*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->where('id', $id);
		$this->db->from('catering_tems ');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result[0];
		}
		return array();
	}
	
	public function save_product($data){
		$this->db->insert($this->merchandise,$data);
		return true;
	}
    public function save_items($data){
		$this->db->insert('catering_tems',$data);
		return true;
	}

	public function save_product_description($data){
		$this->db->insert_batch($this->merchandise_description,$data);
		return true;
	}
	
	public function update_product($data,$id){
		$this->db->where('id',$id);
		$this->db->update($this->merchandise,$data);

		return true;
	}
	public function update_modifiers($data,$id){
		$this->db->where('id',$id);
		$this->db->update('modifiers',$data);

		return true;
	}
	public function update_items($data,$id){
		$this->db->where('id',$id);
		$this->db->update('catering_tems',$data);
		return true;
	}

	public function update_product_description($data,$id){
		$this->db->where('merchandise_id',$id);
		$this->db->update_batch($this->merchandise_description,$data,'language_id');
		return true;
	}

	public function deleteProduct($product_id){
		//$this->deleteImages($product_id);
		$this->db->where('id', $product_id);
		$this->db->delete($this->merchandise);

		/*$this->db->where('merchandise_id', $product_id);
		$this->db->delete($this->merchandise_description);*/
	}
	public function deleteItems($product_id){
		//$this->deleteImages($product_id);
		$this->db->where('id', $product_id);
		$this->db->delete('catering_tems');

		//$this->db->where('merchandise_id', $product_id);
		//$this->db->delete($this->merchandise_description);
	}

	public function deleteSliderFile($id){
		$row = $this->getRow($id);
		if($row['picture']!=''){
			@unlink('uploads/data/'.$row['picture']);
			$data = array("picture" => "");
			$this->db->where('id',$id);
			$this->db->update($this->merchandise,$data);
		}
	}

	public function getRow($id){
		$this->db->where("id",$id);
		$query  =   $this->db->get($this->merchandise);
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}

	public function getRowBySeoUrl($type,$url){
		if($type=='arabic'){
			$url = urldecode($url);
			$this->db->where("arabic_url",$url);
		}else{
			$this->db->where("english_url",$url);
		}

		$query  =   $this->db->get('products');
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}	

	public function createUrl($type,$title,$id=NULL){
		$title = $this->Common_model->toAscii($type,$title);
		$total = $this->countUrl($type,$title,$id);
		if($total>0){
			$title = $title."-".$total;
		}
		return $title;
	}
	
	public function countUrl($type,$title,$id){
		if($id!=''){
			$this->db->where("id <>",$id);
		}
		$this->db->where($type."_url",$title);
		$this->db->select('*');
		$this->db->from('products');
		$query  =   $this->db->get();
		return $query->num_rows();
	}
	
	public function savePicture($event_id){
		foreach($this->session->userdata('event_images_array') as $name){
			$array = array( 
					"user_id"  		=> $this->session->userdata('user_id'),
					"event_id"  	=> $event_id,
					"name"  	    => $name,
					"type"          => 'picture'
				 );
			$this->db->insert('events_files',$array);
		}
	}
	
	public function getProductByCategoryForHome($category_id){
		$this->db->limit(6, 0);
		$this->db->select('*');
		$this->db->where('offer','no');
		$this->db->where('category_id',$category_id);
		$query = $this->db->get('products');
		
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	
	public function getOfferProductsForHome(){
		$this->db->limit(10, 0);
		$this->db->select('*');
		$this->db->order_by('id','desc');
		$this->db->where('offer','yes');
		$query = $this->db->get('products');
		
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	
	public function getAllProductsForResizeImages(){
		$this->db->select('*');
		$query = $this->db->get('products');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	
	public function getAllProductsForUser($data,$start,$limit){
		$this->db->limit($limit, $start);
		/*if(isset($data['sort_by']) && $data['sort_by']!==''){
			$this->db->order_by($data['sort_by'],'asc');
		}else{
			$this->db->order_by('id','desc');
		}*/
		if($data['name']!=''){
			$this->db->like('md.name', $data['name']);
		}
		$this->db->select('m.*,md.*');
		$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->where('md.language_id',1);
		$this->db->from($this->merchandise.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	
	public function getRelatedProducts($category_id){
		$this->db->limit(10, 0);
		$this->db->where('locked', 'no');
		if(isset($data['sort_by']) && $data['sort_by']!==''){
			$this->db->order_by($data['sort_by'],'asc');
		}else{
			$this->db->order_by('id','desc');
		}
		if($category_id!=''){
			$this->db->where('category_id', $category_id);
		}
		$this->db->select('*');
		$query = $this->db->get('products');
		//echo $this->db->last_query();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	
	public function getLatestProduct($start=0,$limit=5){
		$this->db->limit($limit, $start);
		$this->db->where('locked', 'no');
		$this->db->where('offer', 'no');
		$this->db->order_by('id','desc');
		$this->db->select('*');
		$query = $this->db->get('products');
		//echo $this->db->last_query();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	
	public function getHomePageCategories($start=0,$limit=5){
		$this->db->limit($limit, $start);
		$this->db->order_by('id','asc');
		$this->db->select('*');
		$query = $this->db->get('products_categories');
		if($query->num_rows()){
			return $query->result();
		}
		return array();
	}
	
	public function countProductsTotalForUser($data){
		$this->db->where('locked', 'no');
		if($data['name']!=''){
			$this->db->like('title', $data['name']);
			$this->db->or_like('title_arabic', $data['name']);
			$this->db->or_like('detail', $data['name']);
			$this->db->or_like('detail_arabic', $data['name']);
		}
		
		$this->db->select('*');
		$this->db->from('products');
		$query  =   $this->db->get();
		return $query->num_rows();
	}
	
	public function getAllProductsByCategoryID($data,$start,$limit){
		$child_categories = array();
		if(isset($data['category_id'])){
			$child_categories = $this->Categories_model->getChaildCategory($data['category_id']);
			$child_categories[] = $data['category_id'];
			$this->db->where_in("category_id",$child_categories);
		}
		$this->db->order_by("sorting","asc");
		$this->db->limit($limit, $start);
		$this->db->where('locked', 'no');
		$this->db->select('*');
		$query = $this->db->get('products');
		//echo $this->db->last_query();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function getMaxSorting(){
		$query = "select max(sorting) sorting from products";
		$query = $this->db->query($query);
		if($query->num_rows())
		{
			$row = $query->row_array();
			return $row['sorting']+1;
		}
		return 1;
	}

	public function getAllProductsByCategoryIDForWebServices($data,$start,$limit){

		$this->db->where_in("category_id",$data['category_id']);
		$this->db->order_by("id","desc");
		$this->db->limit($limit, $start);
		$this->db->where('locked', 'no');
		$this->db->select('*');
		$query = $this->db->get('products');
		//echo $this->db->last_query();
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	
	public function countProductbyCategoryID($data){
		$child_categories = array();
		if(isset($data['category_id'])){
			$child_categories = $this->Categories_model->getChaildCategory($data['category_id']);
			$child_categories[] = $data['category_id'];
			$this->db->where_in("category_id",$child_categories);
		}
		$this->db->where('locked', 'no');
		$this->db->select('*');
		$this->db->from('products');
		$query  =   $this->db->get();
		return $query->num_rows();
	}
	
	public function getNextID(){
		$query = "SELECT Auto_increment FROM information_schema.tables WHERE table_name='products'";
		$restult = $this->db->query($query)->result();
		return $restult[0]->Auto_increment;
	}
	
	public function saveImage($product_id){
		if($this->session->userdata('images_array')){
			foreach($this->session->userdata('images_array') as $name){
				$array = array( 
							"product_id"  	=> $product_id,
							"name"  	    => $name,
					 	);
				$name = "uploads/data/".$name;
				$destination = "uploads/data/thumb_300_".$name;
				$this->Common_model->generateThumb($name,array("300",""),$destination);
				$this->db->insert('product_images',$array);
			}
			$this->session->unset_userdata(array('images_array'));
		}
	}
	
	public function getImageName($product_id){
		$sSQL   =   $this->db->where("product_id",$product_id);
		$this->db->order_by('id');
		$this->db->limit(1, 0);
		$query  =   $this->db->get('product_images');
		if($query->num_rows()){
			$row = $query->result_array();
			return $row[0]['name'];
		}
		return array();
	}
	
	public function getImages($product_id){
		$sSQL   =   $this->db->where("product_id",$product_id);
		$query  =   $this->db->get('product_images');
		if($query->num_rows()){
			$row = $query->result();
			return $row;
		}
		return array();
	}
	
	public function deleteImages($product_id){
		$this->db->where('product_id', $product_id);
		$this->db->select('*');
		$query = $this->db->get('product_images');
		if($query->num_rows()){
			$rows =  $query->result();
			foreach($rows as $row){
				@unlink('uploads/data/'.$row->name);
				@unlink('uploads/data/thumb_300_'.$row->name);
				$this->db->where('id', $row->id);
				$this->db->delete('product_images');
			}	
		}
	}
	
	public function deleteImageById($id){
		$this->db->where('id', $id);
		$this->db->select('*');
		$query = $this->db->get('product_images');
		if($query->num_rows()){
			$rows =  $query->result();
			foreach($rows as $row){
				@unlink('uploads/data/'.$row->name);
				@unlink('uploads/data/thumb_300_'.$row->name);
				$this->db->where('id', $row->id);
				$this->db->delete('product_images');
			}	
		}
	}
	
	public function getProductsForHome(){
		$this->db->limit(3, 0);
		$this->db->where('featured','yes');
		$this->db->order_by('id','desc');
		$this->db->select('*');
		$query = $this->db->get('products');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}
	
	public function getPrice($currency,$type,$row){
		if($currency==''){
			$currency = 'usd';
		}
		if($type==''){
			$val = $currency.'_price';
			return $row->$val;
		}else{
			$val = $currency."_".$type.'_price';
			return $row->$val;
		}		
	}
	
	public function getPrice2($currency,$type,$row){
		if($currency==''){
			$currency = 'usd';
		}
		if($type==''){
			$val = $currency.'_price';
			return $row[$val];
		}else{
			$val = $currency."_".$type.'_price';
			return $row[$val];
		}		
	}
	
	public function getCurrency($currency){
		if($currency==''){
			return 'usd';
		}else{
			return $currency;
		}
	}
	
	public function getCurrencySymbol($currency){
		if($currency==''){
			return '$';
		}else{
			if($currency=='usd'){
				return "$";
			}else{
				return "&#8358;";
			}
		}
		
	}
	public function getHomeProducts(){
		$this->db->select('m.*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		//$this->db->where('md.language_id',getLangId());
		$this->db->from($this->merchandise.' m');
		$this->db->limit(4,0);
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getProducts(){
		$this->db->select('m.*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		//$this->db->like('category_id',$name);
		$this->db->from($this->merchandise.' m');
		//$this->db->limit(6,0);
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getCategoryProductsforsearch($name){
		$this->db->select('m.*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->like('product_name',$name);
		$this->db->from($this->merchandise.' m');
		//$this->db->limit(6,0);
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	
	public function getCategoryProducts_by_id($id){
		$this->db->select('m.*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->like('id',$id);
		$this->db->from($this->merchandise.' m');
		//$this->db->limit(6,0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		return array();
	}
	public function getCategoryProducts_by_modifier_if($id,$branch){
		$this->db->select('*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->where('modifiergroup_id',$id);
		$this->db->where('branch_id',$branch);
		$this->db->from('modifiers');
		//$this->db->limit(6,0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return array();
	}
	public function getCategoryProducts_by_modifier_group($id,$branch){
		$this->db->select('*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->where('mid',$id);
		$this->db->where('branch_id',$branch);
		$this->db->from('modifiergroup');
		//$this->db->limit(6,0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		return array();
	}
	public function getAllRelatedproducts($name,$start,$limit){

		$this->db->limit($limit, $start);
		$this->db->select('m.*');
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->like('category_id',$name);
		$this->db->from($this->merchandise.' m');
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getCategoryAll($name){
		$this->db->select('*');
		$this->db->where("location",$name);
		//$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->from('media');
		//$this->db->limit(6,0);
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function getAllProductsForBooking(){
		$this->db->select('m.*,md.*');
		$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->where('md.language_id',getLangId());
		$this->db->from($this->merchandise.' m');
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}
	public function get_products_by_id($id){
		$this->db->select('p.*,pd.*');
		$this->db->join($this->merchandise_description.' pd','pd.merchandise_id = p.id');
		$this->db->where('p.id', $id);
		$this->db->where('pd.language_id',getLangId());
		$this->db->from($this->merchandise.' p');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		return array();
	}

	public function countAllPrducts(){
		$this->db->select('m.*,md.*');
		$this->db->join($this->merchandise_description.' md','md.merchandise_id = m.id');
		$this->db->where('md.language_id',getLangId());
		$this->db->from($this->merchandise.' m');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		return 0;	
	}
	public function getLatestNews($limit){
		$this->db->select('p.*,pd.*');
		$this->db->join($this->merchandise_description.' pd','pd.merchandise_id = p.id');
		$this->db->where('pd.language_id',getLangId());
		$this->db->from($this->merchandise.' p');
		$this->db->limit(3,$limit);
		$query = $this->db->get();
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return array();
	}

	public function getCloverProductId($id){
      $this->db->select("clover_id");
      $this->db->where('id',$id);
      $query =  $this->db->get('merchandise');
      if($query->num_rows() > 0){
        return $query->row()->clover_id;
      }
      return "";
    }

    public function save_products($data){
		$this->db->select("*");
		$this->db->where('clover_id',$data['clover_id']);
		$this->db->where('branch_id',$data['branch_id']);
		$query = $this->db->get('merchandise');
		if($query->num_rows() == 0){
			$this->db->insert('merchandise',$data);
		}
	}
	
}
?>
