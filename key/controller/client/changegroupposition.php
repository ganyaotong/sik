<?php
/** 
* client 客户端
* 设置密钥
*/
class ControllerclientChangeGroupPosition extends Controller
{
	/*
	* 功能描述：修改密码组排序位置
	* URL地址：client/changegroupposition/index
	* 请求方法：POST
	* 请求参数：
	*	字段：devicecode；说明：设备编码：类型：String；必须：Y
	*	字段：groupid；说明：组ID；类型：Int；必须：Y
	*	字段：position；说明：位置；类型：Int；必须：Y
	* 返回结果：
	*	字段：message；说明：信息；类型：String；
	*/
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){
			$this->load->model('client/device');
			$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);

			if((int)$userid != 0){

				$this->load->model('client/keygroup');
				$result = $this->model_client_keygroup->changegroupposition($this->request->post['groupid'],$this->request->post['position'],$userid);
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