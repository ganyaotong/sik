<?php
/**
* client 客户端
* delete group
*/
class ControllerWebDeletegroup extends Controller
{
	
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$userid = $this->user->getId();
		if((int)$userid != 0){
			$this->load->model('client/keygroup');
			$result = $this->model_client_keygroup->deletegroup($userid,$this->request->post['groupid']);
			echo "1";
		}else{
			echo "0";
		}
			
		}
		
	}
}
?>