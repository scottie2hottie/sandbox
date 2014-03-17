<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>网站后台管理</title>
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

function singleaudit(id)
{
	var values = {'1':'正常浏览','2':'会员浏览','3':'付费浏览','4':'禁止浏览','8':'删除至回收站','99':'彻底删除'};
	var input = id +',';
	var url = '<?php echo U('Archive/ajax?method=audit');?>';
	$.dialog.select('请选择审核操作',function(){},input,values,url);
}
function audit()
{
	var values = {'1':'正常浏览','2':'会员浏览','3':'付费浏览','4':'禁止浏览','8':'删除至回收站','99':'彻底删除'};
	if(checkselectId())
	{
		var input = checkselectId();
	}
	else
	{
		$.dialog.alert('请勾选ID记录!'); return false;
	}
	var url = '<?php echo U('Archive/ajax?method=audit');?>';
	$.dialog.select('请选择审核操作',function(){},input,values,url);
}
function flag(method)
{
	var values = {'c':'推荐','h':'热门','p':'图片','f':'幻灯','s':'滚动','j':'跳转','a':'特荐','b':'加粗'};
	if(checkselectId())
	{
		var input = checkselectId();
	}
	else
	{
		$.dialog.alert('请勾选ID记录!'); return false;
	}
	var url = '<?php echo U('Archive/ajax?method=flag');?>'+ method;
	if(method=='add') {var methodname = '添加';}else{var methodname = '删除';}
	$.dialog.flag('请选择'+methodname+'属性操作',function(){},input,values,url);
}
/**
 * flag选择
 * @param	{String}	提示内容
 * @param	{Function}	回调函数. 接收参数：输入值
 * @param	{string}    被选中的id
 * @param	{array}     默认的值和描述
 * @param	{string}    ajax提交地址
 * @param	{string}    ajax提交方法,add 增加属性, del 删除属性
 */
artDialog.flag = function (content,yes,input,value,url) {
	var option ='';
	for(var key in value)
	{
		option += value[key] + '<input value="'+ key +'" name="flag" class="noborder" type="radio"/>';
	}
    var input;
    
    return artDialog({
		title:'批量操作',
        id: 'select',
        fixed: true,
        lock: true,
        opacity: .1,
        content: [
            '<div style="margin-bottom:5px;font-size:12px" id="art_content">',
                '<font>批量处理ID值</font>',
            '</div>',
            '<div>',
                '<input value="',
                    input,
                '" style="width:18em;padding:6px 4px" name="art_ids" id="art_ids"/><br/>',
				'<div style="margin-bottom:5px;margin-top:5px;font-size:12px">',
                content,
            '</div>',
            option,
            '</div>',
            ].join(''),
        init: function () {
		
        },
        ok: function (here) {
			if($('#art_ids').val()=='')
			{
				$('#art_content > font').attr('color','red');
				this.shake && this.shake();// 调用抖动接口
				return false;
			}
			//ajax提交
			var ajax_ids = $('#art_ids').val();
			var ajax_flag ='';
			$("input[name='flag']").each(function(){
				if($(this).attr('checked')=='checked') ajax_flag =$(this).val();
			});
			$.ajax({
			type: "POST",
			url: url,
			data: "id="+ajax_ids+"&flag="+ajax_flag,
			success: function(msg){
					//$.dialog.tips('操作成功!即将重载页面~~~');
					//setTimeout("window.location.reload(true)",2000);
					window.location.reload(true);
					}
				});
        },
        cancel: true
    });
};
/**
 * flag属性选择
 * @param	{String}	提示内容
 * @param	{Function}	回调函数. 接收参数：输入值
 * @param	{string}    被选中的id
 * @param	{array}     默认的值和描述
 * @param	{string}    ajax提交地址
 */
