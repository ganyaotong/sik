<?php
/**
* client 客户端
* edit group
*/
class ControllerClientUpdateKeycontent extends Controller
{
	
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$this->load->model('client/device');
		$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);
		if((int)$userid != 0){
			$this->load->model('client/emkey');
			$result = $this->model_client_emkey->updatekeycontent($userid,$this->request->post['keyid'],$this->request->post['keycontent']);
			
			$array[0]  = array('message' => $result );
			echo json_encode($array);
			
		}else{
			$array[0]  = array('message' =>"false" );
			echo json_encode($array);
		}
			
		}
		
	}
}
?>