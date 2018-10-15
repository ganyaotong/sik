<?php
/**
* client 客户端
* edit group
*/
class ControllerClientUpdateKey extends Controller
{
	/*
	* 功能描述：更新密码
	* URL地址：client/updatekey/index
	* 请求方式：POST
	* 请求参数：
	*	字段：devicecode；说明：设备编码；类型：String；必须：Y
	*	字段：keyid；说明：密码ID；类型：Int；必须：Y
	*	字段：groupid；说明：密码组ID；类型：Int；必须：Y
	*	字段：keylabel；说明：密码名称；类型：String；必须：Y
	*	字段：keycontent；说明：密码内容；类型：String；必须：Y
	*	字段：description；说明；密码描述；类型：String；必须：Y
	* 返回结果：
	*	字段：message；说明：成功返回信息；类型：string；
	*/
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$this->load->model('client/device');
		$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);
		if((int)$userid != 0){
			$this->load->model('client/emkey');
			$result = $this->model_client_emkey->updatekey($userid,$this->request->post['keyid'],$this->request->post['groupid'],$this->request->post['keylabel'],$this->request->post['keycontent'],$this->request->post['description']);
			$array[0]  = array('message' =>"update finish" );
			echo json_encode($array);
			
		}else{
			$array[0]  = array('message' =>"device is bad" , );
			echo json_encode($array);
		}
			
		}
		
	}
}
?>