<?php
/***********************************************************
    [WaiKuCms] (C)2012 waikucms.com
    
	@function 模型管理

    @Filename ArcmodelAction.class.php $

    @Author pengyong $

    @Date 2012-12-11 13:04:03 $
*************************************************************/
class ArcmodelAction extends CommonAction
{	
    public function index()
    {
		import('@.ORG.Page');
		$model = M('arcmodel');
		$count = $model->count();
		$fenye = 20;
		$p = new Page($count,$fenye); 
		$list = $model->limit($p->firstRow.','.$p->listRows)->select();
		$p->setConfig('prev','上一页');
		$p->setConfig('header','条记录');
		$p->setConfig('first','首 页');
		$p->setConfig('last','末 页');
		$p->setConfig('next','下一页');
		$p->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%<li><span>共<font color='#009900'><b>%totalRow%</b></font>条记录 ".$fenye."条/每页</span></li>");
		$this->assign('page',$p->show());
		$this->assign('list',$list);
		$this->display();
    }
	
	public function import()
	{
		$this->display();
	}
	
	public function doimport()
	{
		header("Content-type:text/html;charset=utf-8"); 
		$mode = $this->_post('mode');
		$checktable = $this->_post('checktable');
		if(!$mode) $this->error('request error!');
		if($mode=='file')
		{
			$filename = $this->_post('filename',false); 
			$filecontent = File::read_file(rtrim($_SERVER["DOCUMENT_ROOT"],'/').$filename);
		}
		else
		{	
			$filecontent = $this->_post('textname',false);
			$filecontent = stripslashes($filecontent);
		}
		$xml = simplexml_load_string($filecontent);
		$map['typename'] =  (string)$xml->typename;
		$map['nid'] =  (string)$xml->nid;
		$map['titlename'] =  (string)$xml->titlename;
		$map['addtable'] =  (string)$xml->addtable;
		if(empty($map['typename']) or empty($map['nid']) or empty($map['titlename']) or empty($map['addtable']))
		{
			$this->error('导入数据有误!导入失败!');
		}
		if(substr($map['addtable'],0,5)<>'addon') $this->error('附加表前缀必须为addon');
		$arcmodel =M('arcmodel');
		if($arcmodel->where("typename='".$map['typename']."'")->find()) $this->error("系统已存在相同内容,typename字段必须唯一!");
		if($arcmodel->where("nid='".$map['nid']."'")->find())$this->error("系统已存在相同内容,nid字段必须唯一!");
		$model = M();
		$result = $model->query("show tables like '".C('DB_PREFIX').$map['addtable']."'");
		if(!empty($result) && $checktable<>1) $this->error('附加数据表已存在!');
		//新增附加表
		$sql = "CREATE TABLE IF NOT EXISTS `".C('DB_PREFIX').$map['addtable']."` (";
		$sql.= "`id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '文档id',";
		$sql.= "`typeid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目id',";
		$sql.= "`body` mediumtext COMMENT '正文内容',";
		$sql.= "`redirecturl` varchar(255) NOT NULL COMMENT '跳转url',";
		$sql.="  PRIMARY KEY (`id`),KEY `typeid` (`typeid`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
		$arcmodel->execute($sql);
		//分析fieldset字段
		foreach ($xml->fieldset->field as $field)
		{
			$tag = array();
			//标签 name值
			$tag['name'] = (string)$field->attributes()->name;
			//标签类型 string,textarea,editor,checkbox,radio,select
			$tag['tag'] = (string)$field->attributes()->tag;
			//标签id
			$tag['id'] = (string)$field->attributes()->id;
			//提示说明内容
			$tag['alt'] = (string)$field->attributes()->alt;
			//默认值
			$tag['value'] = (string)$field->attributes()->value;
			//字段长度
			$tag['size'] = (string)$field->attributes()->size;
			//所在组: basic advance extend
			$tag['group'] = (string)$field->attributes()->group;
			//字符类型, text/hidden/password
			$tag['type'] = (string)$field->attributes()->type;
			//单标签,如 readonly,checked selected, checked#0 代表 第0个值被默认选择
			$tag['single'] = (string)$field->attributes()->single;
			// 编辑器 主题
			$tag['theme'] = (string)$field->attributes()->theme;
			//编辑器 文件管理
			$tag['fm'] = (string)$field->attributes()->fm;
			//应用样式
			$tag['style'] = (string)$field->attributes()->style;
			if(empty($tag['type'])) $tag['type'] = 'text';
			if(empty($tag['size'])) $tag['size'] = '50';
			if(empty($tag['theme'])) $tag['theme'] = 'default';
			if(empty($tag['id'])) $tag['id'] = $tag['name'];
			if(empty($tag['fm'])) $tag['fm'] = 'true';
			if(empty($tag['group'])) $tag['group'] = 'extend';
			if(empty($tag['tag'])) $tag['tag'] = 'input';
			if($tag['tag']=='textarea' || $tag['tag']=='editor')
			{
				$tag_tag = 'TEXT ';
			}
			else
			{
				$tag_tag	= "CHAR(".$tag['size'].") ";
			}
			if(!empty($tag['value'])) 
			{
				$tag_value = "NOT NULL DEFAULT '".$tag['value']."' ";
			}
			else
			{
				$tag_value = " NOT NULL ";
			}
			$alertsql = "ALTER TABLE `".C('DB_PREFIX').$map['addtable']."` ADD `".$tag_name."` ".$tag_tag.$tag_value;
			if(!empty($tag['name']) && !empty($tag['tag']))
			{
				$arcmodel->execute($alertsql);
			}
			//还原fieldset
			$map['fieldset'].="<field name='".$tag[name]."' value='".$tag['value']."' tag='".$tag['tag']." 'style='".$tag['style']."' theme='".$tag['theme']."' id='".$tag['id']."' fm='".$tag['fm']."' size='".$tag['size']."' single='".$tag['single']."' group='".$tag['group']."' alt='".$tag['alt']."' type='".$tag['type']."' />";
		}
		
		
		$basicfieldset = <<<FIELD
		<field name="redirecturl" tag="input" type="text"  id="redirecturl" size="50" group="basic" alt="跳转地址"/>
		<field name="body" tag="editor" id="Content" group="basic" style="width:800px;height:300px;" alt="正文内容"/>
FIELD;
		$map['fieldset'] = "<fieldset>".$basicfieldset.$map['fieldset']."</fieldset>";
		//新增模型
		$arcmodel->add($map);
		$this->success("导入成功!",U('Arcmodel/index'));
	}
	
	
	public function status()
	{
		$map['id'] = $this->_get('id');
		$arcmodel = M('arcmodel');
		$list = $arcmodel ->where($map)->find();
		if(!$list) $this->error('模型不存在!');
		if($list['status']==0) {$map['status']=1;}else{$map['status']=0;}
		$arcmodel->save($map);
		$this->success('操作成功!',U('Arcmodel/index'));
	}
	public function del()
    {
		$map['id'] = $this->_get('id');
		$arcmodel = M('arcmodel');
		$list = $arcmodel ->where($map)->find();
		if(!$list) $this->error('模型不存在!');
		$arcmodel->where($map)->delete();
		$this->success('操作成功!',U('Arcmodel/index'));
    }
	
	public function copy()
	{
		$map['id'] = $this->_get('id');
		$arcmodel = M('arcmodel');
		$arcmodellist = $arcmodel->where($map)->find();
		if(!$arcmodellist) $this->error('参数不正确!');
		$this->assign("arcmodellist",$arcmodellist);
		$this->display();
	}
	
}
?>