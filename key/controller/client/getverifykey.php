<?php
/**
* client 客户端
* 获取key密钥
*/
class ControllerClientGetVerifykey extends Controller
{
	/*
	* 功能描述：获取验证密码
	* URL地址：client/getverifykey/index
	* 请求方式：POST
	* 请求参数：
	*	字段：email；说明：登陆Email；类型：String；必须：Y
	*	字段：password；说明：登陆密码；类型：String；必须：Y
	*	字段：devicecode；说明：设备编码：类型：String；必须：Y
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
			//验证用户是否存在
			$deviceCode = $this->request->post['devicecode'];
			$arrayresolte = $this->model_client_device->getDeviceInfoByDevice($deviceCode);
			$userid = $arrayresolte['userid'];
			$deviceName = $arrayresolte['divceName'];

			if((int)$userid != 0){
				//验证用户状态
				$this->load->model('client/config');

				if ($this->model_client_config->getUserStatus($userid)) {
					# code...
					//账户正常

					//是否记录本次活动
					//用户设备权限配置
					$config = $this->model_client_config->getConfig($userid);
					$dal= $config['deviceActivityLog'];
					if ($dal=="true") {
						# code...
						$this->data['connectList'] = $this->model_client_device->addConnectLog($deviceName,$deviceCode,$userid);
					}

					$this->load->model('client/emkey');
					$result = $this->model_client_emkey->getverifykey($userid);
					if ($result) {
						# code...
						echo json_encode($result);
					}else{
						$array[0]  = array('message' =>"null");
						echo json_encode($array);
					}
				}else{
					//账户异常
					$array[0]  = array('message' =>"user bad");
					echo json_encode($array);
				}

				
			}else{
				$array[0]  = array('message' =>"bad" );
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