artDialog.select = function (content,yes,input,value,url) {
	var option ='';
	for(var key in value)
	{
		option += '<option value="'+ key +'" id="art_select_"'+ key +'>'+ value[key] +'</option>';
	}
    var input;
    
    return artDialog({
		title:'批量操作',
        id: 'flag',
        fixed: true,
        lock: true,
        opacity: .1,
        content: [
            '<div style="margin-bottom:5px;font-size:12px" id="art_content">',
                '批量处理ID值',
            '</div>',
            '<div>',
                '<input value="',
                    input,
                '" style="width:18em;padding:6px 4px" name="art_ids" id="art_ids"/><br/>',
				'<div style="margin-bottom:5px;margin-top:5px;font-size:12px">',
                content,
            '</div>',
            '<select name="select" id="art_select" style="padding:6px 4px">',
                    option,
                '</select>',
            '</div>',
			'<div id="art_show_money"><div style="margin-bottom:5px;margin-top:5px;font-size:12px">',
                '付费浏览金额',
            '</div>',
			'<input value="',
                    20,
                '" style="width:18em;padding:6px 4px" name="art_money" id="art_money"/></div>',
            ].join(''),
        init: function () {
		
        },
        ok: function (here) {
			if($('#art_ids').val()=='')
			{
				$('#art_content > font').attr('color','red');
				this.shake && this.shake();// 调用抖动接口
				return false;
			}
			//ajax提交
			var ajax_ids = $('#art_ids').val();
			var ajax_select = $('#art_select').val();
			var ajax_money = $('#art_money').val();
			$.ajax({
			type: "POST",
			url: url,
			data: "id="+ajax_ids+"&arcrank="+ajax_select+"&money="+ajax_money+"&method=",
			success: function(msg){
				// $.dialog.tips('操作成功!即将重载页面~~~');
				// setTimeout("window.location.reload(true)",2000);
					window.location.reload(true);
					}
				});
        },
        cancel: true
    });
};
</script>
</head>
<body>

<table width="95%" border="0" cellspacing="2" cellpadding="3"  align="center" class="admintable" style="margin-bottom:5px;">
    <tr>
      <td align="left" height="25" bgcolor="f7f7f7">快速查找：
        <SELECT onChange="javascript:window.open(this.options[this.selectedIndex].value,'main')"  size="1" name="s">
        <OPTION value="" selected>-=请选择=-</OPTION>
        <OPTION value="<?php echo U('Archive/index?modelid='); echo ($arcmodellist["id"]); ?>">所有文档</OPTION>
        <OPTION value="<?php echo U('Archive/index?unarcrank=4');?>&title=<?php echo urlencode('已审的文档');?>">已审的文档</OPTION>
        <OPTION value="<?php echo U('Archive/index?arcrank=4');?>&title=<?php echo urlencode('未审的文档');?>">未审的文档</OPTION>
		<OPTION value="<?php echo U('Archive/index?arcrank=1');?>&title=<?php echo urlencode('正常浏览的文档');?>">正常浏览的文档</OPTION>
		<OPTION value="<?php echo U('Archive/index?arcrank=2');?>&title=<?php echo urlencode('会员浏览的文档');?>">会员浏览的文档</OPTION>
		<OPTION value="<?php echo U('Archive/index?arcrank=3');?>&title=<?php echo urlencode('付费浏览的文档');?>">付费浏览的文档</OPTION>
		<OPTION value="<?php echo U('Archive/index?arcrank=8');?>&title=<?php echo urlencode('回收站');?>">回收站的文档</OPTION>
		<OPTION value="<?php echo U('Archive/index?flag=c');?>&title=<?php echo urlencode('推荐的文档');?>">推荐的文档</OPTION>
		<OPTION value="<?php echo U('Archive/index?flag=h');?>&title=<?php echo urlencode('热门的文档');?>">热门的文档</OPTION>
        <OPTION value="<?php echo U('Archive/index?flag=a');?>&title=<?php echo urlencode('特荐的文档');?>">特荐的文档</OPTION>
        <OPTION value="<?php echo U('Archive/index?flag=j');?>&title=<?php echo urlencode('跳转的文档');?>">跳转的文档</OPTION>
        <OPTION value="<?php echo U('Archive/index?flag=b');?>&title=<?php echo urlencode('加粗的文档');?>">加粗的文档</OPTION>
        <OPTION value="<?php echo U('Archive/index?flag=f');?>&title=<?php echo urlencode('幻灯的文档');?>">幻灯的文档</OPTION>
        <OPTION value="<?php echo U('Archive/index?flag=s');?>&title=<?php echo urlencode('滚动的文档');?>">滚动的文档</OPTION>
		<OPTION value="<?php echo U('Archive/index?flag=p');?>&title=<?php echo urlencode('含图的文档');?>">含缩略图的文档</OPTION>
      </SELECT>      </td>
      <td align="center" bgcolor="f7f7f7">
	  <form name="form1" method="POST" action="<?php echo U('Archive/index?modelid='); echo ($arcmodellist["id"]); ?>&title=<?php echo urlencode('搜索的结果');?>">
        <input name="kwd" type="text" id="keyword" value="<?php echo ($_POST['kwd']); ?>" class="s26">
        <input type="submit" class="bnt" value="搜索">
      </form></td>
      <td align="right" bgcolor="f7f7f7">跳转到：
        <select name="ClassID" id="ClassID" onChange="javascript:window.open('<?php echo U('Archive/index?typeid=');?>'+this.options[this.selectedIndex].value,'main')">
    <option value="">请选择分类</option>
	<?php if(is_array($selecttreelist)): $i = 0; $__LIST__ = $selecttreelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo["id"]); ?>' <?php echo ($vo["selected"]); ?>><?php for($i=0;$i<$vo['count']*4;$i++){ echo '&nbsp;'; } if(($vo["fid"]) != "0"): ?>&nbsp;-|&nbsp;<?php endif; echo ($vo["typename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></td>
    </tr>
