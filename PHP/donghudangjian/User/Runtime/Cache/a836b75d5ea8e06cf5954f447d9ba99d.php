<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><meta charset="utf-8"><title><?php echo ($GLOBALS['cfg_webname']); ?>-站内短消息</title><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="description" content="会员中心"><meta name="author" content="歪酷CMS"><link href="__PUBLIC__/User/css/bootstrap.min.css" rel="stylesheet"><style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style><link href="__PUBLIC__/User/css/bootstrap-responsive.min.css" rel="stylesheet"/><link href="__PUBLIC__/Editor/kindeditor/themes/default/default.css" type="text/css" rel="stylesheet"></head><body><div class="navbar navbar-inverse navbar-fixed-top"><div class="navbar-inner"><div class="container-fluid"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a class="brand" href="<?php echo U('Index/index');?>"><?php echo ($GLOBALS['cfg_webname']); ?></a><div class="nav-collapse collapse"><p class="navbar-text pull-right"><?php if(USER_LOGINED == true): ?><a href="<?php echo U('Index/myfile');?>" class="navbar-link">欢迎您,<?php echo cookie('uname');?></a><a href="<?php echo U('Public/loginout');?>" class="navbar-link">退出?</a><?php else: ?><a href="<?php echo U('Public/login');?>" class="navbar-link">请先登录</a><a href="<?php echo U('Public/reg');?>" class="navbar-link">注册</a><?php endif; ?></p></div><!--/.nav-collapse --></div></div></div><div class="container-fluid"><div class="row-fluid"><div class="span3"><div class="well sidebar-nav"><ul class="nav nav-list"><li class="nav-header">站内导航</li><li><a href="__ROOT__/index.php"><i class="icon-home"></i>网站首页</a></li><li><a href="<?php echo U('Index/index');?>"><i class="icon-calendar"></i>资讯导航</a></li><?php if(USER_LOGINED==false): ?><li><a href="<?php echo U('Public/reg');?>"><i class="icon-user"></i>会员注册</a></li><li><a href="<?php echo U('Public/login');?>"><i class="icon-user"></i>会员登陆</a></li><?php else: ?><li><a href="<?php echo U('Public/loginout');?>"><i class="icon-user"></i>退出系统</a></li><li class="nav-header">基本资料</li><li><a href="<?php echo U('Index/myfile');?>"><i class="icon-list-alt"></i>我的资料</a></li><li><a href="<?php echo U('Index/msg');?>"><i class="icon-envelope"></i>站内短信</a></li><li class="nav-header">功能模块</li><li><a href="<?php echo U('Archive/type');?>"><i class="icon-edit"></i>发布文档</a></li><li><a href="<?php echo U('Archive/index?status=0');?>"><i class="icon-file"></i>已审文档</a></li><li><a href="<?php echo U('Archive/index?status=1');?>"><i class="icon-file"></i>未审文档</a></li><?php endif; ?></ul></div><!--/.well --></div><!--/span--><div class="span9"><div class="navbar"><div class="navbar-inner"><a class="brand">短消息</a><ul class="nav"><li class="active"><a href="<?php echo U('Index/msg');?>">收件箱</a></li><li><a href="<?php echo U('Index/msg_put');?>">发件箱</a></li><li><a href="<?php echo U('Index/msg_send');?>">发送短消息</a></li></ul></div></div></div><div class="span9"><form name="myform" id="myform" action="<?php echo U('Index/delall?method=get');?>" onsubmit="return checkselectId()" method="post"><table class="table table-striped table-bordered"><thead><tr><th width='8%'>批处理</th><th width='60%'>标题</th><th width='8%'>状态</th><th width='14%'>时间</th><th width='10%'>操作</th></tr></thead><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><input type="checkbox" name='id[]' value="<?php echo ($vo["id"]); ?>" class='ids' /></td><td><a href="<?php echo U('Index/msg_read?id='); echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td><td><?php if(($vo["tostatus"]) == "0"): ?><p class="muted">已读</p><?php endif; if(($vo["tostatus"]) == "1"): ?><p class="text-info" ><strong>未读</strong></p><?php endif; ?></td><td><?php echo (date("Y-m-d H:i:s",$vo["pubdate"])); ?></td><td><a onclick="onajax('<?php echo ($vo["id"]); ?>')" href="javascript:;">删除</a></td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td colspan='5'><input name="chkAll" type="checkbox" id="chkAll" onClick="CheckAll(this.form)" value="checkbox">全选
		&nbsp;&nbsp;
		<input name="Del" type="submit" class="btn btn-inverse btn-mini"  id="Del" value="未读" onclick="alertcheck()"><input name="Del" type="submit" class="btn btn-primary btn-mini"  id="Del" value="已读" onclick="alertcheck()"><input name="Del" type="submit" class="btn btn-mini"  id="Del" value="删除" onclick="alertcheck()"></td></tr></table></form><div class="pagination pagination-right"><ul><?php echo ($page); ?></ul></div></div></div><hr/><footer><p class="pull-right"><a href="#top">返回顶部</a></p><p><?php echo ($GLOBALS["cfg_powerby"]); ?></p></footer></div><script charset="utf-8" src="__PUBLIC__/Common/Jquery/Jquery.js"></script><script charset="utf-8" src="__PUBLIC__/Common/artDialog/jquery.artDialog.js?skin=twitter"></script><script charset="utf-8" src="__PUBLIC__/Common/artDialog/extend.js"></script><script>
	function onajax(id)
	{
		$.post("<?php echo U('Index/ajax?method=get');?>", { id: id},
		function(data){
			window.location.reload(true);
		});
	}
	 function unselectall(thisform){
        if(thisform.chkAll.checked){
            thisform.chkAll.checked = thisform.chkAll.checked&0;
        }   
    }
    function CheckAll(thisform){
        for (var i=0;i<thisform.elements.length;i++){
            var e = thisform.elements[i];
            if (e.Name != "chkAll"&&e.disabled!=true)
                e.checked = thisform.chkAll.checked;
        }
    }
	function alertcheck()
	{
		if(checkselectId()==false)
		{
			$.dialog.alert('请勾选ID记录!');
		}
	}
	function checkselectId()
	{
	var ch =  $('.ids');
	var input = '';
	for(var i=0; i<ch.length;i++)
	{
		if(ch[i].checked == true)
		{
			input += ch[i].value+',';
		}       
	}
	if(input=='') return false;
	return input;
   } 
	</script></body></html>