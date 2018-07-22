<?php
/** 
* client 客户端
* 设置密钥
*/
class ControllerclientNotifyChangeSessionKey extends Controller
{
	
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

			$this->load->model('client/device');
			$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);
			if((int)$userid != 0){
				$this->backupSessionKey($userid);
				$result =$this->changefirstkey($userid , $this->request->post['keyid'], $this->request->post['keycontent']);
				$array[0] = array('message' => $result);
				echo json_encode($array);
			}else{
				$array[0] = array('message' => 'false');
				echo json_encode($array);
			}
			
		}
	}

	function backupSessionKey($user_id){
		$this->load->model('client/emkey');
		$result = $this->model_client_emkey->getallkey($user_id);
		
		foreach ($result as $key => $value) {
			# code...
			$key_id =  $value["key_id"];
			$keycontent = $value["keycontent"];
			$result = $this->model_client_emkey->backupkey( $key_id, $keycontent, $user_id);
		}	
	}

	function changefirstkey($user_id,$key_id,$keycontent){
		$this->load->model('client/emkey');
		$result = $this->model_client_emkey->changefirstkey( $user_id,$key_id,$keycontent);
		return $result;
	}

}

?>