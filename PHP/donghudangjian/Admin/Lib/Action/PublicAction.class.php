<?php
/***********************************************************
    [WaiKuCms] (C)2011 - 2013 waikucms.com
    
	@function Admin组 公共模块,不需要做登陆判断

    @Filename PublicAction.class.php $

    @Author pengyong $

    @Date 2012-11-04 16:43:06 $
*************************************************************/
class PublicAction extends Action
{
	public function login()
	{
		$this->display();
	}
	
	public function checklogin()
	{
		if(strtolower($_SESSION['verify']) <> strtolower($_POST['verify']) && C('SOFT_VERIFY')<>1) 
		{
			$this->error('验证码错误！');
		}
		$model = M('admin');
		$data['name'] = trim($_POST['username']);
		$list = $model->where($data)->find();
		if(!$list)
		{
			$this->error('用户名不存在!');
		}
		if(strcmp(xmd5($_POST['password']),$list['password'])<>0)
		{
			$this->error('用户密码错误!');
		}
		cookie("uid", $list['id'],time()+3600);
		cookie("uname", $list['name'],time()+3600);
		$str = 'waikucms';
		session('cmsauth',substr(md5(strrev($list['name']).$str.$list['id']),0,10)); 
		$data['id'] = $list['id'];
		
		$data['loginip'] = get_client_ip();
		
		$data['logintime'] = time();
		
		$model->save($data);
		
		$this->success('登陆成功!正在进入系统~~',U('Index/index'));
	}
	public function loginout()
	{
		cookie('uname',null);
		cookie('uid',null);
		session('cmsauth',null); 
		$this->success('登出成功!',U('Public/login'));
	}
		
	public function verify()
	{
		import("ORG.Verify");
		$verify = new Verify();
		$verify->display();
	}
	//uploadify 单独上传验证
	public function doupload()
	{
		if(xmd5(C('COOKIE_PREFIX')) <> $_POST['uploadify'])
		{
			echo 0; die();
		}
		$dirname = isset($_GET['dirname']) ? $_GET['dirname']:'';
		$savePath = empty($dirname) ? './':'./'.trim($dirname,'/').'/';
		//处理文件名,获取原始文件名
		$filename = $_FILES['file_upload']['name'];
		import('ORG.UploadFile');
		$upload = new UploadFile(); 
		$upload->savePath = $savePath;
		$upload->saveRule = $filename;
		$upload->uploadReplace = true; 
		if($upload->upload())
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
}