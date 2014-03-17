<?php
/***********************************************************
    [WaiKuCms] (C)2011 - 2013 waikucms.com
    
	@function Admin组 wap模板管理组

    @Filename WapManageAction.class.php $

    @Author pengyong $

    @Date 2013-01-15 13:57:23 $
*************************************************************/

class WapManageAction extends TplManageAction
{

	public function index()
	{
		$nowdir = isset($_GET['dir']) ? urldecode($_GET['dir']):'';
		$lastdir = empty($nowdir) ? '' :substr($nowdir ,0,strlen($nowdir) - strlen(strrchr($nowdir,'/')));
		$this->assign("lastdir",$lastdir);
		$base = './Public/Wap';
		$root = empty($nowdir) ? $base: $base.'/'.$nowdir;
		$dir =  File::get_dirs($root);
		$list = array();
		foreach($dir['dir'] as $v)
		{
			if($v <> '.' && $v <> '..')
			{
				$a['filename'] = $v;
				$a['type'] = 'dir';
				$a['filesize'] = File::get_size($root.'/'.$v);
				$b = stat($root.'/'.$v);
				$a['atime'] = $b['atime'];
				$a['mtime'] = $b['mtime'];
				$a['ctime'] = $b['ctime'];
				$a['is_readable'] = @is_readable($root.'/'.$v);
				$a['is_writeable'] = @is_writeable($root.'/'.$v);
				$a['nowdir'] = urlencode($nowdir.'/'.$v);
				$a['empty_dir'] = File::empty_dir($root.'/'.$v);
				$list[] = $a;
			}
		}
		foreach($dir['file'] as $v)
		{
			$a['filename'] = $v;
			$a['type'] = 'file';
			$a['ext'] = substr(strrchr($v,'.'),1);
			$b = stat($root.'/'.$v);
			$a['atime'] = $b['atime'];
			$a['mtime'] = $b['mtime'];
			$a['filesize'] = $b['size'];
			$a['ctime'] = $b['ctime'];
			$a['is_readable'] = @is_readable($root.'/'.$v);
			$a['is_writeable'] = @is_writeable($root.'/'.$v);
			$a['nowdir'] = urlencode($nowdir.'/'.$v);
			$list[] = $a;
		}
		//dump($list); exit;
		$this->assign("list",$list);
		$this->display();
	}	

	public function add()
	{
		$nowdir = isset($_GET['dir']) ? urldecode($_GET['dir']):'';
		$nowpath =  './Public/Wap'.$nowdir;
		$this->assign("nowpath",$nowpath);
		$this->display('add');
	}	
	
	public function doadd()
	{
		$from = $_POST['from'];
		$nowpath = $_POST['nowpath'];
		$filename = $_POST['filename'];
		$content = $_POST['content'];
		$type = $_POST['type'];
		$ext = $_POST['ext'];
		if($type=='file')
		{
			if(empty($filename)) $this->error('文件名不能为空!');
			if(strpos($filename,'.') or strpos($filename,'/') or strpos($filename,'"') or strpos($filename,"'") or strpos($filename,"?")) $this->error('文件名称不能包含点,单双引号,问号等字符');
			$filepath = $nowpath.'/'.$filename.$ext;
			MAGIC_QUOTES_GPC==true ? File::write_file($filepath,stripslashes($content)) : File::write_file($filepath,$content);
		}
		if($type=='dir')
		{
			$filepath = $nowpath.'/'.$filename;
			if(empty($filename)) $this->error('文件夹名不能为空!');
			if(strpos($filename,'.') or strpos($filename,'/') or strpos($filename,'"') or strpos($filename,"'") or strpos($filename,"?")) $this->error('文件夹名称不能包含点,单双引号,问号等字符');
			mkdir($filepath);
		}
		$from = empty($_POST['from']) ? U('WapManage/index') : $_POST['from'];
		$this->success('操作成功!',$from);
	}
	
	public function edit()
	{
		$nowdir = isset($_GET['dir']) ? urldecode($_GET['dir']):'';
		if(empty($nowdir)) $this->error('参数不正确!');
		$file = './Public/Wap'.$nowdir;
		$this->assign('filename',$file);
		if(!file_exists($file)) $this->error('文件不存在！');
		$this->assign("content",File::read_file($file));
		C('TMPL_PARSE_STRING.__ROOT__','__ROOT__');
		C('TMPL_PARSE_STRING.__APP__','__APP__');
		C('TMPL_PARSE_STRING.__PUBLIC__','__PUBLIC__');
		$this->display();
	}
	
	public function doedit()
	{
		$filename = $_POST['filename'];
		$content = $_POST['content'];
		if(empty($filename)) $this->error('文件路径不正确!');
		MAGIC_QUOTES_GPC==true ? File::write_file($filename,stripslashes($content)) : File::write_file($filename,$content);
		$from = empty($_POST['from']) ? U('WapManage/index') : $_POST['from'];
		$this->success('操作成功!',$from);
	}
	
	public  function del()
	{
		$nowdir = isset($_GET['dir']) ? urldecode($_GET['dir']):'';
		if(empty($nowdir)) $this->error('参数不正确!');
		$file = './Public/Wap'.$nowdir;
		if(!file_exists($file)) $this->error('文件不存在！');
		if(is_dir($file))
		{
			File::del_dir($file);
		}
		else
		{
			@unlink($file);
		}
	}
}