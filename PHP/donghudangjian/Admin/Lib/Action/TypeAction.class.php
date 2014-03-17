<?php
/***********************************************************
    [WaiKuCms] (C)2011 - 2012 waikucms.com
    
	@function 栏目管理

    @Filename TypeAction.class.php $

    @Author pengyong $

    @Date 2012-12-05 19:42:37 $
*************************************************************/
class TypeAction extends CommonAction
{
	public function index()
	{
		//栏目综合显示页面
		$model = M('arctype');
		//获取二叉树结构
		$list = $model->field("*,concat(path,'-',id) as bpath")->order('bpath')->select();
		$js ='function extendtree(){';
		foreach($list as $key=>$value)
		{
			$list[$key]['count'] = count(explode('-',$value['bpath']));
			if($list[$key]['count']==2)
			{
				$js.= "$('#{$value['bpath']}').show();"; 
			}
		}
		$js.= '}';
		//动态js脚本
		$js .= '$(document).ready(function(){';
		$js .='extendtree();';
		$js .='});';
		$this->assign("js",$js);
		$this->assign("list",$list);
		$this->display();
	}
	
	public function index_display_manage()
	{
		//栏目综合显示页面
		$model = M('arctype');
		//获取二叉树结构
		$list = $model->field("*,concat(path,'-',id) as bpath")->order('bpath')->select();
		// $js ='function extendtree(){';
		foreach($list as $key=>$value)
		{
			$list[$key]['count'] = count(explode('-',$value['bpath']));
			if($list[$key]['count']==2)
			{
				// $js.= "$('#{$value['bpath']}').show();"; 
			}
		}
		// $js.= '}';
		//动态js脚本
		// $js .= '$(document).ready(function(){';
		// $js .='extendtree(1);';
		// $js .='});';
		// $this->assign("js",$js);
		$this->assign("list",$list);
		$this->display();
	}

	public function save_index_display_manage()
	{
		// dump($_POST);
		$id_arr = $_POST['id'];
		$display_arr = !empty($_POST['is_index_main_display']) ? $_POST['is_index_main_display'] : null;
		$sortrank_arr = $_POST['sortrank_index_main_display'];
		// dump($sortrank_arr);

		$arctype_table = M("Arctype");
		$msg = "";
		foreach ($id_arr as $k => $v) {
			unset($map);unset($data);
			$map['id'] = $v;
			$data['sortrank_index_main_display'] = $sortrank_arr[$k];
			if ($display_arr && in_array($v, $display_arr)) {
				$data['is_index_main_display'] = 1;
			} else {
				$data['is_index_main_display'] = 0;
			}

			$rs = $arctype_table->where($map)->save($data);
			// echo $arctype_table->getLastSql();
			if ($rs) {
				$msg .= $v."数据更新成功 ";
			} else {
				$msg .= $v."数据无变化 ";
			}
		}

		$this->success($msg);
		// dump($msg);

	}

	public function add()
	{
		$list = array();
		if(isset($_GET['id']))
		{
			$data['id'] = (int)$_GET['id'];
			$model = M('arctype');
			$list  = $model ->where($data)->find();
			if(!$list) $list = array(); 
		}
		$this->assign('selecttreelist',$this->selecttree('add',$list));
		$this->assign('modellist',$this->getarcmodel());
		$this->display();
	}
	
	
	//获取栏目模型
	private function getarcmodel($method='add',$_arr = array())
	{
		$model = M('arcmodel');
		$list  =$model->field('id,nid,typename')->where('status=0')->select();
		if($method=='edit')
		{
			foreach($list as $key=>$value)
			{
				if($list[$key]['id']== $_arr['modelid'])
				{
					$list[$key]['selected'] = " selected='selected'";
				}
			}
		}
		return $list;
	}
	
	//栏目二叉树结构
	private function selecttree($method='add',$_arr=array())
	{
		$model = M('arctype');
		$list = $model->field("*,concat(path,'-',id) as bpath")->order('bpath')->select();
		if($method=='add')
		{
			foreach($list as $key=>$value)
			{
				$list[$key]['count'] = count(explode('-',$value['bpath']));
				if($_arr['id']==$list[$key]['id']) $list[$key]['selected'] = " selected='selected'";
			}
		}
		elseif($method=='edit')
		{
			//屏蔽当前栏目和当前栏目子栏目选择
			$ids = array();
			array_push($ids,$_arr['id']);
			$pathlist = $model->field('id,path')->select();
			foreach($pathlist as $k=>$v)
			{
				//file_put_contents('1.txt',substr($v['path'],0,strlen($_arr['path'].'-'.$_arr['id'])));
				if(substr($v['path'],0,strlen($_arr['path'].'-'.$_arr['id'])) == $_arr['path'].'-'.$_arr['id'])
				{
					array_push($ids,$v['id']);
				}
			}
			foreach($list as $key=>$value)
			{
				if($list[$key]['id']== $_arr['fid'])
				{
					$list[$key]['selected'] = " selected='selected'";
				}
				elseif(in_array($list[$key]['id'],$ids))
				{
					$list[$key]['selected'] = " disabled='disabled'";
				}
				else
				{
					$list[$key]['selected'] ='';
				}
				$list[$key]['count'] = count(explode('-',$value['bpath']));
			}
		}
		return $list;
	}	
	
