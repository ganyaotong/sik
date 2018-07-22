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
            <div class="col-3">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                  <a class="nav-link" href="<?php echo $sideLinkKEY ?>" role="tab">密码管理</a>
                  <a class="nav-link" href="<?php echo $sideLinkDevice ?>" role="tab">设备管理</a>
                </div>
              </div>

            <div class="col-9" style = "height:500px">
                <div class="row">
                    <div class="col-6">
                        <h2>链接日志</h2>
                        <p></p>
                        <p><a class="btn" href="#">查看 &raquo;</a></p>
                    </div>
                    <!--/span-->
                    <div class="col-6">
                        <h2>设备日志</h2>
                        <p></p>
                        <p><a class="btn" href="#">查看 &raquo;</a></p>
                    </div>
                    <!--/span-->
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <hr>
        <footer>
        </footer>

    </div>
    <?php echo $footer ?>;
