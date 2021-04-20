<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
		$this->load->model('Pages_model');
		$this->load->model('Sliderimages_model');
		$this->load->model('Product_model');
		$this->load->model('Common_model');
		$this->load->model('preferences_model');
		$this->load->model('Categories_model');
		$this->load->model('Awards_model');
		$this->load->model('Partners_model');
		$this->load->model('Subscription_model');
		$this->load->model('Preferences_model');
		$this->load->model('News_model');
		$this->load->model('Users_model');
		$this->load->model('Emailtemplates_model');
		$this->data['header_pages']  = $this->Pages_model->getPagesByType('header','both');
		$this->data['footer_pages']  = $this->Pages_model->getPagesByType('footer','both');
		$this->load->helper('cookie');
    }
   
	public function index()
	{
		if($this->session->userdata('user_id')!='') {
			redirect(base_url());
		}

		$data	=	array();
		if($this->input->post())
		{
			$rules = array(
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                  )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run())
			{
				$email 		= $this->input->post('email');
				$password 	= $this->input->post('password');
				//alert($email);
				//$checkEmail = $this->Users_model->checkEmailVerification($email);
				$user_row = $this->Users_model->checkEmailExist($email);
				if ($user_row) {
					if ($user_row['email_verify'] == 'true') {
						$user_record	=	$this->Users_model->authenticate($email,$password);
						if($user_record){
							if($user_record->account_type!='free'){
								if($this->Users_model->checkUserAmountForYear($user_record->id)<=0){

									$arr['success'] = false;
									$arr['message']	= 'You did not pay for Subscription. <a href="#" data-dismiss="modal" data-toggle="modal" onclick="updateSubscriptionEmail('.$user_record->id.')" data-target="#payNowModal" class="submit_button">Pay Now</a>';
								}else{
									$login_data['user_id']		=	$user_record->id;
									$login_data['email']		=	$user_record->email;
									$login_data['full_name']	=	$user_record->username;
									$login_data['type']			=	$user_record->type;
									$this->session->set_userdata($login_data);
									$arr['success'] = true;
								}
							}else{
								$login_data['user_id']		=	$user_record->id;
								$login_data['email']		=	$user_record->email;
								$login_data['full_name']	=	$user_record->username;
								$login_data['type']			=	$user_record->type;
								$this->session->set_userdata($login_data);
								$arr['success'] = true;
							}
						}else{
							$arr['success'] = false;
							$arr['message']	= 'Email or password is wrong.';
						}
					}else{
						$arr['success'] = false;
						$arr['message']	= 'Please verify your email. <a class="btn_link" href="'.base_url().'Subscription/activation_email/'.$email.'">Click Here</a> to resend activation email';
					}
				}else{
					$arr['success'] = false;
					$arr['message']	= 'You have not got any subscription account yet. Please subscribe first!';
				}
			}else{
				$arr['success'] = false;
				$arr['message']	= validation_errors();
			}
		}else{
			$arr['success'] = false;
			$arr['message']	= "Invalid Request";
		}
		echo json_encode($arr);
	}

	public function checkEmailExist()
	{
		
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
					if ($user_row['email_verify'] == 'true') {
						$arr['success'] = true;
						$arr['message']	= 'You already subscribe, please login';
					}else{
						$arr['success'] = false;
						$arr['message']	= 'Please verify your email. <a class="btn_link" href="'.base_url().'Subscription/activation_email/'.$email.'">Click Here</a> to resend activation email';
					}
				}else{
					$arr['success'] = true;
					//$arr['message']	= 'You have not any subscribe account, Please subscribe first!';
				}
			}else{
				$arr['success'] = false;
				$arr['message']	= validation_errors();
			}
		}else{
			$arr['success'] = false;
			$arr['message']	= "Invalid Request";
		}
		echo json_encode($arr);
	}

	public function forgetPassword()
	{
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
						//$message = 'Your Password is '. $user_record;
						//mail($email,'Forget Password',$message);
						$email_arr = array("password"=>$user_record,"email"=>$email);
						$result = $this->Emailtemplates_model->sendEmail('forgotpassword',$email_arr);
						$arr['success'] = true;
						$arr['message']	= 'Password Successfully sent to your Email.';
					}else{
						$arr['success'] = false;
						$arr['message']	= 'Email is wrong.';
					}
				}else{
					$arr['success'] = false;
					$arr['message']	= 'You have not got any subscription account yet. Please subscribe first!';
				}
			}else{
				$arr['success'] = false;
				$arr['message']	= validation_errors();
			}
		}else{
			$arr['success'] = false;
			$arr['message']	= "Invalid Request";
		}
		echo json_encode($arr);
		
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

	/*public function forgotPassword(){

		if($this->input->post())
		{
			$rules = array(
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                )
            );

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run())
			{

				
				$user_record	=	$this->Admin_model->getRowByEmail($this->input->post('email',TRUE));
				if($user_record)
				{
					$arr = array(
							"full_name" => $user_record['full_name'],
							"username"  => $user_record['username'],
							"password"  => $this->Common_model->decryptIt($user_record['password']),
							"email"     => $user_record['email']
						   );
					$result = $this->Emailtemplates_model->sendMail('forgot_password',$arr);
					if($result){
						$data['success']      = 'Email Send to '.$user_record['email'];
					}
				}
				else
				{
					$data['error']	=	 'Email not found.';
				}
			}
		}

		$data['page_title'] = 'Forgot Password';
		$data['page_heading'] = 'Forgot Password';
		$this->load->view('admin/forgot_password',$data);
	}*/

}
