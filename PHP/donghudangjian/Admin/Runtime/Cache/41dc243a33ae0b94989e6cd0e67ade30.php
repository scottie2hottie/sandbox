<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>网站后台管理</title>
<link href="__PUBLIC__/Admin/images/Admin_css.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="__PUBLIC__/Admin/images/myfav.ico" type="image/x-icon" />
<script type="text/javascript" src="/Public/Admin/js/admin.js"></script><script type="text/javascript" src="/Public/Admin/js/Jquery.js"></script><script type="text/javascript" src="/Public/Admin/setdate/WdatePicker.js"></script>
<script charset="utf-8" src="__PUBLIC__/Editor/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="__PUBLIC__/Editor/kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/jquery.artDialog.js?skin=green"></script>
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/extend.js"></script>
<link href="__PUBLIC__/Editor/kindeditor/themes/default/default.css" type="text/css" rel="stylesheet">
<script>
function killErrors() {
return true;
}
window.onerror = killErrors;
KindEditor.ready(function(K){
				var colorpicker;
				K('#colorpicker').bind('click', function(e) {
					e.stopPropagation();
					if (colorpicker) {
						colorpicker.remove();
						colorpicker = null;
						return;
					}
					var colorpickerPos = K('#colorpicker').pos();
					colorpicker = K.colorpicker({
						x : colorpickerPos.x,
						y : colorpickerPos.y + K('#colorpicker').height(),
						z : 19811214,
						selectedColor : 'default',
						noColor : '无颜色',
						click : function(color) {
							K('#color').val(color);
							K('#colorpicker').css("background",color);
							colorpicker.remove();
							colorpicker = null;
						}
					});
				});
				K(document).click(function() {
					if (colorpicker) {
						colorpicker.remove();
						colorpicker = null;
					}
				});
				var editor = K.editor({
					allowFileManager : true
				});

	K('#litpic-up').click(function() {
					editor.loadPlugin('image', function() {
						if(K('#litpic').val()=='')
						{
							editor.plugin.imageDialog({
							imageUrl : K('#litpic').val(),
							clickFn : function(url, title, width, height, border, align) {
									K('#litpic').val(url);
									if(width!='')width = ' width="' + width +'"';
									if(title!='') title = ' title="' + title +'" alt="'+title+'"';
									if(height!='') height = ' height="' + height +'"';
									if(align!='') align = ' align="' + align +'"';
									if(border!='') border = ' border="' + border +'"';
									if(url!=''){
									editor_Content.insertHtml('<img '+title + width + height + align + 'src="'+url+'"/>');
									K('#flag-p').attr('checked','checked');
									}
									else
									{
										K('#flag-p').removeAttr('checked');
									}
									editor.hideDialog();
								}
							});
						}
						else
						{
							editor.plugin.imageDialog({
							imageUrl : K('#litpic').val(),
							clickFn : function(url, title, width, height, border, align) {
									K('#litpic').val(url);
									K('#flag-p').attr('checked','checked');
									editor.hideDialog();
								}
							});
						}
						
					});
				});
				
			K('#redirecturl').click(function() {
				if(K('#redirecturl').val() ==''){url ='http://';}else{url=K('#redirecturl').val();} 
					$.dialog.prompt('请输入网址', function (val) {
			K('#flag-j').attr('checked','checked');
			if(val =='' || val=='http://'){K('#flag-j').removeAttr('checked');K('#redirecturl').val('http://');}else{K('#redirecturl').val(val);}
}, url);

				});
			});
	function CheckForm()
	{ 
		if(EmptyCheckForm('title','标题不能为空!','')) return false;
		//if(EmptyCheckForm('writer','作者不能为空!',''))return false;
		//if(EmptyCheckForm('source','来源不能为空!',''))return false;
		if(EmptyCheckForm('click','点击数不能为空!',''))return false;
		if(EmptyCheckForm('typeid','请选择栏目!','0'))return false;
	}
	function EmptyCheckForm(id,value,set)
	{
		if($('#'+id).val()==set)
		{
			$.dialog({icon:'warning',content:value,ok:function(){ $('#' + id).focus();}});return true;
		}
		return false;
	}
	function vote_select(id)
	{
		var values = <?php echo ($choosevote); ?>;
		$.dialog.select(id,'请选择投票项目',function(){},values);
	}
	
/**
 * 投票ID选择
 * @param	{String}	提示内容
 * @param	{Function}	回调函数. 接收参数：输入值
 * @param	{array}     默认的值和描述
 */
artDialog.select = function (id,content,yes,value) {
	var option ='';
	for(var key in value)
	{
		option += '<option value="'+ key +'" id="art_select_"'+ key +'>'+ value[key] +'</option>';
	}
    
    return artDialog({
		title:'选择投票项目',
        id: 'flag',
        fixed: true,
        lock: true,
        opacity: .1,
        content: [
            '<div>',
				'<div style="margin-bottom:5px;margin-top:5px;font-size:12px">',
                content,
            '</div>',
            '<select name="select" id="art_select" style="padding:6px 4px">',
                    option,
                '</select>',
            '</div>',
            ].join(''),
        init: function () {
		
        },
        ok: function (here) {
			$('#'+id).val($('#art_select').val());
        },
        cancel: true
    });
};
</script>
</head>
<body>
<table width="100%" class="admintable">
<tr><td class="admintitle"><span style="float:right"><a href="javascript:;" onclick="history.go(-1)">[返回]</a></span>修改<?php echo ($modellist["typename"]); ?></td></tr>
</table>

