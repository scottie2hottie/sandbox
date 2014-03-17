<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>网站后台管理</title>
<link href="__PUBLIC__/Admin/images/Admin_css.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="__PUBLIC__/Admin/images/myfav.ico" type="image/x-icon" />
<script type="text/javascript" src="/Public/Admin/js/admin.js"></script><script type="text/javascript" src="/Public/Admin/js/Jquery.js"></script>
<script charset="utf-8" src="__PUBLIC__/Editor/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="__PUBLIC__/Editor/kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/jquery.artDialog.js?skin=green"></script>
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/extend.js"></script>
<link href="__PUBLIC__/Editor/kindeditor/themes/default/default.css" type="text/css" rel="stylesheet">
<script>
	KindEditor.ready(function(K) { 
	var editor = K.editor({ allowFileManager : true,removeSize:true,removeAlign:true,removeTitle:true}); 
	K('#50e5974b00984').click(function() {
	editor.loadPlugin('image', function() 
	{ 
	editor.plugin.imageDialog({ 
	imageUrl :'', 
	clickFn : function(url,title) 
	{ 
		url = "<img src='"+ url +"'/>";
		K("textarea[name='content']").val(K("textarea[name='content']").val()+url);
		editor.hideDialog(); 
	} 
	});
	}); 
	}); 
	});
	function CheckForm()
	{ 
		if(EmptyCheckForm('title','广告标题不能为空!','')) return false;
		if(EmptyCheckForm('gid','请选择广告分类!','')) return false;
	}
	function EmptyCheckForm(id,value,set)
	{
		if($('#'+id).val()==set)
		{
			$.dialog({icon:'warning',content:value,ok:function(){ $('#' + id).focus();}});return true;
		}
		return false;
	}
$(document).ready(function(){
	$('#gid > option').each(function(){
		if($(this).val() =='<?php echo ($list["gid"]); ?>')
		{
			$(this).attr('selected','selected');
		}
	});
	$('#status > option').each(function(){
		if($(this).val() =='<?php echo ($list["status"]); ?>')
		{
			$(this).attr('selected','selected');
		}
	});
});
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF" class="admintable">
<tr> 
  <td colspan="5" class="admintitle">编辑广告</td></tr>
<form action="<?php echo U('Ad/doedit');?>" method="post" name="myform" onsubmit="return CheckForm();">
<tr>
<td width="20%" class="b1_1">广告名称</td>
<td colspan='4' class="b1_1"><input name="title" type="text" id="title" size="40" maxlength="20" value="<?php echo ($list["title"]); ?>"/></td>
</tr>
<tr>
  <td class="b1_1">图片上传</td>
  <td colspan='4' class="b1_1"><input type='button' id='50e5974b00984' value='选择图片'/></td>
</tr>
<tr> 
<td width="20%" class="b1_1">广告代码</td>
<td colspan='4' class="b1_1"><textarea name="content" cols="50" rows="8" id="Content"><?php echo ($list["content"]); ?></textarea></td>
</tr>
<tr>
  <td class="b1_1">广告分类</td>
  <td colspan='4' class="b1_1"><select id="gid" name="gid">
  <option value=''>请选择</option>
  <?php if(is_array($grouplist)): $i = 0; $__LIST__ = $grouplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
  </select></td>
</tr>
<tr>
  <td class="b1_1">广告状态</td>
  <td colspan='4' class="b1_1"><select id="status" name="status">
	<option value='1'>启用</option>
	<option value='0'>隐藏</option>
  </select></td>
</tr>
<tr> 
<input type='hidden' name='id' value='<?php echo ($list["id"]); ?>'/>
<td width="20%" class="b1_1"></td>
<td class="b1_1" colspan='4'><input  type="submit" class="bnt" value="编 辑">&nbsp;&nbsp;<input type="button" onclick="history.go(-1);" class="bnt" value="返 回"></td>
</tr>
<input type="hidden" name="_from" value="<?php if(empty($_GET['from'])): echo ($_SERVER['HTTP_REFERER']); endif; ?>"/>
</form>
</table>
<div style="text-align:center;margin:10px;">
<hr>
<a href="http://<?php echo C('SOFT_HOMEPAGE');?>" target="_blank"><?php echo C('SOFT_NAME');?></a> Version <font color="red"><?php echo C('SOFT_VERSION');?></font> &copy; <?php echo date("Y");;?> <?php echo tongji();?>版权所有 
</div>
</body>
</html>