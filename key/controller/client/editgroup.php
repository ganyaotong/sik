<?php
/**
* client 客户端
* edit group
*/
class ControllerClientEditgroup extends Controller
{
	/*
	* 功能描述：编辑密码组
	* URL地址：client/editgroup/index
	* 请求方式：POST
	* 请求参数：
	*	字段：devicecode；说明：设备编码；类型：String；必须：Y
	*	字段：groupid；说明：组ID；类型：String；必须：Y
	*	字段：groupname；说明：组名称：类型：String；必须：Y
	* 返回结果：
	*	字段：message；说明：成功信息；类型：String；
	*/
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$this->load->model('client/device');
		$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);
		if((int)$userid != 0){
			$this->load->model('client/keygroup');
			$result = $this->model_client_keygroup->editgroup($userid,$this->request->post['groupid'],$this->request->post['groupname']);
			$array  = array('message' =>"update finish" , );
			echo json_encode($array);
			
		}else{
			$array  = array('message' =>"device is bad" , );
			echo json_encode($array);
		}
			
		}
		
	}
}
?>