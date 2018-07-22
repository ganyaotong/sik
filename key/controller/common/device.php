<?php
/**
*	http://key wallet
*  密码管理器接入口 
*  作者：Arthur
*/
class ControllerCommonDevice extends Controller
{
	
	function index(){
		$this->load->model('common/config');
		$userid = $this->user->getId();
		if ($this->user->islogged()) {
			# code...
			# echo  $this->user->getId();
			if(!$this->model_common_config->activation($userid)){
				$this->related();
			}
			
			$this->data['username'] = $this->user->getUserMail();
		}else{
			$this->data['username'] = '你';
		}
		
		$this->data['sideLinkKEY'] = $this->url->link('common/key');
		$this->data['sideLinkDevice'] = $this->url->link('common/device');
				
		$this->data['LinkLogout'] = $this->url->reLink('accounts','common/logout');
		$this->data['LinKAccounts'] = $this->url->reLink('accounts','common/home');

		$this->load->model('client/device');
		$this->data['deviceList'] = $this->model_client_device->getDeviceLog($userid);
		
		//用户设备权限配置
		$config =  $this->session->data['keyConfig'];
		$dal= $config['deviceActivityLog'];
		$this->data['dal'] = $dal;
		if ($dal=="true") {
			# code...
			$this->data['connectList'] = $this->model_client_device->getConnectLog($userid);
		}
		
		$this->data['enabledactivityLink'] = $this->url->relink('key','web/enabledactivity');
		$this->data['disabledactivityLink'] = $this->url->relink('key','web/disabledactivity');


		$this->data['activityDevice'] = $this->model_client_device->getAllDevice($userid);
		$this->data['logoutLink'] = $this->url->relink('key','web/logout');

		$this->data['LinkHome'] = HTTP_ROOT;
		$this->data['action'] = $this->url->relink('accounts','common/login') . '&&link='. $this->url->relink('key','common/home');
		$this->template = $this->config->get('config_template') . 'common/device.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
			);
		$this->response->setOutPut($this->render(true));
	}

	private function related() {
		$userInfo = $this->user->getUserInfo();
		$this->load->model('common/config');
		if ($this->model_common_config->addconfig($userInfo)) {
			# code...
			return true;
    	} else {
      		return false;
    	}  	
  	}
}
?>