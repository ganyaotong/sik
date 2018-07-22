<?php
/**
* client 客户端
* 获取key密钥
*/
class ControllerClientLogout extends Controller
{
	
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