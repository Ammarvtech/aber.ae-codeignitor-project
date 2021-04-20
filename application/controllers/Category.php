<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Common_Controller {


	function __construct() {

        parent::__construct();
		$this->load->model('Pages_model');
		$this->load->model('Contactqueries_model');
		$this->load->model('Product_model');
		$this->load->model('Awards_model');
		$this->load->model('Partners_model');
		$this->load->model('Categories_model');
		$this->load->model('Emailtemplates_model');
		$this->load->library('pagination');
		
		$this->data['header_pages']  = $this->Pages_model->getPagesByType('header','both');
		$this->data['footer_pages']  = $this->Pages_model->getPagesByType('footer','both');
		$this->load->helper('cookie');
    }

	public function index($category){
		$language = $this->Common_model->get_language_name();
		$this->data['categoryDetail'] = $this->Categories_model->getRowBySeoUrl($language,$category);

		$arr 		           = array();
        $arr['category_id']    = $this->data['categoryDetail']['id'];
		$config 			   = array();
        $config["base_url"]    = base_url() . "category/".$category;
        $config["total_rows"]  = $this->Product_model->countProductbyCategoryID($arr);
		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
        	$config["per_page"]    = 12;
		}
        $config["uri_segment"] = 3;
		$config['reuse_query_string']   = true;

        $this->pagination->initialize($config);

        $page 		           = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		if($this->input->get('sort_by')){
			$arr['sort_by'] = $this->input->get('sort_by');
			$arr['order'] = $this->input->get('order');
		}
		$this->data['products']      = $this->Product_model->getAllProductsByCategoryID($arr,$page,$config["per_page"]);
		$this->data["links"]         = $this->pagination->create_links();
		$this->data['relatedProducts'] = $this->Product_model->getRelatedProducts($this->data['categoryDetail']['id']);
		
		$this->data['page_title'] = $this->data['categoryDetail']['name'];
		$this->data['meta_description']    	= $this->data['categoryDetail']['name'];
		$this->data['meta_keywords']    	= $this->data['categoryDetail']['name'];
		
		$this->load->view($language.'/category-products',$this->data);
	}
	
	public function allCategories(){
		
		$language = $this->Common_model->get_language_name();
		$arr['category_id']    = NULL;
		$config 			   = array();
        $config["base_url"]    = base_url() . "category/allCategories";
        $config["total_rows"]  = $this->Product_model->countProductbyCategoryID($arr);
		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
        	$config["per_page"]    = 12;
		}
        $config["uri_segment"] = 3;
		$config['reuse_query_string']   = true;

        $this->pagination->initialize($config);

        $page 		           = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		if($this->input->get('sort_by')){
			$arr['sort_by'] = $this->input->get('sort_by');
			$arr['order'] = $this->input->get('order');
		}
		$this->data['products']      = $this->Product_model->getAllProductsByCategoryID($arr,$page,$config["per_page"]);
		$this->data["links"]         = $this->pagination->create_links();		
		$this->data['relatedProducts'] = $this->Product_model->getRelatedProducts("");
		if($language=='arabic'){
			$this->data['page_title'] = "جميع الفئات";
		}else{
			$this->data['page_title'] = "All Categories";
		}
		

		$this->load->view($language.'/category-products',$this->data);
	}
}
