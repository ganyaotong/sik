<?php
/**
* 公共footer
*/
class ControllerWalletActivation extends Controller
{
	
	function index()
	{	
		# code...
		$this->load->model('wallet/wallet');
		$userid = $this->user->getId();
		if ($this->model_wallet_wallet->init($userid)) {
			# code...
			echo "1";
		}else{
			echo "0";
			}

		
	}
}
?>