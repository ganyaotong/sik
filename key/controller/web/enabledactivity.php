<?php
/**
* client 客户端
* add ker group
*/
class ControllerWebEnabledactivity extends Controller
{
	
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$userid = $this->user->getId();
		if((int)$userid != 0){
			$this->load->model('common/config');
			if ($this->model_common_config->updateConfig('deviceActivityLog','true')) {
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