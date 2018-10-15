<?php
/**
* client 客户端
* 获取key密钥
*/
class ControllerClientLogout extends Controller
{
	/*
	* 功能描述：登出
	* URL地址：client/logout/index
	* 请求方式：POST
	* 请求参数：
	*	字段：code；说明：设备编码；类型：String；必须：Y
	* 返回结果：
	*	字段：message；说明：成功信息；类型：String；
	*/
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

			$this->load->model('client/device');
			
				if ($this->model_client_device->logout($this->request->post['code'])) {
				# code...
					$array[0]  = array('message' =>"pass");
					echo json_encode($array);
				}else{
					$array[0]  = array('message' =>"ng");
					echo json_encode($array);
				}
			

		}
	
	}

}
?>