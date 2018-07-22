<?php
/**
* emkey类
*/
class ModelClientEmkey extends Model
{
	//判断用户组
	function getuserGroup($user_id) {
		$config_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyConfig WHERE user_id = '" . (int)$user_id . "' AND status = '1'");
    	if ($config_query->num_rows) {

    		$userGroup=$config_query->row['keyconfig_group_id'];
    		return $userGroup;
    		
    	} else {
      		return "0";
    	}
	}

	function addkey($group_id,$keyLabel,$keycontent,$description,$userid){

		//判断用户组权限
		$userGroup = $this->getuserGroup($userid);
		//获取当前密码总数
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyCipherter WHERE user_id = '" . $userid . "' AND status = '1'");
		switch ($userGroup) {
			case '0':
				# code...
			if ($query->num_rows<10) {
				# code...
				if ($this->addOperation($group_id,$keyLabel,$keycontent,$description,$userid)) {
					# code...
					return "1";
				}else{
					return "0";
				}
				
			}else{
				return "3";
			}
				break;

			case '1':
				# code...
			if ($query->num_rows<50) {
				# code...
				if ($this->addOperation($group_id,$keyLabel,$keycontent,$description,$userid)) {
					# code...
					return "1";
				}else{
					return "0";
				}
				
			}else{
				return "3";
			}
				break;
			
			default:
				# code...
				break;
		}
		
	}

	function addOperation($group_id,$keyLabel,$keycontent,$description,$userid){
		$this->db->query("INSERT INTO " . DB_PREFIX . "KeyCipherter SET keycipherter_group_id = '" . (int)$group_id . "', keyLabel = '" . $keyLabel . "', keyciphertext = '" . $keycontent . "', description = '" . $description . "', user_id = '" . $userid . "', status = '1', date_added = NOW()");
		$cipherter_id = $this->db->getLastId();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyCipherter WHERE cipherter_id = '" . $cipherter_id . "' AND status = '1'");
		if($query->num_rows){
			$keyLabel2 = $query->row['keyLabel'];
			if ($keyLabel == $keyLabel2) {
				# code...
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	function getkey($user_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyCipherter WHERE user_id = '" . $user_id . "' AND status = '1'");
		if($query->num_rows){
			$array = array();
			for($i=0; $i < $query->num_rows; $i++){
				$array[$i] = array("key_id"=>$query->rows[$i]['cipherter_id'],"group_id"=>$query->rows[$i]['keycipherter_group_id'],"keylabel"=>$query->rows[$i]['keyLabel'],"keycontent"=>$query->rows[$i]['keyciphertext'],"keySubdes"=>$query->rows[$i]['description'],"message" =>"true");
			}
			
			return $array;
		}else{
			return false;
		}

	}

	function getallkey($user_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyCipherter WHERE user_id = '" . $user_id . "' AND status != '0'");
		if($query->num_rows){
			$array = array();
			for($i=0; $i < $query->num_rows; $i++){
				$array[$i] = array("key_id"=>$query->rows[$i]['cipherter_id'],"group_id"=>$query->rows[$i]['keycipherter_group_id'],"keylabel"=>$query->rows[$i]['keyLabel'],"keycontent"=>$query->rows[$i]['keyciphertext'],"keySubdes"=>$query->rows[$i]['description'],"message" =>"true");
			}
			
			return $array;
		}else{
			return false;
		}

	}

	function backupkey($key_id,$keycontent,$user_id){
		$this->db->query("INSERT INTO " . DB_PREFIX . "backupkey SET Cipherter_id = '" . (int)$key_id . "', keyciphertext = '" . $keycontent . "', user_id = '" . $user_id . "', status = '1', date_added = NOW()");
	}

	function deletekey($user_id,$key_id){
		$this->db->query("UPDATE " . DB_PREFIX . "KeyCipherter SET status = '0' WHERE cipherter_id = '" . (int)$key_id . "' AND user_id = '".$user_id."'");
		
	}

	function updatekey($user_id,$key_id,$group_id,$keylabel,$keycontent,$description){
		$this->db->query("UPDATE " . DB_PREFIX . "KeyCipherter SET keycipherter_group_id = '" . $group_id . "', keyLabel = '" . $keylabel . "', keyciphertext = '" . $keycontent . "', description = '" . $description . "' WHERE cipherter_id = '" . (int)$key_id . "' AND user_id = '".$user_id."'");

	}

	function updatekeycontent($user_id,$key_id,$keycontent){
		$this->db->query("UPDATE " . DB_PREFIX . "KeyCipherter SET keyciphertext = '" . $keycontent . "' WHERE cipherter_id = '" . (int)$key_id . "' AND user_id = '".$user_id."'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyCipherter WHERE cipherter_id = '" . $key_id . "'");
		if($query->num_rows){
			if ($query->row['keyciphertext'] == $keycontent) {
				# code...
				return "true";
			}else{
				return "false";
			}
		}else{
			return "false";
		}
	}

	function getverifykey($user_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyCipherter WHERE user_id = '" . $user_id . "' AND status = '3'");
		if($query->num_rows){
			$array = array();
			for($i=0; $i < $query->num_rows; $i++){
				$array[$i] = array("key_id"=>$query->rows[$i]['cipherter_id'],"group_id"=>$query->rows[$i]['keycipherter_group_id'],"keylabel"=>$query->rows[$i]['keyLabel'],"keycontent"=>$query->rows[$i]['keyciphertext'],"keySubdes"=>$query->rows[$i]['description'],"message" =>"true");
			}
			
			return $array;
		}else{
			return false;
		}

	}

	//verify key equals first key
	function addfirstkey($group_id,$keyLabel,$keycontent,$description,$userid){
		$this->db->query("INSERT INTO " . DB_PREFIX . "KeyCipherter SET keycipherter_group_id = '" . (int)$group_id . "', keyLabel = '" . $keyLabel . "', keyciphertext = '" . $keycontent . "', description = '" . $description . "', user_id = '" . $userid . "', status = '3', date_added = NOW()");
		$cipherter_id = $this->db->getLastId();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyCipherter WHERE cipherter_id = '" . $cipherter_id . "' AND status = '3'");
		if($query->num_rows){
			$array[0] = array("key_id"=>$query->row['cipherter_id'],"group_id"=>$query->row['keycipherter_group_id'],"keylabel"=>$query->row['keyLabel'],"keycontent"=>$query->row['keyciphertext'],"description"=>$query->row['description']);
			return $array;
		}else{
			return false;
		}

		$this->db->query("INSERT INTO " . DB_PREFIX . "KeyCipherter SET code = '" . $active_code . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) ."',  email = '" . $this->db->escape($data['email']) . "',password = '" . $this->db->escape(md5($data['password'])) . "', status = '0', date_added = NOW()");
	}

	function changefirstkey($user_id,$key_id,$keycontent){
		$this->db->query("UPDATE " . DB_PREFIX . "KeyCipherter SET keyciphertext = '" . $keycontent . "' WHERE cipherter_id = '" . $key_id . "' AND status = '3'");
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "KeyCipherter WHERE cipherter_id = '" . $key_id . "' AND status = '3'");
		if($query->num_rows){
			if ($query->row['keyciphertext'] == $keycontent) {
				# code...
				return "true";
			}else{
				return "false";
			}
		}else{
			return "false";
		}
		
	}
}
?>