<?php
final class User {
	private $user_id;
	private $username;
	private $phone;
	private $usermail;
	private $usergroup;
	private $status;
	private $addDate;
  	private $permission = array();

  	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');
		
    	if (isset($this->session->data['user_id'])) {
			$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");
			
			if ($user_query->num_rows) {

				$this->user_id = $user_query->row['user_id'];
				$this->username = $user_query->row['username'];
				$this->phone = $user_query->row['phone'];
				$this->usermail = $user_query->row['email'];
				$this->usergroup = $user_query->row['user_group_id'];
				$this->status = $user_query->row['status'];
				$this->addDate = $user_query->row['date_added'];
				
      			$this->db->query("UPDATE " . DB_PREFIX . "user SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE user_id = '" . (int)$this->session->data['user_id'] . "'");
      			/*
      			$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");
				
	  			$permissions = unserialize($user_group_query->row['permission']);

				if (is_array($permissions)) {
	  				foreach ($permissions as $key => $value) {
	    				$this->permission[$key] = $value;
	  				}
				}
				*/
			} else {
				$this->logout();
			}
    	}
  	}
		
  	public function login($email, $password) {
    	//$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE email = '" . $this->db->escape($username) . "' AND password = '" . $this->db->escape(md5($password)) . "' AND status = '1'");
    	$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE LOWER(email) = '" . $this->db->escape(strtolower($email)) . "' AND password = '" . $this->db->escape(md5($password)) . "' AND status = '1'");
    	if ($user_query->num_rows) {
			$this->session->data['user_id'] = $user_query->row['user_id'];
			
			$this->user_id = $user_query->row['user_id'];
			$this->username = $user_query->row['email'];
			$this->usermail = $user_query->row['email'];			

			/*
      		$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");

	  		$permissions = unserialize($user_group_query->row['permission']);

			if (is_array($permissions)) {
				foreach ($permissions as $key => $value) {
					$this->permission[$key] = $value;
				}
			}
			*/
			$this->db->query("UPDATE " . DB_PREFIX . "user SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' ,  date_added = NOW() WHERE user_id = '" . (int)$user_query->row['user_id'] . "'");
      		return true;
    	} else {
      		return false;
    	}
  	}

  	public function logout() {
		unset($this->session->data['user_id']);
	
		$this->user_id = '';
		$this->username = '';
		
		session_destroy();
  	}

  	public function hasPermission($key, $value) {
    	if (isset($this->permission[$key])) {
	  		return in_array($value, $this->permission[$key]);
		} else {
	  		return false;
		}
  	}
  
  	public function isLogged() {
    	return $this->user_id;
  	}
  
  	public function getId() {
    	return $this->user_id;
  	}
	
  	public function getUserName() {
    	return $this->username;
  	}
  	public function getPhone() {
    	return $this->phone;
  	}
  	public function getUserMail(){
  		return $this->usermail;
  	}
  	public function getUsergroup(){
  		return $this->usergroup;
  	}
  	public function getStatus(){
  		return $this->status;
  	}
  	public function getAddDate(){
  		return $this->addDate;
  	}
  	public function getUserInfo(){
  		$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");
    	if ($user_query->num_rows) {
    		$userInfo  = array();
    		$userInfo["user_id"] = $user_query->row['user_id'];
			$userInfo["user_group_id"] = $user_query->row['user_group_id'];
			$userInfo["username"] = $user_query->row['username'];
			$userInfo["firstname"] = $user_query->row['firstname'];
			$userInfo["lastname"] = $user_query->row['lastname'];
			$userInfo["email"] = $user_query->row['email'];
			$userInfo["phone"] = $user_query->row['phone'];
			$userInfo["status"] = $user_query->row['status'];
      		return $userInfo;
    	} else {
      		return false;
    	}
  	}
  	public function loginForPhone($phone,$password){
  		$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE phone = '" . $phone . "' AND password = '" . $this->db->escape(md5($password)) . "' AND status = '1'");
    	if ($user_query->num_rows) {
			$this->session->data['user_id'] = $user_query->row['user_id'];
	
			$this->user_id = $user_query->row['user_id'];
			$this->username = $user_query->row['email'];	

			$this->db->query("UPDATE " . DB_PREFIX . "user SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' ,  date_added = NOW() WHERE user_id = '" . (int)$user_query->row['user_id'] . "'");
      		return true;
    	} else {
      		return false;
    	}
  	}
  	function hltouser($hlname){
  		$this->username = $hlname;
  	}
}
?>