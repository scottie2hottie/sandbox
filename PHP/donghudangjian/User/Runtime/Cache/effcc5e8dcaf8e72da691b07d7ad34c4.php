<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><meta charset="utf-8"><title><?php echo ($GLOBALS['cfg_webname']); ?>-用户登录</title><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="description" content="会员中心"><meta name="author" content="歪酷CMS"><link href="__PUBLIC__/User/css/bootstrap.min.css" rel="stylesheet"><style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style><link href="__PUBLIC__/User/css/bootstrap-responsive.min.css" rel="stylesheet"/></head><body><div class="navbar navbar-inverse navbar-fixed-top"><div class="navbar-inner"><div class="container-fluid"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a class="brand" href="<?php echo U('Index/index');?>"><?php echo ($GLOBALS['cfg_webname']); ?></a><div class="nav-collapse collapse"><p class="navbar-text pull-right"><?php if(USER_LOGINED == true): ?><a href="<?php echo U('Index/myfile');?>" class="navbar-link">欢迎您,<?php echo cookie('uname');?></a><a href="<?php echo U('Public/loginout');?>" class="navbar-link">退出?</a><?php else: ?><a href="<?php echo U('Public/login');?>" class="navbar-link">请先登录</a><a href="<?php echo U('Public/reg');?>" class="navbar-link">注册</a><?php endif; ?></p></div><!--/.nav-collapse --></div></div></div><div class="container-fluid"><div class="row-fluid"><div class="span3"><div class="well sidebar-nav"><ul class="nav nav-list"><li class="nav-header">站内导航</li><li><a href="__ROOT__/index.php"><i class="icon-home"></i>网站首页</a></li><li><a href="<?php echo U('Index/index');?>"><i class="icon-calendar"></i>资讯导航</a></li><?php if(USER_LOGINED==false): ?><li><a href="<?php echo U('Public/reg');?>"><i class="icon-user"></i>会员注册</a></li><li><a href="<?php echo U('Public/login');?>"><i class="icon-user"></i>会员登陆</a></li><?php else: ?><li><a href="<?php echo U('Public/loginout');?>"><i class="icon-user"></i>退出系统</a></li><li class="nav-header">基本资料</li><li><a href="<?php echo U('Index/myfile');?>"><i class="icon-list-alt"></i>我的资料</a></li><li><a href="<?php echo U('Index/msg');?>"><i class="icon-envelope"></i>站内短信</a></li><li class="nav-header">功能模块</li><li><a href="<?php echo U('Archive/type');?>"><i class="icon-edit"></i>发布文档</a></li><li><a href="<?php echo U('Archive/index?status=0');?>"><i class="icon-file"></i>已审文档</a></li><li><a href="<?php echo U('Archive/index?status=1');?>"><i class="icon-file"></i>未审文档</a></li><?php endif; ?></ul></div><!--/.well --></div><!--/span--><div class="span9"><div class="navbar"><div class="navbar-inner"><a class="brand">会员登陆</a></div></div></div><div class="span9" style='border:1px solid #ccc;margin-bottom:10px;'><div style="padding:20px"><form class="form-horizontal" action="<?php echo U('Public/dologin');?>" method="post" onsubmit="return CheckForm()" ><div class="control-group"><label class="control-label">用户名</label><div class="controls"><input type="text" name="username" id="username" placeholder="输入用户名..."/></div></div><div class="control-group"><label class="control-label" >密码</label><div class="controls"><input type="password" name="password" id="password" placeholder="输入密码..."/></div></div><?php if(C('SOFT_VERIFY') <>1):?><div class="control-group"><label class="control-label">验证码</label><div class="controls"><input class="input-mini" type="text" name="verify" id="verify" style="text-transform:uppercase;"/><img src="<?php echo U('Public/verify');?>" alt="看不清楚请点击刷新验证码" style="cursor : pointer;border:1px solid #ccc;margin-left:2px;" onclick="show(this)"/></div></div><?php endif; ?><div class="control-group"><div class="controls"><button type="submit" class="btn btn-primary btn-large">登录</button><button type="reset" class="btn btn-inverse btn-large">重置</button></div></div><?php if(!empty($_GET['fromurl'])): ?><input type='hidden' name='fromurl' value="<?php echo ($_GET['fromurl']); ?>"/><?php endif; ?></form></div></div><!--/span--></div><!--/row--><hr/><footer><p class="pull-right"><a href="#top">返回顶部</a></p><p><?php echo ($GLOBALS["cfg_powerby"]); ?></p></footer></div><script>
function show(obj){
obj.src="<?php echo U('Public/verify?random=1');?>"+ Math.random();
}
	function CheckForm()
	{ 
		if(EmptyCheckForm('username','用户名不能为空!','')) return false;
		if(EmptyCheckForm('password','密码不能为空!',''))return false;
		if(EmptyCheckForm('verify','验证码不能为空!',''))return false;
	}
	function EmptyCheckForm(id,value,set)
	{
		if($('#'+id).val()==set)
		{
			$.dialog({icon:'warning',content:value,ok:function(){ $('#' + id).focus();}});return true;
		}
		return false;
	}
</script><script charset="utf-8" src="__PUBLIC__/Common/Jquery/Jquery.js"></script><script charset="utf-8" src="__PUBLIC__/Common/artDialog/jquery.artDialog.js?skin=twitter"></script><script charset="utf-8" src="__PUBLIC__/Common/artDialog/extend.js"></script></body></html>