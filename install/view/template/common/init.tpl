<!DOCTYPE html>
<html lang="zh">
    <head>
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script type="text/javascript" src="./view/js/jquery-3.3.1.min.js"></script>
        <!-- Bootstrap -->
        <link href="./view/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="./view/js/bootstrap.min.js"></script>
        <script src="./view/js/iscroll.js"></script>
        <style type="text/css">
         body {
            padding-top: 60px;
            padding-bottom: 40px;
          }
        .sidebar-nav {
            padding: 9px 0;
          }
        .input-group{
            width: 100% !important;
        }

          @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
              float: none;
              padding-left: 5px;
              padding-right: 5px;
            }
          }

            .emtitle{
                width: 100px;
            }
            .page-lock-info h1{text-align: center;}
        </style>
    </head>
    <body>
    
    <div class="container-fluid">
        <div class="row-fluid">
            
            <!--/span-->
            <div class="span3">
                
                <!--/.well -->
            </div>

            <div class="span9" style = "height:500px">
               <div class="page-body">
                    <div class="page-lock-info">
                        <h1>安装程序SIK</h1>
                        <form class="form-inline" action="<?php echo $action; ?>" method="post">
                            <div class="input-group input-medium">
                                <label class="form-control">数据库</label>
                                <select class="form-control" name="database">
                                    <option value="0">MySQL</option>
                                </select>
                            </div>
                            
                            <div class="input-group input-medium">
                                <label class="form-control">数据库地址</label>
                                <input type="text" class="form-control" placeholder="地址" name="host">
                            </div>
                            
                            <div class="input-group input-medium">
                                <label class="form-control">数据库端口</label>
                                <input type="number" class="form-control" placeholder="端口" name="port">
                            </div>

                            <div class="input-group input-medium">
                                <label class="form-control">数据库名称</label>
                                <input type="text" class="form-control" placeholder="数据库名称" name="databasename">
                            </div>
                            
                            <div class="input-group input-medium">
                                <label class="form-control">数据库用户名</label>
                                <input type="text" class="form-control" placeholder="用户名" name="username">
                            </div>

                            <div class="input-group input-medium">
                                <label class="form-control">数据库密码</label>
                                <input type="text" class="form-control" placeholder="密码" name="password">
                            </div>

                                
                            <div class="input-group input-medium">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn blue icn-only"><i class="m-icon-swapright m-icon-white"></i>下一步</button>
                                </span>
                            </div>
                            <!-- /input-group -->
                            <div class="relogin">
                                     点击下一步进行安装！
                            </div>
                        </form>
                    </div>
                </div>
               
            </div>
            <!--/span-->
        </div>
        <!--/row-->

        <hr>

        <footer>
        </footer>

    </div>
    </body>
</html>;
