<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {

        parent::__construct();
        $this->load->model('Media_model');
		$this->load->model('Contactqueries_model');
		$this->load->model('Common_model');
		$this->load->model('Emailtemplates_model');
		$this->load->model('Registration_model');
		$this->load->model('Users_model');
		$this->load->model('Order_model');
		$this->load->library('session');
		$this->load->helper('cookie');
    }

	public function register(){	
		$rules = array(
           array(
                 'field'   => 'first_name',
                 'label'   => 'First name',
                 'rules'   => 'required'
              ),
            array(
                 'field'   => 'last_name',
                 'label'   => 'Last name',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'password',
                 'label'   => 'Password',
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'email',
                 'label'   => 'Email',
                 'rules'   => 'required|valid_email'
              )
        );
		$this->form_validation->set_rules($rules);
		$arr = array();
		if ($this->form_validation->run()) {
			//$pas = generatePassword();
			//$password=$this->Common_model->encryptIt($pas,TRUE);
			$array = array(
				"first_name"		=> $this->input->post('first_name'),
				"last_name"		=> $this->input->post('last_name'),
				"email"  	 		=> $this->input->post('email'),				
				"date_created"  	=> date('Y-m-d H:i:s',time())

			);

			$new_array = array(
                "firstName" => $this->input->post('first_name'),
                "lastName" => $this->input->post('last_name')
            );
            $emailAddress = array(
                "emailAddress" => $this->input->post('email')
            );

            $new_array['emailAddresses'][] = $emailAddress;

			if($this->Users_model->checkUserexist($array['email'])){
				
    			$data['success'] = false;
				$data['error'] = "Email already exists";
				$data['contact'] = $_REQUEST;
  			}else{
  				
  				$customer_data   = $this->curl->postRequest(ADD_CUSTOMERS_URL,$new_array);
                if(!isset($customer_data->id)){
                    $this->data['error'] = $customer_data->message;
                    $this->data['contact'] = $_REQUEST;
                }else{
                	$array['clover_id'] = $customer_data->id;
                	$array['password'] = $this->Common_model->encryptIt($this->input->post('password'),TRUE);
               		$array['raw_password'] = $this->input->post('password');
                	
                	$contact_id = $this->Users_model->insertRegisterUsFormData($array);
					$user_record	=	$this->Users_model->getUserPassword($array['email']);

					if($user_record){
						//$password = $this->Common_model->decryptIt($user_record,TRUE);
						//$email_arr = array("password"=>$password,"email"=>$array['email'],"name"=>$array['first_name']);
						//$result = $this->Emailtemplates_model->sendEmail('verification',$email_arr);
						if($_GET['id'] == 2){ 
							
	                		redirect(base_url().'Products/cart_data');
	              		}else{
							$this->session->set_userdata(array("user_id"=>$user_record->id));
			                redirect(base_url().'User/dashboard');
						}
						//$data['contact'] = $_REQUEST;
					}else{
						$data['contact'] = $_REQUEST;
						$data['success'] = false;
						$data['msg']	= 'Email is wrong.';
					}
                }
			}
			
		}else{
			$data['contact'] = $_REQUEST;
			$data['success'] = false;
			$data['error'] = validation_errors();
		}
         
        $data['page_title'] =  'Register';
        $data['id']=$_GET['id'];
		$this->load->view('register',$data);
	}
	
	public function login(){
		if($this->session->userdata('user_id')!='') {
			redirect(base_url());
		}
				if(isset($_POST['remember_me'])){

				setcookie("email",$email, time()+3600*24);
				setcookie("password",$password, time()+3600*24);

				}
		$rules = array(
           array(
                 'field'   => 'email',
                 'label'   => 'Email',
                 'rules'   => 'required|valid_email'
              ),
            array(
                 'field'   => 'password',
                 'label'   => 'Password',
                 'rules'   => 'required'
              )
        );

		$this->form_validation->set_rules($rules);
		$output = array();
		if ($this->form_validation->run()) {
			$output = array();
			$email = $_POST['email'];
			$password = $_POST['password'];
	 		$password = $this->Common_model->encryptIt($password,TRUE);
			$data = $this->Users_model->login($email, $password);
			if($data){
				$this->session->set_userdata(array("user_id"=>$data['id']));
				if ($_GET['id'] == 6) {
					$id=$_GET['id'];
					redirect(base_url().'Gifts/send_card/$id');
				}
				else if($_GET['id'] == 2){ 
                redirect(base_url().'Products/cart_data');
              }else{
					$data['success'] = true;
				$data['msg'] = 'Logging in. Please wait...';
				redirect(base_url().'User/dashboard');
				}
				
			}
			else{
				$data['contact'] = $_REQUEST;
				$data['success'] = false;
				$data['error'] = 'Login Invalid. User not found';
			}
			
		}else{
			$data['contact'] = $_REQUEST;
			$data['success'] = false;
			$data['error'] = validation_errors();
		}
	     $data['page_title'] =  'Log in';
	     $data['id']=$_GET['id'];
		$this->load->view('login',$data);
	}
	
	public function myOrders(){
		$data['page_title'] = 'Booking';
		$language = $this->Common_model->get_language_name();
		$id=$this->session->userdata('user_id');
		$data['order_row'] = $this->Users_model->getOrders_($id);
		$this->load->view('myorders',$data);
	}

	public function myAccount(){
		$data['page_title'] = 'Booking';
		$language = $this->Common_model->get_language_name();
		$data['msg'] = ($this->input->get("msg")!='') ? $this->input->get("msg"): "";
		if ($this->input->post()) {
			$rules = array(
               array(
                     'field'   => 'first_name',
                     'label'   => 'Fisrt name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'last_name',
                     'label'   => 'Last Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'contact',
                     'label'   => 'Contact Num',
                     'rules'   => 'required'
                  ),
            );  
			if($this->input->post('new_password') !=""){
                
               $rules[] = array(
                     'field'   => 'new_password',
                     'label'   => 'New Password',
                     'rules'   => 'required'
                 );
               $rules[] = array(
                     'field'   => 'confirm_password',
                     'label'   => 'Confirm Password',
                     'rules'   => 'required|matches[new_password]'
                  );
           	}
         
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
					"first_name"		  	 	=> $this->input->post('first_name'),
					"last_name"  		 		=> $this->input->post('last_name'),
					"contact_num"  		 		=> $this->input->post('contact'),
					"country"	  		 	=> $this->input->post('country'),
					"city"	  		 	=> $this->input->post('city'),
					"date_created"  		=> date('Y-m-d H:i:s',time())
				);

				if($this->input->post('new_password') !=""){
					$password=$this->Common_model->encryptIt($this->input->post('new_password'),TRUE);
               		$array['raw_password'] = $this->input->post('new_password');
               		$array['password'] = $password;
				} 
				$contact_id = $this->Users_model->updateUserDetail( $this->session->userdata("user_id"),$array);
				$data['msg'] = "Updated successfully";
			}else{
				$data['contactDetail'] = $_REQUEST;
				$data['error'] = validation_errors();
				$data['user_row'] = $_POST;
			}
		}
		$data['users']= $this->Users_model->getRow($this->session->userdata("user_id"));
		
		$this->load->view('myaccount',$data);

	}

	public function logout(){
		$this->session->unset_userdata('user_id');
		redirect('');
	}
    public function forgetPassword(){
	
		$data	=	array();
		if($this->input->post())
		{
			$rules = array(
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run())
			{
				$email 		= $this->input->post('email');
				$user_row = $this->Users_model->checkEmailExist($email);
				if ($user_row) {
					$user_record	=	$this->Users_model->getUserPassword($email);
					

					if($user_record){
						$password=$user_record->password;
						$message = 'Your Password is '. $password;
						//mail($email,'Forget Password',$message);
						$email_arr = array("password"=>$password,"email"=>$email);
						$result = $this->Emailtemplates_model->sendEmail('forgotpassword',$email_arr);
						$data['success'] = true;
						$data['msg']	= 'Password Successfully sent to your Email.';
					}else{
						$data['success'] = false;
						$data['error']	= 'Email is wrong.';
					}
				}else{
					$data['success'] = false;
					$data['error']	= 'We didnot Find your Email! Please register First!!';
				}
			}else{
				$data['success'] = false;
				$data['error']	= validation_errors();
			}
		}else{
			$data['success'] = false;
			//$data['msg']	= "Invalid Request";
		}
		$data['page_title'] = 'Forget Password';
        $this->load->view('forget_password',$data);
		
	}

	public function dashboard(){
		$data['page_title'] = "My Account";
		$data['user']= $this->Users_model->getUserDataById($this->session->userdata("user_id"));
		$data['orders']= $this->Order_model->getOrderDetailsById($this->session->userdata("user_id"));
		
		if (!empty($this->session->flashdata('form_data'))) {
        	$data['form_data'] = $this->session->flashdata('form_data');
      	}
      	if(!empty($this->session->flashdata('error'))) {
        	$data['error'] = $this->session->flashdata('error');
      	}
      	if(!empty($this->session->flashdata('msg'))) {
        	$data['msg'] = $this->session->flashdata('msg');
      	}
		$this->load->view('dashboard',$data);
	}

	public function personal_details(){
		if ($this->input->post()) {
			$rules = array(
               array(
                     'field'   => 'first_name',
                     'label'   => 'Fisrt name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'last_name',
                     'label'   => 'Last Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'contact_num',
                     'label'   => 'Contact Num',
                     'rules'   => 'required'
                ),
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                )

            );
         
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$array = array(
					"first_name"		  	 	=> $this->input->post('first_name'),
					"last_name"  		 		=> $this->input->post('last_name'),
					"contact_num"  		 		=> $this->input->post('contact_num'),
					"email"  		 		=> $this->input->post('email'),
					"city"	  		 	=> $this->input->post('city'),
					"address" => $this->input->post('address'),
					"house_num"  => $this->input->post('house_num'),
					"post_code"  => $this->input->post('post_code')
				);
				$contact_id = $this->Users_model->updateUserDetail( $this->session->userdata("user_id"),$array);
				$this->session->set_flashdata('msg', "Updated successfully");
				redirect('User/dashboard');
			}else{
				$this->session->set_flashdata('error', validation_errors());
				$this->session->set_flashdata('form_data', $_REQUEST);
				redirect('User/dashboard');
			}
		}
		$this->session->set_flashdata('error', "Invalid Request!");
		redirect('User/dashboard');
	}

	public function change_password(){
		if ($this->input->post()) {
			$rules = array(
               	array(
                     'field'   => 'new_password',
                     'label'   => 'New Password',
                     'rules'   => 'required'
                ),
               	array(
                     'field'   => 'confirm_password',
                     'label'   => 'Confirm Password',
                     'rules'   => 'required|matches[new_password]'
                )
            );
         
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				$password = $this->Common_model->encryptIt($this->input->post('new_password'),TRUE);
           		$array = array(
           			"raw_password" => $this->input->post('new_password'),
           			"password" => $password
           		);
				
				$contact_id = $this->Users_model->updateUserDetail($this->session->userdata("user_id"),$array);
				$this->session->set_flashdata('msg', "Password Changed successfully!");
				redirect('User/dashboard');
			}else{
				$this->session->set_flashdata('error', validation_errors());
				$this->session->set_flashdata('form_data', $_REQUEST);
				redirect('User/dashboard');
			}
		}
		$this->session->set_flashdata('error', "Invalid Request!");
		redirect('User/dashboard');	
	}
		public function showDetail($user_id){

		$data['orders'] = $this->Contactqueries_model->getAllOrdersdetail($user_id);
		$data['order'] = $this->Contactqueries_model->getAllDetail($user_id);

         
		$data['page_title'] = 'Orders';
		$data['page_heading'] = 'Products Detail';
		$this->load->view('detail_order',$data);
	}
     
}
