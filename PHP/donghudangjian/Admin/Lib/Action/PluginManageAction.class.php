<?php
/***********************************************************
    [WaiKuCms] (C)2011 - 2013 waikucms.com
    
	@function Admin组 插件管理

    @Filename PluginManageAction.class.php $

    @Author pengyong $

    @Date 2013-02-06 14:12:15 $
*************************************************************/
class PluginManageAction extends CommonAction
{	
	//插件列表
    public function index()
	{
		if(isset($_GET['title'])) $this->assign("title",$_GET['title']);
		if(!empty($_GET['status'])) $map['status'] = $_GET['status'];
		$map['id'] = array('gt',0);
		import('@.ORG.Page');
		$install = $this->_get('install',false);
		if($install <> 1)
		{
			$model = M('plugin');
			$count = $model->where($map)->count();
			$fenye = 20;
			$p = new Page($count,$fenye); 
			$list = $model->where($map)->order('pubdate desc')->limit($p->firstRow.','.$p->listRows)->select();
			//echo $model->getLastSql();exit;
			$p->setConfig('prev','上一页');
			$p->setConfig('header','条记录');
			$p->setConfig('first','首 页');
			$p->setConfig('last','末 页');
			$p->setConfig('next','下一页');
			$p->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%<li><span>共<font color='#009900'><b>%totalRow%</b></font>条记录 ".$fenye."条/每页</span></li>");
			$this->assign('page',$p->show());
			$this->assign("list",$list);
			$this->display();
		}
		else
		{
			$model = M('plugin');
			$pluginlist = $model->field('title')->select();
			$plist = array();
			foreach($pluginlist as $v)
			{
				$plist[] = $v['title'];
			}
			//未安装插件
			$path = './Public/Plugin';
			$dir  = File::get_dirs($path);
			foreach($dir['dir'] as $k=>$v)
			{
				if(!in_array($v,$plist) && $v<>'.' && $v <>'..')
				{
					$list['title'] = $v;
					if(file_exists($path.'/'.$v.'/plugin.xml'))
					{
						$tag = simplexml_load_file($path.'/'.$v.'/plugin.xml');
						$list['author'] = (string)$tag->author;
						$list['description'] =  (string)$tag->description;
						$list['copyright'] =  (string)$tag->copyright;
					}
					$list2[] = $list;
				}
			}
			$this->assign("list",$list2);
			$this->display('index2');
		}
		
		
	}
	//插件导入
	public function import()
	{
		$this->display();
	}
	//执行插件导入
	public function doimport()
	{
		$filename = $this->_post('filename',false);
		$checkdir = $this->_post('checkdir',false);
		if(strtolower(substr($filename,-4))<> '.zip') $this->error('仅支持后缀为zip的压缩包');
		$path = ltrim($filename,__ROOT__.'/');
		$filename = substr(ltrim(strrchr($path,'/'),'/'),0,-4);
		$tplpath = './Public/Plugin/'.$filename;
		if(is_dir($tplpath) && $checkdir<>1) $this->error('插件目录已存在!');
		if(!is_file($path)) $this->error('文件包不存在!');
		import('ORG.PclZip');
		$zip =  new PclZip($path);
		$zip->extract(PCLZIP_OPT_PATH,$tplpath); 
		$this->success('操作成功!',U('PluginManage/index?install=1'));
	}
	//插件安装
	public function install()
	{
		$title = $this->_get('title',false);
		if(empty($title)) $this->error('插件名不存在!');
		$data['description'] = '';
		$data['author'] = '';
		$data['copyright'] = '';
		$xmlpath = './Public/Plugin/'.$title.'/plugin.xml';
		if(file_exists($xmlpath))
		{
			$tag = simplexml_load_file($xmlpath);
			$data['author'] = (string)$tag->author; 
			$data['copyright'] = (string)$tag->copyright; 
			$data['description'] = (string)$tag->description; 
		}
		$data['status'] = 1;
		$data['title'] = $title;
		$data['pubdate'] = time();
		$model = M('plugin');
		$model->add($data);
		$path = './Public/Plugin/'.$title.'/admin.php';
		if(file_exists($path))
		{
			set_include_path(__ROOT__);
			include($path);
			call_user_func(array($title.'Plugin','__install'));
		}
		$this->success('操作成功!',U('PluginManage/index?status=0'));
 	}
	
