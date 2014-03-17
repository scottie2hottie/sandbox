<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
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
<?php echo ($js); ?>
function switchjs(path,bpath)
{
  var imgpath ='__PUBLIC__/Admin/images/'; 
  var a = $('#'+bpath+' > td > span > img').attr('id');
  if(a=='+')
  {
    $('#'+bpath+' > td > span > img').attr('id','-');
    $('#'+bpath+' > td > span > img').attr('src',imgpath+'-.gif');
    $("tr[path="+path+"]").show();
  }
  else
  {
    $('#'+bpath+' > td > span > img').attr('id','+');
    $('#'+bpath+' > td > span > img').attr('src',imgpath+'+.gif');
    $("tr[path="+path+"]").hide();
  }
}
function doextendtree(i)
{
  var imgpath ='__PUBLIC__/Admin/images/'; 
  if(i==1)
  {
    $('#extendtreeopen').hide();
    $('#extendtreeclose').show();
    $("tr[datatype='volist']").show();
    $('.jiapic').attr('src',imgpath+'-.gif');
  }
  if(i==2)
  {
    $('#extendtreeclose').hide();
    $('#extendtreeopen').show();
    $("tr[datatype='volist']").hide();
    $('.jiapic').attr('src',imgpath+'+.gif');
    extendtree();
  }
}
</script>
<style>
.typelist{float:left;}
</style>
</head>
<body>
<form name='myform' id='myform' action="<?php echo U('Type/delall');?>" method='post'>
<table border="0" cellspacing="2" cellpadding="3"  align="center" class="admintable">
<tr> 
  <td colspan="3" align="left" class="admintitle">栏目列表　[<a href="<?php echo U('Type/add');?>">添加</a>]</td>
</tr>
  <tr align="center"> 
    <td width="25%" class="ButtonList">栏目名称</td>
    <td width="25%" class="ButtonList">操 作</td>
    <td width="5%" class="ButtonList">首页菜单显示</td>
    <td width="" class="ButtonList">排 序</td>
  </tr>
 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type='checkbox' name="id[]" value='<?php echo ($vo["id"]); ?>' style="display:none;" checked/>
    <tr bgcolor="#f1f3f5" datatype='volist'  onMouseOver="this.style.backgroundColor='#EAFCD5';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''" class='none' id="<?php echo ($vo["bpath"]); ?>" path='<?php echo ($vo["path"]); ?>'>
    <td height="24" class="tdleft" ><span class="typelist" onclick="switchjs('<?php echo ($vo["bpath"]); ?>','<?php echo ($vo["bpath"]); ?>')"><img src="__PUBLIC__/Admin/images/+.gif" id='+' class='jiapic'/>&nbsp;<?php for($i=0;$i<$vo['count'];$i++){ if($vo['count']<>2) { echo '&nbsp;'; } } if($vo['fid']<>0){ echo "-|"; } echo ($vo["typename"]); ?>[ID:<?php echo ($vo["id"]); ?>](文档:<?php echo (archive_gettotal($vo["id"],'arctype')); ?>)</span></td>
    
    <td width="25%" align="center"><a href="<?php echo (url('list',$vo["id"])); ?>" target='_blank'>预览</a>|<a href="<?php echo U('Archive/index?typeid='); echo ($vo["id"]); ?>">内容</a>|<a href='<?php echo U('Type/add?id='); echo ($vo["id"]); ?>'>增加子类</a>|<a href="<?php echo U('Type/edit?id='); echo ($vo["id"]); ?>">编辑</a> | <a href="javascript:;" onClick="JavaScript:return jconfirm('删除的栏目必须无子栏目,且无文章！确定？','<?php echo U('Type/del?id='); echo ($vo["id"]); ?>')">删除</a></td>
  <td>
    <?php if(($vo["is_index_menu_display"]) == "1"): ?>显示<?php else: ?>不显示<?php endif; ?>
  </td>
  <td width="10%"><input type='text' name='sortrank[]' value='<?php echo ($vo["sortrank"]); ?>' style='width:30px;'/></td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
<tr bgcolor="#f1f3f5">
   <td colspan="3" bgcolor="f7f7f7" align="right">
   <input type="button" class="bnt" value="展开所有" id='extendtreeopen' onclick="doextendtree(1);"/>
   <input type="button" class="bnt none" value="合并所有" id='extendtreeclose' onclick="doextendtree(2);"/>&nbsp;&nbsp;
   <input type="submit" class="bnt" value="更新排序"/>&nbsp;&nbsp;
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