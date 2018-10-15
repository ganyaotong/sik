<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title>配置用户密码</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo HTTP_SERVER; ?>view/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo HTTP_SERVER; ?>view/js/jquery-3.3.1.min.js"></script>
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 400px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/Scripts/bootstrap/html5shiv.js"></script>
    <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/Images/bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/Images/bootstrap/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/Images/bootstrap/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/Images/bootstrap/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="/Images/bootstrap/ico/favicon.png">
</head>

<body>

    <div class="container">
      <div class="form-signin">
        
     
        <form>
            <h2 class="form-signin-heading">配置用户密码</h2>
            <input type="password" class="input-block-level" placeholder="password" id="password">
            <input type="password" class="input-block-level" placeholder="confirm password" id="Confirmpassword"><span class="text-error" id="veridyError"></span>
        </form>
  
        <div>
          <button class="btn btn-primary" onclick="return setpwd();" >确定</button>

        </div>

      </div>   
    </div>
    <!-- /container -->

    <script type="text/javascript">

function setpwd(){
  var psd = $('#password').val();
  var cpsd = $('#Confirmpassword').val();
  if (psd==cpsd) {
    $.post('<?php echo $setpwsLink ?>',
    {
        psd: psd
    } , 
    function(data, textStatus, xhr) {
      /*optional stuff to do after success */
      if (data==1) {
        alert('验证成功，马上登陆');
window.location.href="index.php?route=common/logout&&link=";
      }else if(data==0){
        $('#veridyCodeError').text('验证码错误');

        setTimeout(function(){
        $('#veridyCodeError').text('');
        },2000);
      }

    });
  }else{
    $('#veridyError').text('两次密码输入不一致');

    setTimeout(function(){
      $('#veridyError').text('');
    },2000);
  }
}
    </script>
</body>
</html>