	//卸载插件
	public function uninstall()
	{
		$map['id'] = $this->_get('id',false);
		$model = M('plugin');
		$list = $model->field('title,status')->where($map)->find();
		if(!$list) $this->error('插件信息不存在!');
		if($list['status']==0)$this->error('请先禁用当前插件!');
		$model->where($map)->delete();
		$path = './Public/Plugin/'.$title.'/admin.php';
		if(file_exists($path))
		{
			set_include_path(__ROOT__);
			include($path);
			call_user_func(array($title.'Plugin','__uninstall'));
		}
		$this->success('操作成功!',U('PluginManage/index'));
	}
	
	
	public function del()
	{
		$map['title'] = $this->_get('title',false);
		$model = M('plugin');
		if($model->where($map)->find()) $this->error('请先卸载当前插件!');
		$path  = './Public/Plugin/'.$map['title'];
		File::del_dir($path);
		$this->success('操作成功!',U('PluginManage/index'));
	}
	//插件开启和关闭(ajax处理)
	public function status()
	{
		$map['id'] = $this->_post('id',false);
		$model = M('plugin');
		$list = $model->where($map)->find();
		if(!$list) die('插件信息不存在!');
		$map['status'] =  $list['status']==1 ? 0 :1;
		$model->save($map);
		die('1');
	}
	
	
	public function edit()
	{
		$name = $this->_get('name');
		$path = './Public/Plugin'.'/'.$name; 
		if(empty($name) or strpos($name,'/')) $this->error('参数不正确!');
		if(!is_dir($path)) $this->error('插件目录不存在!');
		$configfile = $path.'/plugin.xml';
		$cachefile = $path.'/plugin.php';
		if(!is_file($cachefile))
		{
			if(!is_file($configfile)) $this->error('当前插件无扩展配置信息!');
			$this->assign("field",$this->parsexml($configfile,''));
		}
		else
		{
			$cache = F('plugin','',$path.'/');
			$this->assign("field",$this->parsexml($configfile,$cache));
		}
		$this->display();
	}
	
	public function parsexml($file,$cache='')
	{
		$xml = simplexml_load_file($file);
		$field = array();
		$field['basic'] = $this->parsethemexml($xml,'basic',$cache);
		$field['advance'] = $this->parsethemexml($xml,'advance',$cache);
		$field['extend'] = $this->parsethemexml($xml,'extend',$cache);
		return $field;
	}
	
	private function parsethemexml($xml,$node,$cache='')
	{
		$field = array();
		foreach($xml->$node->field as $k=>$v)
		{
			$tag['tag'] = (string)$v->attributes()->tag;
			$tag['name'] = (string)$v->attributes()->name;
			$tag['alt'] = (string)$v->attributes()->alt;
			$tag['value'] = (string)$v->attributes()->value;
			$tag['extend'] = (string)$v->attributes()->extend;
			$tag['editor'] = (string)$v->attributes()->editor;
			$tag['fullvalue'] = (string)$v->attributes()->fullvalue;
			$tag['before'] = (string)$v->attributes()->before;
			$tag['after'] = (string)$v->attributes()->after;
			//html直接输出
			if($tag['tag']=='html') $tag['data']  = (string)$v;
			//cache判断
			if(!empty($cache[$tag['name']])) $tag['value'] = $cache[$tag['name']];
			if($tag['editor']=='image')
			{
				$id = uniqid();
				$tag['editor'] = "<script src='".__ROOT__."/Public/Editor/kindeditor/editor.php?fm=true&mode=plugin&type=image&buttonid={$id}&tag={$tag['tag']}&name={$tag['name']}'></script><input type='button' id='{$id}' value='选择图片'/>";
			}
			if($tag['editor']=='file')
			{
				$id = uniqid();
				$tag['editor'] = "<script src='".__ROOT__."/Public/Editor/kindeditor/editor.php?fm=true&mode=plugin&type=file&buttonid={$id}&tag={$tag['tag']}&name={$tag['name']}'></script><input type='button' id='{$id}' value='选择文件'/>";
			}
			if($tag['tag']=='editor')
			{
				$tag['uniqid'] = uniqid();
				$tag['select'] = "<script>var editor_{$tag['uniqid']};KindEditor.ready(function(K) {editor_{$tag['uniqid']} = K.create('#editor_{$tag['uniqid']}',{allowPreviewEmoticons : false,allowFileManager : true,resizeType : 1,items : ['source', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist','insertunorderedlist', '|','table', 'image','insertfile','link','baidumap','fullscreen']});});</script>";
			}
			elseif($tag['tag']=='select')
			{
				if(empty($tag['value'])) $tag['value'] = 0;
				$tag['select'] = '';
				$values = explode(',',$tag['fullvalue']);
				foreach($values as $kk=>$vv)
				{
					if($tag['value']==$kk)
					{	
						$tag['select'].="<option value='".$kk."' selected='selected'>".$vv."</option>";
					}
					else
					{
						$tag['select'].="<option value='".$kk."'>".$vv."</option>";
					}
				}
			}
			elseif($tag['tag']=='radio')
			{
				if(empty($tag['value'])) $tag['value'] = 0;
				$tag['select'] = '';
				$values = explode(',',$tag['fullvalue']);
				foreach($values as $kk=>$vv)
				{
					if($tag['value']==$kk)
					{	
						$tag['select'].="<input name='{$tag['name']}' type='radio' value='".$kk."' class='noborder' checked='checked'/>".$vv;
					}
					else
					{
						$tag['select'].="<input name='{$tag['name']}' type='radio' value='".$kk."' class='noborder'/>".$vv;
					}
				}
			}
			/* 不再支持checkbox,缓存不能保存多值
			elseif($tag['tag']=='checkbox')
			{
				if(empty($tag['value'])) $_tmp1 = 1;
				$tag['select'] = '';
				$values = explode(',',$tag['fullvalue']);
				$varr = explode(",",$tag['value']);
				foreach($values as $kk=>$vv)
				{
					if(in_array($kk,$varr) && $_tmp1 <> 1)
					{	
						$tag['select'].= $vv."<input name='{$tag['name']}' value='".$kk."' type='checkbox' class='noborder' checked/>";
					}
					else
					{
						$tag['select'].=$vv."<input name='{$tag['name']}' value='".$kk."' type='checkbox' class='noborder'/>";
					}
				}
			}
			*/
			$field[] = $tag;
		}
		return $field;
	}
	
