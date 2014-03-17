<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="__PUBLIC__/Admin/images/Admin_css.css" type=text/css rel=stylesheet>
<link rel="shortcut icon" href="__PUBLIC__/Admin/images/myfav.ico" type="image/x-icon" />
<script src="__PUBLIC__/Admin/js/admin.js"></script>
<script src="__PUBLIC__/Admin/js/Jquery.js"></script>
<script charset="utf-8" src="__PUBLIC__/Editor/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="__PUBLIC__/Editor/kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/jquery.artDialog.js?skin=green"></script>
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/extend.js"></script>
<link href="__PUBLIC__/Editor/kindeditor/themes/default/default.css" type="text/css" rel="stylesheet">
<script>
     var editor;
        KindEditor.ready(function(K) {
                editor = K.create('#ocontent',{
        items : [
    'source', '|', 'undo', 'redo', '|', 'print', 'template', 'code', 'cut', 'copy', 'paste',
    'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
    'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
    'superscript', 'clearhtml', 'quickformat', 'selectall', 'preview','fullscreen','/',
    'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
    'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
    'flash', 'media', 'insertfile','multifile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
    'anchor', 'link', 'unlink',
  ],
        allowFileManager : true
        });

        
        }); 
function CheckForm()
  { 
    if(EmptyCheckForm('otypename','栏目名称不能为空!','')) return false;
    if(EmptyCheckForm('osortrank','栏目排序不能为空!',''))return false;
  }
  function EmptyCheckForm(id,value,set)
  {
    if($('#'+id).val()==set)
    {
      $.dialog({icon:'warning',content:value,ok:function(){ $('#' + id).focus();}});return true;
    }
    return false;
  }
function getlink(i)
{
  if(i==1 && document.getElementById("getlink").style.display =='none')
  {
    document.getElementById("getlink").style.display ='';
  }
  if(i==0)
  {
    document.getElementById("getlink").style.display ='none';
  }
}
function killErrors() {
return true;
}
window.onerror = killErrors;
</script>
</head>
<body <?php if(($list["modeltype"]) == "2"): ?>onload="getlink(1)"<?php endif; ?>>
<form action="<?php echo U('Type/doedit');?>" method="post" onsubmit="return CheckForm()">
<table width="100%"  class="admintable">
<tr><td class="admintitle">修改栏目</td></tr>
</table>
<div class="nTableft admintable">
  <div class="TabTitleleft">
          <ul id="myTab1">
          <li class="active" onClick="nTabs(this,0);" style="width:<?php echo ($_i + 97/3); ?>%">常规选项</li>
          <li class="normal" onClick="nTabs(this,1);" style="width:<?php echo ($_i + 97/3); ?>%">高级选项</li>
          <li class="normal" onClick="nTabs(this,2);" style="width:<?php echo ($_i + 97/3); ?>%">栏目内容</li>
          </ul>
      </div>
