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
                        <li class="active"><a href="<?php echo $sideLinkWallet ?>">用户钱包</a></li>
                        <li><a href="<?php echo $sideLinkKEY ?>">密码管理</a></li>
                        <li><a href="<?php echo $sideLinkDevice ?>">设备管理</a></li>
                        <li><a href="<?php echo $sideLinkPro ?>">专业版</a></li>
                    </ul>
                </div>
                <!--/.well -->
            </div>

            <div class="col-sm-9" style="min-height: 500px;">
                <?php echo $isactivation ?>

            </div>
            <!--/span-->
        </div>
        <!--/row-->

        <hr>

        <footer>
        </footer>

    </div>
    <?php echo $footer ?>;
