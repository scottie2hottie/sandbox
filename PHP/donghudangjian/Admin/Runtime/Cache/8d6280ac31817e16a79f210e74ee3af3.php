<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>跳转提示</title>
<meta http-equiv='Refresh' content='<?php echo ($waitSecond); ?>;URL=<?php echo ($jumpUrl); ?>'>
<link href="__PUBLIC__/Admin/images/Admin_css.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="__PUBLIC__/Admin/images/myfav.ico" type="image/x-icon" />
</head>
<body>
<center>
<br><br><br><br>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="admintable1" style="width:500px;">
  <tr>
    <td class="admintitle">操作信息</td>
  </tr>
  <?php if(isset($error)): ?><tr>
    <td height="100" align="center"><font style='color:red;font-size:14px;'><?php echo ($error); ?></font></td>
  </tr><?php endif; ?>
	  <tr>
    <td height="100" style="padding-left:100px;">系统将在 <span style="color:blue;font-weight:bold" id='wait'><?php echo ($waitSecond); ?></span> 秒后自动关闭，如果不想等待,直接点击 <a id='href' href="<?php echo ($jumpUrl); ?>">这里</a> 关闭</td>
  </tr>
</table>
<br/><br/><br/><br/>
</center>
<hr>
<a href="http://<?php echo C('SOFT_HOMEPAGE');?>" target="_blank"><?php echo C('SOFT_NAME');?></a> Version <font color="red"><?php echo C('SOFT_VERSION');?></font> &copy; <?php echo date("Y");;?> <?php echo tongji();?>版权所有 
</body>
</html>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>