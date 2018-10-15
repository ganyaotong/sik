<!--
	模板文件
	week 主頁
	函數：header，footer
-->
<?php echo $header ?>
<style type="text/css">
      body {
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
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
.tab-content{margin-top:1em;}
.modal-body{
margin: 1em;
}
.modal-body label{
padding-right: .5em;
}
.modal-body select, .modal-body input, .modal-body textarea{
width: 210px;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Sik账户信息</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">首页 <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $username ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo $LinKAccounts; ?>">账户</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo $LinkLogout; ?>">退出</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="<?php echo $sideLinkKEY ?>">控制台</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
  <ul class="nav nav-tabs"  id="myTab">
  <li class="nav-item">
    <a class="nav-link active" href="#edit">编辑信息</a>
  </li>
  <!--
  <li class="nav-item">
    <a class="nav-link" href="#authenticator">两步验证</a>
  </li>
  -->
  <li class="nav-item">
    <a class="nav-link" href="#changepwd">更改密码</a>
  </li>
</ul>

 
<div class="tab-content">
  <div class="tab-pane fade show active" role="tabpanel" id="edit">

    <div class="form-signin">
      <strong>用户名： </strong><span><?php echo $un; ?></span><br>
      <strong>Email: </strong><span><?php echo $email; ?></span><br>
      <strong>账户状态： </strong><span><?php echo $status; ?></span><br>
      <p class="pull-right"><a href="#editdialog" class="btn btn-primary" data-toggle="modal">编辑</a></p>

    </div>
  </div>

  <div class="tab-pane fade" role="tabpanel" id="authenticator">
    <div class='form-signin'>
        <form>
            <h2 class="form-signin-heading">两步验证</h2>
            <label>大多数用户的帐户只有密码这一道安全防线。有了两步验证，即使别有用心的人通过黑客手段攻破您的密码防线，也还需要拿到您的手机才能进入您的帐户。</label>
            <!--<input type="text" class="input-block-level" placeholder="Email address" id="email"> -->
        </form>
        <div>
          <p><strong>当前状态：</strong><?php if ($two==1) { ?>已启用<?php }else{ ?> 未启用<?php } ?></p>
          <?php if ($two==1) { ?><a class="btn btn-primary" data-toggle="modal" data-target="#AuthenticatorClose">关闭两步验证两步验证</a><?php }else{ ?> <a class="btn btn-primary" data-toggle="modal" href="<?php echo $LinkTwo?>" data-target="#Authenticator">启用两步验证</a><?php } ?>
 <!--
          <a class="btn btn-primary" data-toggle="modal" href="<?php echo $LinkTwo?>" data-target="#Authenticator">启用两步验证</a>
          <a class="btn btn-primary" data-toggle="modal" data-target="#AuthenticatorClose">关闭两步验证两步验证</a>
         
          <button class="btn btn-primary" onclick="openAuthenticator()">启用两步验证</button>
        -->
        </div>
    </div>
  </div>

  <div class="tab-pane fade" role="tabpanel" id="changepwd">
    <div class='form-signin'>
        <form>
            <h2 class="form-signin-heading">更改密码</h2>
            <label>需要更改密码。</label>
            <!--<input type="text" class="input-block-level" placeholder="Email address" id="email"> -->
        </form>
        <div>
          <a class="btn btn-primary" href="<?php echo $changepwdLink; ?>">更改</a>
        </div>
    </div>
  </div>

</div>
</div>


<div id="editdialog" class="modal" tabindex="-1" role="dialog">
 <div class="modal-dialog" role="document">
 <div class="modal-content">
  <div class="modal-header">
	<h5 class="modal-title">编辑用户资料</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
  </div>
  <div class="modal-body">

    <p class="pull-right span2"><strong></strong></p>
	<div class="row">
		<label>用户名称</label>
		<input type="text" placeholder="<?php echo $un; ?>" id="un" />
	</div>
	<div class="row">
      <label>联系手机</label>
	  <input type="text" placeholder="<?php echo $phone; ?>" id="phone" />
	</div>
	<div class="row">
      <label>电子邮件</label>
	  <input type="email" placeholder="<?php echo $email; ?>" id="email" />
	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="btn btn-primary" onclick="updateinfo()">更新</button>
  </div>
  </div>
  </div>
</div>


<div id="alertdialog" class="modal" tabindex="-1" role="dialog" >
<div class="modal-dialog" role="document">
 <div class="modal-content">
  <div class="modal-header">
	<h5 class="modal-title">消息</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
  </div>
  <div class="modal-body">
    <label id='alertdialogmsg'></label>
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
  </div>
  </div>
  </div>
</div>

<div id="closedialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">消息</h3>
  </div>
  <div class="modal-body">
    <label id='closedialogmsg'>关闭账户之后一切功能将会停止，无法登陆，无法恢复。同时客户端也无法登陆。</label>
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="btn btn-primary" onclick="closeAccount()">确定</button>
  </div>
</div>

<div id="Authenticator" class="modal" tabindex="-1" role="dialog" >
<div class="modal-dialog" role="document">
 <div class="modal-content">
  <div class="modal-header">
	<h5 class="modal-title">消息</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
  </div>
  <div class="modal-body">
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
  </div>
  </div>
  </div>
</div>

<div id="AuthenticatorClose" class="modal" tabindex="-1" role="dialog" >
<div class="modal-dialog" role="document">
 <div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">消息</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
  </div>
  <div class="modal-body">
    <p>你确定关闭两步验证功能?</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="btn btn-primary" onclick="closeTwo()">确定</button>
  </div>
  </div>
  </div>
</div>

<script type="text/javascript">
  $('#myTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})
function closeAccount(){
$.post('<?php echo $closeAccountLink ?>',{ param1: 'value1'} , function(data, textStatus, xhr) {
  /*optional stuff to do after success */
  if (data==1) {
    $('#closedialogmsg').text('邮件已经发送，到邮箱进行处理。');
  }else if (data==5) {
    $('#closedialogmsg').text('没有接收到邮件？请联系我们admin@tanknet.asia!');
  };
});
}
function closeAccountdialog(){
      $('#closedialog').modal('toggle');
}

function openAuthenticator(){
   $('#Authenticator').modal('toggle');
}

function submitchange(){
  var email = $('#email').val();
  $.post('<?php echo $changepwdLink ?>',{ email: email}, function(data, textStatus, xhr) {
    /*optional stuff to do after success */
    if (data==1) {
       $('#alertdialogmsg').text('更改邮件已发送，请到收件箱进行下一步操作!');
      $('#alertdialog').modal('toggle');
    }else if(data==0){

    }else if(data==5){
      $('#alertdialogmsg').text('没有接收到邮件？请联系我们admin@tanknet.asia!');
      $('#alertdialog').modal('toggle');
    }
  });
}

function submitchange(){
  var email = $('#email').val();
  $.post('<?php echo $changepwdLink ?>',{ email: email}, function(data, textStatus, xhr) {
    /*optional stuff to do after success */
    if (data==1) {
       $('#alertdialogmsg').text('更改邮件已发送，请到收件箱进行下一步操作!');
      $('#alertdialog').modal('toggle');
    }else if(data==0){

    }else if(data==5){
      $('#alertdialogmsg').text('没有接收到邮件？请联系我们admin@tanknet.asia!');
      $('#alertdialog').modal('toggle');
    }
  });
}

function updateinfo(){
  var email = $('#email').val();
  var phone = $('#phone').val();
  var un = $('#un').val();
  $.post('<?php echo $changeinfoLink ?>',{ email: email, phone: phone, un:un}, function(data, textStatus, xhr) {
    /*optional stuff to do after success */
    if (data==1) {
      window.location.href="index.php?route=common/home";
    }
  });
}

function closeTwo(){
$.post('<?php echo $twocloseLink ?>', 
  {
    param1: 'value1'
  },
   function(data, textStatus, xhr) {
  /*optional stuff to do after success */
  if (data==1) {
    location.reload();
  };
});
}

</script>
<?php echo $footer ?>