	public function doedit()
	{
		$name = $this->_get('name');
		if(empty($name)) $this->error('参数不正确!');
		$tplpath = './Public/Plugin/'.$name.'/';
		if(!is_dir($tplpath)) $this->error('插件目录不存在!');
		F('plugin',$_POST,$tplpath);
		$this->success('操作成功!',U('PluginManage/index'));
	}
	
	public function download()
	{
		$dir = $this->_get('name');
		if(strpos($dir,'/') or empty($dir)) $this->error('参数不正确!');
		$path = './Public/Plugin/'.$dir;
		if(!is_dir($path)) $this->error('目录不存在!');
		import('ORG.PclZip');
		$zippath = $dir.'.zip';
		$zip =  new PclZip($zippath);
		$zip->create($path,PCLZIP_OPT_REMOVE_PATH,$path); 
		//导出下载
		if (file_exists($zippath))
		{
			$filename = $filename ? $filename : basename($zippath);
			$filetype = trim(substr(strrchr($filename, '.'), 1));
			$filesize = filesize($zippath);
			ob_end_clean();
			header('Cache-control: max-age=31536000');
			header('Expires: '.gmdate('D, d M Y H:i:s', time() + 31536000).' GMT');
			header('Content-Encoding: none');
			header('Content-Length: '.$filesize);
			header('Content-Disposition: attachment; filename='.$filename);
			header('Content-Type: '.$filetype);
			readfile($zippath);
			//删除源文件
			unlink($zippath);
			exit;
		}
		else
		{
			$this->error('导出失败!');
		}
	}
	
	//远程安装主题
	function remoteinstall()
	{
		$url = $this->_get('url');
		$ext = strtolower(strrchr($url,'.'));
		$filepath = ltrim(strrchr($url,'/'),'/');
		if($ext <> '.zip') $this->error('远程文件格式必须为.zip');
		$content = fopen_url($url);
		if(empty($content)) $this->error('远程获取文件失败!');
		$filename = substr($filepath,0,-4);
		$tplpath = './Public/Plugin/'.$filename;
		if(is_dir($tplpath)) $this->error('插件目录已存在!');
		File::write_file($filepath,$content);
		import('ORG.PclZip');
		$zip =  new PclZip($filepath);
		$zip->extract(PCLZIP_OPT_PATH,$tplpath); 
		@unlink($filepath);//删除安装文件
		$this->success('操作成功!',U('PluginManage/index?install=1'));
	}
}
?>