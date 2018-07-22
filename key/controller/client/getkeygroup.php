<?php
/**
* client 客户端
* 获取key密钥
*/
class ControllerClientGetkeygroup extends Controller
{
	
	function index()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$this->load->model('client/device');
		$userid = $this->model_client_device->getUserIdByDevice($this->request->post['devicecode']);
		
		$this->load->model('client/keygroup');
		$resultgroup = $this->model_client_keygroup->getgroup($userid);
		
		if ($resultgroup) {
			# code...
			echo json_encode($resultgroup);
		}else{
			$array[0] = array("group_id"=>"0","name"=>"Ungrouped");
			echo json_encode($array);
		}

		}

	
	}

}
?>