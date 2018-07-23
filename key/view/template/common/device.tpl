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
      .my-edit{
    margin-top: 5px;
    margin-left: 5px;
}  
      #wrapper,#wrapper1 {
   /* position: absolute; */
    z-index: 1;
    top: 45px;
    bottom: 48px;
    left: 0;
    width: 100%;
    height: 300px;
    background: #ccc;
    overflow: hidden;
}
#wrapper3 {
   /* position: absolute; */
    z-index: 1;
    top: 45px;
    bottom: 48px;
    left: 0;
    height: 300px;
    background: #ccc;
    overflow: hidden;
}

#scroller {
    /*
    position: absolute; */
    z-index: 1;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    width: 100%;
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-text-size-adjust: none;
    -moz-text-size-adjust: none;
    -ms-text-size-adjust: none;
    -o-text-size-adjust: none;
    text-size-adjust: none;
}

#scroller ul {
    list-style: none;
    padding: 0;
    margin: 0;
    width: 100%;
    text-align: left;
}

#scroller li, #activityDevice li {
    padding: 0 10px;
    height: 40px;
    line-height: 40px;
    border-bottom: 1px solid #ccc;
    border-top: 1px solid #fff;
    background-color: #fafafa;
    font-size: 14px;
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

    <div class="container-fluid">
        <div class="row">
            
            <!--/span-->
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                  <a class="nav-link " href="<?php echo $sideLinkKEY ?>" role="tab">密码管理</a>
                  <a class="nav-link active" href="<?php echo $sideLinkDevice ?>" role="tab">设备管理</a>
                </div>
                <!--/.well -->
            </div>

            <div class="col-md-9" style = "height:500px">
                <div class="row">
                    <div class="col-md-6">
                        <h2>历史设备记录</h2>

                        <div id="wrapper">
                            <div id="scroller">
                                <ul>
                                
                                   <?php foreach ($deviceList as $device ) {?>
                                   <li><?php echo $device['deviceName']; ?><span class="pull-right"><?php echo $device['dateAdded']; ?></span></li>

                                   <?php }?>
                                   
                                </ul>
                               
                            </div>
                        </div>
                        <p class="text-info"><span class="pull-left">设备名称</span><span class="pull-right">初次使用日期</span></p>
                        <p class="well text-warning">设备初次使用，系统生成新的设备编码，显示在此表格。</p>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <h2>活动设备</h2>

                        <div id="wrapper1">
                            <div id="scroller">
                                <?php if ($dal=="true") { ?>
                                    <ul>
                                        <?php foreach ($connectList as $connect ) {?>
                                        <li><?php echo $connect['deviceName']; ?><span class="pull-right"><?php echo $connect['dateAdded']; ?></span></li>
                                        <?php }?>
                                    </ul>
                                <?php }else{?>
                                <p>基于隐私原则，默认状态下服务器不会获取tankkey软件活动信息的，用户如有需要，右边活动记录按钮操作启动。</p>
                                <?php }?>

                            </div>
                        </div>
                        <p class="well text-warning">当用户的软件已经使用，任何点击启动软件操作都会在此记录，即使用户没有输入密钥(session Key).用户如果发现异常，用户应该根据实际情况点击下边的按钮进行操作。</p>
                    </div>
                    <!--/span-->
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h2>远程控制</h2>
                        <p class="well">所有的记录只为用户提供客观全面的信息，为用户进一步保护密码提供帮助，我们坚信这是大家需要的，并且是正确的。下面提供相应的功能，用户可以根据实际情况操作。</p>
                        <p><a class="btn btn-primary" href="#activitylog" data-toggle="modal">活动记录</a> <a class="btn btn-primary" onclick="refreshscroll()">注销登陆</a></p>
                        <!--
                        <p><a class="btn btn-primary" href="#remoteUnstar" data-toggle="modal">禁止启动</a></p>
                    -->
                    </div>
                    <!--/span-->
                </div>
               
            </div>
            <!--/span-->
        </div>
        <!--/row-->


<div id="activitylog" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">禁止启动</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <p class="text-success">当前状态：<span id="messageactivity"><?php if ($dal == "true") { ?>
            开启</span></p>
         <?php }else{?>
        关闭</span></p>
         <?php }?>
        
        <p>特别说明:启用此功能后服务器将会获取tankkey软件活动信息</p>
        <p>此功能关闭将会删除服务器的所有链接数据。再次开启将会消失并重新初始化。</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" onclick="enabledactivity();">启用</button>
        <button type="button" class="btn btn-primary" onclick="disabledactivity();">停用</button>
      </div>
    </div>
  </div>
</div>


<div id="remoteUnstar" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">远程控制</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>特别说明:此功能可以控制掌上设备tankkey软件无法启动，软件失去作用。</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" onclick="addGroup();">停用</button>
      </div>
    </div>
  </div>
</div>

<div id="remoteLogout" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">注销登陆</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>特别说明:此功能可以控制掌上设备tankkey软件限制链接服务器，软件重新登录可以继续使用。</p>
        <div id="wrapper3">
            <div id="scroller">
            <ul>
            <?php foreach ($activityDevice as $device ) {?>
            <li id="id<?php echo $device['deviceCode']; ?>"><?php echo $device['deviceName']; ?><a class="btn btn-danger pull-right my-edit" onclick="logOutdevice('<?php echo $device['deviceCode']; ?>')">注销</a><span class="pull-right"><?php echo $device['dateAdded']; ?></span></li>
            <?php }?>
        </ul>
    </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>   

</div>

<script type="text/javascript">
    var myScroll;
    var myScroll1;
    var myScroll3;
    $(document).ready(function() {
        myScroll = new IScroll('#wrapper', { mouseWheel: true });
        myScroll1 = new IScroll('#wrapper1', { mouseWheel: true });
        myScroll3 = new IScroll('#wrapper3',{ mouseWheel: true });
        document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
    });

    function refreshscroll(){
        $('#remoteLogout').modal('toggle');
        $('#remoteLogout').on('shown', function () {
        // do something…
        myScroll3.refresh();
    })
        
    }
    function logOutdevice(deviceCode){
    $.post('<?php echo $logoutLink ?>',
    {
        code: deviceCode
    } ,
     function(data, textStatus, xhr) {
        /*optional stuff to do after success */
        if (data==1) {
            $('#id'+deviceCode+'').children('a').addClass('disabled');
        }else if (data==0) {

        }else if(data==3){

        };
    });
    }
    function enabledactivity(){
    $.post('<?php echo $enabledactivityLink ?>',{
        param1: 'value1'
    } , function(data, textStatus, xhr) {
        /*optional stuff to do after success */
        if (data==1) {
            $('#messageactivity').text('启用');
            location.reload();
        }else if(data==3){
                $('#messageactivity').text('未知错误');
        }
    });
    }
    function disabledactivity(){
        $.post('<?php echo $disabledactivityLink ?>',{
            param1: 'value1'
        } , function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            if (data==1) {
                $('#messageactivity').text('关闭');
                location.reload();
            }else if(data==3){
                $('#messageactivity').text('未知错误');
            }
        });

    }
</script>

    <?php echo $footer ?>
