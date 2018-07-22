<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title>Sign in EM-ACCOUNTS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" src="<?php echo HTTP_SERVER; ?>view/js/jquery-3.3.1.min.js"></script>
    <!-- Le styles -->
    <link href="<?php echo HTTP_SERVER; ?>view/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo HTTP_SERVER; ?>view/js/bootstrap.min.js"></script>
    
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
            <h2 class="form-signin-heading">忘记密码</h2>
            <label>请输入绑定的电子邮箱</label>
            <input type="email" class="input-block-level" placeholder="Email address" id="email">
            <span class="text-error" id="veridyError"></span>
        </form>
  
        <div>
          <button class="btn btn-primary" onclick="return submitmail();" >确定</button>

        </div>

      </div>   
    </div>
    <!-- /container -->


<div id="dialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">提示<span></span></h3>
  </div>
  <div class="modal-body">
    <p>验证邮件已经发送指定邮箱，请查收！</p>
    <p>你需要登录电子邮箱处理邮件，进行下一步操作!</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
  </div>
</div>


    <script type="text/javascript">

function submitmail(){
  var email = $('#email').val();
    $.post('<?php echo $setpwsLink ?>',
    {
        email: email
    } , 
    function(data, textStatus, xhr) {
      /*optional stuff to do after success */
      if (data==1) {

        $('#dialog').modal('toggle');

      }else if(data==5){
        $('#veridyError').text('没有收到电子邮件？请联系我们admin@tanknet.asia');
      }else if (data==3) {
        $('#veridyError').text('用户不存在！');
        setTimeout(function(){$('#veridyError').text('');},2000);
      };
    });
}
    </script>
</body>
</html>

