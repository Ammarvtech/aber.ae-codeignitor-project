<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {


	function __construct() {

        parent::__construct();
		$this->load->model('Pages_model');
		$this->load->model('Sliderimages_model');
		$this->load->model('Product_model');
		$this->load->model('Media_model');
		$this->load->library("pagination");
		$this->load->model('Common_model');
		$this->load->model('Media_model');
		$this->load->model('Preferences_model');
		$this->lang->load('access',$this->session->userdata("site_lang"));
    	$this->language=$this->session->userdata("site_lang");
		$this->data['header_pages']  = $this->Pages_model->getPagesByType('header','both');
		$this->data['footer_pages']  = $this->Pages_model->getPagesByType('footer','both');
		$this->load->helper('cookie');
    }

	public function index(){
		$data['page_title'] = $this->Preferences_model->getValue('heading_about'.$this->language);
		$data['meta_keywords'] = $this->Preferences_model->getValue('about_key'.$this->language);
		$data['meta_description'] = $this->Preferences_model->getValue('about_des'.$this->language);
		$data['about_1']= $this->Preferences_model->getValue('about_1_'.$this->language);
		$data['about_2']= $this->Preferences_model->getValue('about_2_'.$this->language);
		$data['link']= $this->Preferences_model->getValue('heading_1_link_'.$this->language);
		$data['about_video']= $this->Preferences_model->getValue('about_video'.$this->language);
		$data['about_des_1']= $this->Preferences_model->getValue('about_1_description_'.$this->language);
		$data['about_des_2']= $this->Preferences_model->getValue('about_2_description_'.$this->language);
		$data['media']  =  $this->Media_model->getHomemediaDetail();
		$data['language'] = $this->session->userdata("site_lang");
		
		
	//	$data['media']  =  $this->Media_model->getHomemediaDetail();
	//	$data['total_media'] = $this->Media_model->countAllMedia(); 

		/*$language = $this->Common_model->get_language_name();
		
		$this->data['productDetail'] = $this->Product_model->getRowBySeoUrl($language,$url);
		$this->data['productImages'] = $this->Product_model->getImages($this->data['productDetail']['id']);
		
		if($language=='arabic'){
			$this->data['page_title'] = $this->data['productDetail']['title_arabic'];
			$this->data['meta_description']    	= $this->data['productDetail']['title_arabic'];
			$this->data['meta_keywords']    	= $this->data['productDetail']['title_arabic'];
		}else{
			$this->data['page_title'] = $this->data['productDetail']['title'];
			$this->data['meta_description']    	= $this->data['productDetail']['title'];
			$this->data['meta_keywords']    	= $this->data['productDetail']['title'];
		}
		
		$this->data['relatedProducts'] = $this->Product_model->getRelatedProducts($this->data['productDetail']['category_id']);
		*/

		$this->load->view('about',$data);
	}
	
	public function detail($id){

		$data['mediaDetail']  =  $this->Media_model->get_media_by_id($id);
       
		/*$language 			   = $this->Common_model->get_language_name();
		$search 			   = $this->input->get('search')?$this->input->get('search'):"";
		$arr 		           = array();
        $arr['name']           = $search;
		$config 			   = array();
        $config["base_url"]    = base_url() . "products/search";
        $config["total_rows"]  = $this->Product_model->countProductsTotalForUser($arr);
		if($this->input->get('per_page')){
			$config["per_page"]    = $this->input->get('per_page');
		}else{
        	$config["per_page"]    = 10;
		}
        $config["uri_segment"] = 3;
		$config['reuse_query_string']   = true;

        $this->pagination->initialize($config);

        $page 		           = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		if($this->input->get('sort_by')){
			$arr['sort_by'] = $this->input->get('sort_by');
			$arr['order'] = $this->input->get('order');
		}
		$this->data['products']      = $this->Product_model->getAllProductsForUser($arr,$page,$config["per_page"] );
		$this->data["links"]         = $this->pagination->create_links();
		$this->data['page_title']    = 'Products';
		$this->data['page_heading']  = 'Products';
		$this->data['search']		 = $search;
		
		if($language=='arabic'){
			$this->data['page_title'] = "Search";
		}else{
			$this->data['page_title'] = "Search";
		}
		*/

		$this->load->view('media-detail',$data);
	}
	public function loadmoredata(){
		$limit = $this->input->post('val');
		$data['news'] = $this->Media_model->getLatestNews($limit);

		//$language = $this->Common_model->get_language_name();
		 echo $this->load->view('loadmoremedia',$data, true);
	}
	
	public function offer(){

		$language = $this->Common_model->get_language_name();
		$this->data['offer_products']  	= $this->Product_model->getOfferProductsForHome();
		
		if($language=='arabic'){
			$this->data['page_title'] = "عروض";
		}else{
			$this->data['page_title'] = "Offer";
		}
		

		$this->load->view($language.'/offers',$this->data);
	}
	
}
