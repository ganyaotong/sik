<?php
/**
* 用戶财产模型
*/
class ModelWalletWallet extends Model
{
	
	//增加财产
	
	function add($score,$user_id)
	{
		
		$this->db->query("UPDATE " . DB_PREFIX . "user_wallet SET score = score+'" . $score . "', date_added = NOW() WHERE user_id = '" . $user_id. "'");
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_wallet WHERE user_id = '" . (int)$user_id . "'");
		if($query->num_rows){

			$array = array("score"=>$query->row['score'],"message"=>"added");
			return $array;
		}else{
			$array = array("score"=>"null","message"=>"NG");
			return $array;
		}
	}

	function out($score,$user_id) 
	{
		$this->db->query("UPDATE " . DB_PREFIX . "user_wallet SET score = score-'" .$score."', date_added = NOW() WHERE user_id = '" .$user_id."'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_wallet WHERE user_id = '" . (int)$user_id . "'");
		if($query->num_rows){

			$array = array("score"=>$query->row['score'],"message"=>"useed");
			return $array;
		}else{
			$array = array("score"=>"null","message"=>"NG");
			return $array;
		}
	}

	function addlog($operation,$score,$user_id,$wallet_id){

		$this->db->query("INSERT INTO " . DB_PREFIX . "user_wallet_log SET operation = '" .$operation."', score ='" . $score . "', date_added = NOW() , user_id = '" .$user_id."',wallet_id = '" .$wallet_id."'");
		$id = $this->db->getLastId();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_wallet_log WHERE log_id = '" . (int)$id . "'");
		
		if($query->num_rows){
			if ($query->row['score'] == $score && $query->row['user_id'] == $user_id && $query->row['wallet_id'] == $wallet_id ) {
				# code...

				$array = array("log"=>$query->row['log_id'],"message"=>"added");
				return $array;
			}else{
				$array = array("log"=>"null","message"=>"NG");
				return $array;
			}
			
		}else{
			$array = array("log"=>"null","message"=>"NG");
			return $array;
		}

	}

	function init($user_id){
		//判断是否已经激活
		if (!$this->isActivation($user_id)) {
			# code...
			//没有的话，继续激活
			$this->db->query("INSERT INTO " . DB_PREFIX . "user_wallet SET user_id = '" .$user_id."', score = 0, date_added = NOW() , status = 1");
			$id = $this->db->getLastId();
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_wallet WHERE user_id = '" . (int)$user_id . "'");
		
			if($query->num_rows){
				if ($query->row['user_id'] == $user_id) {
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

	//判断是否已经激活
	function isActivation($user_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_wallet WHERE user_id = '" . (int)$user_id . "'");

		if($query->num_rows){

			return true;
		}else{
			return false;
		}

	}
	function getScore($user_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_wallet WHERE user_id = '" . (int)$user_id . "'");

		if($query->num_rows){

			return $query->row['score'];
		}else{
			return 0;
		}
	}

}
?>