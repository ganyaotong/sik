<?php
/**
* client 客户端
* 获取key密钥
*/
class ControllerClientGetkeygroup extends Controller
{
	/*
	* 功能描述：获取密码组
	* URL地址：client/getkeygroup/index
	* 请求方式：POST
	* 请求参数：
	*	字段：devicecode；说明：设备编码；类型：String；必须：Y
	* 返回结果：
	*	字段：group_id；说明：组id；类型：Int；
	*	字段：name；说明：组名称；类型：String；
	*/
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$this->load->model('client/device');
		$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);
		
		$this->load->model('client/keygroup');
		$resultgroup = $this->model_client_keygroup->getgroup($userid);
		
		if ($resultgroup) {
			# code...
			echo json_encode($resultgroup);
		}else{
			$array[0] = array("group_id"=>"0","name"=>"Ungrouped");
			echo json_encode($array);
		}

		}

	
	}

}
?>