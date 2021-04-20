<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {


	function __construct() {

        parent::__construct();
		$this->load->model('Pages_model');
		$this->load->model('Sliderimages_model');
		$this->load->model('Product_model');
		$this->load->model('Media_model');
		$this->load->model('Location_model');
		$this->load->library("pagination");
		$this->load->model('Common_model');
		$this->load->model('Preferences_model');
		$this->lang->load('access',$this->session->userdata("site_lang"));
    	$this->language=$this->session->userdata("site_lang");
		$this->data['header_pages']  = $this->Pages_model->getPagesByType('header','both');
		$this->data['footer_pages']  = $this->Pages_model->getPagesByType('footer','both');
		$this->load->helper('cookie');
    }

	public function index(){
		$data['page_title'] =  'Media';
		$data['news']  =  $this->Location_model->getAllNews();
		$data['total_media'] = $this->Media_model->countAllMedia();


		$this->load->view(/*$language.*/'/media',$data);
	}
	
	public function detail($id){
        $data['page_title'] =  'Media Detail';
		$data['mediaDetail']  =  $this->Media_model->get_media_by_id($id);

		

		$this->load->view('media-detail',$data);
	}
	public function Successstoriesdetail($id){

			$data['page_title'] =  'Media Detail';
			$data['mediaDetail']  =  $this->Media_model->get_successtories_by_id($id);
			
			$this->load->view('media-detail',$data);

	}
	public function loadmoredata(){
		$limit = $this->input->post('val');
		$data['news'] = $this->Media_model->getLatestmedia($limit);


		//$language = $this->Common_model->get_language_name();
		 echo $this->load->view('loadmoremedia',$data, true);
	}
	public function partners(){
		$data['page_title'] =  'Customers & Partners';
		$data['gallery']  =  $this->Location_model->getAllGallery();
		$this->load->view('customers_partners',$data);
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
