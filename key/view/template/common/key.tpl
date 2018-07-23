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

        #scroller li {
            padding: 0 10px;
            height: 40px;
            border-bottom: 1px solid #ccc;
            border-top: 1px solid #fff;
            background-color: #fafafa;
            font-size: 14px;
        }

        .keymanager label{margin-right: 1em;}
        .my-edit{float: right;}
        .modal-body{
            margin: 1em;
        }
        .modal-body label{
            padding-right: .5em;
        }
        .modal-body select, .modal-body input, .modal-body textarea{
            width: 210px;
        }
        .well{margin-top: 1em;}
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
                  <a class="nav-link active" href="<?php echo $sideLinkKEY ?>" role="tab">密码管理</a>
                  <a class="nav-link" href="<?php echo $sideLinkDevice ?>" role="tab">设备管理</a>
                </div>
                <!--/.well -->
            </div>

            <div class="col-md-9" style = "height:500px">
                <div class="row">
                    <div class="col-md-6">
                        <h2>密码管理</h2>
                        <div id="wrapper">
                            <div id="scroller">
                                <ul>
                                
                                   <?php foreach ($keyList as $key ) {?>
                                   <li class="keymanager"><label><strong><?php echo $key['keylabel']; ?></strong></label><span class="pull-right"><?php echo $key['keySubdes']; ?></span>
                                   <a onclick="editkey(<?php echo  $key['key_id']; ?> ,<?php echo  $key['group_id']; ?>,'<?php echo $key['keylabel']; ?>','<?php echo $key['keycontent']; ?>','<?php echo $key["keySubdes"]; ?>');" class="btn pull-right btn-primary my-edit">编辑</a>
                                    </li>
                                   <?php }?>
                                   
                                </ul>
                               
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-sm-6">
                        <h2>分组管理</h2>
                        <div id="wrapper1">
                            <div id="scroller">
                                <ul>
                                    <?php foreach ($groupList as $group) { ?>
                                        <li id="id<?php echo $group['group_id']; ?>"><?php echo $group['name']; ?> <a class="btn btn-primary pull-right my-edit" onclick="editGroup('<?php echo $group['group_id']; ?>','<?php echo $group['name']; ?>')">编辑</a></li>

                                    <?php }?>
                                    
                                </ul>
                               
                            </div>
                        </div>
                    </div>
                     

<div id="jiamikey" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">输入加密密码</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>加密密码用于创建密码和查看密码，你输入的密码被对称加密。这个KEY只存储到浏览器关闭。</p>
        <label>KEY</label>
        <input type="text" id="jiamikeycontent" />
        <span class="message"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" onclick="sessionKey();">确定</button>
      </div>
    </div>
  </div>
</div>

<div id="addkey" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">添加密码</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <label>密码分组</label>
            <select id="groupid">
                <?php foreach ($groupList as $group) { ?>
                <option value="<?php echo $group['group_id']; ?>"><?php echo $group['name']; ?></option>
                <?php }?>
            </select>
        </div>
        <div class="row">
            <label>密码标签</label>
            <input type="text" id="keylabel" />
        </div>
        <div class="row">
            <label>密码内容</label>
            <input type="text" id="keycontent" />
        </div>
        <div class="row">
            <label>密码描述</label>
            <textarea id="description"></textarea>
        </div>
        <div class="row">
            <span class="message"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" onclick="addKey();">添加密码</button>
      </div>
    </div>
  </div>
</div>

<div id="editkey" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">编辑密码</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <label>密码分组</label>
            <select id="editkey_groupid">
                <?php foreach ($groupList as $group) { ?>
                <option value="<?php echo $group['group_id']; ?>"><?php echo $group['name']; ?></option>
                <?php }?>
            </select>
        </div>
        <div class="row">
            <input type="hidden" id="editkeyid" />
            <label>密码标签</label>
            <input type="text" id="editkeylabel" />
        </div>
        <div class="row">
            <label>密码内容</label>
            <input type="text" id="editkeycontent" />
        </div>
        <div class="row">
            <label>密码描述</label>
            <textarea id="editdescription"></textarea>
        </div>
        <div class="row">
            <span class="editmessage"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-danger" onclick="deletekey();">删除</button>
        <button type="button" class="btn btn-primary" onclick="updateKey();">更新</button>
      </div>
    </div>
  </div>
</div>

<div id="addgroup" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">添加分组</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <label>分组名称</label>
            <input type="text" id="groupName" />
        </div>
        <div class="row">
            <span id="message"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" onclick="addGroup();">添加分组</button>
      </div>
    </div>
  </div>
</div>

<div id="editgroup" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">编辑分组</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <label>分组名称</label>
            <input type="text" id="editgroupName" />
            <input type="hidden" id="editgroupid"/>
        </div>
        <div class="row">
            <span id="editmessage"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-danger" onclick="deleteGroup();">删除</button>
        <button type="button" class="btn btn-primary" onclick="updateGroup();">更新</button>
      </div>
    </div>
  </div>
</div>
                
                    <!--/span-->
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="well">
                            <p><a href="#addkey" class="btn btn-primary" data-toggle="modal">创建密码</a> <a href="#addgroup" class="btn btn-primary" data-toggle="modal">创建分组</a></p>
                        </div>
                    </div>
                </div>
               
            </div>
            <!--/span-->
        </div>
        <!--/row-->

        <footer>
        </footer>

    </div>