</table>


<form name="myform" id="myform" method="POST" onsubmit="return checkselectId()" action="<?php echo U('Archive/delall');?>">
<table width="95%" border="0"  align="center" cellpadding="3" cellspacing="1" bgcolor="#F2F9E8" class="admintable">
<tr> 
<td colspan="8" align="left" class="admintitle"><h6><span style="float:right;"><a href="<?php echo U('Archive/add'); if(isset($map["typeid"])): ?>&typeid=<?php echo ($map["typeid"]); endif; if(isset($map["modelid"])): ?>&modelid=<?php echo ($map["modelid"]); endif; ?>">[添加]</a><a href='<?php echo U('Archive/index'); if(isset($map["typeid"])): ?>&typeid=<?php echo ($map["typeid"]); endif; if(isset($map["modelid"])): ?>&modelid=<?php echo ($map["modelid"]); endif; ?>&arcrank=8&title=<?php echo urlencode('回收站');?>'>[回收站]</a></span>
<a href="<?php echo U('Archive/index?modelid='); echo ($arcmodellist["id"]); ?>"><?php echo ($arcmodellist["typename"]); ?>列表</a>&gt;<?php if(is_array($locationlist)): $i = 0; $__LIST__ = $locationlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Archive/index?typeid='); echo ($vo["id"]); ?>"><?php echo ($vo["typename"]); ?></a>&gt;<?php endforeach; endif; else: echo "" ;endif; ?><a href="javascript:;"><?php if(isset($title)): echo (urldecode($title)); else: ?>所有文档<?php endif; ?></a></h6></td></tr>
    <tr bgcolor="#f1f3f5" style="font-weight:bold;">
    <td width="5%" height="30" align="center" class="ButtonList">ID</td>
    <td width="5%" height="30" align="center" class="ButtonList">选择</td>
    <td width="40%" align="center" class="ButtonList">文档标题</td>
    <td width="8%" height="25" align="center" class="ButtonList">更新时间</td>
    <td width="10%" height="25" align="center" class="ButtonList">类目</td>
    <td width="5%" height="25" align="center" class="ButtonList">点击</td>
    <td width="7%" height="25" align="center" class="ButtonList">发布人</td>
    <td width="20%" height="25" align="center" class="ButtonList">操作</td>    
    </tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr bgcolor="#ffffff" onMouseOver="this.style.backgroundColor='#EAFCD5';" onMouseOut="this.style.backgroundColor='';this.style.color=''">
	<td height="25" align="CENTER"><?php echo ($vo["id"]); ?></td>
    <td height="25" align="CENTER"><input type="checkbox" class='ids' value="<?php echo ($vo["id"]); ?>" name="id[]" onClick="unselectall(this.form)" style="border:0;"></td>
    <td height="25"><a href="<?php echo (url('view',$vo["id"])); ?>" target='_blank'><?php if(!empty($vo["color"])): ?><font color="<?php echo ($vo["color"]); ?>"><?php echo ($vo["title"]); ?></font><?php else: echo ($vo["title"]); endif; ?></a><?php if(!empty($vo["flag"])): ?>[<font color="red"><?php endif; echo (parseflag($vo["flag"])); if(!empty($vo["flag"])): ?></font>]<?php endif; ?></td>
    <td height="25" align="center"><?php echo (date("Y-m-d",$vo["pubdate"])); ?></td>
    <td height="25" align="center"><a href="<?php echo U('Archive/index?typeid='); echo ($vo["typeid"]); if(isset($arcrank)): ?>&arcrank=<?php echo ($arcrank); endif; ?>"><?php echo ($vo["typename"]); ?></a></td>
    <td height="25" align="center"><?php echo ($vo["click"]); ?></td>
    <td height="25" align="center"><?php if(empty($vo["username"])): ?>admin<?php else: echo ($vo["username"]); endif; ?></td>
    <td align="center">
	<a onclick="singleaudit('<?php echo ($vo["id"]); ?>')">
	<?php switch($vo["arcrank"]): case "1": ?><font color="green">正常浏览</font><?php break;?>
	<?php case "2": ?><font color="blue">会员浏览</font><?php break;?>
	<?php case "3": ?><font color="#c33E5">付费浏览</font><?php break;?>
	<?php case "4": ?><font color="red">禁止浏览</font><?php break;?>
	<?php case "8": ?><font color="green">还原文档</font><?php break; endswitch;?>
	</a><a href="<?php echo (url('view',$vo["id"])); ?>" target='_blank'>浏览</a>|<a href="<?php echo U('Archive/edit?id='); echo ($vo["id"]); ?>">更改</a>|<a href="javascript:;" onClick="JavaScript:return jconfirm('确定要删除？','<?php echo U('Archive/del?id='); echo ($vo["id"]); if(($vo["arcrank"]) == "8"): ?>&method=truedel<?php endif; ?>')">删除</a></td>
    
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
<tr>
 <td height="25" align="center" bgcolor="f7f7f7">全选</td>
