<?php
/**
* 用戶數據模型
*/
class ModelClientDevice extends Model
{
	
	function addDevice($device_name)
	{
		
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

	//判断用户组
	function getuserGroup($user_id) {
		$config_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyConfig WHERE user_id = '" . (int)$user_id . "' AND status = '1'");
    	if ($config_query->num_rows) {
    		$unInit_config=$config_query->row['config'];
    		$keyConfig = unserialize($unInit_config);
    		return $keyConfig;
    	} else {
      		return "";
    	}
	}

	function getUserIdByDevice($device_code){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "keydevice WHERE device_code = '" . $device_code . "' AND status = '1'");
		if ($query->num_rows) {
				//获取用户id同时获取用户组权限
				$user_id = $query->row['user_id'];
//				$keyConfig = $this->getuserGroup($user_id);
//				$userGroup = $keyConfig['userGroup'];
//				$config = array('user_id' => $user_id , 'userGroup' => $userGroup);
				return $user_id;
			} else {
				return "0";
			}
	}

	function getDeviceInfoByDevice($device_code){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "keydevice WHERE device_code = '" . $device_code . "' AND status = '1'");
		if ($query->num_rows) {
				$array = array('userid' => $query->row['user_id'], 'divceName' => $query->row['device_name'] );
				return $array;
			} else {
				$array = array('userid' => '0', 'divceName' => '0' );
				return $array;
			}
	}

	function getDeviceLog($user_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "keydevice WHERE user_id = '" . $user_id . "' order by device_id desc");
		if ($query->num_rows) {

			$array = array();
			for($i=0; $i < $query->num_rows; $i++){
				$array[$i] = array("deviceName"=>$query->rows[$i]['device_name'],"deviceCode"=>$query->rows[$i]['device_code'],"dateAdded"=>$query->rows[$i]['date_added']);
			}

			return $array;
		}else{
			return false;
		}
	}

	function getConnectLog($user_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "keydevice_connectLog WHERE user_id = '" . $user_id . "' AND status = '1'");
		if ($query->num_rows) {

			$array = array();
			for($i=0; $i < $query->num_rows; $i++){
				$array[$i] = array("deviceName"=>$query->rows[$i]['device_name'],"deviceCode"=>$query->rows[$i]['device_code'],"dateAdded"=>$query->rows[$i]['date_added']);
			}

			return $array;
		}else{
			return false;
		}
	}

	function addConnectLog($deviceName,$deviceCode,$user_id){
		//$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "keydevice_connectLog WHERE user_id = '" . $user_id . "' AND status = '1'");
		$query = $this->db->query("INSERT INTO " . DB_PREFIX . "keydevice_connectLog SET device_name = '" . $deviceName . "', device_code = '" . $deviceCode . "', date_added = NOW(), status = '1' , user_id = '" . (int)$user_id . "'");

	}
	
	function deleteConnectLog($user_id){
		$query = $this->db->query("UPDATE " . DB_PREFIX . "keydevice_connectLog SET status = '0' WHERE user_id = '" . $user_id . "'");
	}
	
	function getAllDevice($user_id){

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "keydevice WHERE user_id = '" . $user_id . "' AND status = '1'");
		if ($query->num_rows) {

			$array = array();
			for($i=0; $i < $query->num_rows; $i++){
				$array[$i] = array("deviceName"=>$query->rows[$i]['device_name'],"deviceCode"=>$query->rows[$i]['device_code'],"dateAdded"=>$query->rows[$i]['date_added']);
			}

			return $array;
		}else{
			return false;
		}
	}

	function logout($code){
		$this->db->query("UPDATE " . DB_PREFIX . "keydevice SET status = '0' WHERE device_code = '" . $this->db->escape($code). "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "keydevice WHERE device_code = '" . $this->db->escape($code) . "'");
		if ($query->num_rows) {
			$status = $query->row['status'];
			if ($status == 0) {
				# code...
				return true;
			}else{
				return false;
			}
		
		}else{
			return false;
		}
	}

	
}
?>