<script type="text/javascript">
    var myScroll;
    var myScroll1;   
    $(document).ready(function() {
        //checkkey();
        myScroll = new IScroll('#wrapper', { mouseWheel: true, click: true });
        myScroll1 = new IScroll('#wrapper1', { mouseWheel: true, click: true });
        document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
    });

    function editkey(keyid,groupid,keylabel,keycontent,description){
        $("#editkey").modal('toggle');
        $("#editkeyid").val(keyid);
        $("#editkey_groupid").val(groupid);
        $("#editkeylabel").val(keylabel);
        $("#editkeycontent").val(keycontent);
        $("#editdescription").val(description);
    }

    function updateKey(){
        var keyid = $("#editkeyid").val();
        var groupid = $('#editkey_groupid').val();
        var keylabel = $('#editkeylabel').val();
        var keycontent = $('#editkeycontent').val();
        //var keycontent_ = Encrypt(keycontent);
        var description = $('#editdescription').val();
        var message = $('.editmessage');

        $.post('<?php echo $editkeyLink ?>',
        {
            keyid: keyid,
            groupid: groupid,
            keylabel: keylabel,
            keycontent: keycontent,
            description: description
        } ,
        function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            var data = JSON.parse(data);
            if (data[0].message=="ok") {
                $('.editmessage').text('更新成功');
                location.reload();
            }else{
                $('.editmessage').text('未知错误');
            };
        });
    }

    function editGroup(groupid,groupname){
        $('#editgroup').modal('toggle');
        $('#editgroupName').val(groupname);
        $('#editgroupid').val(groupid);
    }


    function deletekey(){
        var keyid = $("#editkeyid").val();
        var message = $('.editmessage');

        $.post('<?php echo $deletekeyLink ?>',
        {
            keyid: keyid
        } ,
        function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            console.log(data);
            var data = JSON.parse(data);
            if (data[0].message=="ok") {
                $('.editmessage').text('更新成功');
                location.reload();
            }else{
                $('.editmessage').text('未知错误');
            };
        });
    }

    function updateGroup(){
        var groupname = $('#editgroupName').val();
        var groupid = $('#editgroupid').val();
        $.post('<?php echo $editgroupLink ?>',
        {
            groupid: groupid,
            groupname:groupname
        } ,
        function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            if (data==1) {
                $('#editmessage').text('更新成功');
                location.reload();
            }else if (data==3) {
                $('#editmessage').text('未知错误');
            };
        });
    }

    function deleteGroup(){
        var groupid = $('#editgroupid').val();
        $.post('<?php echo $deletegroupLink ?>',
        {
            groupid: groupid
        } , function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            if (data==1) {
                $('#id'+groupid+'').remove();
                myScroll1.refresh();
                $('#editgroup').modal('toggle');
            }else if (data==0) {
                $('#editmessage').text('操作失败');
            };
        });
    }

    function addGroup(){
        var groupName = $('#groupName').val();
        var message = $('#message');
        $.post('<?php echo $addgroupLink ?>', 
            {
                groupname: groupName
            },
             function(data, textStatus, xhr) {
            /*optional stuff to do after success */

            if (data==1) {
                message.text('操作成功');
                location.reload();
            }else if(data ==0){
                message.text('操作失败');
            }else if (data==3) {
                message.text('限制：只允许创建3个分组');
            };
        });
    }

    function addKey(){
        var groupid = $('#groupid').val();
        var keylabel = $('#keylabel').val();
        var keycontent = $('#keycontent').val();
        //var keycontent_ = Encrypt(keycontent);
        var description = $('#description').val();
        var message = $('.message');
        $.post('<?php echo $addkeyLink ?>', 
            {
                groupid: groupid,
                keylabel: keylabel,
                keycontent: keycontent,
                description: description
            },
             function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            var data = JSON.parse(data);

            if (data[0].message=="ok") {
                message.text('操作成功');
                location.reload();
            }else if(data[0].message=="ng"){
                message.text('操作失败');
            }else if (data[0].message=="limited") {
                message.text('限制：只允许创建3个分组');
            };
        });
    }


    function Encrypt(word){
        var key = CryptoJS.enc.Utf8.parse(sessionStorage.getItem("key")); 
        var iv = CryptoJS.enc.Utf8.parse('0.0.0.0'); 
        srcs = CryptoJS.enc.Utf8.parse(word);
        var encrypted = CryptoJS.AES.encrypt(srcs, key, { iv: iv,mode:CryptoJS.mode.CBC,padding: CryptoJS.pad.Pkcs7});
        return encrypted.ciphertext.toString().toUpperCase();
    }
    function Decrypt(word){ 
        var key = CryptoJS.enc.Utf8.parse(sessionStorage.getItem("key")); 
        var iv = CryptoJS.enc.Utf8.parse('0.0.0.0'); 
        var encryptedHexStr = CryptoJS.enc.Hex.parse(word);
        var srcs = CryptoJS.enc.Base64.stringify(encryptedHexStr);
        var decrypt = CryptoJS.AES.decrypt(srcs, key, { iv: iv,mode:CryptoJS.mode.CBC,padding: CryptoJS.pad.Pkcs7});
        var decryptedStr = decrypt.toString(CryptoJS.enc.Utf8); 
        return decryptedStr.toString();
    }


    function checkkey(){
        if(!sessionStorage.getItem("key")){
            $("#jiamikey").modal("toggle");
        }
    }

    function sessionKey(){
        var key = $("#jiamikeycontent").val();
        sessionStorage.setItem("key",key);
        $("#jiamikey").modal("toggle");
    }
</script>
    <?php echo $footer ?>
