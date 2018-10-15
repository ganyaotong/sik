<?php
/**
* client 客户端
* edit group
*/
class ControllerClientUpdateKeycontent extends Controller
{
	/*
	* 功能描述：更新密码内容
	* URL地址：client/updatekeycontent/index
	* 请求方式：POST
	* 请求参数：
	*	字段：devicecode；说明：设备编码；类型：String；必须：Y
	*	字段：keyid；说明；密码ID；类型：String；必须：Y
	*	字段：keycontent；说明：密码内容；类型：String；必须：Y
	* 返回结果：
	*	字段：message；说明：成功返回true，失败返回false；类型：bool
	*/
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$this->load->model('client/device');
		$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);
		if((int)$userid != 0){
			$this->load->model('client/emkey');
			$result = $this->model_client_emkey->updatekeycontent($userid,$this->request->post['keyid'],$this->request->post['keycontent']);
			
			$array[0]  = array('message' => $result );
			echo json_encode($array);
			
		}else{
			$array[0]  = array('message' =>"false" );
			echo json_encode($array);
		}
			
		}
		
	}
}
?>