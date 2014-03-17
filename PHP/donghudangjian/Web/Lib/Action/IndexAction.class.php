<?php
/***********************************************************
    [WaiKuCms] (C)2011 - 2013 waikucms.com
    
	@function WEB组 首页

    @Filename IndexAction.class.php $

    @Author pengyong $

    @Date 2013-01-01 23:43:06 $
*************************************************************/
class IndexAction extends CommonAction 
{
  public function index()
	{
		$arctype_table = M("Arctype");
		$archive_table = M("Archive");

		$filename = './Public/Tpl/'.$GLOBALS['cfg_df_style'].'/index.htm';
		//wap支持
		global $_mode;
		if($_mode=='wap') $filename = './Public/Wap/'.$GLOBALS['cfg_wap_tpl_default'].'/index.htm';
		$GLOBALS['_fields']['position'] = $this->position();
		if(!file_exists($filename)) $this->error('主题文件:'.$filename.' 不存在!');

		//公告栏
		unset($map);
		$map['typeid'] = 10;
		$rs_gonggao = $archive_table->where($map)->order('pubdate DESC')->select();
		$this->assign('gonggao', $rs_gonggao);

		//组工动态
		unset($map);
		$map['typeid'] = 11;
		$rs_zgdt = $archive_table->where($map)->order('pubdate DESC')->select();
		$this->assign('zgdt', $rs_zgdt);



		//首页显示的栏目
		unset($map);
		$map['is_index_main_display'] = 1;
		$rs_id = $arctype_table->where($map)->field('id')->order('sortrank_index_main_display ASC')->select();
		$rs_all = array();
		foreach ($rs_id as $k => $v) {
			unset($map);unset($rs);
			$map['typeid'] = $v['id'];
			$rs = $archive_table->where($map)->join("wk_arctype on wk_arctype.id = wk_archive.typeid")->field("wk_archive.*, wk_arctype.typename")->order('pubdate DESC')->limit(6)->select();
			$rs_all[] = $rs;
		}
		$this->assign('rs_all', $rs_all);




		$this->display($filename);
	}
	
	public function ad()
	{
		$map['id'] = (int)$_GET['id']; if($map['id']==0) die();
		$map['status'] = 1;
		$model = M('ad');
		$list = $model->field('content')->where($map)->find();
		if(!$list) die();
		$content = strtr($list['content'],array("'"=>"\\'"));
		//提前渲染解析内容
		$content = $this->fetch('',$content.' ');
		$js = "document.write('{$content}');";
		die($js);
	}
	
	public function special()
	{
		$map['id'] = $this->_get('id');
		$model = M('special');
		$list =  $model->where($map)->find();
		if(!$list) $this->error('专题不存在!');
		$list['tempindex'] = str_replace('{style}',$GLOBALS['cfg_df_style'],$list['tempindex']);
		$filename = './Public/Tpl/'.$list['tempindex'];
		//wap支持
		global $_mode;
		if($_mode =='wap')
		{
			$list['waptempindex'] = str_replace('{wapstyle}',$GLOBALS['cfg_wap_tpl_default'],$list['waptempindex']);
			$filename = './Public/Wap/'.$list['waptempindex'];
		} 
		if(!file_exists($filename)) $this->error('主题文件:'.$filename.' 不存在!');
		$GLOBALS['_fields'] = $list;
		$this->display($filename);
	}

}