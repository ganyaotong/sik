<?php
/**
* client 客户端
* 获取key密钥
*/
class ControllerWebLogout extends Controller
{
	
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

			$this->load->model('client/device');
			if ($this->user->islogged()) {
				# code...
				if ($this->model_client_device->logout($this->request->post['code'])) {
				# code...
					echo "1";
				}else{
					echo "0";
				}
			}else{
				echo "3";
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