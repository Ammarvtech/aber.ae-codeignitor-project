<?php
class Users_model extends CI_Model
{

	public function updateCount($id){
		$counts = $this->getCountValue($id);

		$query = "update users set counts=$counts+1 where id=$id";
		return $this->db->query($query);
	}

	public function getCountValue($id){
		$this->db->select('counts');
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->row()->counts;
		}

		return 0;

	}

	public function save($data){
		if($this->input->post('discount_amount')!=''){
			$data['discount_code'] 	 = $this->input->post('discount_code');
			$data['discount_amount'] = $this->input->post('discount_amount');
		}

		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}

	public function update($data,$id){
		$this->db->where('id' , $id);
		$this->db->update('users' , $data);
		return true;
	}

	public function updateWithMd5Id($data,$id){
		$this->db->where('md5(id)' , $id);
		$this->db->update('users' , $data);
		return true;
	}

	public function updateOrder($id,$data){
		$this->db->where('id' , $id);
		$this->db->update('orders' , $data);
		return true;
	}

	public function addOrder($data){
		$this->db->insert('orders',$data);
		return true;
	}

	public function checkUserAmountForYear($id){
		$date = date("Y-m-d");
		$this->db->where("uid",$id);
		$this->db->where('expiry_date >=' , $date);
		$query = $this->db->get('orders');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return 0;
	}

	public function getAllUsers($limit,$offset){
		$this->db->order_by('id','desc');
		$query = $this->db->limit($limit, $offset)->get('users');
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}

	public function getAllExpireUsers(){
		$date = date("Y-m-d");
		$this->db->select('*');
		$this->db->where('expiry_date <' , $date);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return array();
	}

	public function countUserTotal(){
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return 0;
	}

	public function countPaidPaymentsTotal(){
		$this->db->where('status' , 'paid');
		$query = $this->db->get('orders');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return 0;
	}

	public function getUserDetail($id){
				 $this->db->where('id', $id);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return array();
	}

	public function getExpiryDate($id){
		$this->db->select('expiry_date');
		$this->db->where('uid', $id);
		$query = $this->db->get('orders');
		if ($query->num_rows() > 0) {
			return $query->row()->expiry_date;
		}

		return "";
	}

	public function getUserDetailByEmail($email){
				 $this->db->where('email', $email);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return array();
	}

	public function getRow($id){
		$sSQL   =   $this->db->where("id",$id);
		$sSQL	=	"select * from users";
		$query  =   $this->db->get('users');
		
		if($query->num_rows())
		{
			$row = $query->row_array();
			return $row;
		}
		return array();
	}


	public function getRow2($id){
		$sSQL   =   $this->db->where("id",$id);
		$sSQL	=	"select * from users";
		$query  =   $this->db->get('users');
		
		if($query->num_rows())
		{
			$row = $query->row();
			return $row;
		}
		return array();
	}

	public function getUserRowBymd5($id){
		$this->db->where('md5(id)', $id);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return "";
	}

	public function getUserDetail2($id){
				 $this->db->where('id', $id);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		}
		return 0;
	}

	public function getUserType($id){
				 $this->db->select('type');
				 $this->db->where('md5(id)', $id);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->row()->type;
		}
		return "";
	}

	public function delete_user($id){
		$this->db->where('id', $id);
		$this->db->delete('users');	
	}

	public function getRowByEmail($email){
		$this->db->where("email",$email);
		$query  =   $this->db->get('users');
		if($query->num_rows())
		{
			$row = $query->result_array();
			return $row[0];
		}
		return array();
	}

	public function checkEmailVerification($email){
		$this->db->select('*');
		$this->db->where('email', $email);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		}
		return false;
	}

	public function checkEmailExist($email){
		$this->db->where('email', $email);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		}
		return false;
	}
	
	function authenticate($email,$password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('users');
		if( $query->num_rows() > 0)
		{
			$record	=	$query->result();
			return $record[0];
		}
		else
		{
			return FALSE;
		}
	}

	function getUserPassword($email)
	{
		$this->db->select('password');
		$this->db->select('id');
		$this->db->where('email', $email);
		$query = $this->db->get('users');
		if( $query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return "";
		}
	}	
     function getUserstatus($email)
	{
		$this->db->select('status');
		$this->db->where('email', $email);
		$query = $this->db->get('orders');
		if( $query->num_rows() > 0)
		{
			return $query->row()->status;
		}
		else
		{
			return "";
		}
	}	

	public function getLatLong(){
		if($this->input->get('type')!=''){
			$this->db->where("type",$this->input->get('type'));
		}
		$this->db->select('*');
		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		
		return array();
	}

	public function insertContactUsFormData($data){
		$this->db->insert('contactus',$data);
		return $this->db->insert_id();
	}
	public function insertPaymentFormData($data){
		$this->db->insert('orders',$data);
		return true;
	}
	public function insertAddonFormData($data){
		$this->db->insert('orders',$data);
		return $this->db->insert_id();
	}

     public function insertRegisterUsFormData($data){
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	public function updateUserDetail($id,$data){
		
		$this->db->where('id', $id);
		$this->db->update('users',$data);
		return true;
	}

	function checkUserexist($email) {
  		$this->db->where('email', $email);
  		$this->db->from('users');
  		$query = $this->db->get();
  		if ($query->num_rows() > 0) {
    		return true;
  		}
  		return false; 
	}

	public function login($email, $password){
		$query = $this->db->get_where('users', array('email'=>$email, 'password'=>$password));
		$result = $query->row_array();
		return $result;
	}

	public function getOrderDetail($id){
		$this->db->select('status');
		$this->db->where('uid', $id);
		$query = $this->db->get('orders');
		if ($query->num_rows() > 0) {
			return $query->row()->status;
		}
		return "";
	}

	public function getOrderCreateDate($id){
		$this->db->select('create_date');
		$this->db->where('uid', $id);
		$query = $this->db->get('orders');
		if ($query->num_rows() > 0) {
			return $query->row()->create_date;
		}
		return "";
	}

	public function getUserCreatedDate($id){
		$this->db->select('created_date');
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->row()->created_date;
		}
		return "";
	}

	public function getOrders($id){
		$sql="SELECT * FROM `users` JOIN `orders` ON `users`.`id` = `orders`.`uid` where `users`.`id`=$id ";
		$query =  $this->db->query($sql);
		return $query->result();
	}

	public function getOrdersCount($id){
		$sql="SELECT * FROM `users` JOIN `orders` ON `users`.`id` = `orders`.`uid` where `users`.`id`=$id ";
		$query =  $this->db->query($sql);
		return $query->num_rows();
	}

	public function getPayments($data){
		//$this->db->limit($limit, $start);
		$query = $this->db->get('orders');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function getAllUsersForInvoice(){
		$this->db->order_by('username');
		$this->db->select('users.*');
		$query = $this->db->get('users');
		if($query->num_rows())
		{
			return $query->result();
		}
		return array();
	}

	public function getUserAmountBetweenDate($arr,$start,$limit){
		$this->db->select('orders.* , users.*');
		if($arr['create_date']!=''){
			$this->db->where('orders.create_date ',$arr['create_date']); 
		}
		if($arr['user_id']!=''){ 
			$this->db->where('orders.uid',$arr['user_id']); 
		}
		$this->db->join('users',' users.id = orders.uid');
		$this->db->limit($limit, $start);
		$query = $this->db->get("orders");
		if($query->num_rows()>0){
			return	$query->result();
		}	
		return array();
	}

	public function getUserAmountBetweenDateTotal($arr){
		$this->db->select('orders.* , users.*');
		if($arr['create_date']!=''){
			$this->db->where('orders.create_date ',$arr['create_date']); 
		}
		if($arr['user_id']!=''){ 
			$this->db->where('orders.uid',$arr['user_id']); 
		}
		$this->db->join('users',' users.id = orders.uid');
		$query = $this->db->get("orders");
		if($query->num_rows()>0){
			return	$query->num_rows();
		}	
		return 0;
	}

	function verifyUser($id,$verification_code){
		$this->db->select('*');
		$this->db->where("md5(id)",$id);
		$this->db->where("verification_code",$verification_code);
		$query = $this->db->get("users");
		if($query->num_rows()>0){
			//$this->db->query("update users set email_verify='true', verification_code='' where md5(id)='".$id."'");
			$this->db->query("update users set email_verify='true' where md5(id)='".$id."'");
			$this->db->where("md5(id)",$id);
			$query = $this->db->get("users");
			$user_row = $query->row_array();
			return $user_row;
		}else{
			return false;
		}
	}
	public function getOrders_($id){
		$this->db->select('*');
		$this->db->where('customer_id',$id);
		$this->db->from('orders');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return array();
	}
	public function get_package_data($package_id){
    	$this->db->where('package_id',$package_id);
    	$this->db->select('tittle');
    	$this->db->where('language_id',getLangId());
		$query = $this->db->get('package_description');
		if($query->num_rows())
		{
			return $query->row()->tittle;
		}
		return array();
	}
	public function get_location_data($location_id){
    	$this->db->where('location_id',$location_id);
    	$this->db->select('name');
    	$this->db->where('language_id',getLangId());
		$query = $this->db->get('location_description');
		if($query->num_rows())
		{
			return $query->row()->name;
		}
		return array();
	}
     public function get_product_data($order_id){
     	$this->db->select('product_name,product_quantity');
    	$this->db->where('order_id',$order_id);
		$query = $this->db->get('order_detail');
		if($query->num_rows() > 0){
			return $query->result();
		}
		return array();
	}

	public function getUserDataById($id){
		$sSQL   =   $this->db->where("id",$id);
		$sSQL	=	"select * from users";
		$query  =   $this->db->get('users');
		
		if($query->num_rows())
		{
			$row = $query->row();
			return $row;
		}
		return array();
	}
	public function totalCount(){
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return 0;
	}
	public function totalorders(){
		$query = $this->db->get('orders');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return 0;
	}
	public function totalincome(){
		$this->db->select_sum('sub_total');
		$this->db->from('orders');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row()->sub_total;
		}
		return 0;
	}


}
?>