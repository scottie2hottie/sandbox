<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="__PUBLIC__/Admin/images/Admin_css.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="__PUBLIC__/Admin/images/myfav.ico" type="image/x-icon" />
<title>网站会员管理</title>
<script type="text/javascript" src="/Public/Admin/js/admin.js"></script><script type="text/javascript" src="/Public/Admin/js/Ajax.js"></script><script type="text/javascript" src="/Public/Admin/js/Jquery.js"></script><script type="text/javascript" src="/Public/Admin/setdate/WdatePicker.js"></script> 
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/jquery.artDialog.js?skin=green"></script>
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/extend.js"></script>
<script charset="utf-8" src="__PUBLIC__/Editor/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="__PUBLIC__/Editor/kindeditor/lang/zh_CN.js"></script>
<link href="__PUBLIC__/Editor/kindeditor/themes/default/default.css" type="text/css" rel="stylesheet">
<script>
	KindEditor.ready(function(K) { 
	var editor = K.editor({ allowFileManager : true,removeSize:true,removeAlign:true,removeTitle:true,resizeImage:true}); 
	K('#50e5974b00984').click(function() {
	editor.loadPlugin('image', function() 
	{ 
	editor.plugin.imageDialog({ 
	imageUrl :'', 
	clickFn : function(url,title) 
	{ 
		K("#avtar").val(url);
		K("#preavtar").html("<img src='"+url+"' width='100px' height='100px'/>");
		editor.hideDialog(); 
	} 
	});
	}); 
	}); 
	});
</script>
<script>
	function ajax()
	{
		val = $('#username').val();
		if(val !='')
		{
			$.post("<?php echo U('Member/ajax');?>", {username: val},
			function(data){
				if(data=='1')
				{
				$.dialog({icon:'warning',content:'当前帐户已被注册使用!',ok:function(){ $('#username').focus();}});
				}
			});
		}
		
	}
function CheckForm()
	{ 
		if(EmptyCheckForm('username','会员名称不能为空!','')) return false;
		if(EmptyCheckForm('password','会员密码不能为空!',''))return false;
		if(EmptyCheckForm('province','省份不能为空!',''))return false;
		if(EmptyCheckForm('city','城市不能为空!',''))return false;
		if(EmptyCheckForm('email','email不能为空!',''))return false;
		if(EmptyCheckForm('money','积分不能为空!',''))return false;
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
		$('#rankid').change(function(){
			$('#rankid > option').each(function(){
				if($(this).attr('selected')=='selected')
				{
					$('#money').val($(this).attr('money'));
				}
			});
		});
	});
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF" class="admintable">
<tr> 
  <td colspan="5" class="admintitle">添加会员</th></tr>
<form action="<?php echo U('Member/doadd');?>" name="UserReg" method="post"  onsubmit="return CheckForm()">
<tr>
<td width="20%" class="b1_1">会员名称</td>
<td class="b1_1" colspan='4'><input name="username" type="text" id="username" size="30" onblur="ajax()"></td>
</tr>
<tr> 
<td width="20%" class="b1_1">密码</td>
<td colspan='4' class="b1_1"><input name="password" type="text" id="password" size="30"></td>
</tr>
<tr>
  <td class="b1_1">用户头像</td>
  <td colspan='4' class="b1_1"><input name="avtar" type="text" id="avtar" size="30"/>&nbsp;&nbsp;<input type='button' id='50e5974b00984' value='选择图片'/></td>
</tr>
<tr>
  <td class="b1_1">头像预览</td>
  <td colspan='4' class="b1_1"><div id="preavtar"><img src="__PUBLIC__/User/img/avtar_big.jpg" width="100px" height="100px"/></div></td>
</tr>
<tr>
  <td class="b1_1">性别</td>
  <td colspan='4' class="b1_1"><select name="sex" id="sex">
    <option value="1">男</option>
    <option value="0">女</option>
  </select></td>
</tr>
<tr>
  <td class="b1_1">状态</td>
  <td colspan='4' class="b1_1"><select name="status" id="status">
    <option value="0">启用</option>
    <option value="1">禁用</option>
  </select></td>
