<?php
/**
* 用戶數據模型
*/
class ModelCommonUser extends Model
{
	
	function addUser($data)
	{
		$active_code = md5(uniqid());
		$this->session->data['activeCode'] = $active_code;
		//if($this->config->get('config_active')=='1')
		$this->db->query("INSERT INTO " . DB_PREFIX . "user SET code = '" . $active_code . "',  email = '" . $this->db->escape($data['email']) . "', status = '1', date_added = NOW()");
		//else
		//$this->db->query("INSERT INTO " . DB_PREFIX . "user SET code = '" . $active_code . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) ."',  email = '" . $this->db->escape($data['email']) . "',password = '" . $this->db->escape(md5($data['password'])) . "', status = '1', date_added = NOW()");
		$user_id = $this->db->getLastId();
		//if (!$this->config->get('config_user_approval')) {
		//	$this->db->query("UPDATE " . DB_PREFIX . "user SET approved = '1' WHERE user_id = '" . (int)$user_id . "'");
		//}

		return $user_id;
	}
	function verifyCode(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE code = '" .$this->session->data['activeCode']. "' AND approved='0'");
		if ($query->num_rows) {
      		return true;
    	} else {
      		return false;
    	}
	}
	function closeAccount($userid){
		$this->db->query("UPDATE " . DB_PREFIX . "user SET status = '0' WHERE user_id = '" . $userid . "'");
	}
	function changeInfo($un,$phone,$userid){
		$this->db->query("UPDATE " . DB_PREFIX . "user SET username = '" . $this->db->escape($un) . "', phone = '" . $this->db->escape($phone) . "' WHERE user_id = '" . $userid . "'");
	}
	function verifyResetCode(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE code = '" .$this->session->data['activeCode']. "' AND status='1'");
		if ($query->num_rows) {
      		return true;
    	} else {
      		return false;
    	}
	}

	//驗證用戶
	public function activeuser($psd) {
		$this->db->query("UPDATE " . DB_PREFIX . "user SET password = '" . $this->db->escape(md5($psd)) . "' , approved = '1' WHERE code = '" .$this->session->data['activeCode']. "'");
	}

	//編輯更新用戶信息
	#public function edituser($data) {
	#	$this->db->query("UPDATE " . DB_PREFIX . "user SET firstname = '" . $this->db->escape($data['firstname']) . "',  email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "' WHERE user_id = '" . (int)$this->user->getId() . "'");
	#}

	//修改密碼
	public function rePassword($psd,$umail) {
		$this->db->query("UPDATE " . DB_PREFIX . "user SET password = '" . $this->db->escape(md5($psd)) . "' WHERE email = '" . $umail . "'");
	}

	//通過ID取得用戶
	public function getuser($user_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");

		return $query->row;
	}

	public function changePassword($code,$user_id){
		$this->db->query("UPDATE " . DB_PREFIX . "user SET code = '" .$code. "' WHERE user_id = '" .$user_id. "'AND status = '1'");
	}
	public function reSetPassword($code,$email){
		$this->db->query("UPDATE " . DB_PREFIX . "user SET code = '" .$code. "' WHERE email = '" .$email. "'");
	}
	
	//通過Email取得用戶
	public function getTotalUsersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user WHERE email = '" . $this->db->escape($email) . "'");

		return $query->row['total'];
	}

	public function getUserByEmail($email){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE email = '" . $this->db->escape($email) . "' AND status = '1'");
		if ($query->num_rows) {
			# code...
			return true;
		}else{
			return false;
		}
	}

	public function getverifyByEmail($email){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE email = '" . $this->db->escape($email) . "' AND approved = '0'");
		if ($query->num_rows) {
			# code...
			return true;
			
		}else{
			return false;
		}
	}

	function getAuthenticatorStatus($userid){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "GoogleAuthenticator WHERE user_id = '" . $userid . "' AND status = '1'");
		if ($query->num_rows) {
			# code...
			$this->session->data['authenticatorCode'] = $query->row['secret'];
			return true;
			
		}else{
			return false;
		}
	}
	function setAuthenticator($userid,$secret){
		$query = $this->db->query("INSERT INTO " . DB_PREFIX . "GoogleAuthenticator SET secret = '" . $secret . "',  user_id = '" . $userid . "'");

	}
	function closeAuthenticator($userid){
		$query = $this->db->query("UPDATE " . DB_PREFIX . "GoogleAuthenticator SET status = '0'   WHERE user_id = '" . $userid . "'");
	}

}
?>