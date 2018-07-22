<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title>Sign up Sik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
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
    <script type="text/javascript" src="<?php echo HTTP_SERVER; ?>view/js/jquery-3.3.1.min.js"></script>
    <link href="<?php echo HTTP_SERVER; ?>view/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="<?php echo HTTP_SERVER; ?>view/js/bootstrap.min.js"></script>
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/Images/bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/Images/bootstrap/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/Images/bootstrap/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/Images/bootstrap/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="/Images/bootstrap/ico/favicon.png">
</head>

<body>

    <div class="container" style="max-width: 300px;">

    <ul class="nav nav-tabs " id="myTab">
  <li class="active"><a href="#changepwd">配置用户</a></li>
</ul>
 
<div class="tab-content">


  <div class="tab-pane active" id="changepwd">
    <div class="form-signin">
        <form>
            <h2 class="form-signin-heading">创建账户</h2>

            <div class="control-group ">

              <label class="control-label" for="inputError">输入邮箱地址/你的登陆账户</label>
              <div class="controls">
                <input type="text" class="input-block-level" placeholder="Email address" id="email">
                <p><span class="text-error" id="error"></span></p>
                
              </div>
            </div>
        </form>
        <div>
          <button class="btn btn-primary" id="btnsubmit1" onclick="return submit();" >提交</button>

        </div>
      </div>
  </div>

</div>



      
        
    </div>
    <!-- /container -->
    
<div id="regdialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">提示<span></span></h3>
  </div>
  <div class="modal-body">
    <p></p>
    <p>!</p>
  </div>
  <div class="modal-footer">
    <button class="btn" onclick="toggle()">关闭</button>
  </div>
</div>

<script type="text/javascript">
  $('#myTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})

  function checkboxChange(attr){
    if($("#checkbox"+attr+'').is(':checked')){
        $('#btnsubmit'+attr+'').removeClass('disabled'); 
        $('#btnsubmit'+attr+'').removeAttr('disabled')
    }else{
        $('#btnsubmit'+attr+'').addClass('disabled'); 
        $('#btnsubmit'+attr+'').attr('disabled', 'disabled');
    }
    
}

function submit(){
    $('#error').text('');
  var email = $('#email').val();
  $.post('<?php echo $action ?>',
  {
    email: email,
    
  } , function(data, textStatus, xhr) {
    /*optional stuff to do after success */
    if (data==4) {
        $('#error').text('错误: ');
        setTimeout(function(){$('#error').text('');},2000);
    }else if (data==3) {
      $('#error').text('错误: ');
      setTimeout(function(){$('#error').text('');},2000);
  
    }else if (data==1) {
      window.location.href="/accounts/index.php?route=password/set";
      $('#regdialog').modal('toggle');
    }else if (data==5) {
      $('#error').text('错误');
      //setTimeout(function(){$('#error').text('');},2000);
    };
  });
  return false;
}

function toggle(){
    $('#regdialog').modal('toggle');
}
</script>
</body>
</html>

