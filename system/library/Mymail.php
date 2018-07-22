<?php

final class Mymail {
   protected $to;
   protected $from;
   protected $sender;
   protected $subject;
   protected $text;
   protected $html;
   protected $attachments = array();


    function mail_new($tomail,$code){
      $this->session->data['code'] = $code;
      $linksetpwd = HTTP_ROOT.'accounts/index.php?route=password/set&&activeCode='.$code;
      $body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Really Simple HTML Email Template</title>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <!-- content -->
      <div class="content">
      <table>
        <tr>
          <td>
            <h1>Dear '.$tomail.' </h1>
            <p>Welcome to tank Network Technology Corporation! You can login to your account at  <a href="http://www.tanknet.asia/">http://www.tanknet.asia/</a> or <a href="https://tanknet.sinaapp.com/">https://tanknet.sinaapp.com/</a> in china</p>
            <p>By Before login, you must activate your account </p>
            <p>Please go to <a href="'.$linksetpwd.'">'.$linksetpwd.'</a> to activate your Account.</p>
            <br>
            <p>Enjoy!</p>
            <p>The TankNet Accounts Team</p>
            <br>
          </td>
        </tr>
      </table>

    <table class="preview_table">
    <tbody>
      <tr>
        <td valign="middle" style="color:#a0a0a0;font-size:12px;">
          <p style="margin:0;">tank Network Technology Corporation</p>
          <p style="margin:0;">http://www.tanknet.asia</p>
          <p style="margin:0;">https://tanknet.sinaapp.com</p>
        </td>
      </tr>
    </tbody>
    </table>

      </div>
      <!-- /content -->
      
    </td>
    <td></td>
  </tr>

</table>
<!-- /body -->

<!-- /footer -->

</body>
</html>';

      $mail = new SaeMail();
     //对象
  
      $mail->setOpt( array(   
'from' => 'The TankNet Accounts Team', //form  
'to' => trim( $tomail ),//接收信箱  
'smtp_host' => 'smtp.gmail.com' , //host
     
'smtp_port' => 587, //port
     
'smtp_username' => 'account-new-noreply@tanknet.asia' ,
     
'smtp_password' => 'iAvDYjMH6ah8oRE' ,
     
'subject' => 'TankNet Sign Up' ,
     
'content' => $body,
'content_type' =>'HTML',
 'tls' => true,
          
));

  $ret = $mail->send();
}


  function mail_changePassword($tomail,$activeCode){
      $linksetpwd = HTTP_ROOT.'accounts/index.php?route=password/reset&&activeCode='.$activeCode;
      $body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Really Simple HTML Email Template</title>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <!-- content -->
      <div class="content">
      <table>
        <tr>
          <td>
            <h1>重置賬戶密碼郵箱驗證</h1>
            <p>請點擊以下鏈接更改您 TankNet 帳戶 '.$tomail.' 的賬戶密碼</p>
            <br>
            <p><a href='.$linksetpwd.'>點此鏈接</a></p>
            <p>如果以上鏈接點擊無效：請複製以下鏈接粘帖至瀏覽器地址欄。</p>
            <p>'.$linksetpwd.'</p>
            <br>
            <p>謝謝</p>
            <p>TankNet 賬戶小組</p>
          </td>
        </tr>
      </table>

    <table class="preview_table">
    <tbody>
      <tr>
        <td valign="middle" style="color:#a0a0a0;font-size:12px;">
          <p style="margin:0;">TankNet賬戶小組</p>
          <p style="margin:0;">坦克网络</p>
          <p style="margin:0;">https://www.tanknet.asia</p>
        </td>
      </tr>
    </tbody>
    </table>

      </div>
      <!-- /content -->
      
    </td>
    <td></td>
  </tr>

</table>
<!-- /body -->

<!-- /footer -->

</body>
</html>';


    
      $mail = new SaeMail();
     //对象
  
      $mail->setOpt( array(   
'from' => 'The tanknet Security Team', //form  
'to' => trim( $tomail ),//接收信箱  
'smtp_host' => 'smtp.gmail.com' , //host
     
'smtp_port' => 587, //port
     
'smtp_username' => 'account-security-noreply@tanknet.asia' ,
     
'smtp_password' => 'iAvDYjMH6ah8oRE' ,
     
'subject' => '重置賬戶密碼郵箱驗證' ,
     
'content' => $body,
'content_type' =>'HTML',
 'tls' => true,
          
));

$ret = $mail->send();

    }

