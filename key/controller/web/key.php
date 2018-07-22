<?php
/** 
* client 客户端
* 设置密钥
*/
class ControllerwebKey extends Controller
{
	function index(){

	}
	function add()
	{
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){
			$userid = $this->user->getId();
			if((int)$userid != 0){
				$this->load->model('client/emkey');
				$result = $this->model_client_emkey->addkey($this->request->post['groupid'],$this->request->post['keylabel'],$this->request->post['keycontent'],$this->request->post['description'],$userid);
				if ($result==1) {
					# code...
					$array[0]  = array('message' =>"ok" , );
				}elseif ($result==0) {
					# code...
					$array[0]  = array('message' =>"ng" , );
				}elseif ($result==3) {
					# code...
					$array[0]  = array('message' =>"limited" , );
				}
				echo json_encode($array);
			}else{
			$array  = array('message' =>"device is bad" , );
			echo json_encode($array);
			}
		}
	
	}

	function update(){
		# code...
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$userid = $this->user->getId();

		if((int)$userid != 0){
			$this->load->model('client/emkey');
			$result = $this->model_client_emkey->updatekey($userid,$this->request->post['keyid'],$this->request->post['groupid'],$this->request->post['keylabel'],$this->request->post['keycontent'],$this->request->post['description']);
			$array[0]  = array('message' =>"ok" );
			echo json_encode($array);
			
		}else{
			$array[0]  = array('message' =>"device is bad" , );
			echo json_encode($array);
		}
			
		}
	}

	function delete(){
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){

		$userid = $this->user->getId();

		if((int)$userid != 0){
			$this->load->model('client/emkey');
			$result = $this->model_client_emkey->deletekey($userid,$this->request->post['keyid']);
			$array[0]  = array('message' =>"ok" );
			echo json_encode($array);
			
		}else{
			$array[0]  = array('message' =>"device is bad" , );
			echo json_encode($array);
		}
			
		}
	}

}
?>