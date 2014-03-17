<?php
/***********************************************************
    [WaiKuCms] (C)2011 - 2013 waikucms.com
    
	@function Admin组 初始化基类

    @Filename CommonAction.class.php $

    @Author pengyong $

    @Date 2013-01-07 13:46:23 $
*************************************************************/
class CommonAction extends Action
{
	function _initialize() 
	{
		$uname = cookie('uname');
		$uid = cookie('uid');
		if(empty($uname) or empty($uid))
		{
			jump(U('Public/login'));
		}

		if(session('cmsauth')<>substr(md5(strrev(cookie('uname')).'waikucms'.cookie('uid')),0,10))
		{
			jump(U('Public/login'));
		}
		$model = M('config');
		$list = $model->select();
		foreach($list as $v)
		{
			$GLOBALS[$v['varname']] =$v['value'];
		}
		import('ORG.File');
		import('ORG.Plugin');
	}
}