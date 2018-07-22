<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title>Sign in EM-ACCOUNTS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo HTTP_SERVER; ?>view/css/bootstrap.min.css" rel="stylesheet">
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
        margin-top: 100px;
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
  <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="nav-collapse collapse">
                    
                <!--    <p class="navbar-text pull-right">
                     Logged in as <a href="<?php echo $action ?>" class="navbar-link"><?php echo $username ?></a>
                    
                    </p>
                
                    
                    <ul class="nav">
                        <li><a href="<?php echo $LinkHome ?>">Home</a></li>
                       <!-- <li><a href="<?php echo $LinkPricing ?>">Pricing</a></li> 
                        <li><a href="<?php echo $LinkHome ?>">Blog</a></li>
                        <li><a href="<?php echo $LinkHelp ?>">Help</a></li>
                        <li><a href="<?php echo $LinkPrivacy ?>">Privacy & Terms</a></li>
                        <li><a href="<?php echo $sideLinkKEY ?>">manage</a></li>
                    </ul>-->
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
   </div>

    <div class="container">

        <form class="form-signin"  action="<?php echo $action ?>" method="post">
            <h2 class="form-signin-heading">二次验证</h2>
            <input type="text" class="input-block-level" placeholder="" name="code">

            <button class="btn btn-primary" type="submit">确认</button>
            <p class="span4 text-right"><a href="<?php echo $fotget ?>">无法获取验证码</a></p>
        </form>
<!--
        <div class="form-signin">
          <a href="<?php echo HTTP_ROOT.'oauth/login/qq/tank/oauth/index.php' ?>"><img src="<?php echo HTTP_IMAGE; ?>qq/Connect_logo_7.png"></a>
        </div>
-->
    </div>
    <!-- /container -->

<script type="text/javascript">
  function toLogin()
 {
   //以下为按钮点击事件的逻辑。注意这里要重新打开窗口
   //否则后面跳转到QQ登录，授权页面时会直接缩小当前浏览器的窗口，而不是打开新窗口
   var A=window.open("<?php echo HTTP_ROOT.'oauth/login/qq/tank/oauth/index.php' ?>","TencentLogin","width=450,height=320,menubar=0,scrollbars=1,resizable=1,status=1,titlebar=0,toolbar=0,location=1");
 } 
</script>

</body>
</html>

