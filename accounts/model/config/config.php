<?php
/**
* 用戶數據模型
*/
class ModelConfigConfig extends Model
{
	
	function stopUserForKey($userid){
		$config_query = $this->db->query("UPDATE " . DB_PREFIX . "KeyConfig SET status = '0' WHERE user_id = '" . (int)$userid . "'");    	
	}
}
?>