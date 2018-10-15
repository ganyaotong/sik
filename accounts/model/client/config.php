<?php
/**
* 用戶數據模型
*/
class ModelClientConfig extends Model
{
	
	function addConfig($data)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "KeyConfig SET user_id = '" . $data['user_id'] .  "', username = '" . $data['username'] ."',  firstname = '" . $data['firstname'] . "',lastname = '" . $data['lastname'] . "', status = '1', date_added = NOW()");
		return true;
	}
	//查询是否使用
	public function isUsed($user_id){
		$config_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyCipherter WHERE user_id = '" . (int)$user_id . "' AND status = '3'");
    	if ($config_query->num_rows) {
      		return true;
    	} else {
      		return false;
    	}
	}
	//查询是否激活
	public function activation($user_id) {
		$config_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyConfig WHERE user_id = '" . (int)$user_id . "' AND status = '1'");
    	if ($config_query->num_rows) {

      		return true;
    	} else {
      		return false;
    	}
	}

	//編輯更新用戶信息
	public function edituser($data) {
		$this->db->query("UPDATE " . DB_PREFIX . "user SET firstname = '" . $this->db->escape($data['firstname']) . "',  email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "' WHERE user_id = '" . (int)$this->user->getId() . "'");
	}

	//修改密碼
	public function editPassword($email, $password) {
		$this->db->query("UPDATE " . DB_PREFIX . "user SET password = '" . $this->db->escape(md5($password)) . "' WHERE email = '" . $this->db->escape($email) . "'");
	}

	//通過ID取得用戶
	public function getuser($user_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");

		return $query->row;
	}
	//通過Email取得用戶
	public function getTotalUsersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user WHERE email = '" . $this->db->escape($email) . "'");

		return $query->row['total'];
	}

}
?>