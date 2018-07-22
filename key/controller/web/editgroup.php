<?php
/**
* client 客户端
* edit group
*/
class ControllerWebEditgroup extends Controller
{
	
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$userid = $this->user->getId();
		if((int)$userid != 0){
			$this->load->model('client/keygroup');
			$result = $this->model_client_keygroup->editgroup($userid,$this->request->post['groupid'],$this->request->post['groupname']);
			echo "1";
		}else{
			echo "3";
		}
			
		}
		
	}
}
?>