<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>无标题文档</title>
<link href="__PUBLIC__/Admin/images/Admin_css.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="__PUBLIC__/Admin/images/myfav.ico" type="image/x-icon" />
<script type="text/javascript" src="/Public/Admin/js/admin.js"></script> 
</head>
<body>
<table width="95%" border="0" cellspacing="2" cellpadding="3"  align="center" class="admintable" style="margin-bottom:5px;">
    <tr>
      <td align='left' height="25" bgcolor="f7f7f7">快速查找：
        <SELECT onChange="javascript:window.open(this.options[this.selectedIndex].value,'main')"  size="1" name="s">
        <OPTION value="" selected>-=请选择=-</OPTION>
        <OPTION value="<?php echo U('Ad/index');?>&title=<?php echo urlencode('所有的广告');?>">所有的广告</OPTION>
		<OPTION value="<?php echo U('Ad/index?status=1');?>&title=<?php echo urlencode('启用的广告');?>">启用的广告</OPTION>
		<OPTION value="<?php echo U('Ad/index?status=0');?>&title=<?php echo urlencode('隐藏的广告');?>">隐藏的广告</OPTION>
      </SELECT></td>
      <td align="right" bgcolor="f7f7f7">跳转到：
        <select name="ClassID" id="ClassID" onChange="javascript:window.open(this.options[this.selectedIndex].value,'main')">
    <option value="">请选择分类</option>
		<OPTION value="<?php echo U('Ad/index');?>&title=<?php echo urlencode('所有的广告');?>">所有的广告</OPTION>
		<?php if(is_array($grouplist)): $i = 0; $__LIST__ = $grouplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><OPTION value="<?php echo U('Ad/index?gid='); echo ($vo["gid"]); ?>&title=<?php echo (urlencode($vo["name"])); ?>"><?php echo ($vo["name"]); ?></OPTION><?php endforeach; endif; else: echo "" ;endif; ?>
       </select></td>
    </tr>
</table>
<table border="0" cellspacing="2" cellpadding="3"  align="center" class="admintable">
<tr><td class="admintitle"><span style="float:right;"><a href="<?php echo U('Ad/groupadd');?>">[添加分类]</a></span>广告分类</td>
  </tr>
<tr align="center" bgcolor="#FFFFFF"> 
	<td align="left"><br/>
	  <?php if(is_array($grouplist)): $i = 0; $__LIST__ = $grouplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>&nbsp;&nbsp;<a href="<?php echo U('Ad/groupedit?id='); echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a>[<a href="<?php echo U('Ad/dogroupdel?id='); echo ($vo["id"]); ?>">删除</a>]<?php endforeach; endif; else: echo "" ;endif; ?><br/><br/>
	 </td>
  </tr>
</table>
<form name="myform" method="POST" action="<?php echo U('Ad/delall');?>">
<table border="0"  align="center" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF" class="admintable">
<tr> 
  <td colspan="8" align="left" class="admintitle"><span style="float:right;">[<a href="<?php echo U('Ad/add');?>">添加广告</a>]</span><a href="<?php echo U('Ad/index');?>">广告列表</a><?php if(isset($title)): ?>&nbsp;->&nbsp;<?php echo ($title); endif; ?></td>
</tr>
  <tr align="center"> 
    <td width="5%" class="ButtonList"></td>
    <td width="5%" class="ButtonList">ID号</td>
    <td width="20%" class="ButtonList">广告标题</td>
    <td width="20%" class="ButtonList">最后修改时间</td>
    <td width="10%" class="ButtonList">分类</td>
    <td width="20%" class="ButtonList">标签调用</td>
    <td width="20%" class="ButtonList">操 作</td>
  </tr>
 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr bgcolor="#f1f3f5" onMouseOver="this.style.backgroundColor='#EAFCD5';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
    <td height="25" align="center"><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id[]" onClick="unselectall(this.form)" style="border:0;"></td>
    <td class="tdleft"><?php echo ($vo["id"]); ?></td>
    <td height="25" align="center"><a href="<?php echo U('Ad/edit?id='); echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td>
    <td height="25" align="center"><?php echo (date('Y-m-d H:i:s',$vo["pubdate"])); ?></td>
    <td height="25" align="center"><a href="<?php echo U('Ad/index?gid='); echo ($vo["gid"]); ?>&title=<?php echo urlencode($vo['groupname']);?>"><?php echo ($vo["groupname"]); ?></a></td>
	<td height="25" align="center"><a href="<?php echo U('Ad/js?id='); echo ($vo["id"]); ?>">调用代码</a></td>
   <td align="center"><a href="<?php echo U('Ad/status?id='); echo ($vo["id"]); ?>"><?php if(($vo["status"]) == "1"): ?><font color='green'>启用<?php else: ?><font color='red'>隐藏<?php endif; ?></font></a>|<a href="<?php echo U('Ad/edit?id='); echo ($vo["id"]); ?>">编辑</a>|<a href="<?php echo U('Ad/del?id='); echo ($vo["id"]); ?>">删除</a></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
<tr>
  <td align="center" bgcolor="#f1f3f5"><input name="Action" type="hidden"  value="Del"><input name="chkAll" type="checkbox" id="chkAll" onClick="CheckAll(this.form)" value="checkbox" style="border:0"></td>
  <td align="center" class="b1_1" colspan="6"><input name="Del" type="submit" class="bnt" id="Del" value="隐藏">
    <input name="Del" type="submit" class="bnt" id="Del" value="显示"></td>
  </tr>
<tr>
  <td colspan="7" align="center" class="b1_1"><div id="page">
	<ul style="text-align:left;">
<?php echo ($page); ?>
    </ul>
</div></td>
</tr>
</table>
</form>
<div style="text-align:center;margin:10px;">
<hr>
<a href="http://<?php echo C('SOFT_HOMEPAGE');?>" target="_blank"><?php echo C('SOFT_NAME');?></a> Version <font color="red"><?php echo C('SOFT_VERSION');?></font> &copy; <?php echo date("Y");;?> <?php echo tongji();?>版权所有 
</div>
</body>
</html>