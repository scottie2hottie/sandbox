<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="__PUBLIC__/Admin/images/Admin_css.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="__PUBLIC__/Admin/images/myfav.ico" type="image/x-icon" />
<script type="text/javascript" src="/Public/Admin/js/admin.js"></script><script type="text/javascript" src="/Public/Admin/js/Ajax.js"></script><script type="text/javascript" src="/Public/Admin/js/Jquery.js"></script> 
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/jquery.artDialog.js?skin=green"></script>
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/extend.js"></script>
<title>网站会员管理</title>
<script>
function CheckForm()
	{ 
		if(EmptyCheckForm('rankname','等级名称不能为空!','')) return false;
		if(EmptyCheckForm('rankmoney','等级积分不能为空!',''))return false;
		if(EmptyCheckForm('rankimg','等级图片不能为空!',''))return false;
	}
	function EmptyCheckForm(id,value,set)
	{
		if($('#'+id).val()==set)
		{
			$.dialog({icon:'warning',content:value,ok:function(){ $('#' + id).focus();}});return true;
		}
		return false;
	}
</script>
</head>
<body>
<form method="POST" action="<?php echo U('Member/doaddrank');?>" onsubmit="return CheckForm()">
<table width="95%" border="0"  align="center" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF" class="admintable">
<tr> 
<td colspan="2" class="admintitle">添加新的用户等级</td>
</tr>
<tr style="text-align:left">
<td width="37%" class="forumrow"><B>等级名称</B></td>
<td width="63%" class="forumrow"><input size="30" name="rankname" id="rankname" type="text"></td>
</tr>
<tr style="text-align:left">
<td width="37%" class="forumrow"><B>最少积分</B><BR></td>
<td width="63%" class="forumrow"><input size="30" name="rankmoney" id="rankmoney" type="text"></td>
</tr>
<tr style="text-align:left">
<td width="37%" class="forumrow"><B>所属会员组</B><BR> 荣誉会员组和管理员组不参与积分累积!</td>
<td width="63%" class="forumrow">
<select name="groupid">
<option value="1">普通会员组</option>
<option value="2">荣誉会员组</option>
<option value="3">管理员组</option>
</select>
</td>
</tr>
<tr style="text-align:left">
<td width="37%" class="forumrow"><B>等级图片</B></td>
<td width="63%" class="forumrow"><input name="rankimg" type="text" id="rankimg" value="level1.gif" size="30">&nbsp;</td>
</tr>
<tr> 
<td colspan="2" class="forumrow"> 
  <input name="Submit" type="submit" class="bnt" value="提 交"/> <input type="button" class="bnt" value="返 回" onclick="history.go(-1)"/> </td>
</tr>
</table>
</form>
 
</body>
</html>