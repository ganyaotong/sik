<?php
/**
* client 客户端
* add ker group
*/
class ControllerClientAddkeygroup extends Controller
{
	
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$this->load->model('client/device');
		$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);
		if((int)$userid != 0){
			$this->load->model('client/keygroup');
			$result = $this->model_client_keygroup->addgroup($userid,$this->request->post['groupname']);

			if ($result==1) {
					# code...
					$array[0]  = array('message' =>"ok" );
				}elseif ($result==0) {
					# code...
					$array[0]  = array('message' =>"ng" );
				}elseif ($result==3) {
					# code...
					$array[0]  = array('message' =>"limited");
				}
				echo json_encode($array);
			}else{
			$array[0]  = array('message' =>"device is bad" , );
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