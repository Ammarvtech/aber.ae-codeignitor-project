<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/third_party/stripe-php/init.php');

class Products extends CI_Controller {


	function __construct() {
       	parent::__construct();
        $this->load->model('Media_model');
        $this->load->model('Emailtemplates_model');
        $this->load->model('Contactqueries_model');
        $this->load->model("Order_model");
        $this->load->model('Users_model');
		$this->load->model('Pages_model');
		$this->load->model('Sliderimages_model');
		$this->load->model('Product_model');
		$this->load->library("pagination");
		$this->load->model('Common_model');
		$this->load->library('session');
		$this->load->model('Preferences_model');
		$this->lang->load('access',$this->session->userdata("site_lang"));
    	$this->language=$this->session->userdata("site_lang");
		$this->data['header_pages']  = $this->Pages_model->getPagesByType('header','both');
		$this->data['footer_pages']  = $this->Pages_model->getPagesByType('footer','both');
		$this->load->helper('cookie');
    }

	public function index($id=''){
		$data['page_title'] = ' Products' ;
		$data['products']  =  $this->Product_model->getProducts();

		$this->load->view('products',$data);
	}
	public function search(){
		$data['page_title'] = 'Category Products' ;
		$aa=$this->input->post();
		$a = implode($aa);
		$data['products']  =  $this->Product_model->getCategoryProductsforsearch($a);
		$data['categories']  =  $this->Product_model->getCategoryAll($this->session->userdata("location_id"));
		$data['category_name'] = $a;

		$data['total_products'] = $this->Product_model->countAllPrducts(); 
		$this->load->view('category_products',$data);
	}
	
	public function detail($id){
         $data['page_title'] = 'Product Detail';
        $data['mediaDetail']  =  $this->Media_model->get_products_by_id($id);
        

		$this->load->view('product-detail',$data);
	}
	function add_to_cart(){
		$price=0;
        if(is_array($this->input->post('modifier'))){
		foreach  ($this->input->post('modifier') as  $value) {
			 list($one, $two) = explode(",", "$value", 2);
			 $price += $two;

		}
	}
         
		$data = array(
			'id' 		=> $this->input->post('product_id'),
			'name' 		=> $this->input->post('product_name'),
			'price_product'=> $this->input->post('product_price'),
			'price' 	=> $this->input->post('product_price') + $price,
			'modifier' 	=>  $this->input->post('modifier'),
			'qty' 		=> $this->input->post('quantity'),
			'options' 	=> array('Image' => $this->input->post('picture'))
		);

		$this->cart->insert($data);
		$data['page_title'] = 'Cart';
		$re = $this->cart->total_items();
		echo $re;
	}
	function cart_data(){
		$data['page_title'] = 'Cart';
		$this->load->view('ajax_cart',$data);
	}

	function load_cart(){ 
		$data = array();
		$html = $this->load->view('ajax_cart_item',$data,true);
		echo $html;
	}

	function plus(){
		$qty = $this->input->post('qty');
        $qty = $qty+1;
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => $qty, 
		);