    function mail_reSetPassword($tomail,$activeCode){
      $linksetpwd = HTTP_ROOT.'accounts/index.php?route=password/reset&&activeCode='.$activeCode;
      $body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Really Simple HTML Email Template</title>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <!-- content -->
      <div class="content">
      <table>
        <tr>
          <td>
            <h1>重置賬戶密碼郵箱驗證</h1>
            <p>請點擊以下鏈接更改您 TankNet 帳戶 '.$tomail.' 的賬戶密碼</p>
            <br>
            <p><a href='.$linksetpwd.'>點此鏈接</a></p>
            <p>如果以上鏈接點擊無效：請複製以下鏈接粘帖至瀏覽器地址欄。</p>
            <p>'.$linksetpwd.'</p>
            <br>
            <p>謝謝</p>
            <p>TankNet 賬戶小組</p>
          </td>
        </tr>
      </table>

    <table class="preview_table">
    <tbody>
      <tr>
        <td valign="middle" style="color:#a0a0a0;font-size:12px;">
          <p style="margin:0;">TankNet賬戶小組</p>
          <p style="margin:0;">坦克网络</p>
          <p style="margin:0;">https://www.tanknet.asia</p>
        </td>
      </tr>
    </tbody>
    </table>

      </div>
      <!-- /content -->
      
    </td>
    <td></td>
  </tr>

</table>
<!-- /body -->

<!-- /footer -->

</body>
</html>';


    
      $mail = new SaeMail();
     //对象
  
      $mail->setOpt( array(   
'from' => 'The tanknet Security Team', //form  
'to' => trim( $tomail ),//接收信箱  
'smtp_host' => 'smtp.gmail.com' , //host
     
'smtp_port' => 587, //port
     
'smtp_username' => 'account-security-noreply@tanknet.asia' ,
     
'smtp_password' => 'iAvDYjMH6ah8oRE' ,
     
'subject' => '重置賬戶密碼郵箱驗證' ,
     
'content' => $body,
'content_type' =>'HTML',
 'tls' => true,
          
));

$ret = $mail->send();

    }

    function mail_close($tomail,$activeCode){
      $linksetpwd = HTTP_ROOT.'accounts/index.php?route=userinfo/close&&activeCode='.$activeCode;
      $body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Really Simple HTML Email Template</title>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <!-- content -->
      <div class="content">
      <table>
        <tr>
          <td>
            <h1>關閉賬戶郵箱驗證</h1>
            <p>請點擊以下鏈接关闭您的 TankNet 帳戶 '.$tomail.' </p>
            <br>
            <p><a href='.$linksetpwd.'>點此鏈接</a></p>
            <p>如果以上鏈接點擊無效：請複製以下鏈接粘帖至瀏覽器地址欄。</p>
            <p>'.$linksetpwd.'</p>
            <br>
            <p>謝謝</p>
            <p>TankNet 賬戶小組</p>
          </td>
        </tr>
      </table>

    <table class="preview_table">
    <tbody>
      <tr>
        <td valign="middle" style="color:#a0a0a0;font-size:12px;">
          <p style="margin:0;">TankNet賬戶小組</p>
          <p style="margin:0;">坦克网络</p>
          <p style="margin:0;">https://www.tanknet.asia</p>
        </td>
      </tr>
    </tbody>
    </table>

      </div>
      <!-- /content -->
      
    </td>
    <td></td>
  </tr>

</table>
<!-- /body -->

<!-- /footer -->

</body>
</html>';


    
      $mail = new SaeMail();
     //对象
  
      $mail->setOpt( array(   
'from' => 'The tanknet Security Team', //form  
'to' => trim( $tomail ),//接收信箱  
'smtp_host' => 'smtp.gmail.com' , //host
     
'smtp_port' => 587, //port
     
'smtp_username' => 'account-security-noreply@tanknet.asia' ,
     
'smtp_password' => 'iAvDYjMH6ah8oRE' ,
     
'subject' => '關閉賬戶郵箱驗證' ,
     
'content' => $body,
'content_type' =>'HTML',
 'tls' => true,
          
));

$ret = $mail->send();

    }

}
?>
