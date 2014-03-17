<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><meta charset="utf-8"><title><?php echo ($GLOBALS['cfg_webname']); ?>-会员中心首页</title><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="description" content="会员中心"><meta name="author" content="歪酷CMS"><link href="__PUBLIC__/User/css/bootstrap.min.css" rel="stylesheet"><style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
	  .clear{
	  clear:both;
	  }
	  .f-right
	  {
		float:right;
	  }
	  .f-left
	  {
		float:left;
	  }
	  .hr
	  {
		border:1px dashed #ccc;
	  }
	  .readmore
	  {
		float:right;padding-right:5px;
	  }
	  .litpic
	  {
		width:100px;height:100px;border:1px solid #ccc;float:left;margin-right:5px;
	  }
	  .litpic img{width:100px;height:100px;}
    </style><link href="__PUBLIC__/User/css/bootstrap-responsive.min.css" rel="stylesheet"/></head><body><div class="navbar navbar-inverse navbar-fixed-top"><div class="navbar-inner"><div class="container-fluid"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a class="brand" href="<?php echo U('Index/index');?>"><?php echo ($GLOBALS['cfg_webname']); ?></a><div class="nav-collapse collapse"><p class="navbar-text pull-right"><?php if(USER_LOGINED == true): ?><a href="<?php echo U('Index/myfile');?>" class="navbar-link">欢迎您,<?php echo cookie('uname');?></a><a href="<?php echo U('Public/loginout');?>" class="navbar-link">退出?</a><?php else: ?><a href="<?php echo U('Public/login');?>" class="navbar-link">请先登录</a><a href="<?php echo U('Public/reg');?>" class="navbar-link">注册</a><?php endif; ?></p></div><!--/.nav-collapse --></div></div></div><div class="container-fluid"><div class="row-fluid"><div class="span3"><div class="well sidebar-nav"><ul class="nav nav-list"><li class="nav-header">站内导航</li><li><a href="__ROOT__/index.php"><i class="icon-home"></i>网站首页</a></li><li><a href="<?php echo U('Index/index');?>"><i class="icon-calendar"></i>资讯导航</a></li><?php if(USER_LOGINED==false): ?><li><a href="<?php echo U('Public/reg');?>"><i class="icon-user"></i>会员注册</a></li><li><a href="<?php echo U('Public/login');?>"><i class="icon-user"></i>会员登陆</a></li><?php else: ?><li><a href="<?php echo U('Public/loginout');?>"><i class="icon-user"></i>退出系统</a></li><li class="nav-header">基本资料</li><li><a href="<?php echo U('Index/myfile');?>"><i class="icon-list-alt"></i>我的资料</a></li><li><a href="<?php echo U('Index/msg');?>"><i class="icon-envelope"></i>站内短信</a></li><li class="nav-header">功能模块</li><li><a href="<?php echo U('Archive/type');?>"><i class="icon-edit"></i>发布文档</a></li><li><a href="<?php echo U('Archive/index?status=0');?>"><i class="icon-file"></i>已审文档</a></li><li><a href="<?php echo U('Archive/index?status=1');?>"><i class="icon-file"></i>未审文档</a></li><?php endif; ?></ul></div><!--/.well --></div><!--/span--><div class="span9"><div class="navbar"><div class="navbar-inner"><a class="brand">资讯导航</a><ul class="nav"><li id='li1'><a href="<?php echo U('Index/index');?>">最新</a></li><li id='li2'><a href="<?php echo U('Index/index?flag=h');?>">热门</a></li><li id='li3'><a href="<?php echo U('Index/index?flag=c');?>">推荐</a></li><li id='li4'><a href="<?php echo U('Index/index?flag=p');?>">图片</a></li></ul></div></div></div><div class="span9" style='border:1px solid #ccc;margin-bottom:10px;'><div style="padding:20px;"><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h5><?php if(!empty($vo["color"])): ?><font color="<?php echo ($vo["color"]); ?>"><a href="<?php echo (url('view',$vo["id"])); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></font><?php else: ?><a href="<?php echo (url('view',$vo["id"])); ?>" target="_blank"><?php echo ($vo["title"]); ?></a><?php endif; ?></h5><?php if(!empty($vo["litpic"])): ?><span class="litpic"><a href="<?php echo (url('view',$vo["id"])); ?>" target="_blank"><img src="<?php echo ($vo["litpic"]); ?>"/></a></span><?php endif; ?><p <?php if(!empty($vo["litpic"])): ?>style="height:100px;"<?php endif; ?>><?php echo ($vo["description"]); ?></p><p><span class="readmore"><a class="btn btn-primary btn-mini" target='_blank' href="<?php echo (url('view',$vo["id"])); ?>">阅读更多 &raquo;</a></span>投稿人:<?php echo ($vo["username"]); ?> 发布时间:<?php echo (date('Y-m-d H:i:s',$vo["pubdate"])); ?> 阅读:<?php echo ($vo["click"]); ?></p><hr class="hr"/><div class="clear"></div><?php endforeach; endif; else: echo "" ;endif; ?><div class="pagination pagination-right"><ul><?php echo ($page); ?></ul></div></div></div></div><!--/row--><hr/><footer><p class="pull-right"><a href="#top">返回顶部</a></p><p><?php echo ($GLOBALS["cfg_powerby"]); ?></p></footer></div><!--/.fluid-container--><script charset="utf-8" src="__PUBLIC__/Common/Jquery/Jquery.js"></script><script>
	var flag ='<?php echo ($_GET['flag']); ?>';
	if(flag=='') $('#li1').addClass('active');
	if(flag=='h')  $('#li2').addClass('active');
	if(flag=='c')  $('#li3').addClass('active');
	if(flag=='p')  $('#li4').addClass('active');
  </script></body></html>