<td align="center" bgcolor="f7f7f7">
<input name="Action" type="hidden"  value="Del">
<input name="chkAll" type="checkbox" id="chkAll" onClick="CheckAll(this.form)" value="checkbox" style="border:0">
</td>
  <td colspan="6" bgcolor="f7f7f7" align="left">
  <font color="red">移动到：</font>
    <select id="typeid" name="typeid">
    <option value="0">请选择分类</option>
	<?php if(is_array($selecttreelist)): $i = 0; $__LIST__ = $selecttreelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo["id"]); ?>' <?php echo ($vo["selected"]); ?>><?php for($i=0;$i<$vo['count']*4;$i++){ echo '&nbsp;'; } if(($vo["fid"]) != "0"): ?>&nbsp;-|&nbsp;<?php endif; echo ($vo["typename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
    &nbsp;
<input name="Del" type="submit" class="bnt" id="Del" value="移动" onclick="alertcheck()">
<input name="Del" type="<?php if(($arcrank) != "8"): ?>submit<?php else: ?>button<?php endif; ?>" class="bnt" id="Del" value="<?php if(($arcrank) != "8"): ?>删除" onclick="alertcheck()"<?php else: ?>还原" onclick="audit()"<?php endif; ?>>
<input name="Del" type="submit" class="bnt" id="Del" value="更新" onclick="alertcheck()">
<input name="Del" type="button" class="bnt" id="Del" value="审核" onclick="audit()">
<input name="Del" type="button" class="bnt" id="Del" value="增加属性" onclick="flag('add')">
<input name="Del" type="button" class="bnt" id="Del" value="删除属性" onclick="flag('del')">
</td>
</tr>
<tr>
<td colspan="8" bgcolor="f7f7f7">
<div id="page">
	<ul>
<?php echo ($page); ?>
    </ul>
</div>
</td>
</tr>
</table>
</form>
<div style="text-align:center;margin:10px;">
<hr>
<a href="http://<?php echo C('SOFT_HOMEPAGE');?>" target="_blank"><?php echo C('SOFT_NAME');?></a> Version <font color="red"><?php echo C('SOFT_VERSION');?></font> &copy; <?php echo date("Y");;?> <?php echo tongji();?>版权所有 
</div>
</body>
</html>