<form action="<?php echo U('Archive/doedit');?>" onsubmit="return CheckForm();" name="myform" method="post" id="myform" enctype="multipart/form-data">

<div class="nTableft admintable">
		<div class="TabTitleleft">
      		<ul id="myTab1">
					<li class="active" onClick="nTabs(this,0);" style="width:<?php echo ($i+97/3); ?>%"> 常规选项 </li>
					<li class="normal" onClick="nTabs(this,1);" style="width:<?php echo ($i+97/3); ?>%"> 高级选项 </li>
					<li class="normal" onClick="nTabs(this,2);" style="width:<?php echo ($i+97/3); ?>%"> 扩展选项 </li>
      		</ul>
    	</div>

	<div id="myTab1_Content0"  style="clear:both;">
	<table width="100%" border="0"  align="center" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">
<tr>
<td width="20%" class="b1_1"><?php echo ($modellist["titlename"]); ?></td>
<td class="b1_1"><input name="title" type="text" id="title" group="basic" size="60" maxlength="50" value="<?php echo ($archivelist["title"]); ?>"/><input name="color" type="hidden" id="color" value="<?php echo ($archivelist["color"]); ?>" Readonly>
	  <img border=0 src="__PUBLIC__/Admin/images/Rect.gif" title="选取标题颜色" align="absmiddle" id="colorpicker" <?php if(!empty($archivelist["color"])): ?>style='cursor:pointer;background:<?php echo ($archivelist["color"]); ?>'<?php else: ?>style="cursor:pointer;"<?php endif; ?>  >&nbsp;<span class="note">注：最多60个字符</span></td>
</tr>

<tr>
  <td class="b1_1">自定义属性</td>
  <td class="b1_1">
	<?php if(is_array($flagtreelist)): $i = 0; $__LIST__ = $flagtreelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["value"]); ?><input name="flag-<?php echo ($vo["key"]); ?>" type="checkbox" group="basic" class="noborder" id="flag-<?php echo ($vo["key"]); ?>" value="<?php echo ($vo["key"]); ?>" <?php echo ($vo["checked"]); ?>/><?php endforeach; endif; else: echo "" ;endif; ?>
</td>
</tr>


<tr>
  <td class="b1_1">文档主栏目</td>
  <td class="b1_1"><select ID="typeid" name="typeid" group="basic">
	<option value='0'>请选择</option>
	<?php if(is_array($selecttreelist)): $i = 0; $__LIST__ = $selecttreelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo["id"]); ?>' <?php echo ($vo["selected"]); ?>><?php for($i=0;$i<$vo['count']*4;$i++){ echo '&nbsp;'; } if(($vo["fid"]) != "0"): ?>&nbsp;-|&nbsp;<?php endif; echo ($vo["typename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select></td>
</tr>

<tr>
  <td class="b1_1">缩略图</td>
  <td class="b1_1"><input name="litpic" type="text" id="litpic" group="basic" size="50" maxlength="200" value="<?php echo ($archivelist["litpic"]); ?>"> <input type="button" id="litpic-up" value="选择图片" /></td>
</tr>
<?php echo ($taglist["basic"]); ?>
<tr>
<td width="20%" class="b1_1"></td>
<td class="b1_1"><input name="submit" type="submit" class="bnt" value="修 改">&nbsp;&nbsp;<input type="button" onclick="history.go(-1);" class="bnt" value="返 回"></td>
</tr>

</table>
	
</div>	


	<div id="myTab1_Content1"  style="clear:both;" class='none'>
		
		<table width="100%" border="0"  align="center" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">
		<tr>
  <td class="b1_1">短标题</td>

  <td class="b1_1"><input name="shorttitle"  group="advance"  type="text" id="shorttitle" size="30" maxlength="36" value="<?php echo ($archivelist["shorttitle"]); ?>"/>&nbsp;<span class="note">最多36个字符</span></td>
</tr>

	<tr>
  <td class="b1_1">关键字</td>

  <td class="b1_1"><input name="keywords" group="advance" type="text" id="keywords" size="40" maxlength="50" value="<?php echo ($archivelist["keywords"]); ?>"/>&nbsp;<span class="note">多个关键字用,隔开</span></td>
</tr>

<tr>
  <td class="b1_1">投稿人</td>
  <td class="b1_1"><?php echo ($memberlist["username"]); ?></td>
</tr>

<tr>
  <td class="b1_1">作者</td>
  <td class="b1_1">
    <input name="writer" type="text" id="writer"  group="advance" value="<?php echo ($archivelist["writer"]); ?>" size="40" maxlength="200"/>    </td>
</tr>

<tr>
  <td class="b1_1">来源</td>

  <td class="b1_1"><span class="td">
    <input name="source" type="text" id="source" group="advance" value="<?php echo ($archivelist["source"]); ?>" size="40" maxlength="200"/>
  </span></td>