</tr>
<tr>
  <td class="b1_1">出生日期</td>
  <td colspan='4' class="b1_1"><input name='birthday' type='text' class="borderall" onFocus="WdatePicker({isShowClear:false,readOnly:true,startDate:'1988-01-23',minDate:'1960-01-01',maxDate:'2012-12-31',skin:'whyGreen'})" style="width:140px;"/></td>
</tr>
<tr>
  <td class="b1_1">籍贯(省/市)：</td>
  <td colspan='4' class="b1_1"><select onChange="setcity();" name='province' style="width:90px;">
    <option value=''>请选择省份</option>
    <option value="广东">广东</option>
    <option value="北京">北京</option>
    <option value="重庆">重庆</option>
    <option value="福建">福建</option>
    <option value="甘肃">甘肃</option>
    <option value="广西">广西</option>
    <option value="贵州">贵州</option>
    <option value="海南">海南</option>
    <option value="河北">河北</option>
    <option value="黑龙江">黑龙江</option>
    <option value="河南">河南</option>
    <option value="香港">香港</option>
    <option value="湖北">湖北</option>
    <option value="湖南">湖南</option>
    <option value="江苏">江苏</option>
    <option value="江西">江西</option>
    <option value="吉林">吉林</option>
    <option value="辽宁">辽宁</option>
    <option value="澳门">澳门</option>
    <option value="内蒙古">内蒙古</option>
    <option value="宁夏">宁夏</option>
    <option value="青海">青海</option>
    <option value="山东">山东</option>
    <option value="上海">上海</option>
    <option value="山西">山西</option>
    <option value="陕西">陕西</option>
    <option value="四川">四川</option>
    <option value="安徽">安徽</option>
    <option value="台湾">台湾</option>
    <option value="天津">天津</option>
    <option value="新疆">新疆</option>
    <option value="西藏">西藏</option>
    <option value="云南">云南</option>
    <option value="浙江">浙江</option>
    <option value="海外">海外</option>
  </select>
    <select name='city'  style="width:90px;">
    </select>
    <script src="__PUBLIC__/Admin/js/getcity.js"></script>
    <script>initprovcity('','');</script>
    <font color="#FF0000">*</font></td>
</tr>
<tr>
  <td class="b1_1">所属组</td>
  <td colspan='4' class="b1_1">
  <select name="rankid" id="rankid">
  <?php if(is_array($ranklist)): $i = 0; $__LIST__ = $ranklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" money="<?php echo ($vo["rankmoney"]); ?>">【
    <?php switch($vo["groupid"]): case "2": ?>会员组<?php break;?>
    <?php case "3": ?>管理员组<?php break; endswitch;?>
  】<?php echo ($vo["rankname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
  </select>
  </td>
</tr>
<tr>
  <td class="b1_1">积分</td>
  <td colspan='4' class="b1_1"><input name="money" type="text" id="money" value="0" size="30" maxlength="5"></td>
</tr>
<tr>
  <td class="b1_1">用户邮箱</td>
  <td colspan='4' class="b1_1"><input name="email" type="text" id="email" size="30"></td>
</tr>
<tr>
  <td class="b1_1">QQ</td>
  <td colspan='4' class="b1_1"><input name="qq" type="text" id="qq" size="30"></td>
</tr>
<tr> 
<td width="20%" class="b1_1"></td>
<td colspan='4' class="b1_1"><input  type="submit" class="bnt" value="添 加"/>&nbsp;&nbsp;<input type="button" class="bnt" value="返 回" onclick="history.go(-1)"/> </td>
</tr></form>
</table>
<div style="text-align:center;margin:10px;">
<hr>
<a href="http://<?php echo C('SOFT_HOMEPAGE');?>" target="_blank"><?php echo C('SOFT_NAME');?></a> Version <font color="red"><?php echo C('SOFT_VERSION');?></font> &copy; <?php echo date("Y");;?> <?php echo tongji();?>版权所有 
</div>
</body>
</html>