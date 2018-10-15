<?php
/** 
* client 客户端
* 设置密钥
*/
class ControllerclientNotifyChangeSessionKey extends Controller
{
	/*
	* 功能描述：修改加密KEY，弃用加密KEY后此函数不再调用
	* URL地址：client/notifychangesessionkey/index
	* 请求方式：POST
	* 请求参数：
	*	字段：devicecode；说明：设备编码；类型：String；必须：Y
	*	字段：keyid；说明：Key ID；类型：Int；必须：Y
	*	字段：keycontent；说明：密码内容；类型：String；必须：Y
	* 返回结果：
	*	字段：message；说明：成功返回true,失败返回false；类型：bool；
	*/
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
	/*
	* 功能描述：备份用户所有密码
	* URL地址：client/notifychangesessionkey/backupSessionKey
	* 请求方式：POST
	* 请求参数：
	*	字段：user_id；说明：用户id；类型：Int；必须：Y
	* 返回结果：
	*	无
	*/
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
	/*
	* 功能描述：更改回话密码
	* URL地址：client/notifychangesessionkey/changefirstkey
	* 请求方式：POST
	* 请求参数：
	*	字段：user_id；说明：用户id；类型：Int；必须：Y
	*	字段：key_id；说明：密码ID；类型：Int；必须：Y
	*	字段：keycontent；说明：密码内容；类型：String；必须：Y
	* 返回结果：
	*	说明：成功返回true，失败返回false；
	*/
	function changefirstkey($user_id,$key_id,$keycontent){
		$this->load->model('client/emkey');
		$result = $this->model_client_emkey->changefirstkey( $user_id,$key_id,$keycontent);
		return $result;
	}

}

?>