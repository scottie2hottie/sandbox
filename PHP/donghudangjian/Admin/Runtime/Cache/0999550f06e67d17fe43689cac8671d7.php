<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>admin</title>
<link href="__PUBLIC__/Admin/images/Admin_css.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="__PUBLIC__/Admin/images/myfav.ico" type="image/x-icon" />
<script type="text/javascript" src="/Public/Admin/js/admin.js"></script><script type="text/javascript" src="/Public/Admin/js/Ajax.js"></script><script type="text/javascript" src="/Public/Admin/js/Jquery.js"></script> 
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/jquery.artDialog.js?skin=green"></script>
<script charset="utf-8" src="__PUBLIC__/Common/artDialog/extend.js"></script>
<script>
$(function($) {
	var notice = '<?php echo cookie("updatenotice");?>';
	 $.post("<?php echo U('Update/index');?>", { version: "<?php echo substr(C('SOFT_VERSION'),-8);?>"},
	function(data){	
	if(data.msg==1 && notice !=1)
	{
		jconfirm('系统检测到有新版本!是否更新?<br/>当前版本:<?php echo C('SOFT_VERSION');?>&nbsp;&nbsp;最新版本:'+data.version,'<?php echo U('Update/update');?>');
	}
   });
   
   $("#update").click( function () {
   art.dialog.tips('正在检测新版本...',60);
	//$('#update').fadeOut("slow");
	 $.post("<?php echo U('Update/index');?>", { version: "<?php echo substr(C('SOFT_VERSION'),-8);?>"},
	function(data){
    if(data.msg==0)
	{
		art.dialog.tips('已经是最新版本!');
	}	
	if(data.msg==1)
	{
		jconfirm('系统检测到有新版本!是否更新?<br/>当前版本:<?php echo C('SOFT_VERSION');?>&nbsp;&nbsp;最新版本:'+data.version,'<?php echo U('Update/update');?>');
	}
	if(data.msg==2)
	{
		art.dialog.tips('检测更新失败!');
	}
   });
   
   
   });
});
artDialog.updatesystem = function (str,url) {
    
    return artDialog({
		title:'歪酷CMS系统在线更新',
        id: 'updatesystem',
        fixed: true,
        lock: true,
        opacity: .1,
        content: [
            '<div style="margin-bottom:10px;font-size:12px" id="art_content">',
                str,
            '</div>',
            '<div>',
                '备份整站: <input type="checkbox"  name="art_backupall" id="art_backupall"/>&nbsp;&nbsp;备份数据库: <input type="checkbox"  name="art_backupsql" id="art_backupsql"/><br/>',
				'<div style="margin-bottom:5px;margin-top:5px;font-size:12px">系统更新也会有意外,推荐备份数据!整站备份不包括Public目录,Public目录请自行备份!</div>',
            '</div>',
            ].join(''),
        init: function () {
		$.post("<?php echo U('Update/applycookie');?>");
        },
        ok: function (here) {
			if($('#art_backupall').attr('checked')=='checked') url = url + '&backupall=1';
			if($('#art_backupsql').attr('checked')=='checked') url = url + '&backupsql=1';
			window.location.href=url;
			art.dialog.tips('请勿关闭浏览器,系统正在更新中...',60);
        },
        cancel: function(here)
		{
			var list = art.dialog.list;
			for (var i in list) {
			list[i].close();
			};
			return true;
		}
    });
};
function jconfirm(str,url)
{
   artDialog.updatesystem(str,url);
}