</tr>

<tr>
  <td class="b1_1">浏览次数</td>
  <td class="b1_1"><input name="click" type="text" group="advance" id="click" value="<?php echo ($archivelist["click"]); ?>" size="6" maxlength="10"/>&nbsp;&nbsp;<input name="get" type="button" class="bnt" onclick="document.myform.click.value=Math.ceil(Math.random()*(1000-1)+1);" value="随 机"></td>
 </tr>
 <tr>
  <td class="b1_1">发布时间</td>
  <td class="b1_1"><input name="pubdate" type="text" group="advance" id="pubdate" value="<?php echo (date('Y-m-d H:i:s',$archivelist["pubdate"])); ?>" 
  onFocus="WdatePicker({isShowClear:false,readOnly:true,startDate:'1988-01-01',minDate:'1960-01-01 00:00:00',maxDate:'2088-12-31 23:59:59',dateFmt:'yyyy-MM-dd HH:mm:ss',skin:'whyGreen'})" /></td>
 </tr>
  <tr>
  <td class="b1_1">投稿时间</td>
  <td class="b1_1"><input name="senddate" type="text" group="advance" id="senddate" value="<?php echo (date('Y-m-d H:i:s',$archivelist["senddate"])); ?>" onFocus="WdatePicker({isShowClear:false,readOnly:true,startDate:'1988-01-01',minDate:'1960-01-01 00:00:00',maxDate:'2088-12-31 23:59:59',dateFmt:'yyyy-MM-dd HH:mm:ss',skin:'whyGreen'})" /></td>
 </tr>
 <tr>
  <td class="b1_1">文章投票ID</td>
  <td class="b1_1"><input name="voteid" type="text" id="voteid" group="advance" value="<?php echo ($archivelist["voteid"]); ?>" size='6' />
  <input type="button" onclick="vote_select('voteid')" value="选择投票" /></td>
 </tr>
 <tr>
  <td class="b1_1">阅读权限</td>

  <td class="b1_1"><span class="td">
    <select name="arcrank" group="advance" id="arcrank">
	<option value="1" <?php if(($archivelist["arcrank"]) == "1"): ?>selected='selected'<?php endif; ?>>开放浏览</option>
	<option value="2" <?php if(($archivelist["arcrank"]) == "2"): ?>selected='selected'<?php endif; ?>>会员浏览</option>
	<option value="3" <?php if(($archivelist["arcrank"]) == "3"): ?>selected='selected'<?php endif; ?>>付费浏览</option>
	<option value="4" <?php if(($archivelist["arcrank"]) == "4"): ?>selected='selected'<?php endif; ?>>禁止浏览</option>
	<option value="8" <?php if(($archivelist["arcrank"]) == "8"): ?>selected='selected'<?php endif; ?>>垃圾回收</option>
	</select>
  </span></td>
</tr>
 
 <tr>
  <td class="b1_1">阅读所需金币</td>

  <td class="b1_1"><span class="td">
    <input name="money" type="text" id="money" group="advance" value="<?php echo ($archivelist["money"]); ?>" size="6"/>
  </span></td>
</tr>

 <tr>
  <td bgcolor="#FFFFFF" class="b1_1">内容摘要(描述)</td>
  <td colspan=4 class="b1_1"><textarea name="description" group="advance" id="description" cols="60" rows="6"><?php echo ($archivelist["description"]); ?></textarea></td>
</tr>
 <tr>
<td width="20%" class="b1_1"></td>
<td class="b1_1"><input name="submit" type="submit" class="bnt" value="修 改">&nbsp;&nbsp;<input type="button" onclick="history.go(-1);" class="bnt" value="返 回"></td>
</tr>
		</table>

	</div>
	
	
	<div id="myTab1_Content2"  style="clear:both;" class='none'>
	<table width="100%" border="0"  align="center" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">
	<?php echo ($taglist["extend"]); ?>
	<tr>
<td width="20%" class="b1_1"></td>
<td class="b1_1"><input name="submit" type="submit" class="bnt" value="保 存">&nbsp;&nbsp;<input type="button" onclick="history.go(-1);" class="bnt" value="返 回"></td>
</tr>
	
	</table>
	
	</div>
</div>
<input type="hidden" name="modelid" value="<?php echo ($archivelist["modelid"]); ?>"/>
<input type="hidden" name="mid" value="<?php echo ($archivelist["mid"]); ?>"/>
<input type="hidden" name="id" value="<?php echo ($archivelist["id"]); ?>"/>
<input type="hidden" name="_from" value="<?php if(empty($_GET['from'])): echo ($_SERVER['HTTP_REFERER']); endif; ?>"/>
</form>

<div style="text-align:center;margin:10px;">
<hr>
<a href="http://<?php echo C('SOFT_HOMEPAGE');?>" target="_blank"><?php echo C('SOFT_NAME');?></a> Version <font color="red"><?php echo C('SOFT_VERSION');?></font> &copy; <?php echo date("Y");;?> <?php echo tongji();?>版权所有
</div>
</body>
</html>