<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="__PUBLIC__/Admin/images/Admin_css.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="__PUBLIC__/Admin/images/myfav.ico" type="image/x-icon" />
<script type="text/javascript" src="/Public/Admin/js/admin.js"></script><script type="text/javascript" src="/Public/Admin/js/Ajax.js"></script><script type="text/javascript" src="/Public/Admin/js/Jquery.js"></script> 
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/jquery.artDialog.js?skin=green"></script>
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/extend.js"></script>
<script>
function jconfirm(str,url)
{
   $.dialog.confirm(str,function (){window.location.href=url;});
}
</script>
<title>网站会员管理</title>
</head>
 
<body>
<table width="95%" border="0" cellspacing="2" cellpadding="3"  align="center" class="admintable" style="margin-bottom:5px;">
    <tr>
      <td align="left" height="25" bgcolor="f7f7f7">快速查找：
        <SELECT onChange="javascript:window.open(this.options[this.selectedIndex].value,'main')"  size="1" name="s">
        <OPTION value="" selected>-=请选择=-</OPTION>
        <OPTION value="<?php echo U('Member/index');?>&title=所有用户">所有用户</OPTION>
        <OPTION value="<?php echo U('Member/index?status=0');?>&title=已审的用户">已审的用户</OPTION>
        <OPTION value="<?php echo U('Member/index?status=1');?>&title=未审的用户">未审的用户</OPTION>
        <OPTION value="<?php echo U('Member/index?logintime=24');?>&title=24小时登录用户">24小时登录用户</OPTION>
        <OPTION value="<?php echo U('Member/index?regtime=24');?>&title=24小时注册用户">24小时注册用户</OPTION>
      </SELECT>      </td>
      <td  align="right"  bgcolor="f7f7f7"><form name="form1" method="post" action="<?php echo U('Member/index');?>">
        <input name="username" type="text" id="username" value="<?php echo ($_POST['username']); ?>" class="s26">
        <input type="submit" class="bnt" value="搜索"></td>
      </form>
    </tr>
</table>
 
<table border="0" cellspacing="2" cellpadding="3"  align="center" class="admintable">
<tr> 
  <td colspan="7" align="left" class="admintitle"><span style="float:right">[<a href="<?php echo U('Member/add');?>">添加</a>]</span>用户列表<?php if(!empty($_GET['title'])): ?>-> <?php echo ($_GET['title']); endif; ?></td>
</tr>
  <tr align="center"> 
    <td width="10%" class="ButtonList">ID</td>
    <td width="15%" class="ButtonList">用户名</td>
    <td width="10%" class="ButtonList">积分</td>
    <td width="12%" class="ButtonList">等级</td>
    <td width="14%" class="ButtonList">注册时间</td>
    <td width="13%" class="ButtonList">登陆ＩＰ</td>
    <td width="14%" class="ButtonList">操 作</td>
  </tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr bgcolor="#f1f3f5" onMouseOver="this.style.backgroundColor='#EAFCD5';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
    <td height="25" class="tdleft"><?php echo ($vo["id"]); ?></td>
    <td height="25" class="tdleft"><?php echo ($vo["username"]); ?></td>
    <td height="25" align="center" class="tdleft"><?php echo ($vo["money"]); ?></td>
    <td height="25" align="center" class="tdleft"><?php echo ($vo["rankname"]); ?></td>
    <td align="center"><?php echo (date('Y-m-d H:i:s',$vo["regtime"])); ?></td>
    <td align="center"><?php echo ($vo["loginip"]); ?></td>
    <td width="11%" align="center">
		<a href='<?php echo U('Member/status?id='); echo ($vo["id"]); ?>'><?php if(($vo["status"]) == "0"): ?><font color="green">已审</font><?php else: ?><font color="red">未审</font><?php endif; ?></a>|<a href="<?php echo U('Member/edit?id='); echo ($vo["id"]); ?>">编辑</a>|<a href="javascript:;" onClick="JavaScript:return jconfirm('确认删除吗?','<?php echo U('Member/del?id='); echo ($vo["id"]); ?>')">删除</a>
		</td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
   
 
<tr>
<td colspan="7" bgcolor="f7f7f7">
<div id="page">
	<ul>
<?php echo ($page); ?>
    </ul>
</div>
</td>
</tr>
</table>
 
<table border="0" cellspacing="2" cellpadding="3"  align="center" class="admintable">
  <tr>
    <td colspan="2" class="admintitle" >清理操作</td>
  </tr>
  <tr style="text-align:left;">
    <td height="50">
        <input type="button" id="button" value="用户积分归零"  onClick="JavaScript:return jconfirm('请慎重操作：此操作将导致所有用户积分归零并不可恢复!','<?php echo U('Member/clearmoney');?>')"/>&nbsp;&nbsp;
        <input type="button" id="button" value="清理已删除短消息"  onClick="JavaScript:return jconfirm('请慎重操作：此操作将清理所有用户已执行删除的短消息!','<?php echo U('Member/clearmsg');?>')"/>&nbsp;&nbsp;
		<input type="button" id="button" value="完全清理所有短消息"  onClick="JavaScript:return jconfirm('请慎重操作：此操作将清理所有用户的短消息!','<?php echo U('Member/clearmsg?method=all');?>')"/>&nbsp;&nbsp;
    </td>
  </tr>
</table>
<table border="0" cellspacing="2" cellpadding="3"  align="center" class="admintable">
  <tr>
    <td colspan="2" align="left" class="admintitle">更新用户等级</td>
  </tr>
  <tr style="text-align:left;">
    <td height="50">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <FORM METHOD="POST" ACTION="<?php echo U('Member/doupdaterank');?>">
<tr>
<td width="20%" height="30" class="forumrow">更新用户等级</td>
<td width="80%" class="forumrow">执行本操作将按照当前数据库用户积分和等级设置重新计算用户等级。</td>
</tr>
<tr>
<td width="20%" height="30" class="forumrow">开始用户ID</td>
<td width="80%" class="forumrow"><input type="text" name="beginID" value="1" size=10>&nbsp;用户ID，可以填写您想从哪一个ID号开始进行修复</td>
</tr>
<tr>
<td width="20%" height="30" class="forumrow">结束用户ID</td>
<td width="80%" class="forumrow"><input type="text" name="endID" value="100" size=10>&nbsp;将更新开始到结束ID之间的用户数据，之间的数值最好不要选择过大</td>
</tr>
<tr>
<td width="20%" class="forumrow"></td>
<td width="80%" class="forumrow"><input name="Submit" type="submit" class="bnt" value="更新等级"></td>
</tr>
</form>
    </table></td>
  </tr>
</table>
<div style="text-align:center;margin:10px;">
<hr>
<a href="http://<?php echo C('SOFT_HOMEPAGE');?>" target="_blank"><?php echo C('SOFT_NAME');?></a> Version <font color="red"><?php echo C('SOFT_VERSION');?></font> &copy; <?php echo date("Y");;?> <?php echo tongji();?>版权所有 
</div>
</body>
</html>