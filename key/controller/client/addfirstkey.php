<?php
/** 
* client 客户端
* 设置密钥
*/
class ControllerclientAddfirstkey extends Controller
{
	/*
	* 功能描述：添加第一个密码，使用第一个密码初始化密码
	* URL地址：client/addfirstkey/index
	* 请求方式：POST
	* 请求参数：
	*	字段：devicecode；说明：设备编码；类型：String；必须：Y
	*	字段：groupid；说明：密码组id；类型：int；必须：Y
	*	字段：keylabel；说明：密码名称；类型：String；必须：Y
	*	字段：keycontent；说明：密码内容；类型：String；必须：Y
	*	字段：description；说明：密码描述；类型：String；必须：Y
	* 返回结果：
	*	字段：message；说明：失败说明信息；类型：String；
	*	字段：key_id；说明：密码ID；类型：Int；
	*	字段：group_id；说明：组ID；类型：Int；
	*	字段：keylabel；说明：密码名称；类型：String；
	*	字段：keycontent；说明：密码内容；类型：String；
	*	字段：description；说明：密码描述；类型：String；
	*/
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){
			$this->load->model('client/device');
			$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);

			if((int)$userid != 0){
				$this->load->model('client/emkey');
				$result = $this->model_client_emkey->addfirstkey($this->request->post['groupid'],$this->request->post['keylabel'],$this->request->post['keycontent'],$this->request->post['description'],$userid);
					if ($result) {
					# code...
						echo json_encode($result);
					}else{
						$array  = array('message' =>"key null" , );
						echo json_encode($array);
					}
			}else{
			$array  = array('message' =>"device is bad" , );
			echo json_encode($array);
		}
		}
	
	}

}
?>