function hiddena(i)
{
	if(i==0)
	{
		$('.hiddena').fadeIn("slow");
		$('#adda').fadeOut("slow");
		$('#unadda').fadeIn("slow");
	}
	if(i==1)
	{
		$('#unadda').fadeIn("slow");
		$('.hiddena').fadeOut("slow");
		$('#adda').fadeIn("slow");
	}
}
function hiddenb(i)
{
	if(i==0)
	{
		$('.hiddenb').fadeIn("slow");
		$('#addb').fadeOut("slow");
		$('#unaddb').fadeIn("slow");
	}
	if(i==1)
	{
		$('#unaddb').fadeIn("slow");
		$('.hiddenb').fadeOut("slow");
		$('#addb').fadeIn("slow");
	}
}
</script>
</head>
<body>
<table width="98%" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15" height="30"><img src="__PUBLIC__/Admin/images/tab_03.gif" width="15" height="30" /></td>
        <td width="24" background="__PUBLIC__/Admin/images/tab_05.gif"><img src="__PUBLIC__/Admin/images/311.gif" width="16" height="16" /></td>
        <td width="1373" background="__PUBLIC__/Admin/images/tab_05.gif" class="title1">系统信息</td>
        <td width="14"><img src="__PUBLIC__/Admin/images/tab_07.gif" width="14" height="30" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="9" background="__PUBLIC__/Admin/images/tab_12.gif">&nbsp;</td>
        <td bgcolor="#f3ffe3">
		
		<table border="0" align="center" cellpadding="3" cellspacing="1" class="admintable1" style="margin-top:5px;margin-bottom:5px;">
            <tr>
				<td width="33%" align="left" bgcolor="#FFFFFF" style="height:30px;">程序名称:<font color='green'><?php echo C('SOFT_NAME');?></font></td>
				<td width="33%" align="left" bgcolor="#FFFFFF" style="height:30px;">程序版本:<font color='green'><?php echo C('SOFT_VERSION');?><img alt='在线升级' style="cursor:pointer;"  id="update" src="__PUBLIC__/Admin/images/update.gif" /></font></td>
				<td width="33%" align="left" bgcolor="#FFFFFF" style="height:30px;">程序作者:<font color='green'><?php echo C('SOFT_AUTHOR');?> <a href='http://bbs.waikucms.com/thread-74-1-1.html' title='捐赠开发' target='_blank'><img src='__PUBLIC__/Admin/images/donate.gif'/></a></font></td>
            </tr>
			 <tr>
				<td width="33%" align="left" bgcolor="#FFFFFF" style="height:30px;">程序授权:<font color='red'>未授权,请联系授权!<a href="http://www.waikucms.com/view-14.html" title='购买授权'><img src="__PUBLIC__/Admin/images/shouquan.gif"/></a></font></td>
				<td width="33%" align="left" bgcolor="#FFFFFF" style="height:30px;">官方社区:<font color='green'><a href="http://bbs.waikucms.com" target="_blank">bbs.waikucms.com</a></font></td>
				<td width="33%" align="left" bgcolor="#FFFFFF" style="height:30px;">定制开发:<font color='green'>Tel:18040573293 QQ:634150845<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=634150845&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:634150845:45" alt="点击这里给我发消息" title="点击这里给我发消息"></a></font></td>
            </tr>
          </table>
		  
		  
          <table border="0" align="center" cellpadding="3" cellspacing="1" class="admintable1">
            <tr>
              <td width="33%" align="left" bgcolor="#FFFFFF" style="height:30px;">模型：
				<?php if(is_array($arcmodellist)): $i = 0; $__LIST__ = $arcmodellist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Archive/add?modelid='); echo ($vo["id"]); ?>"><?php echo ($vo["typename"]); ?></a>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
			  </td>
              <td width="33%" align="left" bgcolor="#FFFFFF">栏目总数：<font color="red"><?php echo ($num["typenum"]); ?></font> </td>
              <td align="left" bgcolor="#FFFFFF"><span style="float:right" id='adda'><img style="cursor:pointer;" alt='展开' onclick='hiddena(0)'  src='__PUBLIC__/Admin/images/add.gif'/></span>文档总数：<font color="red"><?php echo ($num["totalnum"]); ?></font></td>
            </tr>
			
			<tr class='hiddena' style='display:none;'>
              <td width="33%" align="left" bgcolor="#FFFFFF" style="height:30px;">已审核：<font color="red"><?php echo ($num["postednum"]); ?></font></td>
              <td width="33%" align="left" bgcolor="#FFFFFF">未审核：<font color="red"><?php echo ($num["unpostednum"]); ?></font> </td>
              <td align="left" bgcolor="#FFFFFF">回收站：<font color="red"><?php echo ($num["recyclenum"]); ?></font></td>
            </tr>
			
			
            <tr class='hiddena' style='display:none;'>
              <td width="33%" align="left" bgcolor="#FFFFFF" style="height:30px;">今日新增：<font color="red"><?php echo ($num["todaynum"]); ?></font>  </td>
              <td width="33%" align="left" bgcolor="#FFFFFF">最近一周：<font color="red"><?php echo ($num["weeknum"]); ?></font> </td>
              <td align="left" bgcolor="#FFFFFF"><span style="float:right" id='unadda'><img style="cursor:pointer;" alt='收起' onclick='hiddena(1)'  src='__PUBLIC__/Admin/images/unadd.gif'/></span>最近一月：<font color="red"><?php echo ($num["monthnum"]); ?></font></td>
            </tr>
          </table>
		  
		  <table border="0" align="center" cellpadding="3" cellspacing="1" class="admintable1" style="margin-top:5px;">
            <tr>
			<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 3 );++$i;?><td width="33%" align="left" bgcolor="#FFFFFF" style="height:30px;"><?php if(($i) == "3"): ?><span style="float:right" id='addb'><img style="cursor:pointer;" alt='展开' onclick='hiddenb(0)' src='__PUBLIC__/Admin/images/add.gif'/></span><?php endif; if(($i) == "12"): ?><span style="float:right" id='unaddb'><img style="cursor:pointer;" alt='收起' onclick='hiddenb(1)' src='__PUBLIC__/Admin/images/unadd.gif'/></span><?php endif; echo ($key); ?>：<font color="red"><?php echo ($v); ?></font></td>
			  <?php if(($mod) == "2"): ?></tr><tr class="hiddenb" style='display:none;'><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </tr>
          </table>
		  
		  
          
          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="50%"><table border="0" cellspacing="2" cellpadding="3"  align="left" class="admintable1" style="margin-top:5px;width:99%;">
                <tr>
                  <td align="left" class="admintitle">系统缓存清理</td>
                </tr>
                <tr>
                  <td height="80" bgcolor="#FFFFFF" style="text-align:left;height:75px;line-height:22px;">注意：此操作用于清空<font color="red"><b>Web,Admin,User</b></font>下runtime文件夹,更新系统配置或修改系统模板后请及时更新缓存
                    <form id="form1" name="form1" method="post" action="<?php echo U('Clear/index');?>">
                        <input type="submit" name="button" id="button" value="开始清理"  style="background:#ffffff;"/>
                    </form></td>
                </tr>
              </table></td>
              <td><table border="0" cellspacing="2" cellpadding="3" align="right" class="admintable1" style="margin-top:5px;width:99%">
                <tr>
                  <td align="left" class="admintitle">快捷管理</td>
                </tr>
                <tr>
                  <td height="80" bgcolor="#FFFFFF" style="text-align:left;height:75px;line-height:22px;text-align:center;">
				  <input type="button" name="button" value="广告管理" class="bnt" onClick="window.location.href='<?php echo U('Ad/index');?>'" />&nbsp;&nbsp;
                   <input type="button" name="button" value="专题管理" class="bnt" onClick="window.location.href='<?php echo U('Special/index');?>'" />&nbsp;&nbsp;
                   <input type="button" name="button" value="主题管理" class="bnt" onClick="window.location.href='<?php echo U('Tpl/index');?>'" />&nbsp;&nbsp;
                    <input type="button" name="button" value="插件管理" class="bnt" onClick="window.location.href='<?php echo U('PluginManage/index');?>'" />&nbsp;&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        <td width="9" background="__PUBLIC__/Admin/images/tab_16.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="29"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15" height="29"><img src="__PUBLIC__/Admin/images/tab_20.gif" width="15" height="29" /></td>
        <td background="__PUBLIC__/Admin/images/tab_21.gif">&nbsp;</td>
        <td width="14"><img src="__PUBLIC__/Admin/images/tab_22.gif" width="14" height="29" /></td>
      </tr>
    </table></td>
  </tr>
</table>
 
</body>
</html>