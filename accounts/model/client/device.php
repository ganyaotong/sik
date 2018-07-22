<?php
/**
* 用戶數據模型
*/
class ModelClientDevice extends Model
{
	
	function addDevice($device_name)
	{
		(int)$this->session->data['user_id'];

		$active_code = md5(uniqid());
		$this->db->query("INSERT INTO " . DB_PREFIX . "keydevice SET device_name = '" . $device_name . "', device_code = '" . $active_code . "',user_id = '" . (int)$this->session->data['user_id'] . "', status = '1', date_added = NOW()");
		
		return $active_code;
	}

	//驗證用戶
	public function activeuser($code) {
		$this->db->query("UPDATE " . DB_PREFIX . "user SET status = '1' WHERE code = '" . $this->db->escape($code). "'");
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

	
}
?>