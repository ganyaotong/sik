<?php
/**
* client 客户端
* 获取key密钥
*/
class ControllerClientGetkey extends Controller
{
	/*
	* 功能描述：获取密码
	* URL地址：client/getkey/index
	* 请求方式：POST
	* 请求参数：
	*	字段：devicecode；说明：设备编码；类型：String；必须：Y
	*	字段：email；说明：email；类型：String；必须：Y
	*	字段：password；说明：登陆密码；类型：String；必须：Y
	* 返回结果：
	*	字段：message；说明：失败返回结果，成功返回true；类型：String；
	*	字段：key_id；说明：密码ID；类型：Int
	*	字段：group_id；说明：密码组ID；类型：Int
	*	字段：keylabel；说明：密码名称；类型：String；
	*	字段：keycontent；说明：密码内容：类型：String；
	*	字段：keySubdes；说明：密码描述；类型：String；
	*/
	function index()
	{
		# code...
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()){
			$this->load->model('client/device');
			$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);

			if((int)$userid != 0){
			$this->load->model('client/emkey');
			$result = $this->model_client_emkey->getkey($userid);
				if ($result) {
			# code...
					echo json_encode($result);
				}else{
					$array[0]  = array('message' =>"null");
					echo json_encode($array);
				}
			}else{
			$array  = array('message' =>"device is bad" , );
			echo json_encode($array);
		}
		}
	
	}

	private function validate(){
		if (!$this->user->login($this->request->post['email'], $this->request->post['password'])) {
      		$this->error['warning'] = "登陆错误";
    	}
	
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
}
?>