	private function getdata($method='add')
	{
		$data = array();
		$data['fid'] = trim($_POST['fid']);
		$data['typename'] = trim($_POST['typename']);
		$data['modelid'] = trim($_POST['modelid']);
		$data['sortrank'] = trim($_POST['sortrank']);
		$data['seotitle'] = trim($_POST['seotitle']);
		$data['keywords'] = trim($_POST['keywords']);
		$data['modeltype'] = trim($_POST['modeltype']);
		$data['linkurl'] = trim($_POST['linkurl']);
		$data['description'] = trim($_POST['description']);
		$data['tempindex'] = trim($_POST['tempindex']);
		$data['templist'] = trim($_POST['templist']);
		$data['temparticle'] = trim($_POST['temparticle']);
		$data['waptempindex'] = trim($_POST['waptempindex']);
		$data['waptemplist'] = trim($_POST['waptemplist']);
		$data['waptemparticle'] = trim($_POST['waptemparticle']);

		$data['is_index_menu_display'] = trim($_POST['is_index_menu_display']);

		if (get_magic_quotes_gpc()) 
		{
			$data['content'] = stripslashes($_POST['content']);
		} 
		else 
		{
			$data['content'] = $_POST['content'];
		}
		if($method=='edit')
		{
			$data['id'] = trim($_POST['id']);
		}
		$model = M('arctype');
		if($data['fid']=='0')
		{
			$data['path']='0';
		}
		else
		{
			$list = $model->where('id='.$data['fid'])->find();
			if(!$list) return false;
			$data['path'] = $list['path'].'-'.$data['fid'];
		}
		return $data;
	}
	public function doadd()
	{
		$data =  $this->getdata();
		$model = M('arctype');
		$model->add($data);
		$this->success('操作成功!',U('Type/index'));
	}
	
	public function edit()
	{
		$data['id'] = (int)$_GET['id'];
		if($data['id']==0)
		{
			$this->error('参数不正确!');
		}
		$model = M('arctype');
		$list = $model->where($data)->find();
		$this->assign("list",$list);
		// dump($list);
		$this->assign("selecttreelist",$this->selecttree('edit',$list));
		$this->assign("modellist",$this->getarcmodel('edit',$list));
		$this->display();
	}
	
	public function doedit()
	{
		$model = M('arctype');
		$data = $this->getdata('edit');
		// dump($data);exit;
		//需要判断,当栏目下有子栏目的时候,子栏目的path是跟着在变动的
		$list = $model->field('id')->where('fid='.$data['id'])->select();
		if($list)
		{
			//存在子栏目,则子栏目的path 也需要变动
			foreach($list as $k=>$v)
			{
				$v['path'] = $data['path'].'-'.$data['id'];
				$model->save($v);
			}
		}

		$rs = $model->save($data);
		// dump($data);
		// echo $model->getLastSql();
		// dump($rs);exit;
		if($rs)
		{
			$this->success('操作成功!',U('Type/index'));
		}
		$this->error('未做更改!');
	}
	
	public function del()
	{
		//删除栏目
		$data['id'] = (int)$_GET['id'];
		if($data['id']==0) $this->error('参数不正确!');
		$model = M('arctype');
		if(!$model->where($data)->find()) $this->error('栏目ID不存在!');
		if($model->where('fid='.$data['id'])->find()) $this->error('当前栏目有子栏目.不能删除!');
		//当前栏目下有文章也不行,得提示先把文章给删除
		$arctiny = M('arctiny');
		if($arctiny->where("typeid=".$data['id'])->find()) $this->error('当前栏目下还有文章，请先删除所有的文章！');
		$model->where($data)->delete();
		$this->success('操作成功!',U('Type/index'));
	}
	public function delall()
	{
		$model = M('arctype');
		for($i=0;$i< count($_POST['id']);$i++)
		{
			$map['id'] = $_POST['id'][$i];
			$map['sortrank'] = $_POST['sortrank'][$i];
			$model->save($map);
		}
		$this->success("操作成功!",U('Type/index'));
	}
}