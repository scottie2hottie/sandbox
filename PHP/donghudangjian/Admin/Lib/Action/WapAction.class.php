<?php
/***********************************************************
    [WaiKuCms] (C)2011 - 2013 waikucms.com
    
	@function Admin组 主题管理

    @Filename WapAction.class.php $

    @Author pengyong $

    @Date 2013-01-06 15:01:03 $
*************************************************************/
class WapAction extends CommonAction
{
	public function index()
	{
		//遍历目录获取模板信息
		$tplarray = array();
		$defaulttpl =array();
		$path = './Public/Wap/';
		$tpl = File::get_dirs($path);
		$tpl['dir'] = array_values($tpl['dir']);
		foreach($tpl['dir'] as $k=>$v)
		{
			if($v<>'.' && $v <>'..')
			{
				$tplpath = $path.$v.'/';
				if($GLOBALS['cfg_wap_tpl_default']==$v)
				{
					if(is_file($tplpath.'theme.png')) $default['thumb'] = $tplpath.'theme.png';
					if(is_file($tplpath.'theme.jpg')) $default['thumb'] = $tplpath.'theme.jpg';
					if(is_file($tplpath.'theme.gif')) $default['thumb'] = $tplpath.'theme.gif';
					$default['path'] = $tplpath;
					$default['name'] = $v;
				}
				else
				{
					if(is_file($tplpath.'theme.png')) $tplarray[$k]['thumb'] = $tplpath.'theme.png';
					if(is_file($tplpath.'theme.jpg')) $tplarray[$k]['thumb'] = $tplpath.'theme.jpg';
					if(is_file($tplpath.'theme.gif')) $tplarray[$k]['thumb'] = $tplpath.'theme.gif';
					$tplarray[$k]['path'] = $tplpath;
					$tplarray[$k]['name'] = $v;
					$tplarray[$k]['sql'] = is_file($tplpath.'demo.sql') ? '' : 'disabled=disabled';
					$plist = File::get_dirs($tplpath.'plugin');
					$tplarray[$k]['plugin'] = empty($plist['file']) ? 'disabled=disabled' : '';
				}
			}
		}
		$this->assign("defaultlist",$default);
		$this->assign("list",$tplarray);
		$this->display();
	}
	
	public function setdefault()
	{
		$name = $this->_get('name');
		$demo = $this->_get('demo');
		$backup = $this->_get('backup');
		$plugin = $this->_get('plugin');
		if(empty($name)) $this->error('参数不正确!');
		$model = M('config');
		$map['varname'] = 'cfg_wap_tpl_default';
		$list = $model->field('id')->where($map)->find();
		$map['id'] = $list['id'];
		$map['value'] = $name;
		$model->save($map);
		if($demo==1)
		{
			//检测演示数据安装
			$demosqlpath = './Public/Wap/'.$name.'/demo.sql';
			if(file_exists($demosqlpath))
			{
				$rs = new Model();
				$sql = File::read_file($demosqlpath);
				$sql = str_replace("\r\n", "\n", $sql); 
				foreach(explode(";\n", trim($sql)) as $query)
				{
					$rs->query(trim($query));
				}
			}
		}
		if($backup==1)
		{
			//数据备份
			global $cfg_wap_tpl_default;
			$rs = new Model();
			$list = $rs->query("SHOW TABLES FROM "."`".C('DB_NAME')."`");
			$filesize = 2048;
			$file ='./Public/Backup/';
			$random = mt_rand(1000, 9999);
			$sql = ''; 
			$p = 1;
			foreach($list as $k => $v)
			{
				$table = current($v);
				//仅备份当前系统的数据库表
				$prefix = C('DB_PREFIX');
				if(substr($table,0,strlen($prefix)) == $prefix)
				{
					$rs = D(str_replace(C('DB_PREFIX'),'',$table));
					$array = $rs->select();
					$sql.= "TRUNCATE TABLE `$table`;\n";
					foreach($array as $value)
					{
						$sql.= $this->insertsql($table, $value);
						if (strlen($sql) >= $filesize*1000) 
						{
							$filename = $file.'theme_'.$cfg_df_style.'_'.date('Ymd').'_'.$random.'_'.$p.'.sql';
							File::write_file($filename,$sql);
							$p++;
							$sql='';
						}
					}
				}
			}
			if(!empty($sql))
			{
				$filename = $file.'waptheme_'.$cfg_wap_tpl_default.'_'.date('Ymd').'_'.$random.'_'.$p.'.sql';
				File::write_file($filename,$sql);
			}
		}
		if($plugin==1)
		{
			//依赖插件安装
			$prepluginpath = './Public/Wap/'.$name.'/plugin';
			$list = File::get_dirs($prepluginpath);
			if(!empty($list['file']))
			{
				import('ORG.PclZip');
				foreach($list['file'] as $v)
				{
					$filename = substr($v,0,-4);
					$model = M('plugin');
					if(!$model->where("title='".$filename."'")->find())
					{
						//插件解压缩
						$zip =  new PclZip($prepluginpath.'/'.$v);
						$zip->extract(PCLZIP_OPT_PATH,'./Public/Plugin/'.$filename); 
						//安装插件
						$data['description'] = '';
						$data['author'] = '';
						$data['copyright'] = '';
						$xmlpath = './Public/Plugin/'.$filename.'/plugin.xml';
						if(file_exists($xmlpath))
						{
							$tag = simplexml_load_file($xmlpath);
							$data['author'] = (string)$tag->author; 
							$data['copyright'] = (string)$tag->copyright; 
							$data['description'] = (string)$tag->description; 
						}
						$data['status'] = 0;
						$data['title'] = $filename;
						$data['pubdate'] = time();
						$model->add($data);
						$path = './Public/Plugin/'.$filename.'/admin.php';
						if(file_exists($path))
						{
							set_include_path(__ROOT__);
							include($path);
							call_user_func(array($title.'Plugin','__install'));
						}
					}
				}
			}	
		}
		$this->success('操作成功!',U('Wap/index'));
	}
	