		$this->cart->update($data);
		$this->load->view('ajax_cart_item',$data);

	}

	function minus(){ 
		$qty = $this->input->post('qty');
        $qty = $qty-1;
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => $qty, 
		);
		$this->cart->update($data);
		$this->load->view('ajax_cart_item',$data);
	}

	function total_price(){
        $total= $this->cart->total();
        echo $total;
    }

	public function loadmoredata(){
		$limit = $this->input->post('val');
		$data['news'] = $this->Product_model->getLatestNews($limit);

		//$language = $this->Common_model->get_language_name();
		 echo $this->load->view('loadmoredata',$data, true);
	}

	public function order(){
		if ($this->input->post()) {
			$rules = array(
               /*array(
                     'field'   => 'my_card',
                     'label'   => 'My Card',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'reload_amount',
                     'label'   => 'Reload amount',
                     'rules'   => 'required'
                  ),*/
               array(
                     'field'   => 'payment_method',
                     'label'   => 'Payment Method',
                     'rules'   => 'required'
                  )
            );

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
			  	$session = array('payment_method'=>$_POST['payment_method'],'total'=>$_POST['total']);
               	$this->session->set_userdata($session);
				echo json_encode(['status' => 'true']); die;
			}else{
				/*$data['contactDetail'] = $_REQUEST;
				$data['error'] = validation_errors();*/
				echo json_encode(['status' => 'false']); die;
			}
		}

		if (!empty($this->session->flashdata('form_data'))) {
        	$data['form_data'] = $this->session->flashdata('form_data');
      	}
      	if(!empty($this->session->flashdata('error'))) {
        	$data['error'] = $this->session->flashdata('error');
      	}
		$data['page_title'] = 'Billing';		
		$this->load->view('billing_view',$data);
	}
	
	public function billing(){
		$data['page_title'] = 'Check out';
		$discount_value =0;
		$payment_method = $this->session->userdata('payment_method');
		if ($this->input->post()) {
			$rules = array(
               array(
                     'field'   => 'adress_1',
                     'label'   => 'Adress 1',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'adress_2',
                     'label'   => 'Adress 2',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'city',
                     'label'   => 'City',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'state',
                     'label'   => 'State',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'zip_code',
                     'label'   => 'Zip Code',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'phone',
                     'label'   => 'Phone',
                     'rules'   => 'required'
                  )/*,
               array(
                     'field'   => 'billing_add',
                     'label'   => 'Billing Adress',
                     'rules'   => 'required'
                )*/
            );
          

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run()) {
				
				$foremail = $this->Order_model->getDataOfId($this->session->userdata('user_id'));
           if($this->input->post('discount_code') !=""){

					$discount = $this->Order_model->get_discount_value($this->input->post('discount_code'));
					if($discount != ""){
						if($discount->type =="amount" ){
							$discount_value = $discount->value;
							$total =$this->session->userdata('total')-$discount_value;
							$this->session->set_userdata('sub_total',$total);
						}
						if($discount->type =="percentage" ){
							$percentInDecimal = $discount->value / 100;
							$percent = $percentInDecimal * $this->cart->total();
							$discount_value = $percent;
							$total =$this->session->userdata('total')-$percent;
							$this->session->set_userdata('sub_total',$total);

	                 	}
	                 	$array['discount_code'] = $this->input->post('discount_code');
	                 	$array['discount_amount'] = $discount_value;
	                }else{

	                	$this->session->set_flashdata('form_data', $_REQUEST);
	                	$this->session->set_flashdata('error',"Discount Code is not valid!");
	                	echo json_encode(['error'=>'true']);die;
	                }
				}
			
            	$array = array(
					'full_name' => $foremail->first_name,
					'email' => $foremail->email,
					'discount_amount' => $discount_value,
					'discount_code' => $this->input->post('discount_code'),
					//'clover_id' => $order_data->id,
					'customer_id' => $this->session->userdata('user_id'),
					//"my_card"		  	 	=> $this->session->userdata('my_card'),
					"total"		  	 	=> $this->session->userdata('total'),
					"sub_total"		  	 	=> $this->session->userdata('sub_total'),
					//"reload_amount"  		 => $this->session->userdata('reload_amount'),
					"payment_method"    => $this->session->userdata('payment_method'),
					//"billing_address" => $this->input->post('billing_add'),
					"phone"  		 => $this->input->post('phone'),
					"zip_code"  		 => $this->input->post('zip_code'),
					"state"  		 => $this->input->post('state'),
					"city" => $this->input->post('city'),
					"adress_2"		  	 	=> $this->input->post('adress_2'),
					"adress_1"  		 => $this->input->post('adress_1'),
					"date_created"  		=> date('Y-m-d H:i:s',time())
				);

				$order_id = $this->Order_model->insertAddonFormData($array);


				foreach($this->cart->contents() as $key => $value){
					$one=0;
					$two=0;
					if(is_array($value['modifier'])){
						foreach ($value['modifier'] as $item) {
							$array = explode(",",$item);
							$one = $array[0];
							$two = $array[1];
					    }
					}

					$order_details[] = [
						"order_id" => $order_id,
						"product_id" => $value['id'],
						"product_name" => $value['name'],
						"modifier" => $one,
						"modifier_price" => $two,
						"product_price"	=> $value['price'],
						"product_quantity" => $value['qty']
					];
				}
				
                $this->db->insert_batch('order_detail',$order_details);
				$this->session->set_userdata('order_id',$order_id);
				echo json_encode(['status'=>'true']); die;
			}else{
				
				$this->session->set_flashdata('form_data',$_REQUEST);
				$this->session->set_flashdata('error',validation_errors());
				echo json_encode(['status'=>'false']); die;
				//redirect("Products/billing");
			}
		}else{
			
			$this->session->set_flashdata('error',"Invalid Request");
			echo json_encode(['status'=>'false']); die;
			//redirect("Products/billing");
		}
	}

	public function proceed_to_payment(){
		$payment_method = $this->session->userdata('payment_method');
       if ($payment_method=='cod') {
       	redirect("Products/checkout");
       }
       
		//$data['msg'] = $this->session->flashdata('msg');
		$order_id = $this->session->userdata('order_id');

      	$order = $this->Order_model->getOrderDataById($order_id);
      	$data['order']=	$order;

		$data['amount'] = $order->total;

		if($this->input->post()) {
            $result = $this->_subscribe_customer($this->session->userdata('order_id'), $order->total);
            if($result['success']==true){
                	
            	/////////////////// Clover Data /////////////////////
        		$foremail = $this->Order_model->getDataOfId($this->session->userdata('user_id'));
        		$pay  = $this->curl->getRequest(API_V2_URL);
	            $orderArray = array(
	                'total'     => $order->total * 100,
	                "state"     => "OPEN",
	                "currency" => "usd",
	                "manualTransaction" => false, 
	                "groupLineItems"    => true, 
	                "testMode" => false, 
	                "payType" => "FULL"
	            );
    			
    			$order_data   = $this->curl->postRequest(ADD_ORDER_URL,$orderArray);
                
                //////////// Get Tenders ////////////////
                $tenders = $this->curl->getRequest(GET_TENDERS);
	            
	            // payment by cash
	            //if($payment_method == "cod"){

		            foreach ($tenders->elements as $key => $t) {
		            	if($t->label == "Cash"){
		            		$payments['tender']['id'] = $t->id;
		            	}
		            }

	                $mTotal = $order->total * 100;

	                //$payments['employee']['id'] = $branch['employee'];
	                //$payments['device']['id']   = $deviceId;
	                $payments['order']['id']    = $order_data->id;
	                $payments['amount']         = $mTotal;
	                $payments['taxAmount']      = 0;//$totalTaxValue;
	                $payments['opensCashDrawer']      = false;
	                $payments['result']      = "SUCCESS";
	                $payments['payType']     = "FULL";
	                                                
	                // Add Payment order.
	                $payment_url = str_replace('orderId', $order_data->id, CREATE_PAYMENT);
	                $payment_data   = $this->curl->postRequest($payment_url,$payments);
    			//}

    			//payment by credit card 
    			/*if($payment_method == "credit_card1"){
    				$card_number = $this->input->post('card_num');
    				$first6 = substr($card_number,0 , 6);
    				$last4 = substr($card_number, -4);

                    $paymentData = array(
                        "orderId"   => $order_data->id, //the Clover order 
                        "currency"  => "usd",
                        "amount"    => $this->session->userdata('total') * 100,
                        "tipAmount" => 0,
                        "taxAmount" => 0,
                        "first6"    => $first6,
                        "last4"     => $last4,
                        "vaultedCard"=> array(
                             //"token" => $card['token'],
                             "first6" => $first6,
                             "last4"  => $last4,
                              "expirationDate" => $this->input->post('date')."".$this->input->post('year')
                        ));

                    $transData = $this->curl->postRequest(API_V2_URL, $paymentData);
    				print_r($transData);
    			}*/

    			// Add Customer
    			$customer = array('id' => $foremail->clover_id);
                $orderArray['customers'][] = $customer;
                $edit_order_url = str_replace('orderId', $order_data->id, EDIT_ORDER_URL);
                $customer_data   = $this->curl->postRequest($edit_order_url,$orderArray);

                // Add Line Items
    			foreach($this->cart->contents() as $key => $item){
    				$cloverProdId = $this->Product_model->getCloverProductId($item['id']);
    				$data = array(
                        'item'     => array(
                            'id' => $cloverProdId
                        ),
                        "name"   => $item['name'],
                        'price'  => $item['price'] * 100
                    );
                    
                    $itemsArray[] = $data;
                }
                     
               	$lineItems = array('items' => $itemsArray);
                $create_line_items = str_replace('orderId', $order_data->id, CREATE_LINE_ITEMS);
                $itemsData   = $this->curl->postRequest($create_line_items,$lineItems);
                
                if(!isset($order_data->id)){
                    $this->data['message'] = $order_data->message;
                    $this->data['orderDetails'] = $REQUEST;
                }else{
                	$array = array(
						'clover_id' => $order_data->id,
					);

					/*if($payment_method == "credit_card"){
						$array["cvn"] = $this->input->post('cvn');
						$array["card_num"] = $this->input->post('card_num');
						$array["card_name"] = $this->input->post('card_name');
						$array["card_type"] = $this->input->post('card_type');
						$array["nick_name"]	= $this->input->post('nick_name');
						$array["expiry"] = $this->input->post('date')."-".$this->input->post('year');
					}*/
					
					//$contact_id = $this->Users_model->insertPaymentFormData($array);
					//$order_id = $this->Order_model->updateOrderData($array);
					//$order = $this->Order_model->getOrderDataById($order_id);
					
					$email_arr = array("email" => $order->email, "name" =>$order->full_name);
					$result = $this->Emailtemplates_model->sendEmail('order',$email_arr);
					$place_order = $this->Order_model->updateOrderDetails($array, $order->id);
					/*foreach($this->cart->contents() as $key => $value){
						$order_details[] = [
							"order_id" => $order->id,
							"product_id" => $value['id'],
							"product_name" => $value['name'],
							"product_price"	=> $value['price'],
							"product_quantity" => $value['qty']
						];
					}
					if(isset($order_details)){
                    	$this->db->insert_batch('order_detail',$order_details);
                	}*/
                	$this->session->set_flashdata('msg','Your Order has been placed Successfully!');
					redirect("Products/checkout");
                }

        		////////////////// End Clover ////////////////////////

            }else{
                $data['error'] = $result['message'];
            }
        }
        $data['page_title'] = 'Payment';

		$this->load->view('payment-view',$data);
	}

	public function checkout(){
		$data['page_title'] = 'Check out';
		$data['msg'] = $this->session->flashdata('msg');
      	$this->cart->destroy();
     	$this->load->view('checkout',$data);
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


	function createOrder(){
        $paramVal = $this->requestAuthorization();        
        $customerId    = $paramVal['customerId'];
        $merchantId    = $paramVal['merchantId'];
        $data          = $paramVal['lineItems'];
        $deviceId      = $paramVal['deviceId'];
          
        $user = $this->getUserDetails($customerId);
        $store = $this->PppBranch->find('first', array('conditions'=>array('status' => 1, 'merchantId' => $merchantId)));
        
        if(count($store) <= 0){ 
            $response = array(
                'error' => true,
                'message' => "Branch not found",
            );
            $this->jsonOutput($response);
        }
        
        $branch = $store['PppBranch'];
                
        $totalTaxValue = 0;
        $totalPrice = 0;
        
        $data = json_decode($data, true);        
        
        $isBalance = $data['isBalance'];
        $cardId =  0;
        if(isset($data['cardId']))
            $cardId = $data['cardId'];
        
        $reloadAmount =  0;
        if(isset($data['reloadAmount']))
            $reloadAmount = $data['reloadAmount'];
                
        $lineItems = $data['lineItems'];  
               
        $mResult = $this->PppReward->find('all', array('conditions'=>array('status' => 1, 'type IN' => array(3, 0, 2))));
        
        $rewards = array();        
        foreach($mResult as $item)
            $rewards[] = $item['PppReward'];
        
        $rewardsCount = 0;            
        foreach($lineItems as $item){
            $itemPrice = $item['price'];
            $modifiers = $item['modifiers'];
            foreach($modifiers as $modifier)
                $itemPrice = $itemPrice + $modifier['price'];
            
            $rewardFoundAndApplied = false;
            
            foreach($rewards as $rewardItem)
            {
                if($rewardItem['type'] == REWARD_ITEM && $rewardItem['itemId'] == $item['id'])
                {
                    $rewardFoundAndApplied = true;
                    $rewardsCount = $rewardsCount + (round(($item['unitQty'] * $itemPrice)) * $rewardItem['bonus']);
                }
                
                $dayOfWeek = date('w');
                if($rewardItem['type'] == REWARD_DAY && $rewardItem['day'] == $dayOfWeek)
                {
                    $rewardFoundAndApplied = true;
                    $rewardsCount = $rewardsCount + (round(($item['unitQty'] * $itemPrice)) * $rewardItem['bonus']);
                }
            }
            
            if(!$rewardFoundAndApplied)
            {
                $rewardsCount = $rewardsCount + round(($item['unitQty'] * $itemPrice));
            }
            
            $totalPrice = $totalPrice + ($item['unitQty'] * $itemPrice);            
            $totalTaxValue = $totalTaxValue + $item['taxValue'];
        }
        
        //$this->jsonOutput($rewardsCount);        
        $totalPrice    = $totalPrice * 100;
        $totalTaxValue = $totalTaxValue * 100;
               
        if(count($store) > 0){
            
            $branch = $store['PppBranch'];            
            $url = $this->getCloverUrl($merchantId) . "/" . $merchantId . "/orders?access_token=" . $branch['accessToken'];            
            
            $user = $this->getUserDetails($customerId);
            
            $cloverDetails = $this->getCloverCustomer($merchantId, $branch['accessToken'], $branch['id'], $user);
            $cloverCustId = $cloverDetails['cloverId'];   
            
            $customersList = array();
            $customer = array('id' => $cloverCustId);
            $customersList[] = $customer;
            
            $orderArray = array(
                'total'     => $totalPrice,
                "state"     => "OPEN",
                'currency'  => "USD",
                "employee"  =>  array("id" => $branch['employee']),
                //"orderType" =>  array("id" => "NC276PC2YQAHW"),
                "manualTransaction" => false, 
                "groupLineItems"    => true, 
                "testMode" => false, 
                "payType" => "FULL",
                "device"  =>  array("id" => $deviceId),
            );
            
            $order = $this->getUrlResponse($url, true, $orderArray);
            //$this->jsonOutput($order);
            $order = json_decode($order, true);
            $orderId = $order['id'];
                        
            if(isset($order['href']))
            {
                $url = $order['href'];
                
                // Make Payment
                $payments = array();
                $tenders = $this->getAllTenders($merchantId, $branch['accessToken']);
                
                if (!$isBalance)
                {
                    if(isset($data['applePayDict'])) // Apple Pay
                    {
                        $tender = '';
                        foreach($tenders as $mTender)
                        {
                            if($mTender['label'] == 'Credit Card')
                                $tender = $mTender;
                        }
                        
                        $payments['tender']['id'] = $tender['id'];
                        
                        $transData = $data['applePayDict'];
                        $type = "Reload via Apple Pay";
                    }
                    if(isset($data['googlePayDict'])) // Apple Pay
                    {
                        $tender = '';
                        foreach($tenders as $mTender)
                        {
                            if($mTender['label'] == 'Credit Card')
                                $tender = $mTender;
                        }
                        
                        $payments['tender']['id'] = $tender['id'];
                        
                        $transData = $data['googlePayDict'];
                        $type = "Reload via Google Pay";
                    }
                    else
                    {
                        $card = $this->PppCard->find('first', array('conditions'=>array('id' => $cardId)
                        ));

                        if(count($card) <= 0)
                        { 
                            $response = array(
                                        'error' => true,
                                        'message' => "Card not found",
                                );
                            $this->jsonOutput($response);
                        }
                        
                        $tender = '';
                        foreach($tenders as $mTender)
                        {
                            if($mTender['label'] == 'Credit Card')
                                $tender = $mTender;
                        }
                        
                        $payments['tender']['id'] = $tender['id'];

                        $card = $card['PppCard'];                        
                        $mUrl = $this->getCloverUrlV2($merchantId) . "/" . $merchantId . "/pay?access_token=" . $branch['accessToken'];   

                        $paymentData = array(
                                    "orderId"   => $orderId, //the Clover order 
                                    "currency"  => "usd",
                                    "amount"    => $totalPrice,
                                    "tipAmount" => 0,
                                    "taxAmount" => $totalTaxValue,
                                    "first6"    => $card['first'],
                                    "last4"     => $card['cardNum'],
                                    "vaultedCard"=> array(
                                             "token" => $card['token'],
                                             "first6"    => $card['first'],
                                             "last4"     => $card['cardNum'],
                                              "expirationDate"=> $card['expiry']
                                    ));

                        $transData = $this->getUrlResponse($mUrl, true, $paymentData);
                        $type = "Reload via Card";
                    }
                }
                else
                {                   
                    $userBalance = $user['balance'] * 100;
                    $mTotal = $totalPrice + $totalTaxValue;
                    if($userBalance < $mTotal)
                    {
                            $response = array(
                                'error' => true,
                                'message' => "Branch not found",
                            );
                            $this->jsonOutput($response);
                    }
                    else
                    {
                        // Getting cash tender
                        $tender = '';
                        foreach($tenders as $mTender)
                        {
                            if($mTender['label'] == 'Cash')
                                $tender = $mTender;
                        }
                        
                        $payments['tender']['id'] = $tender['id'];
                    }
                }   
                
                $mTotal = $totalPrice + $totalTaxValue;

                $payments['employee']['id'] = $branch['employee'];
                $payments['device']['id']   = $deviceId;
                $payments['order']['id']    = $orderId;
                $payments['amount']         = $mTotal;
                $payments['taxAmount']      = $totalTaxValue;
                $payments['opensCashDrawer']      = false;
                $payments['result']      = "SUCCESS";
                $payments['payType']     = "FULL";
                                                
                // Add Payment order.
                $mUrl = $this->getCloverUrl($merchantId) . "/" . $merchantId . "/orders/$orderId/payments?access_token=" . $branch['accessToken'];   
                $order = $this->getUrlResponse($mUrl, true, $payments);               
                $order = json_decode($order, true);
                //$this->jsonOutput($order);
                                                
                // update order.
                $mUrl = $this->getCloverUrl($merchantId) . "/" . $merchantId . "/orders/$orderId?access_token=" . $branch['accessToken'] . "&expand=lineItems,customers,payments,credits,refunds,serviceCharge,discounts";   
                $orderArray = array(
                    "payType" => "FULL",
                    'customers' => $customersList
                 ); 
                                
                $order = $this->getUrlResponse($mUrl, true, $orderArray);               
                $order = json_decode($order, true);

                                         
                $mUrl = $url . "/bulk_line_items?access_token=" . $branch['accessToken']; 
                $itemsArray = array();
                
                $modifiersList = array();
                
                foreach($lineItems as $item)
                {
                    $modifiersPrice = 0;
                    $modifiers = $item['modifiers'];
                    foreach($modifiers as $modifier)
                    {
                        $modifiersPrice = $modifiersPrice + $modifier['price'];
                    }  

                    for ($x = 0; $x < $item['unitQty']; $x++) 
                    {
                        $taxRates = array();
                        $taxRates[] = $item['tax'];
                        
                        $data = array(
                            'item'     => array(
                                'id' => $item['id']
                            ),
                            "name"   => $item['name'],
                            'price'  => $item['price'] * 100,
                            'priceWithModifiers' => $modifiersPrice + $item['price'] * 100,
                            "taxRates" => $taxRates
                        );
                        
                        $itemsArray[] = $data;
                    }    
                    
                    $modifiersList[$item['id']] = $item['modifiers'];
                }
                
                $data = array('items' => $itemsArray);                                
                $data = $this->getUrlResponse($mUrl, true, $data); 
                $itemsListArray = json_decode($data, true);                                
                              
                $responsesModList = array();
                foreach($itemsListArray as $item)
                {
                    $itemIndexId = $item['id'];                    
                    $itemId = $item['item']['id'];                         
                    $modifiers = $modifiersList[$itemId];
                    foreach($modifiers as $modifier)
                    {
                        $data = array(
                                'modifier' => array(
                                    'id' => $modifier['modId']
                                )
                        );                
                        
                        $mUrl = $this->getCloverUrl($merchantId) . "/" . $merchantId . "/orders/$orderId/line_items/$itemIndexId/modifications?access_token=" . $branch['accessToken'];   
                        $responsesModList[] = $this->getUrlResponse($mUrl, true, $data); 
                    }                    
                }
                
                $orderData = array(
                    'modifiers' => json_encode($responsesModList),
                    'payments'  => json_encode($payments),
                    'lineItems' => json_encode($itemsListArray),
                    'orderId'  => $orderId,
                    'currency' => 'USD',
                    'customerId' => $customerId,
                    'employeeId' => $branch['employee'],
                    'branchId'   => $branch['id'],
                    'totalPrice' => $totalPrice,
                    'taxAmount'  => $totalTaxValue,
                    'cardId'      => $cardId,
                );
                
                $this->PppOrder->save($orderData);
                $mOrderId = $this->PppOrder->getLastInsertID();  
                
                if($isBalance)
                {
                    $mTotal = $totalPrice + $totalTaxValue;
                    $mTotal = $mTotal/100;
                    
                    $userBalance = $user['balance'];
                    $userBalance = round(($userBalance - $mTotal), 2);                    
                    $this->PppCustomer->query("UPDATE ppp_customers SET balance = $userBalance, rewardsCount = (rewardsCount + $rewardsCount) WHERE id = $customerId");
                    
                    $transactionData = array(
                        'orderId'  => $mOrderId,
                        'customerId' => $customerId,
                        'rewardAdded' => $rewardsCount,
                        'amount'      => $mTotal,
                        'type'  => "Balance Deduction",
                    );

                    $this->PppTransaction->save($transactionData); 
                }
                else
                {
                    $userBalance = $user['balance'];
                    $mTotal = $totalPrice + $totalTaxValue;
                    $mTotal = $mTotal/100;
                        
                    $valueAdd = $reloadAmount - $mTotal;
                    $userBalance = $userBalance + $valueAdd;
                    $userBalance = round($userBalance, 2);
                                        
                    $this->PppCustomer->query("UPDATE ppp_customers SET balance = $userBalance, rewardsCount = (rewardsCount + $rewardsCount) WHERE id = $customerId");
                    
                    $transactionData = array(
                        'orderId'       => $mOrderId,
                        'customerId'    => $customerId,
                        'rewardAdded'   => $rewardsCount,
                        'amount'        => $valueAdd,
                        'type'          => $type,
                        'transData' => $transData
                    );
                   
                    $this->PppTransaction->save($transactionData); 
                }
                
                //$this->sendEmail($to, $subject, $message);
                
                $response = array(
                            'error' => false,
                            'message' => "Order has been created successfully.",
                            'data' => $this->getUserDetails($customerId),
                            'orderId' => $orderId
                    );
                $this->jsonOutput($response);
            }
            else{
                $response = array(
                            'error' => true,
                            'message' => "An error has occurred",
                    );
                $this->jsonOutput($response);                
            }            
            
            $response = array(
                        'error' => false,
                        'message' => $result,
                );
            $this->jsonOutput($response);
            
        }else{
            
            $response = array(
                        'error' => true,
                        "invalidKey" => false,
                        'message' => 'No data found',
                );
            $this->jsonOutput($response);
        }
    }

     private function _subscribe_customer($id, $amount){
        $stripe_token   = $this->input->post('stripeToken');
        $arr = "";
        try {
            \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
            $charge = \Stripe\Charge::create(array(
                "amount"        => $amount*100,
                "description"   => "One Time bill payment",
                "currency"      => STRIPE_CURRENCY,
                "source"        => $stripe_token
            ));
         
            $data['merchant_response'] = mysql_real_escape_string($charge);
            /* if remember card yes in customer then token will be save */
            $countinue_process = true;
            $data['payment_status'] = 'completed';
            $this->Order_model->updateOrderDetails($data,$id);
            $arr = array("success"=>true,"message"=>"Payment Charged Successfully");
        }catch (Exception $e) {
        // The card has been declined
            $countinue_process = false;
            $array = $e->getJsonBody();
            $arr = $array['error']['message'];
        }
        return $arr;
    }

}
