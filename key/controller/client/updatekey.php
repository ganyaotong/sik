<?php
/**
* client 客户端
* edit group
*/
class ControllerClientUpdateKey extends Controller
{
	
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$this->load->model('client/device');
		$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);
		if((int)$userid != 0){
			$this->load->model('client/emkey');
			$result = $this->model_client_emkey->updatekey($userid,$this->request->post['keyid'],$this->request->post['groupid'],$this->request->post['keylabel'],$this->request->post['keycontent'],$this->request->post['description']);
			$array[0]  = array('message' =>"update finish" );
			echo json_encode($array);
			
		}else{
			$array[0]  = array('message' =>"device is bad" , );
			echo json_encode($array);
		}
			
		}
		
	}
}
?>