	public function edit()
	{
		C('TMPL_PARSE_STRING.__ROOT__','__ROOT__');
		C('TMPL_PARSE_STRING.__APP__','__APP__');
		C('TMPL_PARSE_STRING.__PUBLIC__','__PUBLIC__');
		$name = $this->_get('name');
		$path = './Public/Wap'.'/'.$name; 
		if(empty($name) or strpos($name,'/')) $this->error('参数不正确!');
		if(!is_dir($path)) $this->error('主题目录不存在!');
		$configfile = $path.'/theme.xml';
		$cachefile = $path.'/theme.php';
		if(!is_file($cachefile))
		{
			if(!is_file($configfile)) $this->error('无扩展配置信息!');
			$this->assign("field",$this->parsexml($configfile,''));
		}
		else
		{
			$cache = F('theme','',$path.'/');
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
		$tplpath = './Public/Wap/'.$name.'/';
		if(!is_dir($tplpath)) $this->error('主题目录不存在!');
		F('theme',$_POST,$tplpath);
		$this->success('操作成功!',U('Wap/index'));
	}

	public function doimport()
	{
		$filename = $this->_post('filename');
		$checkdir = $this->_post('checkdir');
		if(strtolower(substr($filename,-4))<> '.zip') $this->error('仅支持后缀为zip的压缩包');
		$path = ltrim($filename,__ROOT__.'/');
		$filename = substr(ltrim(strrchr($path,'/'),'/'),0,-4);
		$tplpath = './Public/Wap/'.$filename;
		if(is_dir($tplpath) && $checkdir<>1) $this->error('模板目录已存在!');
		if(!is_file($path)) $this->error('文件包不存在!');
		import('ORG.PclZip');
		$zip =  new PclZip($path);
		$zip->extract(PCLZIP_OPT_PATH,$tplpath); 
		$this->success('操作成功!',U('Wap/index'));
	}
	
	public function del()
	{
		$dir = $this->_get('name');
		if(strpos($dir,'/') or empty($dir)) $this->error('参数不正确!');
		if($GLOBALS['cfg_wap_tpl_default']==$dir) $this->error('默认主题不可以删除!');
		$path = './Public/Wap/'.$dir;
		if(!is_dir($path)) $this->error('目录不存在!');
		File::del_dir($path);
		$this->success('操作成功!',U('Wap/index'));
	}
	
	public function download()
	{
		$dir = $this->_get('name');
		if(strpos($dir,'/') or empty($dir)) $this->error('参数不正确!');
		$path = './Public/Wap/'.$dir;
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
	
	public function clear()
	{
		$path = './Web/Runtime';
		File::del_dir($path);
		$this->success('操作成功!',U('Wap/index'));
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
		$tplpath = './Public/Wap/'.$filename;
		if(is_dir($tplpath)) $this->error('模板目录已存在!');
		File::write_file($filepath,$content);
		import('ORG.PclZip');
		$zip =  new PclZip($filepath);
		$zip->extract(PCLZIP_OPT_PATH,$tplpath); 
		@unlink($filepath);//删除安装文件
		$this->success('操作成功!',U('Wap/index'));
	}
	
	//生成SQL备份语句
	public function insertsql($table, $row)
	{
		$sql = "INSERT INTO `{$table}` VALUES ("; 
		$values = array(); 
		foreach ($row as $value) 
		{
			$values[] = "'" . mysql_real_escape_string($value) . "'"; 
		}
		$sql .= implode(', ', $values) . ");\n"; 
		return $sql;
	}
}