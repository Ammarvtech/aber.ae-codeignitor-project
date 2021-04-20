<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."libraries/recaptchalib.php";
class Contactus extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('Pages_model');
		$this->load->model("Media_model");
		$this->load->model('Location_model');
		$this->load->model('Contactqueries_model');
		$this->load->model('Product_model');
		$this->load->model('Emailtemplates_model');
		$this->load->model('Common_model');
		$this->load->model('Preferences_model');
		$this->load->model('Users_model');
		$this->data['header_pages']  = $this->Pages_model->getPagesByType('header','both');
		$this->data['footer_pages']  = $this->Pages_model->getPagesByType('footer','both');
		$this->load->helper('cookie');
		$this->lang->load('access',$this->session->userdata("site_lang"));
    	$this->language=$this->session->userdata("site_lang");
    }

	public function index(){

		$data['page_title'] =  'Contactus';
		//$language = $this->Common_model->get_language_name();
		//$data['page_title']    	= $this->Preferences_model->getValue('contactus_meta_title'.$this->language);
		$data['follow']  =  $this->Location_model->getHomeLocation();
		$data['locations']  =  $this->Location_model->getOurLocations();
		
		$data['action']			= base_url().'Contactus';
		$data['latitude']		= $this->Preferences_model->getValue('latitude');
		$data['longitude'] 		= $this->Preferences_model->getValue('longitude');

		$data['contactDetail'] = array("message"=>'');
		
		if ($this->input->post()) {
			$rules = array(
               array(
                     'field'   => 'contact',
                     'label'   => 'Contact',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
               array(
                     'field'   => 'message',
                     'label'   => 'Message',
                     'rules'   => 'required'
                  )
            );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				// your secret key
				$secret = "6LddbwEVAAAAACTOjiQCCiABnjDZ6CroVCbIt1Lg";
				
				// empty response
				$response = null;
				
				// check secret key
				$reCaptcha = new ReCaptcha($secret);
				if ($_POST["g-recaptcha-response"]) {
					$response = $reCaptcha->verifyResponse(
						$_SERVER["REMOTE_ADDR"],
						$_POST["g-recaptcha-response"]
					);
					
					if ($response != null && $response->success) {
						$array = array(
							//"full_name"		  	 	=> $this->input->post('full_name'),
							//"subject"  		 		=> $this->input->post('subject'),
							"contact"  		 		=> $this->input->post('contact'),
							"email"  	 			=> $this->input->post('email'),
							"message"	  		 	=> $this->input->post('message'),
							"date_created"  		=> date('Y-m-d H:i:s',time())
							
						);
						$contact_id = $this->Users_model->insertContactUsFormData($array);
						redirect(base_url().'Contactus?msg=Message sent successfully');
						/*if($contact_id) {
							$to = $this->Preferences_model->getValue('email');
							$subject	= $this->input->post('subject');
							$message	= $this->input->post('message');
							$email_array = array(
												"name"			=> $this->input->post('full_name'),
												"user_email"	=> $this->input->post('email'),
												"reason"		=> $this->input->post('reason'),
												"phone"			=> $this->input->post('phone'),
												"message"		=> $this->input->post('message'),
												"subject"		=> "Contact Us query"
											);
							if($this->input->post('reason')=='Al Quoz Branch'){
								$email_array['email'] = 'hello@thesmashroom.com';
								$email_array['cc'] = '';
							}else if($this->input->post('reason')=='Last Exit Mad X Branch'){
								$email_array['email'] = 'action@thesmashroom.com';
								$email_array['cc'] = '';
							}else if($this->input->post('reason')=='Franchising'){
								$email_array['email'] = 'admin@thesmashroom.com';
								$email_array['cc'] = 'ibrahim@thesmashroom.com';
							}
							$this->Emailtemplates_model->sendMail('contactus',$email_array);
							$arr = "";
							redirect(base_url().'Contactus?msg=Message sent successfully');
							//redirect(base_url().'contactus?msg=1');
						}else {
							$data['error']	    = 'Some Error try later';
							$data['contactDetail'] = $_REQUEST;
						}*/
					}else{
						$data['error']	    = 'Google recaptch error!';
						$data['contactDetail'] = $_REQUEST;
					}
				}else{
					$data['error']	    = 'Google recaptch error!';
					$data['contactDetail'] = $_REQUEST;
				}
			}else{
				$data['contactDetail'] = $_REQUEST;
				$data['error'] = validation_errors();
			}
		}
		$data['msg'] = ($this->input->get("msg")!='') ? $this->input->get("msg"): "";
		$this->load->view('contactus',$data);
	}
	
	public function set_language($val){
		$cookie= array(
      		'name'   => 'language',
      		'value'  => $val,
       		'expire' => time()+'86400'*365,
  		);
  		$this->input->set_cookie($cookie);
	}
}