<div id="myTab1_Content0"  style="clear:both;">
<table width="100%" border="0"  align="center" cellpadding="3" cellspacing="1" style="margin:5px 0;background:#FFF">
<tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">内容模型
        <div id='hmodelid' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
  <select class='css_select' name="modelid" type="text" id="omodelid" onFocus="hmodelid.style.color='blue';" onBlur="hmodelid.style.color='#ccc';" style="width:auto;">
  <?php if(is_array($modellist)): $i = 0; $__LIST__ = $modellist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["typename"]); ?>|<?php echo ($vo["nid"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
  </select>
  </td>
  </tr>
<tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">所属栏目
        <div id='fid' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
  <select class='css_select' name="fid" type="text" id="ofid" onFocus="hmodelid.style.color='blue';" onBlur="hmodelid.style.color='#ccc';" style="width:auto;">
  <option value='0'>做为顶级分类</option>
<?php if(is_array($selecttreelist)): $i = 0; $__LIST__ = $selecttreelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo["id"]); ?>' <?php echo ($vo["selected"]); ?>><?php for($i=0;$i<$vo['count']*4;$i++){ echo '&nbsp;'; } if(($vo["fid"]) != "0"): ?>&nbsp;-|&nbsp;<?php endif; echo ($vo["typename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select>
  </select>
  </td>
  </tr>
<tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">栏目名称
        <div id='htypename' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input name="typename" type="text" id="otypename" onFocus="htypename.style.color='blue';" onBlur="htypename.style.color='#ccc';" value="<?php echo ($list["typename"]); ?>" style="width:200px;">
  </td>
  </tr>
<tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">排列顺序
        <div id='hsortrank' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input name="sortrank" type="text" id="osortrank" onFocus="hsortrank.style.color='blue';" onBlur="hsortrank.style.color='#ccc';" value="<?php echo ($list["sortrank"]); ?>" style="width:200px;">
  </td>
  </tr>

<tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">是否首页菜单显示
  <div id='hsortrank' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input type="radio" name="is_index_menu_display" value="1" id="is_index_menu_display_yes" <?php if(($list["is_index_menu_display"]) == "1"): ?>checked<?php endif; ?>/><label for="is_index_menu_display_yes">是</label>
    <input type="radio" name="is_index_menu_display" value="0" id="is_index_menu_display_no" <?php if(($list["is_index_menu_display"]) == "0"): ?>checked<?php endif; ?>/><label for="is_index_menu_display_no">否</label>
  </td>
</tr>

  
<tr>
<td width="30%" align="left">栏目属性
        <div id='hmodeltype' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input name='modeltype' type='radio' class='noborder' value='0' onclick="getlink(0)" <?php if(($list["modeltype"]) == "0"): ?>checked='checked'<?php endif; ?>/>最终列表栏目（允许在本栏目发布文档，并生成文档列表）<br/>
    <input name='modeltype' type='radio' class='noborder' value='1' onclick="getlink(0)" <?php if(($list["modeltype"]) == "1"): ?>checked='checked'<?php endif; ?>/>频道封面（栏目本身不允许发布文档）<br/> 
    <input name='modeltype' type='radio' class='noborder' value='2' onclick="getlink(1)" <?php if(($list["modeltype"]) == "2"): ?>checked='checked'<?php endif; ?>/>外部链接（跳转到外部地址）<br/>
    <div style="display:none;" id='getlink'>外部链接地址：<input name="linkurl" type="text" value="<?php echo ($list["linkurl"]); ?>" style="width:200px;"/></div>
  </td>
  </tr>
</table>
</div>







<div id="myTab1_Content1"  style="clear:both;" class='none'>
<table width="100%" border="0"  align="center" cellpadding="3" cellspacing="1" style="margin:5px 0;background:#FFF">

<tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">封面模板
        <div id='htempindex' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input name="tempindex" type="text" id="otempindex" onFocus="htempindex.style.color='blue';" onBlur="htempindex.style.color='#ccc';" value="<?php echo ($list["tempindex"]); ?>" style="width:300px;"/>
  </td>
  </tr>

  <tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">列表模板
        <div id='htemplist' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input name="templist" type="text" id="otemplist" onFocus="htemplist.style.color='blue';" onBlur="htemplist.style.color='#ccc';" value="<?php echo ($list["templist"]); ?>" style="width:300px;"/>
  </td>
  </tr>
  
  
  <tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">文章模板
        <div id='htemparticle' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input name="temparticle" type="text" id="otemparticle" onFocus="htemparticle.style.color='blue';" onBlur="htemparticle.style.color='#ccc';" value="<?php echo ($list["temparticle"]); ?>" style="width:300px;"/>
  </td>
  </tr>
  
  
  <tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">WAP封面模板
        <div id='hwaptempindex' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input name="waptempindex" type="text" id="owaptempindex" onFocus="hwaptempindex.style.color='blue';" onBlur="hwaptempindex.style.color='#ccc';" value="<?php echo ($list["waptempindex"]); ?>" style="width:300px;"/>
  </td>
  </tr>

  <tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">WAP列表模板
        <div id='hwaptemplist' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input name="waptemplist" type="text" id="owaptemplist" onFocus="hwaptemplist.style.color='blue';" onBlur="hwaptemplist.style.color='#ccc';" value="<?php echo ($list["waptemplist"]); ?>" style="width:300px;"/>
  </td>
  </tr>
  
  
  <tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">WAP文章模板
        <div id='hwaptemparticle' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input name="waptemparticle" type="text" id="owaptemparticle" onFocus="hwaptemparticle.style.color='blue';" onBlur="hwaptemparticle.style.color='#ccc';" value="<?php echo ($list["waptemparticle"]); ?>" style="width:300px;"/>
  </td>
  </tr>
  
  
  
  
<tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">SEO标题
        <div id='hseotitle' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input name="seotitle" type="text" id="oseotitle" onFocus="hseotitle.style.color='blue';" onBlur="hseotitle.style.color='#ccc';" value="<?php echo ($list["seotitle"]); ?>" style="width:300px;">
  (栏目模板里用<?php echo htmlentities('<wk:field name="seotitle" />');?>调用) 
  </td>
  </tr>
  
<tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">关键词
        <div id='hkeywords' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
    <input name="keywords" type="text" id="okeywords" onFocus="hkeywords.style.color='blue';" onBlur="hkeywords.style.color='#ccc';" value="<?php echo ($list["keywords"]); ?>" style="width:300px;">
  </td>
  </tr>
  

<tr onMouseOver="this.style.backgroundColor='#EEFCDD';this.style.color='red'" onMouseOut="this.style.backgroundColor='';this.style.color=''">
<td width="30%" align="left">描述
        <div id='hdescription' style="color:#ccc;letter-spacing: 0px;font-size:12px;"></div>
</td>
  <td width="70%" align="left">
  <textarea class='css_textarea' name="description" type="text" id="odescription" onFocus="hdescription.style.color='blue';" onBlur="hdescription.style.color='#ccc';" cols="50" rows="5" ><?php echo ($list["description"]); ?></textarea> 
  </td>
  </tr>
</table>
</div>






<div id="myTab1_Content2"  style="clear:both;" class='none'>
<table width="100%" border="0"  align="center" cellpadding="3" cellspacing="1" style="margin:5px 0;background:#FFF">

<tr>
<td width="100%" align="center">  说明：栏目内容是替代原来栏目单独页的更灵活的一种方式，可在栏目模板中用<?php echo htmlentities('<wk:field name="content" />');?>调用，通常用于企业简介之类的用途。</td>
</tr>
<tr>
  <td width="100%" align="center">
  <textarea class='css_textarea' name="content" type="text" id="ocontent" style="width:100%;height:300px;"><?php echo ($list["content"]); ?></textarea> 
  </td>
  </tr>

</table>
</div>



</div>
<tr class=css_page_list>
      <td height="30" colspan=2 align="center">
      <input name='Submit' type='submit' class="bnt" value=' 保存 '>&nbsp;&nbsp;&nbsp;&nbsp;
       <input name='button' type='button' class="bnt" value=' 返 回 ' onclick="javascript:history.go(-1);"></td>
    </tr>
    <input type="hidden" name="id" value="<?php echo ($list["id"]); ?>"/>
</form>
<div style="text-align:center;margin:10px;">
<hr>
<a href="http://<?php echo C('SOFT_HOMEPAGE');?>" target="_blank"><?php echo C('SOFT_NAME');?></a> Version <font color="red"><?php echo C('SOFT_VERSION');?></font> &copy; <?php echo date("Y");;?> <?php echo tongji();?>版权所有  
</div>
</body>
</html>