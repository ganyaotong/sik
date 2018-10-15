<?php
/**
* client 客户端
* delete group
*/
class ControllerClientDeleteKey extends Controller
{
	/*
	* 功能描述：删除密码
	* URL地址：client/deletekey/index
	* 请求方式：POST
	* 请求参数：
	*	字段：devicecode；说明：设备编码；类型：String；必须：Y
	*	字段：keyid；说明：密码ID；类型：Int；必须：Y
	* 返回结果：
	*	字段：message；说明：成功信息；类型：String
	*/
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$this->load->model('client/device');
		$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);
		if((int)$userid != 0){

			$this->load->model('client/emkey');
			$result = $this->model_client_emkey->deletekey($userid,$this->request->post['keyid']);
			$array[0]  = array('message' =>"delete finish" );
			echo json_encode($array);
		}else{
			$array[0]  = array('message' =>"device is bad" );
			echo json_encode($array);
		}
			
		}
		
	}
}
?>