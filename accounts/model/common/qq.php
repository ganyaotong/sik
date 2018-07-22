<?php
/**
* 用戶數據模型
*/
class ModelCommonQq extends Model
{
	
	function addhl($openid,$nn)
	{
		
		if ($this->gethl($openid)) {
			# code...
			return true;
		}else{
			$this->db->query("INSERT INTO " . DB_PREFIX . "qq_hl SET conopenid = '" . $openid . "',  conqqnick = '" . $nn . "', status = '1'");
			if ($this->gethl($openid)) {
				# code...
				return true;
			}else{
				return false;
			}
		}

	}

	//
	public function gethl($openid) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "qq_hl WHERE conopenid = '" . $openid . "' AND status = '1'");
		if ($query->num_rows) {

			$this->user->hltouser($query->row['conqqnick']);
			return true;
		}
		return false;
	}

	//通過Email取得用戶
	public function getTotalUsersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user WHERE email = '" . $this->db->escape($email) . "'");

		return $query->row['total'];
	}

}
?>