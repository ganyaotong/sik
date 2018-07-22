<?php
/** 
* 登陆功能类
*/
class ControllerCommonTwov extends Controller
{
  private $error = array();
	
	function index()
	{
		#  require_once '../PHPGangsta/GoogleAuthenticator.php';
require_once(DIR_SYSTEM . 'library/GoogleAuthenticator.php');
$ga = new PHPGangsta_GoogleAuthenticator();

/*
$secret = $ga->createSecret();
echo "Secret is: ".$secret."\n\n";

$qrCodeUrl = $ga->getQRCodeGoogleUrl('坦克网络', $secret);
echo "Google Charts URL for the QR-Code: ".$qrCodeUrl."\n\n";


$oneCode = $ga->getCode($secret);
echo "Checking Code '$oneCode' and Secret '$secret':\n";
*/

$oneCode =  $this->request->get['code'];
$checkResult = $ga->verifyCode('KQCI6PHUQAFBW57O', $oneCode, 2);    // 2 = 2*30sec clock tolerance
if ($checkResult) {
    echo 'OK';
} else {
    echo 'FAILED';
}
   
	}


}
?>