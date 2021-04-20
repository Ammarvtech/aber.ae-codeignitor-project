<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Common_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('Contactqueries_model');
    }

	public function index(){
		$this->load->view(base_url('dashboard'));
	}
	

	function get_lat_long($address){

	    $address = str_replace(" ", "+", $address);
	    $key = 'AIzaSyBpMDSpvXOF1S-1utgfrrNtwrxnSzBRzUI';
	    $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=$key");
	    $json = json_decode($json);

	    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
	    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
	    return $lat.','.$long;
	}

	function deactivate(){
		$userDetail = $this->Users_model->getRow($this->session->userdata("user_id"));
		$arr['username'] 	= $userDetail['username'];
		$arr['userEmail'] 	= $userDetail['email'];
		$arr['email'] 		= $this->Preferences_model->getValue('email');
		$arr['registered']  = date("Y-m-d H:i:s",strtotime($userDetail['created_date']));

		$sendEmail = $this->Emailtemplates_model->sendEmail('Deleted user',$arr);

		$this->Users_model->delete_user($this->session->userdata("user_id"));
		$this->logout();

	}

	public function subscription(){
		if($this->session->userdata('user_id') =='') {
			redirect(base_url());
		}

		$language = $this->Common_model->get_language_name();
		$data['page_title'] = 'Subscription';
		//$data['action']		= base_url().'Dashboard/subscription';
		$data['payNowAction'] = base_url().'Subscription/renew';

		$data['orderStatus'] = $this->Users_model->getOrderDetail($this->session->userdata('user_id'));
		//$data['orderCreateDate'] = $this->Users_model->getOrderCreateDate($this->session->userdata('user_id'));
		$data['userCreatedDate'] = $this->Users_model->getUserCreatedDate($this->session->userdata('user_id'));
		$data['userDetail'] = $this->Users_model->getUserDetail($this->session->userdata('user_id'));
		$data['user_row'] 	= $this->Users_model->getUserDetail2($this->session->userdata('user_id'));
		
		if ($data['user_row']['expiry_date']) {
			$data['orderCreateDate'] = $data['user_row']['expiry_date'];
		}else{
			$data['orderCreateDate'] = date('d M Y');	
		}

		$this->load->view($language.'/subscription',$data);		

	}

	public function order(){
		if($this->session->userdata('user_id') =='') {
			redirect(base_url());
		}

		$language = $this->Common_model->get_language_name();
		$data['page_title'] = 'Orders';
		$data['payNowAction'] = base_url().'Subscription/renew';

		$data['ordersStatus']	= $this->Users_model->getOrders($this->session->userdata('user_id'));
		$data['ordersCount'] 	= $this->Users_model->getOrdersCount($this->session->userdata('user_id'));
		$data['userDetail'] 	= $this->Users_model->getUserDetail($this->session->userdata('user_id'));
		$data['expiry_date']	= $this->Users_model->getExpiryDate($this->session->userdata('user_id'));
		$data['user_row'] 		= $this->Users_model->getUserDetail2($this->session->userdata('user_id'));
		if ($data['user_row']['expiry_date']) {
			$data['orderCreateDate'] = $data['user_row']['expiry_date'];
		}else{
			$data['orderCreateDate'] = date('d M Y');	
		}

		$this->load->view($language.'/orders',$data);		

	}

	public function transaction(){
		if($this->session->userdata('user_id') =='') {
			redirect(base_url());
		}
		
		$language = $this->Common_model->get_language_name();
		$data['page_title'] = 'Transcations';
		$data['payNowAction'] = base_url().'Subscription/renew';

		$data['transactionsPackages']	= $this->Users_model->getOrders($this->session->userdata('user_id'));
		$data['transactionsCount'] 		= $this->Users_model->getOrdersCount($this->session->userdata('user_id'));
		$data['userDetail'] 			= $this->Users_model->getUserDetail($this->session->userdata('user_id'));
		$data['user_row'] 				= $this->Users_model->getUserDetail2($this->session->userdata('user_id'));
		$this->load->view($language.'/transactions',$data);		

	}

	public function changePassword() {
		$data['payNowAction'] = base_url().'Subscription/renew';
		$data['user_row'] 	= $this->Users_model->getUserDetail2($this->session->userdata('user_id'));

		if($this->input->post()) {
			$rules = array(
			  array(
                     'field'   => 'old_password', 
                     'label'   => 'Old Password', 
                     'rules'   => 'trim|required'
                  ),
              array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'trim|required|matches[confirm_password]'
                  ),
               array(
                     'field'   => 'confirm_password', 
                     'label'   => 'Confirm password', 
                     'rules'   => 'trim|required'
                  )
            );

			$this->form_validation->set_rules($rules);
		
			if ($this->form_validation->run()) {
				$user_record    =   $this->Users_model->getRow($this->session->userdata('user_id'));

				if($user_record['password'] == $this->input->post('old_password')) {
					$update_data['password'] =	$this->input->post('password');
					$this->Users_model->update($update_data,$this->session->userdata('user_id'));
					$data['success']	     =	 'Password changed successfully.';
				}
				else {
					$data['error']	         =	'Old password is wrong.';
				}
			}else{
				$data['userDetail'] = $_REQUEST;
			}
		}

		$data['page_title'] = 'Change Password';
		$data['page_heading'] = 'Change Password';
		$data['userDetail'] 			= $this->Users_model->getUserDetail($this->session->userdata('user_id'));
		$this->load->view('english/change_password',$data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function detail(){
		$data['page_title'] = 'Detail';
		$data['userDetail']	= $this->Users_model->getUserDetail($this->input->get('id'));

		$language = $this->Common_model->get_language_name();
		$this->load->view($language.'/detail',$data);

	}
	
	public function set_language($val){
		$cookie= array(
      		'name'   => 'language',
      		'value'  => $val,
       		'expire' => time()+'86400'*365,
  		);
  		$this->input->set_cookie($cookie);
		redirect(base_url());
	}
}
