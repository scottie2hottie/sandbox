<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登陆</title>
<style type="text/css"> 
body,td {margin:0;padding:0;color:#528311;font-size:12px;}
body {background:#A3D862;}
td img {display: block;}
form,input {margin:0;padding:0;}
.lyform {border:1px solid #CADCB2;height:17px;}
</style>
</head>
<body>
<script language="javascript">
function chk(){
		if(document.getElementById('AdminName').value==""){
		alert('用户名不能为空!');
		document.getElementById('AdminName').focus();
		return false;
	}
	if(document.getElementById('adminpwd').value==""){
		alert('密码不能为空!');
		document.getElementById('adminpwd').focus();
		return false;
	}
	if(document.getElementById('verify').value==""){
		alert('验证码不能为空!');
		document.getElementById('verify').focus();
		return false;
	}
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="background:url(__PUBLIC__/Admin/images/login1.jpg) left 1px repeat-x;"><table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="261" height="1" border="0" alt="" /></td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="231" height="1" border="0" alt="" /></td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="53" height="1" border="0" alt="" /></td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="81" height="1" border="0" alt="" /></td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="66" height="1" border="0" alt="" /></td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="68" height="1" border="0" alt="" /></td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="243" height="1" border="0" alt="" /></td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="1" height="1" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="7">&nbsp;</td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="1" height="173" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="5">&nbsp;</td>
        <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="__PUBLIC__/Admin/images/t2_r1_c1.jpg" width="102" height="72" />            </td>
            <td><img src="__PUBLIC__/Admin/images/t2_r1_c2.jpg" width="53" height="72" /></td>
            <td><img src="__PUBLIC__/Admin/images/t2_r1_c3.jpg" width="82" height="72" /></td>
            <td><img src="__PUBLIC__/Admin/images/t2_r1_c4.jpg" width="135" height="72" /></td>
            <td><img src="__PUBLIC__/Admin/images/t2_r1_c5.jpg" width="72" height="72" /></td>
            <td><img src="__PUBLIC__/Admin/images/t2_r1_c6.jpg" width="55" height="72" /></td>
          </tr>
        </table></td>
        <td rowspan="5">&nbsp;</td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="1" height="72" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="3" background="__PUBLIC__/Admin/images/login_r3_c2.jpg">&nbsp;</td>
        <td colspan="4" rowspan="2" background="__PUBLIC__/Admin/images/login_r3_c3.jpg">
        <form name="form1" method="post" action="<?php echo U('Public/checklogin');?>" onsubmit="return chk();">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="108" background="__PUBLIC__/Admin/images/login_r3_c3.jpg"><table width="200" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
              <tr>
                <td width="77" height="25" align="center">用户名</td>
                <td width="123" colspan="2"><input name="username" type="text" class="lyform" id="AdminName"   style="width:100px;" /></td>
              </tr>
              <tr>
                <td height="25" align="center">密　码</td>
                <td colspan="2"><input name="password" type="password" class="lyform" id="adminpwd" style="width:100px;" /></td>
              </tr>
			  <?php if(C('SOFT_VERIFY')<>1):?>
              <tr>
                <td height="25" align="center">验证码</td>
                <td><input name="verify" type="text" class="lyform"  id="verify" size="5" maxlength="5" style="text-transform:uppercase;"/></td>
                <td><img src="<?php echo U('Public/verify');?>" alt="看不清楚请点击刷新验证码" style="cursor : pointer;width:78px;height:18px;border:1px solid #ccc;margin-left:2px;" onclick="show(this)"/></td>
              </tr>
			  <?php endif;?>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="__PUBLIC__/Admin/images/login_r4_c3.jpg" width="53" height="22" /></td>
                <td><input type="image" src="__PUBLIC__/Admin/images/login_r4_c4_r1_c1.jpg" width="40" height="22" name="button" id="button" value="提交" /></td>
                <td><img src="__PUBLIC__/Admin/images/login_r4_c4_r1_c2.jpg" width="41" height="22" onClick="document.form1.reset()" style="cursor:pointer;"/></td>
                <td><img src="__PUBLIC__/Admin/images/login_r4_c5.jpg" width="66" height="22" /></td>
                <td><img src="__PUBLIC__/Admin/images/login_r4_c6.jpg" width="68" height="22" /></td>
              </tr>
            </table></td>
          </tr>
        </table>
        </form>
        </td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="1" height="108" border="0" alt="" /></td>
      </tr>
      <tr>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="1" height="22" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="4" valign="top" background="__PUBLIC__/Admin/images/login_r5_c3.jpg" style="padding-top:27px;"><?php echo C('SOFT_NAME');?>&nbsp;<?php echo C('SOFT_VERSION');?></td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="1" height="231" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="5"><img name="login_r6_c2" src="__PUBLIC__/Admin/images/login_r6_c2.jpg" width="499" height="7" border="0" id="login_r6_c2" alt="" /></td>
        <td><img src="__PUBLIC__/Admin/images/spacer.gif" width="1" height="7" border="0" alt="" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<script>
function show(obj){
obj.src="<?php echo U('Public/verify?random=1');?>"+ Math.random();
}
</script>