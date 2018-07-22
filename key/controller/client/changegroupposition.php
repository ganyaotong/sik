<?php
/** 
* client 客户端
* 设置密钥
*/
class ControllerclientChangeGroupPosition extends Controller
{
	
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