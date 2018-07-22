<?php
/**
* client 客户端
* 获取key密钥
*/
class ControllerClientGetkey extends Controller
{
	
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