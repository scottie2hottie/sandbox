<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="__PUBLIC__/Admin/images/Admin_css.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="__PUBLIC__/Admin/images/myfav.ico" type="image/x-icon" />
<script type="text/javascript" src="/Public/Admin/js/admin.js"></script> 
<title>网站会员管理</title>
</head>
<body>
 
<table width="95%" border="0" cellspacing="2" cellpadding="3"  align="center" class="admintable" style="margin-bottom:5px;">
    <tr>
      <td align="left" height="25" bgcolor="f7f7f7">快速查找：
        <SELECT onChange="javascript:window.open(this.options[this.selectedIndex].value,'main')"  size="1" name="s">
        <OPTION value="" selected>-=请选择=-</OPTION>
        <OPTION value="<?php echo U('Member/rank');?>&title=<?php echo urlencode('所有用户等级');?>">所有用户等级</OPTION>
        <OPTION value="<?php echo U('Member/rank?groupid=2');?>&title=<?php echo urlencode('荣誉会员组');?>">会员组</OPTION>
        <OPTION value="<?php echo U('Member/rank?groupid=3');?>&title=<?php echo urlencode('管理员组');?>">管理员组</OPTION>
      </SELECT>      </td>
      <td align="right" bgcolor="f7f7f7">
	  <form name="form1" method="POST" action="<?php echo U('Member/rank');?>&title=<?php echo urlencode('搜索的结果');?>">
        <input name="rankname" type="text"  value="<?php echo ($_POST['rankname']); ?>" class="s26">
        <input type="submit" class="bnt" value="搜索">
      </form></td>
    </tr>
</table>
<form method="POST" action="<?php echo U('Member/dorank');?>">
<table width="95%" border="0"  align="center" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF" class="admintable">
<tr> 
<td colspan="6" class="admintitle" ><span style="float:right">[<a href="<?php echo U('Member/addrank');?>">添加</a>]</span>用户等级设定<?php if(!empty($_GET['title'])): ?>-> <?php echo (urldecode($_GET['title'])); endif; ?></td>
</tr>
<tr> 
<td width="8%" height="30" align="center" bgcolor="#f7f7f7" class="ButtonList"><B>等级ID</B></td>
<td width="20%" height="30" align="center" bgcolor="#f7f7f7" class="ButtonList"><B>等级名称</B></td>
<td width="12%" bgcolor="#f7f7f7" class="ButtonList"><B>最少积分</B></td>
<td width="25%" bgcolor="#f7f7f7" class="ButtonList"><B>图片</B></td>
<td width="15%" bgcolor="#f7f7f7" class="ButtonList"><B>所属组</B></td>
<td width="20%" bgcolor="#f7f7f7" class="ButtonList"><B>操作</B></td>
</tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr> 
	<td align="center" bgcolor="#f7f7f7"  class="Forumrow"><?php echo ($vo["id"]); ?><input type="hidden" value="<?php echo ($vo["id"]); ?>" name="id[]"/></td>
	<td align="center" bgcolor="#f7f7f7"  class="Forumrow"><input size="15" value="<?php echo ($vo["rankname"]); ?>" name="rankname[]" type="text"></td>
	<td align="center" bgcolor="#f7f7f7"  class="Forumrow"><input type="text"  value="<?php echo ($vo["rankmoney"]); ?>" name="rankmoney[]" ></td>
	<td bgcolor="#f7f7f7"  class="Forumrow" style="text-align:left;"><input size="15" value="<?php echo ($vo["rankimg"]); ?>" name="rankimg[]" type="text">&nbsp;&nbsp;&nbsp;&nbsp;<img src="__PUBLIC__/User/level/<?php echo ($vo["rankimg"]); ?>"></td>
	<td align="center" bgcolor="#f7f7f7"  class="Forumrow">
	<select name="groupid">
	<option value='2'<?php if(($vo["groupid"]) == "2"): ?>selected='selected'<?php endif; ?>>会员组</option>
	<option value='3'<?php if(($vo["groupid"]) == "3"): ?>selected='selected'<?php endif; ?>>管理员组</option>
	</td>
	<td align="center" bgcolor="#f7f7f7"  class="Forumrow"><a href="<?php echo U('Member/index?rankid='); echo ($vo["id"]); ?>&title=<?php echo ($vo["rankname"]); ?>等级">列出用户</a> </td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
<tr> 
<td colspan="7" align="center" bgcolor="#f7f7f7" class="Forumrow"> 
<input type="submit" class="bnt" value=" 编 辑 "></td>
</tr>
</table>
</form>
</body>
</html>