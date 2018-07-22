<?php
/**
* 用戶數據模型
*/
class ModelKeyconfigConfig extends Model
{
	
	function addConfig($data)
	{
		$init_config = array('deviceActivityLog' => "false",'userGroup' =>"0");
		$config = serialize($init_config);
		$this->db->query("INSERT INTO " . DB_PREFIX . "KeyConfig SET user_id = '" . $data['user_id'] .  "', username = '" . $data['username'] ."',  firstname = '" . $data['firstname'] . "',lastname = '" . $data['lastname'] . "', email= '".$data['email']."', status = '1', config = '".$config."', date_added = NOW()");
		return true;
	}

	//判断是否激活
	function activation() {
		$config_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyConfig WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");
    	if ($config_query->num_rows) {
    		$unInit_config=$config_query->row['config'];
    		$this->session->data['keyConfig'] = unserialize($unInit_config);
      		return true;
    	} else {
      		return false;
    	}
	}
	function getConfig(){

	}
	function changeUserGroup($user_id,$userGroup){
    		$this->db->query("UPDATE " . DB_PREFIX . "KeyConfig SET keyconfig_group_id = '" . (int)$userGroup .  "'  WHERE user_id = '" . (int)$user_id  . "'");
	}
	function updateConfig($key,$value){
		$config_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyConfig WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");
    	if ($config_query->num_rows) {
    		$unInit_config=$config_query->row['config'];

    		$Config = unserialize($unInit_config);
    		$Config[$key]=$value;
    		$input = serialize($Config);

    		$this->db->query("UPDATE " . DB_PREFIX . "KeyConfig SET config = '" . $input .  "'  WHERE user_id = '" . (int)$this->session->data['user_id']  . "'");
    		return true;
    	} else {
    		return false;
    	}
	}
	//編輯更新用戶信息
	function edituser($data) {
		$this->db->query("UPDATE " . DB_PREFIX . "user SET firstname = '" . $this->db->escape($data['firstname']) . "',  email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "' WHERE user_id = '" . (int)$this->user->getId() . "'");
	}

	//修改密碼
	function editPassword($email, $password) {
		$this->db->query("UPDATE " . DB_PREFIX . "user SET password = '" . $this->db->escape(md5($password)) . "' WHERE email = '" . $this->db->escape($email) . "'");
	}

	//通過ID取得用戶
	function getuser($user_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");

		return $query->row;
	}
	//通過Email取得用戶
	function getTotalUsersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user WHERE email = '" . $this->db->escape($email) . "'");

		return $query->row['total'];
	}

}
?>