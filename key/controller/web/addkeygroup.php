<?php
/**
* client 客户端
* add ker group
*/
class ControllerWebAddkeygroup extends Controller
{
	
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$userid = $this->user->getId();
		if((int)$userid != 0){
			$this->load->model('client/keygroup');
			$result = $this->model_client_keygroup->addgroup($userid,$this->request->post['groupname']);

			if ($result==1) {
					# code...
					echo "1";
				}elseif ($result==0) {
					# code...
					echo "0";
				}elseif ($result==3) {
					# code...
					echo "3";
				}
				
		}else{
			echo "0";
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