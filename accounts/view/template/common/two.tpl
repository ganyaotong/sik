<!--
	模板文件
	week 主頁
	函數：header，footer
-->
<?php echo $header ?>
<style type="text/css">

     
      .form-signin1 {
        max-width: 200px;
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
      .form-signin1 .form-signin-heading,
      .form-signin1 .checkbox {
        margin-bottom: 10px;
      }
      .form-signin1 input[type="text"],
      .form-signin1 input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
  
</style>
  <img class="pull-right" src="<?php echo $img ?> ">
  <div>
    <form class="form-signin1 pull-left">

            <h2 class="form-signin-heading">输入动态码</h2>
            <input type="text" class="input-block-level" placeholder="Email address" id="authenticatorCode">
            <a class="btn btn-primary" onclick="setAuthenticator()" >开始设定</a>

    </form>

  </div>
      <p class="pull-left">需要安装 Google 身份验证器, 请访问<a href="https://play.google.com/store" target="_blank"> Google Play。</a>然后搜索 Google 身份验证器。</p>
<script type="text/javascript">

  function setAuthenticator(){
     var code = $('#authenticatorCode').val();
    $.post('<?php echo $setAuthenticatorLink ?>',
     { 
      code: code
    }, 
     function(data, textStatus, xhr) {
      /*optional stuff to do after success */
      if (data==0) {
alert("验证码错误");
      }else if (data==1) {
      location.reload();
      };
      
    });
    
  }
</script>
  




<?php echo $footer ?>