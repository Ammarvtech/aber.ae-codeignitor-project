<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends Common_Controller
{
	function __construct() {

        parent::__construct();
		$this->load->model('Categories_model');
		$this->load->model('Common_model');
		$this->load->library("pagination");
		
		$this->load->helper('csv');
		if(!$this->session->userdata('admin_id')) {
			redirect(base_url().'admin/login');
		}
    }
    
	public function index() {
		$arr 		           = array();
        $arr['name']           = $this->input->get('name') ? $this->input->get('name') : '';
		$config 			   = array();
        $config["base_url"]    = base_url() . "admin/categories";
        $config["total_rows"]  = $this->Categories_model->countProductsTotal($arr);
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
		$data['categories']    = $this->Categories_model->getAllProducts($arr,$page,$config["per_page"] );
		$data["links"]         = $this->pagination->create_links();
		$data['page_title']    = 'Categories';
		$data['page_heading']  = 'Categories';
		
		$data['msg'] = $this->input->get('msg') ? $this->input->get('msg') : '';
		$this->load->view('admin/categories',$data);
	}
	
	public function add() {

		$data['page_title']   = 'Add Category';
		$data['page_heading'] = 'Add Category';
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'name',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	)
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				$english_seo_url = $this->Product_model->createUrl('english',$this->input->post('name'));
				$array = array(
							"parent_id"  	 			=> 0,
							"name"  	 				=> $this->input->post('name'),
							"tagline"  	 				=> $this->input->post('tagline'),
							"description" 				=> $this->input->post('description'),
							"picture"        			=> $this->input->post('picture_name'),
							"english_url"				=> $english_seo_url,
						 );
				$product_id			=	$this->Categories_model->save($array);
				if($product_id) {
					if(isset($_FILES['file']) and $_FILES['file']['name']!=''){
						$file_name= time().$_FILES['file']['name'];
						$data['name'] = $file_name;
						$returnValue = $this->Common_model->uploadFile2($file_name, 'file', 'uploads/data/');
						if($returnValue == true) {				
							$this->Categories_model->update(array('picture'=>$file_name),$product_id);
						}
					}
					
					if(isset($_FILES['file2']) and $_FILES['file2']['name']!=''){
						$file_name= time().'1'.$_FILES['file2']['name'];
						$data['name'] = $file_name;
						$returnValue = $this->Common_model->uploadFile2($file_name, 'file2', 'uploads/data/');
						if($returnValue == true) {				
							$this->Categories_model->update(array('picture2'=>$file_name),$product_id);
						}
					}
					
					redirect(base_url().'admin/categories?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['productDetail'] = $_REQUEST;
				}
			}else{
				$data['productDetail'] = $_REQUEST;
			}
		}else {
			$data['productDetail'] = array();
		}
		$this->load->view('admin/add_category',$data);
	}

	public function edit() {

		$data['page_title']   = 'Edit Category';
		$data['page_heading'] = 'Edit Category';
		
		if($this->input->post()) {
			$rules = array(
			    array(
                	'field'   => 'name',
                 	'label'   => 'Name',
                 	'rules'   => 'trim|required'
              	)
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run()) {
				$english_seo_url = $this->Categories_model->createUrl('english',$this->input->post('name'),$this->input->get('id'));
				
				if($this->input->post('picture_name')!=''){
					$this->Categories_model->deleteFile($this->input->post('id'));
					$picture_name = $this->input->post('picture_name');
				}else{
					$picture_name = $this->input->post('old_picture');
				}
				$array = array(
							"parent_id"  	 			=> 0,
							"name"  	 				=> $this->input->post('name'),
							"tagline"  	 				=> $this->input->post('tagline'),
							"description" 				=> $this->input->post('description'),
							"english_url"				=> $english_seo_url,
						 );
				$product_id			=	$this->Categories_model->update($array,$this->input->post('id'));
				if($product_id) {
					if(isset($_FILES['file']) and $_FILES['file']['name']!=''){
						$file_name= time().$_FILES['file']['name'];
						$data['name'] = $file_name;
						$returnValue = $this->Common_model->uploadFile2($file_name, 'file', 'uploads/data/');
						if($returnValue == true) {				
							$this->Categories_model->update(array('picture'=>$file_name),$this->input->post('id'));
						}
					}
					
					if(isset($_FILES['file2']) and $_FILES['file2']['name']!=''){
						$file_name2 = time().rand(1111,9999).$_FILES['file2']['name'];
						$returnValue = $this->Common_model->uploadFile2($file_name2, 'file2', 'uploads/data/');
						if($returnValue == true) {				
							$this->Categories_model->update(array('picture2'=>$file_name2),$this->input->post('id'));
						}
					}
					$arr = "";
					redirect(base_url().'admin/categories?msg=Updated Successfully');
				}else {
					$data['error']	    = 'Some Error try later';
					$data['productDetail'] = $_REQUEST;
				}
			}else{
				$data['productDetail'] = $_REQUEST;
			}
		}else {
			$data['productDetail'] = array();
		}
		if($this->input->get('id')){
			$data['productDetail'] = $this->Categories_model->getRow($this->input->get('id'));
		}
		$this->load->view('admin/edit_category',$data);
	}
	
	public function delete() {
		$id = $this->input->get('id');
		$data['user'] = $this->Categories_model->delete($id);
		redirect(base_url().'admin/categories?msg=Deleted Successfully');
	}
	
	public function deleteImage(){
		$id = $this->input->get('id');
		$this->Categories_model->deleteFile($id);
		redirect('admin/categories/edit/'.$id.'?msg=Image Deleted Successfully');
	}
	
	public function uploadAddImage(){

		$picture_name = 'categories_' . time();
		$path         = 'uploads/data/';
		$picture_name = $this->Common_model->uploadImage($picture_name,$path);
		if ($picture_name){
			$arr            = array('picture_name' =>  $picture_name);
			$this->session->set_userdata($arr);
			$array = array('error'=>'','picture_name' => $picture_name);
			echo json_encode($array);
		}else{
			$error = array('error' => strip_tags($this->upload->display_errors()).$this->image_lib->display_errors());
			echo json_encode($error);
		}
	}
	
}
