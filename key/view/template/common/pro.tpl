<?php echo $header ?>
		<style type="text/css">
      body {
        padding-top: 60px;
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
    width: 300px;
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
	<div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="nav-collapse collapse">
                    <div class="dropdown pull-right" style="margin-top:10px">
  <a class="dropdown-toggle navbar-link" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
    <?php echo $username ?>
    <b class="caret"></b>
  </a>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    <li><a tabindex="-1" href="<?php echo $LinKAccounts; ?>">账户</a></li>
    <li class="divider"></li>
    <li><a tabindex="-1" href="<?php echo $LinkLogout; ?>">退出</a></li>
  </ul>
</div>

                    <ul class="nav">
                        <li><a href="<?php echo $LinkHome ?>">Home</a></li>
                       <!-- <li><a href="<?php echo $LinkPricing ?>">Pricing</a></li> 
                        
                        <li><a href="<?php echo $LinkHelp ?>">Help</a></li>-->
                        <li><a href="<?php echo $LinkBlog ?>">Blog</a></li>
                        <li class="active"><a href="<?php echo $sideLinkKEY ?>">manage</a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row-fluid">
            
            <!--/span-->
            <div class="col-sm-3">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                
                        <li><a href="<?php echo $sideLinkWallet ?>">用户钱包</a></li>
                
                        <li><a href="<?php echo $sideLinkKEY ?>">密码管理</a></li>
                        <li><a href="<?php echo $sideLinkDevice ?>">设备管理</a></li>
                        <li class="active"><a href="<?php echo $sideLinkPro ?>">专业版</a></li>
                    </ul>
                </div>
                <!--/.well -->
            </div>

            <div class="col-sm-9" style = "height:500px">
                <div class="row">
                    <div class="col-sm-3 offset2">
                    <img class="img-circle" data-src="holder.js/140x140">
                    <h2>Free</h2>
                    <p>password:10pcs</p>
                    <p>group:3pcs</p>
                </div>
            <!-- /.span4 -->
                <div class="col-sm-3 offset2">
                    <img class="img-circle" data-src="holder.js/140x140">
                    <h2>Pro</h2>
                    <p>password:50pcs</p>
                    <p>group:10pcs</p>
                    <p>Only 10GL/year</p>
                    <p><button class="btn btn-primary" <?php if ($userGroup==0) { ?> <?php }elseif ($userGroup==1) { ?>disabled<?php } ?>   onclick="return getPro();"><?php if ($userGroup==0) { ?>  Get it <?php }elseif ($userGroup==1) { ?>using<?php } ?>
                    </button></p>
                </div>
            <!-- /.span4 -->
        </div>
               
            </div>
            <!--/span-->
        </div>
        <!--/row-->

        <hr>

        <footer>
        </footer>

    </div>

    <div id="getProdialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">提示<span></span></h3>
  </div>
  <div class="modal-body">
    <p>你目前的绿叶：<?php echo $score ?>pcs</p>
    <p>你需要支付绿叶数量：10pcs</p>
  </div>
  <div class="modal-footer">
    <button class="btn" onclick="toggle()">关闭</button>
    <button class="btn btn-warning" onclick="submitPro()">确认</button>
  </div>
</div>

<script type="text/javascript">
function getPro(){
$('#getProdialog').modal('toggle');
}
function toggle(){
$('#getProdialog').modal('toggle');
}
function submitPro(){

   var A=window.open("<?php echo HTTP_ROOT.'accounts/index.php?route=wallet/checkout&&usergroup=1' ?>","TencentLogin","width=450,height=320,menubar=0,scrollbars=1,resizable=1,status=1,titlebar=0,toolbar=0,location=1");
}
</script>

    <?php echo $footer ?>;
