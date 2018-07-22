<?php
/**
* emkey类
*/
class ModelClientKeygroup extends Model
{
	
	function getgroup($user_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "keycipherter_group WHERE user_id = '" . $user_id . "' AND status = '1' ORDER BY sort" );
		if($query->num_rows){
			$array = array();
			for($i=0; $i < $query->num_rows; $i++){
				$array[$i] = array("group_id"=>$query->rows[$i]['keycipherter_group_id'],"name"=>$query->rows[$i]['name']);
			}
			return $array;
		}else{
			return false;
		}

	}

	function changegroupposition($group_id,$position,$user_id){
		$this->db->query("UPDATE " . DB_PREFIX . "keycipherter_group SET sort = '" . (int)$position . "' WHERE keycipherter_group_id = '" . (int)$group_id . "' AND user_id = '".$user_id."'");
		
	}

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

	function addgroup($user_id,$groupname){

		//判断用户组权限
		$userGroup = $this->getuserGroup($user_id);

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "keycipherter_group WHERE user_id = '" . $user_id . "' AND status = '1'");
		switch ($userGroup) {
			case '0':
				# code...
			if ($query->num_rows<3) {
				# code...
				if ($this->addOperation($user_id,$groupname)) {
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
			if ($query->num_rows<10) {
				# code...
				if ($this->addOperation($user_id,$groupname)) {
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
	function addOperation($user_id,$groupname){

		$this->db->query("INSERT INTO " . DB_PREFIX . "keycipherter_group SET user_id = '" . (int)$user_id . "', name = '" . $groupname . "', status = '1', date_added = NOW()");
		
		$keycipherter_group_id = $this->db->getLastId();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "keycipherter_group WHERE keycipherter_group_id = '" . $keycipherter_group_id . "' AND status = '1'");
		
		if($query->num_rows){
			$groupname2= $query->row['name'];
			if ($groupname==$groupname2) {
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}

	}
	function deletegroup($user_id,$group_id){
		$this->db->query("UPDATE " . DB_PREFIX . "keycipherter_group SET status = '0' WHERE keycipherter_group_id = '" . (int)$group_id . "' AND user_id = '".$user_id."'");
		
	}
	function editgroup($user_id,$group_id,$groupname){
		$this->db->query("UPDATE " . DB_PREFIX . "keycipherter_group SET name = '" . $groupname . "' WHERE keycipherter_group_id = '" . (int)$group_id . "' AND user_id = '".$user_id."'");

	}
}
?>