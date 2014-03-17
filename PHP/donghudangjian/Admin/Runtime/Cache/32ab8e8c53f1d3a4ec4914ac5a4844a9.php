<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>无标题文档</title>
<style type="text/css"> 
<!--
body,td,th,div,a,h3,textarea,input{
  font-family: "宋体", "Times New Roman", "Courier New";
  font-size: 12px;
  color: #333333;
}
html{
  overflow-x:hidden;
  overflow-y:hidden;
}
.menuHtml{
  overflow-y:auto;
}
body {
  background-color: #FFFFFF;
  margin: 0px;
}
img{
  border: none;
}
form{
  margin: 0px;
  padding: 0px;
}
input{
  color: #000000;
  height: 22px;
  vertical-align: middle;
}
textarea{
  width: 80%;
  font-weight: normal;
  color: #000000;
}
a{
  text-decoration: underline;
  color: #666666;
}
a:hover{
  text-decoration: none;
}
.menuDiv,.menuDiv1{
  background-color: #FFFFFF;
}
.menuDiv1{
  postion:relative;bottom:0px;top:50;
}
.menuDiv h3,.menuDiv1 h3{
  font:bold 14px "Microsoft Yahei",sans-serif;color:#4B8303;
  padding-top: 5px;
  padding-right: 5px;
  padding-bottom: 5px;
  padding-left: 10px;
  background:url(__PUBLIC__/Admin/images/tab_05.gif);
  margin: 0px;cursor:pointer;
}
.menuDiv1 h3 {color:#ff0000;}
.menuDiv ul,.menuDiv1 ul{
  margin: 0px;
  padding: 0px;
  list-style-type: none;
}
.menuDiv ul li,.menuDiv1 ul li{
  color: #666666;
  background:url(__PUBLIC__/Admin/images/arrow_082.gif) 14px 6px no-repeat;background-color:#EEFCDD;
  padding: 5px 5px 5px 30px;
  font-size: 12px;
  height: 16px;border-bottom:1px solid #fff;
}
.menuDiv ul li a,.menuDiv1 ul li a{
  color: #666666;
  text-decoration: none;
}
.menuDiv ul li a:hover,.menuDiv1 ul li a:hover{ 
  color: #ff0000;text-decoration: underline;
}
.red{
  color:#FF0000;
}

-->
</style>
<script src="__PUBLIC__/Admin/js/menuswitch.js"></script>
</head>

<body>
<table width="177" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
      <tr>
        <td height="28"><img src="__PUBLIC__/Admin/images/main_21.gif" border="0" usemap="#Map" /></td>
      </tr>
      <tr>
        <td style="background:url(__PUBLIC__/Admin/images/main_23.gif) left top repeat-x;height:80px"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="45"><div align="center"><a href="<?php echo U('Config/index');?>" target="main"><img src="__PUBLIC__/Admin/images/main_26.gif" name="Image1" width="40" height="40" border="0" /></a></div></td>
            <td><div align="center"><a href="<?php echo U('Admin/index');?>" target="main"><img src="__PUBLIC__/Admin/images/main_28.gif" name="Image2" width="40" height="40" border="0" id="Image2" /></a></div></td>
            <td><div align="center"><a href="<?php echo U('Archive/index');?>" target="main"><img src="__PUBLIC__/Admin/images/main_31.gif" name="Image3" width="40" height="40" border="0" id="Image3" /></a></div></td>
          </tr>
          <tr>
            <td height="25"><div align="center" class="STYLE2"><a href="<?php echo U('Config/index');?>" target="main">网站配置</a></div></td>
            <td><div align="center" class="STYLE2"><a href="<?php echo U('Admin/index');?>" target="main">管理员</a></div></td>
            <td><div align="center" class="STYLE2"><a href="<?php echo U('Archive/index');?>" target="main">内容管理</a></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td style="border-top:1px solid #B0D561;">
    <div class="menuDiv"> 
    <h3>模型分类</h3>     
    <ul>      
      <li><a href="<?php echo U('Arcmodel/index');?>&from=frame" target="main">模型管理</a> | <a href="<?php echo U('Arcmodel/import');?>&from=frame" target="main">导入模型</a></li>
      <li><a href="<?php echo U('Type/index');?>&from=frame" target="main">栏目管理</a> | <a href="<?php echo U('Type/add');?>&from=frame" target="main">添加栏目</a></li>
      <li><a href="<?php echo U('Type/index_display_manage');?>&from=frame" target="main">首页显示设置</a></li>
    </ul>
  </div>
  <div class="menuDiv"> 
    <h3>内容管理</h3>     
    <ul> 
    <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Archive/index?modelid='); echo ($vo["id"]); ?>&from=frame" target="main"><?php echo ($vo["typename"]); ?>管理</a> | <a href="<?php echo U('Archive/add?modelid='); echo ($vo["id"]); ?>&from=frame" target="main">添加<?php echo ($vo["typename"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php else: ?>
      <li><a href="<?php echo U('Archive/index?modelid=1');?>&from=frame" target="main">文档管理</a> | <a href="<?php echo U('Archive/add?modelid=1');?>&from=frame" target="main">添加文档</a></li><?php endif; ?>
  
    </ul>
  </div>
    <div class="menuDiv"> 
    <h3>会员管理</h3>     
    <ul>      
    <li><a href="<?php echo U('Member/index');?>&from=frame" target="main">会员管理</a> | <a href="<?php echo U('Member/rank');?>&from=frame" target="main">会员等级</a></li>
    </ul>
  </div>
  <div class="menuDiv"> 
    <h3>辅助功能</h3>     
    <ul>      
    <li><a href="<?php echo U('Ad/index');?>&from=frame" target="main">广告管理</a> | <a href="<?php echo U('Special/index');?>&from=frame" target="main">专题管理</a></li>
    <li><a href="<?php echo U('ArticleLink/index');?>&from=frame" target="main">文章内链</a> | <a href="<?php echo U('Vote/index');?>&from=frame" target="main">投票管理</a></li>
    <li><a href="<?php echo U('Friendlink/index');?>&from=frame" target="main">友情链接</a> | <a href="<?php echo U('Tag/index');?>&from=frame" target="main">TAG关键词</a></li>
    </ul>
  </div>
  <div class="menuDiv"> 
    <h3>数据安全</h3>     
    <ul>      
    <li><a href="<?php echo U('Backup/index');?>&from=frame" target="main">数据备份</a> | <a href="<?php echo U('Backup/restore');?>&from=frame" target="main">数据还原</a></li>
    <li><a href="<?php echo U('FileManage/index');?>&from=frame" target="main">文件管理</a> | <a href="<?php echo U('Update/manage');?>&from=frame" target="main">更新管理</a></li>
    </ul>
  </div>
  <div class="menuDiv"> 
    <h3>扩展中心</h3>     
    <ul>      
    <li><a href="<?php echo U('PluginManage/index');?>&from=frame" target="main">插件管理</a> | <a href="<?php echo U('PluginManage/import');?>" target="main">安装插件</a></li>
    <li><a href="<?php echo U('Tpl/index');?>&from=frame" target="main">主题管理</a> | <a href="<?php echo U('Wap/index');?>&from=frame" target="main">WAP主题</a></li>
    <li><a href="<?php echo U('Market/plugin');?>" target="main">插件市场</a> | <a href="<?php echo U('Market/theme');?>" target="main">主题市场</a></li>
    </ul>
  </div>

    <div class="menuDiv1"> 
    <h3>版权信息</h3> 
    <ul>      
    <li><?php echo C('SOFT_NAME');?> 版权所有</li>
    <li>官方网站:<a href="http://<?php echo C('SOFT_HOMEPAGE');?>" target="_blank"><?php echo C('SOFT_HOMEPAGE');?></a></li>
    <li>作者:<?php echo C('SOFT_AUTHOR');?> QQ:<?php echo C('SOFT_CONTRACT');?></li>
    </ul>
  </div>
          </td>
      </tr>
    </table></td>
  </tr>
</table>


<map name="Map" id="Map">
<area shape="rect" coords="26,5,91,22" href="<?php echo U('Index/main');?>" target="main" alt="后台首页" />
<area shape="rect" coords="94,5,157,24" href="<?php echo U('Public/loginout');?>" target="_top" alt="安全退出" />
</map><script language="javascript">
  var mSwitch = new MenuSwitch("menuDiv");
  mSwitch.setDefault(1);
  mSwitch.setPrevious(false);
  mSwitch.init();
</script></body>
</html>