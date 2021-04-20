<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {


	function __construct() {

        parent::__construct();
		$this->load->model("Sliderimages_model");
        $this->load->model('Location_model');
        $this->load->model("Media_model");
         $this->load->model("Follow_model");
    	$this->load->model("Pages_model");
    	$this->load->model('Services_model');
    	$this->load->model('Portfolio_model');
    	$this->load->model('Reviews_model');
    	$this->load->model('Blogs_model');
    	$this->load->model('Preferences_model');
    	$this->load->model('Users_model');
    	$this->load->model('Package_model');
    	$this->load->library("pagination");		
		/*$this->data['header_pages']  = $this->Pages_model->getPagesByType('header','both');
		$this->data['footer_pages']  = $this->Pages_model->getPagesByType('footer','both');*/
		$this->load->helper('cookie');
    }

	public function index(){

		$data['page_title'] =  'Media';
		$data['news']  =  $this->Location_model->getAllNews();
		$data['total_media'] = $this->Media_model->countAllMedia();
		
		$this->load->view('news',$data);
	}
	
	public function detail($id){
		$data['page_title'] =  'News Detail';
		$data['news_del']  =  $this->Location_model->getNews_by_id($id);
		$data['news_rec']  =  $this->Location_model->getRecentNews();
		$this->load->view('detail-news',$data);

	}
	public function specials(){
		$data['page_title'] =  ' Specials';
		if (!empty($_GET['id'])) {
            $data['news_del']  =  $this->Location_model->getSpecials_by_id($_GET['id']);
		}else{
          $data['news_del']  =  $this->Location_model-> getNews_by_special();
	        }
		$data['news_rec']  =  $this->Location_model->getSpecials();
		$this->load->view('specials',$data);

	}
	/*public function detail($url){
		$language = $this->Common_model->get_language_name();
		$this->data['newsDetail'] = $this->News_model->getRowBySeoUrl($url);
		
		if($language=='arabic'){
			$this->data['page_title'] = $this->data['newsDetail']['title_arabic'];
		}else{
			$this->data['page_title'] = $this->data['newsDetail']['title'];
		}
		$this->data['prevuos_row'] = $this->News_model->getPreviousRow($this->data['newsDetail']['id']);
		$this->data['next_row'] = $this->News_model->getNextRow($this->data['newsDetail']['id']);

		$this->load->view($language.'/news-detail',$this->data);
	}*/
	
	public function prevNews($id){
		$prevRow = $this->News_model->getPreviousRow($id);
	}
	
	/*public function nextNews($url){
		$language = $this->Common_model->get_language_name();
		
		$this->data['newsDetail'] = $this->News_model->getRowBySeoUrl($url);
		
		if($language=='arabic'){
			$this->data['page_title'] = $this->data['newsDetail']['title_arabic'];
		}else{
			$this->data['page_title'] = $this->data['newsDetail']['title'];
		}
		

		$this->load->view($language.'/news-detail',$this->data);
	}*/
	public function media_detail($id){
		$data['page_title'] ='Media Detail';
		$data['news'] =  $this->News_model->getRow($id);
		$language = $this->Common_model->get_language_name();

		$this->load->view($language."/media-detail",$data);
	}

	public function loadmoredata(){
		$limit = $this->input->post('val');
		$this->data['news'] = $this->News_model->getLatestNews($limit);
		$language = $this->Common_model->get_language_name();
		echo $this->load->view($language.'/loadmoredata',$this->data, true);
	}

}
